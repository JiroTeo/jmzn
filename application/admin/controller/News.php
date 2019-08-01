<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class news extends Base{

    /*站内信列表*/
    public function index(){

        $newModel = db('news');
        $userModel = db('user');
        $newsDataWhere['status'] = $_GET['status'];
        $newData = $newModel -> order('status desc,id desc') -> where($newsDataWhere) -> paginate(10);
        $page = $newData -> render();
        $data = iterator_to_array($newData);
        $where = array();
        foreach ($data as $key => $value) {
            $where['uid'] = $value['uid'];
            $user = $userModel -> where($where) -> find();
            $data[$key]['username'] = empty($user['uname']) ? '' : base64_decode($user['uname']);
            $data[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
        }
        $this -> assign('data',$data);
        $this -> assign('page',$page);
        $this -> assign('status',$_GET['status']);
        return view();
    }
    /*发布站内通知*/
    public function add_news(){
        if(empty($_POST)){
            return view();
        }else{
            //接收参数
            $add['uid'] =  $_SESSION['admin']['uid'];
            $add['title'] =  $_POST['title'];
            $add['content'] =  $_POST['content'];
            $add['status'] =  1;
            $add['addtime'] =  time();
            $newId = db('news') -> insertGetId($add);
            if(empty($newId)){
                $this -> error('发布失败');
            }else{
                $this -> addNotice($newId);
                $this -> success('发布成功');
            }
        }
    }
    /*删除站内信*/
    public function del_news(){
        $where['id'] = $_POST['id'];
        $data['status'] = 0;
        $result = db('news') -> where($where) -> update($data);
        if($result){
            echo  1;
        }else{
            echo 0;
        }
    }

    /*执行给所有用户添加站内信操作*/
    public function addNotice($tid){
        $noticeModel = db('notice');
        $where['status'] = 1;
        $userData = db('user') -> where($where) -> select();
        $add['content'] = '站内通知';
        $add['form_uid'] = 1;
        $add['read'] = 0;
        $add['status'] = 1;
        $add['tid'] = $tid;
        foreach ($userData as $key => $value) {
            $add['addtime'] = time();
            $add['uid'] = $value['uid'];
            $noticeModel -> insertGetId($add);
        }
    }

    /*  推送的通知列表 */
    public function user_con_list(){
        $newModel = db('news');
        $userModel = db('user');
        $newsDataWhere['status'] = $_GET['status'];
        $newData = $newModel -> order('status desc,id desc') -> where($newsDataWhere) -> paginate(10);
        $page = $newData -> render();
        $data = iterator_to_array($newData);
        $where = array();
        foreach ($data as $key => $value) {
            $where['uid'] = $value['uid'];
            $user = $userModel -> where($where) -> find();
            $data[$key]['username'] = empty($user['uname']) ? '' : base64_decode($user['uname']);
            $data[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
        }
        $this -> assign('data',$data);
        $this -> assign('page',$page);
        $this -> assign('status',$_GET['status']);
        return view();
    }

    /*  推送消息    */
    public function push_consult(){
        $data = $this -> request -> param();
        if(empty($data)){
            return view();
        }else{
            dump($data);die;
            //验证手机号
//            name    content item_id sex addtime intention type  uid=1 read = 0 status=1;
            $addData['item_id'] = 0;
            $addData['addtime'] = time();
            $addData['type'] = 2;//站内通知
            $addData['read'] = 0;
            $addData['status'] = 1;
            $addData['name'] = $data['name'];
            $addData['content'] = $data['content'];
            $addData['sex'] = $data['sex'];
            $addData['phone'] = $data['phone'];
            $addData['to_uid'] = $data['to_uid'];
            $result = db('consult') -> insertGetId($addData);
            if(empty($result)){
                $this -> error('添加推送失败');
            }else{
                $this -> error('添加推送成功');
            }
        }
    }
}