<?php
namespace app\wap\model;

use think\Model;

/*跟进model*/
class consult extends Model{

    private static $consultModel; //

    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this->consultModel = db('consult');
    }

    /*获取咨询列表*/
    public function getConsultData($where){
        $consultList = $this -> consultModel -> where($where) -> select();
        //格式化数据
        $dataList = $this -> formatConsultData($consultList);
        return $dataList;
    }
    /*获取资讯数据（单条）*/
    public function getConsultDetail($where){
        $consult = $this -> consultModel -> where($where) -> find();
        //格式化数据
        $data = $this -> formatConsule($consult);
        return $data;
    }

    /*格式化咨询详情数据*/
    public function formatConsule($data){
        if(empty($data)){
            return array();
        }
        $dataList['id'] = $data['id'];
        $dataList['name'] = $data['name'];
        $dataList['content'] = $data['content'];
        $dataList['item_id'] = $data['item_id'];
        $dataList['phone'] = $data['phone'];
        $dataList['status'] = $data['status'];
        $dataList['sex'] = $data['sex'] == 0 ? '女' : '男' ;
        $dataList['addtime'] = date('Y-m-d H:i:s',$data['addtime']);
        $dataList['intention'] = $data['intention'];
        return $dataList;
    }
    /*格式化留言数据*/
    public function formatConsultData($data){
        if(empty($data)){
            return array();
        }
        $where = array();
        $userModel = db('user');
        $userWhere = array();
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['name'] = $value['name'];
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['item_id'] = $value['item_id'];
            $dataList[$key]['phone'] = $value['phone'];
            $dataList[$key]['status'] = $value['status'];
            $dataList[$key]['sex'] = $value['sex'] == 0 ? '女' : '男' ;
            $dataList[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            $dataList[$key]['intention'] = $value['intention'];
            //获取用户信息
            if(!empty($value['uid'])){
                $userWhere['uid'] = $value['uid'];
                $avatar = $userModel -> where($userWhere) -> value('avatar');
                $dataList[$key]['user_avatar'] = empty($avatar) ? 'https://www.jiamengzhinan.com/uploads/defultavatar.jpg' : 'https://www.jiamengzhinan.com'.trim($avatar,'.') ;
            }

            $dataList[$key]['type'] = $value['type'];
            if($value['type'] == 1){//type=2 为留言。获取回复信息
                $where['cid'] = $value['id'];
                $where['status'] = 1;
                $dataList[$key]['comment'] = $this -> get_con_log($where);
            }
        }
        return $dataList;
    }
    /*修改跟进状态*/
    public function consultEdit($where,$edit){
        $res = $this -> consultModel -> where($where) -> update($edit);
        return $res;
    }

    /*获取回复信息*/
    public function get_con_log($where){
        $con_log = db('con_log') -> where($where) -> select();
        //格式化回复信息
        $data = $this -> formarConLog($con_log);
        return $data;
    }
    /*格式化回复信息*/
    public function formarConLog($data){
        $userModel = \model('user');
        $where = array();
        if(empty($data)){
            $dataList[0]['id'] = 1;
            $dataList[0]['content'] = '我是王英赞。我很有钱';
            $dataList[0]['addtime'] = date("Y-m-d H:i:s");
            $dataList[0]['uid'] = 1;
            $dataList[0]['username'] = '耶和华';
            return $dataList;
        }
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
            $dataList[$key]['uid'] = $value['uid'];
            $where['uid'] = $value['uid'];
            $username = $userModel -> getUserValue($where,'uname');
            $dataList[$key]['username'] = base64_decode($username);
        }
        return $dataList;
    }

    /*删除留言、。咨询*/
    public function delConLog($where){
        //查询状态 0未读 1已读 2催促查看 4无效
        $status = $this -> consultModel -> where($where) -> value('read');
        if($status == 4){
            $saveData['read'] = 1;
        }else{
            $saveData['read'] = 4;
        }
        $res = $this -> consultModel -> where($where) -> update($saveData);
        return $res;
    }

   /*我的留言格式化数据*/
    public function getMyConsult($where){
        $dataList = $this -> consultModel -> where($where) -> select();
        $data = array();
        $itemModel = \model('item');
        foreach ($dataList as $key => $value) {
            $itemWhere['id'] = $value['item_id'];
            $itemList = $itemModel -> getItemData($itemWhere);
            $data[] = array(
                'status'=>$value['status'],
                'addtime'=>date("Y-m-d H:i:s",$value['status']),
                'id'=>$value['id'],
                'item_list'=>$itemList,
            );
        }
        return $data;
    }

    /*修改留言状态*/
    public function edit_consult_data($where,$save){
        $result = $this -> where($where) -> update($save);
        return $result;
    }

    /*我的留言-获取项目id*/
    public function get_item_id($where){
        $data = $this -> consultModel -> where($where) -> select();
        if(empty($data)){
            return false;
        }
        $idStr = '';
        foreach ($data as $key => $value) {
            $idStr .= $value['item_id'].',';
        }
        return rtrim($idStr,',');
    }

    /*我的留言-获取项目*/
    public function get_item_data($where){
        $data = $this -> consultModel -> where($where) -> select();
        if(empty($data)) {
            return array();
        }
        $itemDb = db('item');
        $cateDb = db('category');
        $itemWhere = array();
        $cateWhere = array();
        foreach ($data as $key => $value) {
            $dataList[$key]['status'] = $value['status'];
            $dataList[$key]['id'] = $value['id'];
            $itemWhere['id'] = $value['item_id'];
            $itemData = $itemDb -> where($itemWhere) -> find();
            $dataList[$key]['item_id'] = $value['item_id'];
            $dataList[$key]['item_name'] = $itemData['item_name'];
            $dataList[$key]['title'] = $itemData['item_name'];
            $dataList[$key]['sign'] = $itemData['recommend'];
            $dataList[$key]['min_money'] = $itemData['min_money'];
            $dataList[$key]['max_money'] = $itemData['max_money'];
            $dataList[$key]['addtime'] = date("Y-m-d H:i:s",$itemData['addtime']);
            $dataList[$key]['cate_id'] = $itemData['cate_id'];
            $cateWhere['id'] =  $itemData['cate_id'];
            $dataList[$key]['cate'] = $cateDb -> where($cateWhere) -> value('name');
            $dataList[$key]['apply'] = $itemData['apply'];
            $dataList[$key]['shop_count'] = $itemData['shop_count'];
            $dataList[$key]['img'] = 'http://'.$_SERVER['SERVER_NAME'].trim($itemData['img'],'.');
            $dataList[$key]['imag_url'] = 'http://'.$_SERVER['SERVER_NAME'].trim($itemData['img'],'.');
        }
        return $dataList;
    }

    /*  获取留言&&咨询&&站内推送内容接口  */
    public function getConsultDataList( $where = false , $order = false , $limit = false , $type = false ,$debug = false ){
        $data = $this -> consultModel -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($data)){   return []; }
        //格式化数据
        switch ($type) {
            case 1:
                $dataList = $this -> formatPushNotify($data,$debug);
                break;

            default:
                # code...
                break;
        }
        return $dataList;
    }

    /*  格式化推送消息数据   */
    public function formatPushNotify($data = false , $debug = false ){
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['name'] = $value['name'];
            $dataList[$key]['phone'] = getMid($value['phone']);//手机号加密
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['to_uid'] = $value['to_uid'];
        }
        return $dataList;
    }

}