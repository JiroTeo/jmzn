<?php
namespace app\wap\controller;
use think\Cache;
use think\Db;
use think\Controller;
class item{

    private $itemModel;

    public function __construct()
    {
        // 实例化y用户模型
        $this->itemModel = model('item');
    }

    /*产品详情
     *  @param  TODO 项目详情
     * */
    public function item_detail(){
        //获取专题信息
        $returnCode = config('RETURNLOG');
        //接收token并且解析。足迹节点使用
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        $user = Cache::get($token);
        //个人中心访问品牌页面
        if(empty($_REQUEST['id'])){
            //验证登录
            if(empty($user)){
                wapReturn($returnCode['ERROR'][5]);
            }
            $uid = $user['uid'];
            $itemWhere['wid'] = $uid;
            $itemWhere['status'] = 1;
            $itemData = $this -> itemModel -> getItemData($itemWhere);
            if(empty($itemData)){
                wapReturn($returnCode['ERROR'][4]);
            }
            $id = $itemData['id'];
        }else{
            $id = $_REQUEST['id'];
        }
        //添加到足迹1、验证登录。
        if(!empty($user['uid'])){
            $trackWhere['tid'] = $id;
            $trackWhere['uid'] = $user['uid'];
            $trackWhere['type'] = 1;
            $trackModel = model('track');
            $trackModel -> addTrack($trackWhere);
        }

        $token = empty($_REQUEST['token']) ? null : $_REQUEST['token'];
        if($token != null){
            $user = Cache::get($token);
        }else{
            $user = array();
        }
        $where['status'] = 1 ;
        $where['id'] = $id;
        $itemData = $this -> itemModel -> itemDetail($where,$user);
        if(empty($itemData)){
            $dataList = $returnCode['ERROR'][4];
            $dataList['data'] = array();
            wapReturn($dataList);
        }
        $data['code'] = 200;
        $data['msg'] = '成功';
        $data['data']['item'] = $itemData;
        //获取资讯信息
        $consultModel = Model('consult');
        //获取在线咨询信息
        $conWhere['item_id'] = $id;
        $conWhere['type'] = 0;
        $consult = $consultModel -> getConsultData($conWhere);
        $data['data']['comment'] = $consult;
        //猜你喜欢。获取同类型id
        $likeWhere['cate_id'] = $itemData['cate_id'];
        $likeItem = $this -> itemModel -> getItem($likeWhere,4);
        $data['data']['like'] = $likeItem;
        //加盟攻略
        $artWhere['item_id'] = $id;
        $artWhere['status'] = 1;
        $articleModel = model('article');
        $article = $articleModel -> getArticleData($artWhere);
        if(empty($article)){
            $article = array();
        }
        $data['data']['article'] = $article;
        return json_encode($data);
    }

    /*  TODO 清空足迹
     * 清空我的足迹
    */
    public function del_item_log(){
        $returnCode =  config('RETURNLOG');
        $trackModel = model('track');
        //验证token
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'] ;
        //验证用户信息
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //获取&&定义参数 执行删除操作
        $where['uid'] = $user['uid'];
        $where['type'] = 1;
        $where['status'] = 1;
        $result = $trackModel -> clearTrackLog($where);
        if($result){
            $dataList = $returnCode['SUCCESS'][0];
        }else{
            $dataList = $returnCode['ERROR'][0];
        }
        wapReturn($dataList);
    }

    /*
     *  我的留言    TODO 我的留言
     * */
    public function get_consult_item(){
        $returnCode = config('RETURNLOG');
        //验证token
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'] ;
        if(empty($token)){
            wapReturn($returnCode['ERROR'][1]);
        }
//        验证登录
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //接收 && 定义参数
        $consultModel = model('consult');
        //获取留言数据&& 通过数据查找项目
        $where['uid'] = $user['uid'];
        $where['type'] = 0;
        $itemData = $consultModel -> get_item_data($where);
        if(empty($itemData)){//数据不存在
            $dataList = $returnCode['ERROR'][4];
            $dataList['data'] = array();
        }else{
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = $itemData;
        }
        wapReturn($dataList);
    }

    /*  首页 推荐项目  */
    public function top_item(){
        //定义参数 && 查询数据
        $where['reco_wap'] = 1;
        $where['status'] = 1;
        $data = $this -> itemModel -> getItem($where);
        $rinfo = config('RETURNLOG')['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }



}