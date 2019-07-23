<?php
namespace app\wap\controller;
use think\Cache;
use think\Db;
use think\Controller;
class follow{

    private $follModel;

    public function __construct(){
        // 实例化y用户模型
        $this->follModel = model('follow');
    }

    /*关注*/
    public function addFoll(){
        //定义返回参数
        $returnCode = config('RETURNLOG');
        //接收参数 && 验证
        if(empty($_REQUEST)){
            wapReturn($returnCode['ERROR']['1']);
        }
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user['uid'])){
            wapReturn($returnCode['ERROR']['5']);
        }
        $data['uid'] = $user['uid'];    //用户id
        $data['tid'] = $_REQUEST['id'];//被关注id
        $data['ftype'] = $_REQUEST['type'];//关注类型 1关注项目2收藏项目3收藏文章
        $res = $this -> follModel -> addData($data);
        if($res){
            $return = $returnCode['SUCCESS'][0];
            //消息通知 关注项目没有消息通知
            if($_REQUEST['type'] != 1){
                //定义参数
                $noticeData['tid'] = $_REQUEST['id'];
                $noticeData['form_uid'] = $user['uid'];
                $noticeModel = model('notice');
                //收藏项目
                if($_REQUEST['type'] == 2){

                    $noticeData['type'] = 5;
                    $noticeModel -> add_notice($noticeData);

                }else if($_REQUEST['type'] == 3){//收藏文章

                    $noticeData['type'] = 6;
                    $noticeModel -> add_notice($noticeData);

                }
            }
        }else{
            $return = $returnCode['ERROR'][0];
        }
        wapReturn($return);
    }

    /*取消关注*/
    public function remove_follwo(){
        $returnCode = config('RETURNLOG');
        //验证login
        $token = $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //接收参数
        $where['tid'] = array('in',$_REQUEST['id']);//被关注的id
        $where['uid'] = $user['uid'];
        $where['ftype'] = $_REQUEST['type'];
        //执行删除操作
        $result = $this -> follModel -> delFollow($where);
        if($result){
            $dataList = $returnCode['SUCCESS'][0];
        }else{
            $dataList = $returnCode['ERROR'][0];
        }
        wapReturn($dataList);
    }

    /*获取关注OR收藏项目*/
    public function get_my_follow(){
        //定义返回参数
        $returnCode = config('RETURNLOG');
        $token = $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //查询我的关注
        $where['status'] = 1;
        $where['uid'] = $user['uid'];;
        $where['ftype'] = empty($_REQUEST['type']) ? 1 : $_REQUEST['type'];
        $itemId = $this -> follModel -> getTid($where);
        $isItemId = trim($itemId,',');
        if(empty($isItemId)){
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = array();
            wapReturn($dataList);
        }
//        获取关注的专题列表
        $itemWhere['id'] = array('in',$isItemId);
        $itemWhere['status'] = 1;
        $itemModel = model('item');
        $data = $itemModel -> getItem($itemWhere);
        if($data){
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = $data;
        }
        wapReturn($dataList);
    }

    /*获取关注OR收藏的文章*/
    public function get_coll_article(){
        $returnCode = config('RETURNLOG');
        //接收参数 && 验证 && 格式化
        if(empty($_REQUEST)){
            $dataList['data'] = array();
            $dataList['data'] = $returnCode['ERROR'][1];
            wapReturn($dataList);//参数错误
        }
        //验证token以及login
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'] ;
        if(empty($token)){
            wapReturn($returnCode['ERROR'][1]);
        }
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //接收 && 格式化数据
        $where['ftype'] = $_REQUEST['type'];//关注收藏类型0关注用户1关注项目2收藏项目3收藏文章
        $where['status'] = 1;
        $where['uid'] = $user['uid'];
        //获取收藏的文章主键
        $getTid = $this -> follModel -> getTid($where);
        //查询文章的数据
        $articleModel = model('article');
        $artiW['id'] = array('in',trim($getTid,','));
        $artiW['status'] = 1;
        $artiW['type'] = empty($_REQUEST['ftype']) ? 0 : $_REQUEST['ftype'];//文章类型0行业报告1咨询2攻略
        $data = $articleModel -> getArticleData($artiW);
        $dataList = $returnCode['SUCCESS'][0];
        $dataList['data'] = $data;
        //改变消息通知状态为已读start
        $noticeData['uid'] = $user['uid'];
        $noticeData['type'] = 6;
        model('notice') -> read_notice($noticeData);
        //改变消息通知状态为已读end
        wapReturn($dataList);
    }
}