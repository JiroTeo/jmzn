<?php
namespace app\index\model;

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
    public function getComment($where = false , $order = false , $limit =5 , $type = false , $user = false ,$debug = 0){
        $Comment = $this -> comModel -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($Comment)){    return [];  }
        //格式化评论
        $data = $this -> formatCommontData($Comment,$debug);
        return $data;
    }

    /*格式化评论数据*/
    public function formatCommontData($data,$debug){
        //定义变量
        $where = [];
        foreach ($data as $key => $value) {
            $formatData[$key]['id'] = $value['id'];//评论内容
            $formatData[$key]['content'] = $value['content'];//评论内容
            $formatData[$key]['likes'] = $value['like_num'];//评论内容
            $where['uid'] = $value['form_uid'];
            $userData = $this -> userModel -> getUserData($where);
            $formatData[$key]['username'] = empty($userData['username']) ? '' : $userData['username'] ;//用户名
            $formatData[$key]['userAvatar'] = $userData['avatar'];//用户头像
            $formatData[$key]['uid'] = $userData['uid'];//
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
    public function getCommentData($where = false , $order = false , $limit=5 , $type = false , $user = false , $debug= false ){
        $data = $this -> comModel -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($data)){   return [];  }
		switch ($type) {
			case 1:
                $dataList = $this -> formatMyCenterComment($data,$debug);
				break;

			default:
		        $dataList = $this -> formatMyCenterComment($data,$debug);
				break;
		}
        return $dataList;
    }

    /*  格式化-个人中心-我的评论-文章&&评论 格式*/
    public function formatMyCenterComment($data,$debug){
        $model = \model('article');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            //文章数据
            $articleData = $model -> getArticleData(['id'=>$value['topic_id']] , false , 1 , 3 , false , $debug);
            $dataList[$key]['article'] = $articleData[0];
        }
        return $dataList;
    }

    /*格式化-个人中心-我的评论-格式化 todo 是否启用？*/
    public function formatData($data){
        if(empty($data)){
            return array();
        }
        $articleModel = \model('article');
        $where = array();
        $itemWhere = array();
        $image = config('IMAGE');
        foreach ($data as $key => $value) {
//            $dataList[$key]['id'] = $value['id'];
//            $dataList[$key]['content'] = $value['content'];
//            $dataList[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            $where['uid'] = $value['form_uid'];
            $userData = $this -> userModel -> getUserData($where);
            $dataList[$key]['avatar'] = empty($userData['avatar']) ? $image['AVATAR'] : trim($userData['avatar'],'.');
            $dataList[$key]['username'] = empty($userData['uname']) ? '' : $userData['uname'];
            $articleWhere['id'] = $value['topic_id'];
            $articleWhere['status'] = 1;
            $itemData = $articleModel -> getArticleDataOnce($articleWhere);
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

    /*  統計數量    */
    public function countNum($where){
        $count = $this -> comModel -> where($where) -> count();
        return $count;
    }

}