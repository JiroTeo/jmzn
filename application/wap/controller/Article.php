<?php
namespace app\wap\controller;
use think\Cache;
use think\Db;
use think\Controller;
class article{

    private $artModel;
    public function __construct(){
         // 实例化y用户模型
         $this->artModel = model('article');
    }

    /*  文章列表
     *  加盟咨询1/加盟攻略2/行业报告0
     *  文章列表    收藏
     * */
    public function article_list(){
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 0 ;//类型参数
        $isFow = isset($_REQUEST['is_fow']) ? $_REQUEST['is_fow'] : 0 ;
        //文章列表
        $artModel = model('article');
        $where['type'] = $type;
        $where['status'] = 1;
        //判断是否为个人收藏
        if($isFow == 1){//收藏列表

        }
        //获取文章数据
        $page = $_REQUEST['page'] - 1 ;
        $num = $page * 7;
        $limit = $num.',7';
        $data = $this -> artModel -> getArticleData($where,$limit,'reco_wap desc , id desc');
        $jsonData['code'] = 200;
        $jsonData['msg'] = '成功';
        $jsonData['data'] = $data;
        return json_encode($jsonData);
    }

    /*文章详情*/
    public function art_detail(){
        $returnCode = config('RETURNLOG');
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        if($token){
            $user = Cache::get($token);
        }
        $uid = empty($user['uid']) ? 0 : $user['uid'];
        //接收参数
        $where['id'] = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
        $where['status'] = 1;
        //获取文章数据
        $article = $this->artModel -> getArtDeta($where,$uid);

        //获取评论内容
        $comModel = model('comment');
        $comW['topic_id'] = $_REQUEST['id'];
        $comW['status'] = 1;
        $comW['pid'] = 0;
        $comment = $comModel -> getComment($comW);
        $data['article'] = $article;
        $data['comment'] = $comment;
        $dataList = $returnCode['SUCCESS'][0];
        $dataList['data'] = $data;
        wapReturn($dataList);



    }
}