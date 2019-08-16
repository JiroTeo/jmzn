<?php
namespace app\index\model;

use think\Model;

class user extends Model{

    private static $userModel; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> userModel = db('user');
    }

    /*验证用户是否存在*/
    public function is_user($where){
        $user = $this -> userModel -> where($where) -> find();
        $result = empty($user) ? false : $user ;
        return $result;
    }
    /*添加用户*/
    public function addUser($data){
        $res = $this -> userModel -> insertGetId($data);
        $result = empty($res) ? false : $res ;
        return $result;
    }

    /*获取用信息（单条）*/
    public function getUserDetail( $where = false ,$debug = false){
        $userData = $this -> userModel -> where($where) -> find();
        if(empty($userData)){   return [];  }
        //格式化数据
        $data = $this -> formatUserData($userData,$debug);
        return $data;
    }

    /*  格式化-个人中心-用户数据   */
    public function formatUserData($data,$debug){
        $perfix = config('IMAGE');
        if($data['type'] != 1){//个人用户
            $format['avatar'] = empty($data['avatar']) ? $perfix['AVATAR'] : $perfix['PERFIX'].trim($data['avatar'],'.');
            $format['username'] = empty($data['uname']) ? '' : base64_decode($data['uname']);
            $format['name'] = empty($data['name']) ? '' :$data['name'];
            $format['sex'] = empty($data['sex']) ? 0 :$data['sex'];
            $format['sex'] = empty($data['sex']) ? 0 :$data['sex'];
            $format['phone'] = empty($data['phone']) ? '' :$data['phone'];
            $format['addtime'] = date('Y-m-d',$data['rtime']);
        }else{//企业用户
            $format['avatar'] = empty($data['avatar']) ? $perfix['AVATAR'] : $perfix['PERFIX'].trim($data['avatar'],'.');
            $format['username'] = empty($data['uname']) ? '' : base64_decode($data['uname']);
            $format['name'] = empty($data['name']) ? '' :$data['name'];
            $format['sex'] = empty($data['sex']) ? 0 :$data['sex'];
            $format['sex'] = empty($data['sex']) ? 0 :$data['sex'];
            $format['phone'] = empty($data['phone']) ? '' :$data['phone'];
            $format['addtime'] = date('Y-m-d',$data['rtime']);
            $format['logo'] = empty($data['logo']) ? '' : $perfix['PERFIX'].$data['logo'];
            $format['cname'] = empty($data['cname']) ? '' :$data['cname'];
            $format['phone'] = empty($data['phone']) ? '' :$data['phone'];
            $format['bname'] = empty($data['bname']) ? '' :$data['bname'];
            $format['email'] = empty($data['email']) ? '' :$data['email'];
            $format['address'] = db('city') -> where(['id'=>$data['city_id']]) -> value('cityname');
        }
        $format['type'] = $data['type'];
        return $format;
    }

    /*获取用户数据 && 格式化用户数据*/
    public function getUserData($where){
        $perfix = config('IMAGE');
        $userData = $this -> userModel -> where($where) -> find();
        if(empty($userData)){   return [];  }
        //格式化用户数据
        $user['uid'] = $userData['uid'];
        $user['username'] = empty($userData['uname']) ? $userData['phone'] : base64_decode($userData['uname']) ;
        $user['name'] = empty($userData['name']) ? '' : $userData['name'];
        $user['avatar'] = empty($userData['avatar']) ? $perfix['AVATAR'] : trim($userData['avatar']);
        return $user;

    }
    /*统计用户数量*/
    public function countUser($where){
        $count = $this -> userMode -> where($where) -> count();
        return $count;
    }

    /*修改用户信息*/
    public function editUserData($where,$data){
        $result = $this -> userModel -> where($where) -> update($data);
        if(empty($result)){ return [];  }
        return $result;
    }


}