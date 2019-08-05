<?php
namespace app\wap\controller;
use think\Cache;
use think\Db;
use think\Controller;
use think\response\Redirect;
use app\common\model\NoticeLog as logModel;
use app\common\model\User as userModel;

class consult extends Base{

    private $consultModel;

    function _initialize(){
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->consultModel = model('consult');
    }

    /*重构-投资者/留言管理*/
    public function get_consult(){
        $recodeCode = config('RETURNLOG');
        //判断登录
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){
            $dataList = $recodeCode['ERROR'][5];
            $dataList['data'] = array();
            wapReturn($dataList);
        }
        //判断参数 type 0为咨询（投资者管理） 1为留言（留言管理）
        $type = empty($_REQUEST['type']) ? 0 : $_REQUEST['type'];
        $where['type'] = $type;
       //查询出项目信息
//        $itemWhere['wid'] = $user['uid'];
//        $itemId = db('item') -> where($itemWhere) -> value('id');
//        if(empty($itemId)){//数据不存在 返回数据不存在
//            $dataList = $recodeCode['ERROR'][4];
//            $dataList['data'] = array();
//            wapReturn($dataList);
//        }
//        $where['item_id'] = $itemId;
        //判断参数  stauts 咨询/留言 状态0待跟进/未查看  1已跟进/已查看 2已签约/催促查看 3放弃跟进/已回复  4 无效
        $status = empty($_REQUEST['status']) ? 0 : $_REQUEST['status'];
        if($status != 5){ //status=5 查看全部 status不赋值 只有当status!=5 的时候才进行赋值
            $where['read'] = $status;
        }
        $where['to_uid'] = $user['uid'];
        //执行查询
        $consultData = $this -> consultModel -> getConsultData($where);
        //消息通知处理start
        if($type == 0){
            $noticeData['type'] = 3;
        }elseif($type == 1){
            $noticeData['type'] = 4;
        }
        $noticeData['uid'] = $user['uid'];
        model('notice') -> read_notice($noticeData);
        //消息通知end

