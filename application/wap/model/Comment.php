<?php
namespace app\wap\model;

use think\Model;

class comment extends Model{

    private static $comModel; //
    private static $userModel; //

    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this->comModel = db('comment');
        $this->userModel = \model('user');
    }

    /*获取评论*/
    public function getComment($where,$limit =5 ){
        $Comment = $this -> comModel -> where($where) -> order('id desc') -> limit($limit) -> select();
        //格式化评论
        $data = $this -> formatCommontData($Comment);
        return $data;
    }

    /*格式化评论数据*/
    public function formatCommontData($data){
        //定义变量
        $formatData = array();
        $userData = array();
        $where = array();
        foreach ($data as $key => $value) {
            $formatData[$key]['id'] = $value['id'];//评论内容
            $formatData[$key]['content'] = $value['content'];//评论内容
            $formatData[$key]['comment'] = array();//评论内容
            $formatData[$key]['likes'] = $value['like_num'];//评论内容
            $where['uid'] = $value['form_uid'];
            $userData = $this -> userModel -> getUser($where);
            $formatData[$key]['username'] = empty($userData['uname']) ? '' : $userData['uname'] ;//用户名
            $formatData[$key]['userAvatar'] = empty($userData['avatar']) ? 'https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=124322766,2809385387&fm=26&gp=0.jpg' : $userData['avatar'] ;//用户头像
            $formatData[$key]['uid'] = $userData['uid'];//用户头像
            $formatData[$key]['is_follow'] = 1;
            $formatData[$key]['is_like'] = 0;
            $formatData[$key]['time'] = date('Y-m-d H:i:s',$value['addtime']);
            $backWhere['pid'] = $value['id'];
            $backWhere['status'] = 1;
            $formatData[$key]['comment'] = $this -> getComment($backWhere);
        }
        return $formatData;
    }

    /*统计评论数量*/
    public function getComCount($where){
        $num = $this -> comModel -> where($where) -> count();
        return $num;
    }

    /*添加评论*/
    public function addComment($data){
        $getId = $this -> comModel -> insertGetId($data);
        return $getId;
    }

    /*个人中心-我的评论格式*/
    public function getCommentData($where,$limit=5){
        $data = $this -> comModel -> where($where) -> order('id desc') -> limit($limit) -> select();
        if($data){
            $dataList = $this -> formatData($data);
        }else{
            $dataList = array();
        }

        return $dataList;

    }
    /*格式化-个人中心-我的评论-格式化*/
    public function formatData($data){
        if(empty($data)){
            return array();
        }
        $articleModel = \model('article');
        $where = array();
        $itemWhere = array();
        $image = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            $where['uid'] = $value['form_uid'];
            $userData = $this -> userModel -> getUser($where);
            $dataList[$key]['avatar'] = empty($userData['avatar']) ? $image['AVATAR'] : trim($userData['avatar'],'.');
            $dataList[$key]['username'] = empty($userData['uname']) ? '' : $userData['uname'];
            $articleWhere['id'] = $value['topic_id'];
            $articleWhere['status'] = 1;
            $itemData = $articleModel -> getArticleListData($articleWhere);
             if(empty($itemData)){
                $dataList[$key]['item']['content'] = '文章已下架';
             }else{
                 $dataList[$key]['item'] = $itemData;
             }

        }
        return $dataList;
    }

    /*点赞操作*/
    public function commentLike($where){
        $res = $this -> comModel -> where($where) -> setInc('like_num');
        return $res;
    }

}