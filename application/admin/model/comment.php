<?php
namespace app\admin\model;

use think\Model;

class comment extends model{

    private static $commentModel; // 

    // 
    public function __construct(){
        parent::__construct();
        $this -> commentModel = db('comment');
    }

    //获取文章评论数据
    public function getArticleCommentList($where = false , $order = false , $limit = false , $type = false ){
        $data = $this -> commentModel -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($data)){   return [];  }
        //格式化数据
        $dataList = $this -> formatArticleCommentDataList($data);
        return $dataList;

    }

    /*  格式化文章评论数据   */
    public function formatArticleCommentDataList($data = false , $type = false ){
        $userModel = \model('user');
        foreach ($data as $key => $value) {
            $userInfo = $userModel -> getUserData(['uid'=>$value['form_uid']]);
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['username'] = $userInfo['username'];
            $dataList[$key]['avatar'] = $userInfo['avatar'];
            $dataList[$key]['uid'] = $userInfo['uid'];
            $dataList[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            $dataList[$key]['child'] = $this -> getArticleCommentList(['pid'=>$value['id']],'addtime desc');
        }
        return $dataList;
    }

}