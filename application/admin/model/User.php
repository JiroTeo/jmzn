<?php
namespace app\admin\model;

use think\Model;

class User extends Model{

    private static $userModel; //

    // 
    public function __construct(){
        parent::__construct();
        $this -> userModel = db('user');
    }
    
    /*查询用户 单个用户信息*/
    public function findUser($where){
    	// 查询语句
    	$userData =  $this -> userModel -> where($where) -> find();
    	return $userData;
    }

    /*获取用户数据*/
    public function getUserList($whereor,$where){
        // 根据条件查询用户数据
        $userData = $this -> userModel -> whereOr($whereor) -> where($where) -> order('uid desc') -> paginate(10);
        $page = $userData->render();
        $data = iterator_to_array($userData);

        // 格式化用户数据
        foreach ($data as $key => $value) {
            $data[$key]['uname'] = base64_decode($value['uname']);              //用户名
            $data[$key]['cname'] = base64_decode($value['cname']);              //企业名
            $data[$key]['bname'] = base64_decode($value['bname']);              //品牌名
            $data[$key]['sex'] = $value['sex'] == 0 ? '女' : '男';              //性别
            $data[$key]['rtime'] = date('Y-m-d h:i:s',$value['rtime']);         //注册时间
            $data[$key]['crtime'] = date('Y-m-d h:i:s',$value['crtime']);       //企业注册时间
            $data[$key]['last_log'] = date('Y-m-d h:i:s',$value['last_log']);   //最后登录时间
            // 用户类型0代表个人用户 1代表企业用户 2后台管理员
            switch ($value['type']) {
                case $value['type'] == 0:
                        $data[$key]['type'] = '个人用户';
                    break;
                case $value['type'] == 1:
                        $data[$key]['type'] = '企业用户';
                    break;
                case $value['type'] == 2:
                        $data[$key]['type'] = '后台管理员';
                    break;
                default:
                    # code...
                    break;
            }
        }
        $dataList['data'] = $data;
        $dataList['page'] = $page;
        return $dataList;
    }

    /*  获取用户数据  */
    public function getUserData($where = false){
        $user = $this -> userModel -> where($where) -> find();
        if(empty($user)){   return [];  }
        $userInfo = $this -> formatUserData($user);
        return $userInfo;
    }

    /*  格式化用户数据 */
    public function formatUserData($data = false){
        $userInfo['uid'] = $data['uid'];
        $userInfo['username'] = empty($data['uname']) ? '' : base64_decode($data['uname']);
        $userInfo['avatar'] = $data['avatar'];
        return $userInfo;
    }

    /*  获取用户数据  */
    public function getUserDataList($whereOr = false ){
        $data = $this -> userModel -> whereOr($whereOr) -> select();
        if(empty($data)){return [] ; }
        //格式化数据
        $dataList = $this -> formatUserDataSearchDataList($data);
        return $dataList;
    }

    /*  格式化用户数据 */
    public function formatUserDataSearchDataList($data = false ){
        foreach ($data as $key => $value) {
            $dataList[$key]['username'] = empty($value['uname']) ? '' : base64_decode($value['uname']);
            $dataList[$key]['uid'] = $value['uid'];
        }
        return $dataList;
    }


}