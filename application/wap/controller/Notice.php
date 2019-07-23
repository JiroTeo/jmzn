<?php
namespace app\wap\controller;
use think\Cache;
use think\Db;
use think\Controller;
class notice{

    private $noticeModel;

    public function __construct()
    {
        // 实例化y用户模型
        $this-> noticeModel = model('notice');
    }

    /*评论和赞*/
    public function like_notice(){
        $returnCode = config('RETURNLOG');
        $token = empty($_REQUEST['token']) ? null : $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        $userModel = db('user');
        $commentModel = db('comment');
//        获取noticeData
        $getNoticeWhere['uid'] = $user['uid'];
        $getNoticeWhere['uid'] = 1;
        $getNoticeWhere['status'] = 1;
        $getNoticeWhere['type'] = array('in','1,2');
        $noticeData = db('notice') -> where($getNoticeWhere) -> select();
        if(empty($noticeData)){
            $dataList = $returnCode['ERROR'][4];
            $dataList['data'] = array();
            wapReturn($dataList);
        }
        foreach ($noticeData as $key => $value) {
            //获取发起通知的用户信息
            $getUserWhere['uid'] = $value['form_uid'];
            $formUserData = $userModel -> where($getUserWhere) -> find();
            //发起通知用户信息
            $userOper['username'] = empty($formUserData['uname']) ? '' : base64_decode($formUserData['uname']) ;
            $userOper['avatar'] = empty($formUserData['avatar']) ? '' : 'https://'.$_SERVER['SERVER_NAME'].trim($formUserData['avatar'], '.') ;
            //通知内容
            $userOper['content'] = $value['content'];
            $userOper['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
            $userOper['type'] = $value['type'];//通知类型 通知类型0站内通知1回复留言2赞
            //被通知用户信息
            $where['uid'] = $value['uid'];
            $userData = $userModel -> where($where) -> find();
            $comment['username'] = empty($userData['uname']) ? '' : base64_decode($userData['uname']);
            //获取被点赞的留言内容
            $commentWhere['id'] = $value['tid'];
            $commentData = $commentModel -> where($commentWhere) -> find();
            $comment['content'] = empty($commentData['content']) ? '' : $commentData['content'];
            $data[$key]['comment'] = $comment;
            $data[$key]['userOper'] = $userOper;
            $data[$key]['type'] = $value['type'];
            $data[$key]['id'] = $value['id'];
        }
        //改变消息通知状态为已读start
        $notiData['uid'] = $user['uid'];
        $notiData['type'] = array('in','1,2');
        $this -> noticeModel -> read_notice($notiData);
        //改变消息通知状态为已读end

        //返回
        $dataList = $returnCode['SUCCESS'][0];
        $dataList['data'] = $data;
        wapReturn($dataList);
    }
    /*站内通知*/
    public function notice_content(){
        $returnCode = config("RETURNLOG");
        //验证登录
        $token = $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //获取站内通知
        $where['type'] = 0;
        $where['status'] = 1;
        $where['uid'] = $user['uid'];
        $noticeData = db('notice') -> where($where) -> select();
        if(empty($noticeData)){
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = array();
        }else{
           $newsModel = db('news');
            foreach ($noticeData as $key => $value) {
                $newWhere['id'] = $value['tid'];
                $newsData = $newsModel -> where($newWhere) -> find();
                $data[$key]['content'] = $newsData['content'];
                $data[$key]['title'] = $newsData['title'];
                $data[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            }
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = $data;
        }
        //改变消息通知状态为已读start
        $nocData['uid'] = $user['uid'];
        $nocData['type'] = 0;
        $this -> noticeModel -> read_notice($nocData);
        //改变消息通知状态为已读end
        wapReturn($dataList);
    }

    /*消息通知提示*/
    public function get_notice_num(){
        $returnCode = config('RETURNLOG');
        //验证登录
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //未读消息数量
        $where['uid'] = $user['uid'];
        $where['read'] = 0;
        $where['status'] = 1;
        //评论和赞
        $where['type'] = array('in','1,2');
        $data['pl_num'] = $this -> noticeModel -> count_notice($where);
        //站内消息
        $where['type'] = 0;
        $data['news_num'] = $this -> noticeModel -> count_notice($where);
        //投资者提示
        $where['type'] = 3;
        $data['consult_inv_num'] = $this -> noticeModel -> count_notice($where);
        //留言提示
        $where['type'] = 4;
        $data['consult_notice_num'] = $this -> noticeModel -> count_notice($where);
        //项目收藏提示
        $where['type'] = 5;
        $data['item_num'] = $this -> noticeModel -> count_notice($where);
        //文章收藏提示
        $where['type'] = 6;
        $data['article_num'] = $this -> noticeModel -> count_notice($where);
        $data['count'] = $data['pl_num']+$data['news_num'];
        //返回数据
        $dataList = $returnCode['SUCCESS'][0];
        $dataList['data'] = $data;
        wapReturn($dataList);
    }
}