<?php
namespace app\wap\model;

use think\Model;

class article extends Model{

    private static $articleModel; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> articleModel = db('article');
    }

    /*获取文章列表数据*/
    public function getArticleData( $where , $limit=5 , $order = 'id desc' ){
        $articleData = $this -> articleModel -> where($where) -> order($order) -> limit($limit) -> select();
        //格式化用户数据
        $data = $this -> formatArticleData($articleData);
        return $data;

    }

    /*获取文章列表数据-仅调用一次*/
    public function getArticleListData($where){
        $data = $this -> articleModel -> where($where) -> find();
        if(empty($data)){
            return array();
        }
        //格式化用户数据
        $dataList['title'] = $data['title'];
        //分割封面图
        $image = explode(',',$data['img']);
        $dataList['img_url'] = empty($image[0]) ? '' : 'https://www.jiamengzhinan.com'.trim($image[0],'.');
        $dataList['sign'] = $data['sign'];
        $dataList['id'] = $data['id'];
        $dataList['read_num'] = $data['read_num'];
        $dataList['type'] = $data['type'];
        $dataList['addtime'] = date("Y-m-d H:i:s",$data['addtime']);
        $userWhere['uid'] = $data['uid'];
        $userData = db('user') -> where($userWhere) -> find();
        $dataList['avatar'] = empty($userData['avatar']) ? 'https://www.jiamengzhinan.com/uploads/defultavatar.jpg' : 'https://www.jiamengzhineng.com'.trim($userData['avatar'],'.');$dataList['username'] = empty($userData['uname']) ? '' : base64_decode($userData['uname']);
        $dataList['uid'] = $data['uid'];
        return $dataList;
    }

    /*格式化文章列表数据*/
    public  function formatArticleData($data){
        $formatData = array();
        $userModel  = \model('user');
        $comModel = \model('comment');
        $where = array();
        $userW = array();
        $userData = array();
        foreach ($data as $index => $datum) {

            $formatData[$index]['id'] = $datum['id'];
            $formatData[$index]['sign'] = $datum['sign'];
            $formatData[$index]['avde'] = $datum['reco_wap'];//特殊标识（广告）
            $formatData[$index]['title'] = $datum['title'];
            //字符串转数组
            $imgArr = array();
            $imgArr = explode( ',',$datum['img']);
            $image = array();
            if($datum['type'] == 1){
                foreach ($imgArr as $key => $value) {
                    $image[] = "http://".$_SERVER['SERVER_NAME'].$value;
                }
                $formatData[$index]['img'] = $image;
            }else{
                $formatData[$index]['img'] = "http://".$_SERVER['SERVER_NAME'].$imgArr[0];
            }
            $formatData[$index]['read_num'] = $datum['read_num'];
            $formatData[$index]['addtime'] = date('Y-m-d H:i:s',$datum['addtime']);

            $where['status'] = 1;
            $where['topic_id'] = $datum['id'];
            $formatData[$index]['comment_num'] = $comModel -> getComCount($where);;//评论数量
            $formatData[$index]['read_num'] = $datum['read_num'];//阅读数
            //获取发布人
            $userW['uid'] = $datum['uid'];
            $userData = $userModel -> getUser($userW);
            $formatData[$index]['username'] = isset($userData['uname']) ? base64_decode($userData['uname']) : '' ;;
            $formatData[$index]['avatar'] = empty($userData['avatar'])
                ? 'https://'.$_SERVER['SERVER_NAME'].'/uploads/defultavatar.jpg'
                : 'https://'.$_SERVER['SERVER_NAME'].$userData['avatar'];//用户头像

        }
        return isset($formatData) ? $formatData : array() ;
    }

    /*获取单条文章数据*/
    public function getArtDeta($where,$uid=0){
       $artData = $this -> articleModel -> where($where) -> find();
//       dump($artData);die;
       //格式化数据
        $data = $this -> formatArticleDetailData($artData,$uid);
        return $data;
    }

    /*格式化文章详情数据*/
    public function formatArticleDetailData($data,$uid){
        //定义变量
        $userModel = \model('user');
        //格式化数据
        $formatData['title'] = $data['title'];//文章标题
        $formatData['id'] = $data['id'];//文章标题
        $formatData['uid'] = $data['uid'];//文章标题
        $formatData['sign'] = $data['sign'];//介绍
        $formatData['detail'] = $data['detail'];
        $formatData['addtime'] = date('Y-m-d H:i:s',$data['addtime']);//发布时间
        //获取用户名
        $userW['uid'] = $data['uid'];
        $userData = $userModel -> getUser($userW);
        $formatData['username'] = isset($userData['uname']) ? $userData['uname'] : '';
        $formatData['useravatar'] = empty($userData['avatar']) ? '' : $userData['avatar'] ;
        $likeWhere['ftype'] = 3;
        $likeWhere['uid'] = $uid;
        $likeWhere['tid'] = $data['id'];
        $likeWhere['status'] = 1;
        $foData = db('follow') -> where($likeWhere) -> find();
        $formatData['is_like'] = empty($foData) ? 0 : 1;
        return $formatData;
    }

}