        if($consultData){//数据存在 返回成功
            $dataList = $recodeCode['SUCCESS'][0];
        }else{//数据不存在 返回错误
            $dataList = $recodeCode['ERROR'][4];
            $consultData = array();
        }
        $dataList['data'] = $consultData;
        wapReturn($dataList);
    }

    /*跟进详情/回复*/
    public function get_consult_detail(){
        //接收参数&&自定义信息
        $returnCode = config('RETURNLOG');
        //验证token&&login
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //查询咨询/留言信息
        $id = empty($_REQUEST['id'])? 0 : $_REQUEST['id'];
        $where['id'] = $id;
        $consultData = $this -> consultModel -> getConsultDetail($where);
        if(empty($consultData)){
            wapReturn($returnCode['ERROR'][4]);
        }
        //获取跟进信息
        $conWhere['cid'] = $_REQUEST['id'];
        $conWhere['type'] = $_REQUEST['type'];//0咨询1留言
        $conLog = db('con_log') -> where($conWhere) -> select();
        foreach ($conLog as $key => $value) {
            $conLog[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
        }
        $data['con_log'] = $conLog;
        $data['consult'] = $consultData;
        $dataList['data'] = $data;
        if($consultData){
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = $data;
            //执行 if type=1 update status = 1
            if($_REQUEST['type'] == 1){//留言 改变留言状态。已读
                $saveData['read'] = 1 ;
                $this -> consultModel -> consultEdit($where,$saveData);
            }
        }else{
            $dataList = $returnCode['ERROR'][4];
            $dataList['data'] = array();
        }
        wapReturn($dataList);
    }
    /*改变咨询状态*/
    public function eidt_consult_status(){
        $returnCode = config('RETURNLOG');
        //.接收参数并且格式化
        $id = empty($_REQUEST['id']) ? 1 : $_REQUEST['id'];
        $status = empty($_REQUEST['status']) ? 0 : $_REQUEST['status'];
        //修改跟进状态
        $where['id'] = $id;
        $edit['read'] = $status;
        $res = $this -> consultModel -> consultEdit($where,$edit);
        if($res){
            $dataList = $returnCode['SUCCESS'][0];
        }else{
            $dataList = $returnCode['ERROR'][0];
        }
        wapReturn($dataList);
    }
    /*添加跟进*/
    public function add_consult_log(){
        $returnCode =  config('RETURNLOG');
        //接收参数并且格式化
        $token = $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){//未登录
            wapReturn($returnCode['ERROR'][5]);
        }
        //格式化参数&&执行添加操作
        $add['uid'] = $user['uid'];//用户id
        $add['cid'] = $_REQUEST['id'];//咨询/留言id
        $add['content'] = $_REQUEST['content'];//跟进内容
        $add['status'] = 1;//有效
        $add['addtime'] = time();
        $add['type'] = empty($_REQUEST['type']) ? 0 : $_REQUEST['type'] ;
        $logId = db('con_log') -> insertGetId($add);
        if(empty($logId)){
            $dataList = $returnCode['ERROR'][0];
        }else{
            $dataList = $returnCode['SUCCESS'][0];
            //修改咨询、留言状态
            $ConWhere['id'] = $_REQUEST['id'];
            $saveData['read'] = 1;
            $this -> consultModel -> consultEdit($ConWhere,$saveData);
        }
        wapReturn($dataList);
    }

    /*删除/恢复留言*/
    public function del_consult(){
        $returnCode = config('RETURNLOG');
        //验证token && login
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        $user =Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //验证id
        $id = empty($_REQUEST['id']) ? false : $_REQUEST['id'];
        if(empty($id)){
            wapReturn($returnCode['ERROR'][1]);
        }
        //查询状态 如果无效修改为有效 如果有效修改为无效
        $where['id'] = $id;
        $res = $this -> consultModel -> delConLog($where);
        if($res){
            $dataList = $returnCode['SUCCESS'][0];
        }else{
            $dataList = $returnCode['ERROR'][0];
        }
        wapReturn($dataList);
    }

    /*我的留言*/
    public function get_my_consult(){
        $returnCode = config('RETURNLOG');
        //验证登录
        $token = $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
//        获 取留言过的项目专题
        $where['uid'] = $user['uid'];
        $dataList['data'] = $this -> consultModel -> getMyConsult($where);
        $dataList['code'] = $returnCode['SUCCESS'][0]['code'];
        $dataList['msg'] = $returnCode['SUCCESS'][0]['msg'];
        wapReturn($dataList);
    }

    /*留言-催促
     *  status=2 催促
     * */
    public function com_urge(){
        $returnCode = config('RETURNLOG');
        //验证登录
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'] ;
        //验证token有没有用户信息
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //验证id
        $id = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
        if( $id == 0 ){
            wapReturn($returnCode['ERROR'][1]);
        }
        //改变催促状态
        $where['id'] = $id;
        $where['id'] = $id;
        $save['read'] = 3;
        $result = $this -> consultModel -> edit_consult_data($where,$save);
        if($result){
            wapReturn($returnCode['SUCCESS'][0]);
        //添加消息通知
        }else{
            wapReturn($returnCode['ERROR'][0]);
        }
    }

    /*  接收推送消息  */
    public function get_push_consult(){
        //验证登录
        $user = $this -> user;
        if(empty($user)){
            wapReturn($this -> returnCode['ERROR'][5]);
        }
        //分页数据
        $page = empty($_REQUEST['page']) ? 0 : $_REQUEST['page'] -1 ;
        $num = empty($_REQUEST['num']) ? 10 : $_REQUEST['num'];
        $limit = ( $page * $num ) . ' , ' . $num;

        //获取推送内容
        $where['to_uid'] = $user['uid'];
        $where['type'] = 2;
        $where['status'] = 1;
        $data = $this -> consultModel ->  getConsultDataList($where,'addtime desc',$limit,1,$this -> debug);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }

    /*  阅读过推送消息 ，推送消息状态变成 投资者管理*/
    public function read_Notify(){

        //验证登录
        if(empty($this -> user)){
            wapReturn($this -> returnCode['ERROR'][0]);
        }
        //接收参数 &&验证参数&&修改状态
        $id = $this -> request -> param('id');
        if(empty($id)){
            wapReturn($this -> returnCode['ERROR'][1]);
        }
        //验证是否还有剩余查看条数
        $userModel = new userModel();
        $res = $userModel -> parseModel(['uid'=>$this -> user['uid']]);
        if(empty($res)){
            //条数不足
            $rinfo = $this -> returnCode['ERROR'][6];
            wapReturn($rinfo);
        }
        //验证end

        //修改数据状态
        $where['id'] = $id;
        $save['type'] = 0;
        $result = $this->consultModel -> edit_consult_data($where,$save);
        //update notice_log.readtime
        $logModel = new logModel();
        $logWhere['tid'] = $id;
        $logWhere['uid'] = $this -> user['uid'];
        $logWhere['type'] = 1;
        $logSave['readtime'] = time();
        $result = $logModel -> editNoticeLogField($logWhere,$logSave);
        //update end
        if(empty($result)){
            $rinfo = $this -> returnCode['ERROR'][0];
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        wapReturn($rinfo);
    }

}