<?php
namespace app\admin\model;

use think\Model;
use app\common\model\User as userModel;
class UserPush extends Model{

    private $userPush; //

    // 
    public function __construct(){
        parent::__construct();
        $this->userPush = db('user_push');
    }

    /*  getUserPush */
    public function getUserPushData( $where = false , $type = false , $debug = false ){
        $pushData = $this -> userPush -> where($where) -> find();
        if(empty($pushData)){   return []; }
        //格式化数据
        switch ($type) {
            case 1:
                $dataList = $this -> formatUserPushData($pushData,$debug);
                break;

            default:
                # code...
                break;
        }
        return $dataList;
    }

    /*  获取可接受推送用户信息 */
    public function getUserPushDatList($where = false, $order = false, $limit = false, $type = false){
        $userPushData = $this->userPush->where($where)->order($order)->paginate($limit);
        $page = $userPushData->render();
        $data = iterator_to_array($userPushData);
        $dataList['page'] = $page;
        if (empty($data)) {
            $dataList['data'] = [];
            return $dataList;
        }
        //格式化数据
        $dataList['data'] = $this -> formatUserPushDataList($data);
        return $dataList;
    }

    /*  格式化推送数据     */
    public function formatUserPushDataList($data){
        $userModel = new userModel();
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['uid'] = $value['uid'];
            $dataList[$key]['count'] = $value['count'];
            $dataList[$key]['read_num'] = $value['read_num'];
            $dataList[$key]['unread_num'] = $value['count'] - $value['read_num'];
//                $value['unread_num'];
            $where['uid'] = $value['uid'];
            $userData = $userModel -> getUserData($where,1);
            $dataList[$key]['username'] = $userData['uname'];
            $dataList[$key]['name'] = $userData['name'];
            $dataList[$key]['cname'] = $userData['cname'];
            $dataList[$key]['email'] = $userData['email'];
            $dataList[$key]['phone'] = $userData['phone'];
            $dataList[$key]['lastlog'] = date('Y-m-d H:i:s',$value['lastlog']);
        }
        return $dataList;
    }

    /*  格式化userPush数据   */
    public function formatUserPushData($data,$debug){
        $dataList['id'] = $data['id'];
        $dataList['count'] = $data['count'];
        $dataList['read_num'] = $data['read_num'];
        $dataList['unread_num'] = $data['count'] - $data['read_num'];
        //获取用户数据
        $userModel = new userModel();
        $userData = $userModel -> getUserData(['uid'=>$data['uid']],1);
        $dataList['username'] = $userData['uname'];
        $dataList['phone'] = $userData['phone'];
        return $dataList;
    }

    /*  修改userPush字段    */
    public function updateUserPushData($where = false , $save =  false ,$type=false ){
        $result = $this -> userPush -> where($where) -> update($save);
        return empty($result) ? false : $result;
    }

}