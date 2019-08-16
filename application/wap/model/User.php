<?php
namespace app\wap\model;

use think\Model;

class user extends Model{

    private $userModel; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> userModel = db('user');
    }

    /*验证用户是否存在*/
        public function is_user($where){
        $result = $this -> userModel -> where($where) -> find();
        return $result;
    }
    /*添加用户*/
    public function addUser($data){
        $res = $this -> userModel -> insertGetId($data);
        return $res;
    }

    /*获取用户的某个字段*/
    public function getUserValue($where,$value){
        $value = $this -> userModel -> where($where) -> value($value);
        return $value;
    }

    /*获取用信息（单条）*/
    public function getUser($where){
        $userData = $this -> userModel -> where($where) -> find();
        if($userData['type'] == 1){//企业用户
            $data = $this -> formatEnt($userData);
        }else{
            $data = $this -> formatData($userData);
        }
        return $data;
    }

    /*格式化企业用户数据*/
    public function formatEnt($data){
        $dataList['logo'] = $data['logo'];
        $dataList['uid'] = $data['uid'];
        $dataList['sex'] = $data['sex'];
        $dataList['cname'] = $data['cname'];
        $dataList['uname'] = base64_decode($data['uname']);
        $dataList['name'] = $data['name'];
        $dataList['phone'] = $data['phone'];
        $dataList['bname'] = $data['bname'];
//        $dataList['city_id'] = $data['city_id'];
//        $where['id'] = $data['city_id'];
//        $dataList['city_name'] = db('city') -> where($where) -> value('cityname');
//        $dataList['city_id'] = $data['city_id'];
        $dataList['email'] = $data['email'];
        $dataList['city_name'] = $data['address'];
        $dataList['type'] = $data['type'];
        $image = config('IMAGE');
        $dataList['avatar'] = empty($data['avatar']) ? $image['AVATAR'] : $image['PERFIX'].ltrim($data['avatar'],'.');
        $dataList['day_num'] = intdiv(time() - $data['rtime'],86400);
        //个人中心 - 未查看留言
        $itemDb = db('item');
        $itemWhere['wid'] = $data['uid'];
        $itemWhere['status'] = 1;
        $itemData = $itemDb -> where($itemWhere) -> find();
        if(empty($itemData)){
              $consult_data = array();
        }else{
            $consult_data['item_title'] = $itemData['item_name'];
            $consultModel = db('consult');
            $conWhere['status'] = 0;
            $conWhere['item_id'] = $itemData['id'];
            $conWhere['type'] = 1;
            $sultData = $consultModel -> where($conWhere) -> order('id desc') -> find();
            if(empty($sultData)){
                $consult_data = array();
            }else{
                $consult_data['item_id'] = $itemData['id'];
                $consult_data['consult_id'] = $sultData['id'];
                $consult_data['consult_content'] = $sultData['content'];
                $consult_data['addtime'] = date('m-d',$sultData['addtime']);
                $userWhere['uid'] = $sultData['uid'];
                $consult_data['user_avatar'] = db('user') -> where($userWhere) -> value('avatar');
            }
        }
        $dataList['consult'] = $consult_data;

        return $dataList;
    }


    /*格式化用户数据*/
    public function formatData($data){
        $userData['uname'] = base64_decode($data['uname']);
        $userData['avatar'] = empty($data['avatar']) ? " " : $data['avatar'];
        $userData['uid'] = $data['uid'];
        $userData['name'] = empty($data['name']) ? '' : $data['name'];
        $userData['phone'] = empty($data['phone'])? "" : $data['phone'];
        $userData['rtime'] = date('Y-m-d H:i:s',$data['rtime']);
        $userData['type'] = $data['type'];
        $userData['sex'] = $data['sex'];
        $image = config('IMAGE');
        $userData['avatar'] = empty($data['avatar']) ? $image['AVATAR'] : $image['PERFIX'].ltrim($data['avatar'],'.');
        $userData['day_num'] = intdiv(time() - $data['rtime'],86400);
        //个人中心 - 未查看留言
        $itemDb = db('item');
        $itemWhere['wid'] = $data['uid'];
        $itemWhere['status'] = 1;
        $itemData = $itemDb -> where($itemWhere) -> find();
        if(empty($itemData)){
              $consult_data = array();
        }else{
            $consult_data['item_title'] = $itemData['item_name'];
            $consultModel = db('consult');
            $conWhere['status'] = 0;
            $conWhere['item_id'] = $itemData['id'];
            $conWhere['type'] = 1;
            $sultData = $consultModel -> where($conWhere) -> order('id desc') -> find();
            $consult_data['consult_content'] = $sultData['content'];
            $consult_data['addtime'] = date('m-d',$sultData['addtime']);
            $userWhere['uid'] = $sultData['uid'];
            $consult_data['user_avatar'] = db('user') -> where($userWhere) -> value('avatar');
        }
        $userData['consult'] = $consult_data;
        return $userData;
    }

    /*获取用户数据*/
    public function getUserData($where){
        $userData = $this -> userModel -> where($where) -> select();
        //格式化用户数据

    }
    /*统计用户数量*/
    public function countUser($where){
        $count = $this -> userMode -> where($where) -> count();
        return $count;
    }

    /*修改用户信息*/
    public function editUserData($where,$data){
        $result = $this -> userModel -> where($where) -> update($data);
        return $result;
    }

}