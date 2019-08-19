<?php
namespace app\index\model;

use think\Model;
use app\index\model\Item as itemModel;
class consult extends Model{

    /*  todo    获取留言列表            getConsultList
     *  todo    获取留言数据            getConsultDetail
     *  todo    格式化留言详情          formatConsule
     *  todo    格式化留言数据          formatConsultData
     *  todo    修改咨询状态            consultEdit
     *  todo    获取回复消息            get_con_log
     *  todo    格式化回复消息          formarConLog
     *  todo    删除留言                delConLog
     *  todo    我的留言 格式化数据     getMyConsult
     *  todo    修改留言状态            edit_consult_data
     *  todo    我的留言获取项目id      get_item_id
     *  todo    我的留言    获取项目    get_item_data
     *  todo    获取跟进数据            get_con_log_data_list
     *  todo    格式化跟进状态            formaitConLogDataList
     * **/

    private static $consultModel;
    private static $conLog;

    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this->consultModel = db('consult');
        $this->conLog = db('con_log');

    }
    /*  分页获取咨询列表    */
    public function getConsultListByPage($where = false , $order = false , $num = false , $type = 0 , &$page = '' , $debug = false ){
        $consultList = $this -> consultModel -> where($where) -> order($order) -> paginate($num,false,['var_page'=>'p']);
        $page = $consultList->render();
        $data = iterator_to_array($consultList);
        if(empty($data)){    return [];  }
        switch ($type) {
            case 1://留言列表数据
                $dataList = $this -> formarItemDetailConsultList($data);
                break;
            case 2://投资者管理
                $dataList = $this -> formatConsultDataList($data);
                break;
            case 3://推送留言
                $dataList = $this -> formatPushNotify($data);
                break;
            default:
                return [];
                break;
        }
        return $dataList;
    }

    /*获取咨询列表*/
    public function getConsultList($where = false , $order = false , $limit = false , $type = 0 , $user = [] , $debug = false ){
        $consultList = $this -> consultModel -> where($where) -> order($order) -> limit($limit) -> select();
//        dump($consultList);
//        echo $this -> consultModel -> getLastSql();die;

        if(empty($consultList)){    return [];  }
        //格式化数据
        	switch ($type) {
                case 1://留言列表数据
                    $dataList = $this -> formarItemDetailConsultList($consultList,$user,$debug);
                    break;
                case 2://投资者管理
                    $dataList = $this -> formatConsultDataList($consultList,$user,$debug);
                    break;
                case 3://推送留言
                    $dataList = $this -> formatPushNotify($consultList,$user,$debug);
                    break;
                default:
                    return [];
                    break;
            }
        //格式化数据

        return $dataList;
    }
    /*  格式化推送消息数据   */
    public function formatPushNotify($data = false ){
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['name'] = $value['name'];
            $dataList[$key]['phone'] = getMid($value['phone']);//手机号加密
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['to_uid'] = $value['to_uid'];
        }
        return $dataList;
    }

    /*  格式化-项目详情-留言列表数据   */
    public function formarItemDetailConsultList($data,$user,$debug){
        $userModel = \model('user');
        $perfix = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['addtime'] = date("Y-m-d h:i:s",$value['addtime']);
            //验证用户id
            if(empty($value['uid'])){
                $dataList[$key]['avatar'] = $perfix['AVATAR'];
                $dataList[$key]['username'] = substr_replace($value['phone'],'********',2,8);
            }else{
                $where['uid'] = $value['uid'];
                $userData = $userModel -> getUserData($where);
                $dataList[$key]['avatar'] = empty($userData['avatar']) ? $perfix['AVATAR'] : $perfix['PERFIX'].$userData['avatar'] ;
                $dataList[$key]['username'] = empty($userData['username']) ? substr_replace($value['phone'],'********',2,8) : $userData['username'];
            }
        }
        return $dataList;

    }

    /*获取资讯数据（单条）*/
    public function getConsultDetail($where,$debug=false){
        $consult = $this -> consultModel -> where($where) -> find();
        if($debug == 1){
            echo $this -> consultModel -> getLastSql();
        }
        if(empty($consult)){    return [];  }
        //格式化数据
        $data = $this -> formatConsule($consult);
        return $data;
    }

    /*格式化咨询详情数据*/
    public function formatConsule($data){
        $dataList['id'] = $data['id'];
        $dataList['name'] = $data['name'];
        $dataList['content'] = $data['content'];
        $dataList['phone'] = $data['phone'];
        $dataList['read'] = $data['read'];
        $dataList['status'] = $data['status'];
        $dataList['sex'] = $data['sex'];
        $dataList['addtime'] = date('Y-m-d H:i:s',$data['addtime']);
        $dataList['intention'] = $data['intention'];
        return $dataList;
    }

    /*  格式化-投资者管理-数据*/
    public function formatConsultDataList($data,$debug=false){
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['item_id'] = $value['item_id'];
            $dataList[$key]['status'] = $value['status'];
            $dataList[$key]['read'] = $value['read'];
            $dataList[$key]['name'] = $value['name'];
            $dataList[$key]['sex'] = $value['sex'];
            $dataList[$key]['phone'] = $value['phone'];
            $dataList[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
        }
        return $dataList;
    }

    /*修改跟进状态*/
    public function consultEdit($where,$edit){
        $res = $this -> consultModel -> where($where) -> update($edit);
        return $res;
    }

    /*  删除留言&&咨询    */
    public function changeConsultFiled( $where = false , $filed = false , $debug = false ){
        if(empty($where) || empty($filed)){ return false;   }
        $res = $this -> consultModel -> where($where) -> update($filed);
        if($debug == 1){
            echo "changeFiledSql:".$this -> consultModel -> getLastSql();
        }
        $result = empty($res) ? false : $res ;
        return $result;
    }

    /*  我的留言    分页获取    */
    public function getMyConsultByPage($where = false ,$order = false , $num = false , &$page ){
        $consult = $this -> consultModel -> where($where) -> order($order) -> paginate($num);
        $page = $consult ->render();
        $data = iterator_to_array($consult);
        if(empty($data)){   return [];   }
        //格式化数据
        $itemModel = new itemModel();
        foreach ($data as $key => $value) {
            //项目信息
            $item = $itemModel -> getItemData(['id'=>$value['item_id']],2);
            //留言信息
            $data[$key]['id'] = $value['id'];
            $data[$key]['content'] = $value['content'];
            $data[$key]['status'] = $value['status'];
            $data[$key]['read'] = $value['read'];
            $data[$key]['addtime'] = date("Y-m-d",$value['addtime']);
            $data[$key]['item'] = $item;
        }
        return $data;
    }

    /*我的留言   数据为项目  格式化数据*/
    public function getMyConsult( $where = false ,$order = false , $limit = false , $type = false , $debug = false ){
        $dataList = $this -> consultModel -> where($where) -> order($order) -> limit($limit) -> select();
        if($debug == 1){
            echo $this -> consultModel -> getLastSql();
        }
        if(empty($dataList)){   return [];  }//数据不存在
        $model = \model('item');
        foreach ($dataList as $key => $value) {
            //获取项目列表信息
            $item = $model -> getItemData(['id'=>$value['item_id']],2);
            //留言信息
            $data[$key]['id'] = $value['id'];
            $data[$key]['content'] = $value['content'];
            $data[$key]['status'] = $value['status'];
            $data[$key]['read'] = $value['read'];
            $data[$key]['addtime'] = date("Y-m-d",$value['addtime']);
            $data[$key]['item'] = $item;
        }
        return $data;
    }

    /*修改留言状态*/
    public function edit_consult_data($where,$save){
        $result = $this -> where($where) -> update($save);
        return $result;
    }

    /*我的留言-获取项目id*/
    public function get_item_id( $where = false , $order = false , $limit = false , $debug = false ){
        $data = $this -> consultModel -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($data)){   return false;   }//数据不存在返回false
        //将项目id 拼接成字符串
        $idStr = '';
        foreach ($data as $key => $value) {
            $idStr .= $value['item_id'].',';
        }
        //RETURN
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
            $dataList[$key]['read'] = $value['read'];
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

    /*  获取跟进/回复信息   */
    public function getConLogDataList($where = false ,$order = false ,$limit = false , $type = false , $debug = false ){
        $data = $this -> conLog -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($data)){   return [];  }
        //格式化数据
        $dataList = $this -> formaitConLogDataList($data);
        return $dataList;

    }

    /*  格式化跟进数据格式   */
    public function formaitConLogDataList($data = false , $debug = false ){
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['content'] = $value['content'];
            $dataList[$key]['addtime'] = date('Y-m-d',$value['addtime']);
        }
        return $dataList;
    }

    /*发布咨询*/
    public function addConsult( $data = false , $debug = false ){
        $result = $this -> consultModel -> insertGetId($data);
        return $result;
    }
}