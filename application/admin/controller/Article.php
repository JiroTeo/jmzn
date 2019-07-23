<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class article extends Base{
   // 构造方法
     public function __construct(){
        parent::__construct();
        // 实例化分类模型
        $this -> articleModel = model('article');
        
    }
    /* @param  文章列表
     * @param  删除文章
     * @param  发布文章
     * @param  文章详情
     * @param  修改文章
     * @param  推荐文章
     * @param  查看文章留言
     * **/

    /*文章列表*/
    public function article_list(){
        // 验证是否有参数传来
        if(isset($_GET['type'])){
            $where['type'] = $_GET['type'];
        }
        $where['status'] = 1;
        $aData = db('article') -> where($where) -> order('id desc') -> paginate(10);
        $page = $aData->render();
        // 实例化用户模型。查询发布人
        $userModel = model('user');
        // 遍历数据 将用户id 所对应的用户名查询出来
        $bData = iterator_to_array($aData);
        foreach ($bData as $key => $value) {
            // 调用查询用户方法 查询用户信息
            $cond['uid'] = $value['uid'];
            $userData = $userModel->findUser($cond);
            $username = base64_decode($userData['uname']);
            $bData[$key]['username'] = $username;
            $bData[$key]['img'] = explode(',', $value['img']);
            $bData[$key]['addtimie'] = date("Y-m-d",$value['addtime']);
            switch ($value['type']) {
                case 0:
                    $bData[$key]['type'] = '行业报告';
                    break;
                case 1:
                    $bData[$key]['type'] = '加盟资讯';
                    break;
                case 2:
                    $bData[$key]['type'] = '加盟攻略';
                    break;
            }
        }
        $this -> assign('page',$page);
        $this -> assign('data',$bData);
        return view();
    }

    /*删除文章*/
    public function article_del(){
        $where['id'] = $_POST['id'];
        $data['status'] = 0;
        $res = $this -> articleModel -> delArticle($where,$data);
        if($res){
            $this -> success('删除文章成功');
        }else{
            $this -> error('删除文章失败');
        }
        
    }

    /*发布文章*/
    public function article_add(){
        // 接收数据
        $data = input('post.');
        if($data){
            if(!empty($data['img'])){//验证是否有上传图片
                $data['img'] = implode(',',$data['img']);
            }
            $data['uid'] = $_SESSION['admin']['uid'];
            $data['item_id'] = empty($_POST['item_id']) ? 0 : $_POST['item_id'] ;
            $data['addtime'] = time();
            $res = $this -> articleModel -> addArticle($data);
            if($res){
                $this -> success('发布成功');
            }else{
                $this -> error('发布失败');
            }
        }else{
            $item_id = empty($_GET['id']) ? 0 : $_GET['id'];
            $this -> assign('item_id',$item_id);
            return view();
        }
    }
    /*文章详情页面*/
    public function article_detail(){
        // 根据id查询文章
        $where['id'] = $_GET['id'];
        $where['status'] = 1;           //文章状态 查询的必须是有效文章
        $data = $this -> articleModel -> articleDetail($where);
        //获取文章的留言
        $cwhere['topic_id'] = input('get.id');
        $cwhere['pid'] = 0;
        $cwhere['status'] = 1;
        $comment = model('comment') -> getArticleCommentList($cwhere,'addtime desc');
        $commentNum = count($comment);
        $this -> assign('comment',$comment);
        $this -> assign('commentNum',$commentNum);
        $this -> assign('data',$data);
        return view();
    }

    /*修改文章页面*/
    public function edit_article(){
        if($_POST){
            if(!empty($_POST['img'])){//验证是否有上传图片
                $data['img'] = implode(',',$_POST['img']);
            }
            $data['title'] = $_POST['title'];
            $data['sign'] = $_POST['sign'];
            $data['type'] = $_POST['type'];
            $data['detail'] = $_POST['detail'];
            $where['id'] = $_POST['id'];
            $result = db('article') -> where($where) -> update($data);
            if($result){
                $this -> success('修改成功');
            }else{
                $this -> error('修改失败');
            }
        }else{
            $where['id'] = $_GET['id'];
            $articleData = db('article') -> where($where) -> find();
            $articleData['img'] = explode(',',$articleData['img']);

            $this -> assign('data',$articleData);
            return view();
        }
    }

    /*文章推荐*/
    public function change_article(){
        $articleModel = model('article');
        //验证type
        $type = empty($_REQUEST['type']) ? 0 : $_REQUEST['type'];
        $where['id'] = $_REQUEST['id'];

        switch ($type) {
        case 1://修改推荐状态
            $save['reco'] = $_REQUEST['reco'];
            break;
        case 2://排序
            $save['order'] = $_REQUEST['order'];
            break;
        case 3://
            $save['reco_wap'] = $_REQUEST['reco_wap'];
            break;
        default:
            $this -> error('你到底想干啥');
            break;
        }
        $result = $articleModel -> where($where) -> update($save);
        if($_POST){//ajax请求
            if($result){
                echo 1;return;
            }else{
                echo 0;return;
            }
        }
        if($result){
            $this -> success('SUCCESS');
        }else{
            $this -> error('LOSE');
        }
    }

    /*获取留言信息*/
    public function get_article_comment(){
        $commentModel = db('comment');
        $w['topic_id'] = $_GET['id'];
        $w['status'] = 1;
        $w['pid'] = 0;
        $commentData = $commentModel -> where($w) -> order('addtime desc') -> select();
        foreach ($commentData as $key => $value) {
            $commentData[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
            $commentData[$key]['com'] = $this -> get_reply($value['id']);
        }
        $this -> assgin('data',$commentData);
        return view();
    }

    /*回调函数-获取文章留言下回复*/
    public function get_reply($pid){
        $commentModel = db('comment');
        $where['pid'] = $pid;
        $data = $commentModel -> where($where) -> order('addtime desc') -> select();
        foreach ($data as $key => $value) {
            $data[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
        }
        $data = empty($data) ? array(): $data;
        return $data;
    }

}