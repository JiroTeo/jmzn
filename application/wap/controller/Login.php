<?php
namespace app\wap\controller;
use think\Cache;
use think\Controller;
use app\common\model\User as userModel;
class Login extends Base {

    // 构造方法
    private $userModel; //

     public function _initialize(){
         parent::_initialize();
         // 实例化y用户模型
         $this->userModel = model('user');
     }

     /* 登录逻辑    */
     public function login_bf(){
        //接收参数
         $phone = $this -> request -> param('phone');
         $code = $this -> request -> param('code');
         $wx_openid = $this -> request -> param('wx_openid');
         $wx_openid = empty($wx_openid) ? '': $wx_openid;
         //验证手机号
         $resPhone = verifMobile($phone);
         if(empty($resPhone)){
             $rinfo['code'] = 401;
             $rinfo['msg'] = '手机号格式错误';
             wapReturn($rinfo);
         }
         //验证验证码
         $codeKey = 'CODE'.$phone;
         $resCode = verifCode($code,$codeKey);
         if(empty($resCode)){
             $rinfo['code'] = 401;
             $rinfo['msg'] = '验证码错误';
             wapReturn($rinfo);
         }
         $userModel = new userModel();
             //通过手机号验证用户是否存在
             $where['phone'] = $phone;
             $where['status'] = 1;
             $userData = $userModel -> getUserData($where,1);
             if(empty($userData)){//用户不存在
                 //新建用户
                 $userId = $userModel -> insertUserGetId($phone , $wx_openid);
                 if($userId){
                     $rinfo = $this -> returnCode['SUCCESS'][0];
                     //用户存储到redis
                     $cacheUser['uid'] = $userId;
                     $cacheUser['username'] = 'jmzn_'.$phone;
                     $cacheUser['openid'] = $wx_openid;
                     $key = "__JM".$userId."__".md5(date('Y-m-d H:i:s').$userId."_".$cacheUser['username']);
                     \cache($key,$cacheUser);
                     //修改用户表的token
                     $userwhere['uid'] = $userId;
                     $save['token'] = $key;
                     $editUserRes = $userModel -> editUserData($userwhere,$save);
                 }else{
                     $rinfo = $this -> returnCode['ERROR'][0];
                     $key = '';
                 }
             }else{//用户存在
                 //验证openid&&处理
                 if(empty($userData['wx_opneid']) && $userData['wx_opneid'] !== $wx_openid ){
                     $userwhere['uid'] = $userData['uid'];
                     $save['wx_openid'] = $wx_openid;
                     $userModel -> editUserData($userwhere,$save);
                 }
                 $rinfo = $this -> returnCode['SUCCESS'][0];
                 //验证token是否有效
                 $key = $userData['token'];
                 $cacheData = Cache::get($key);
                 if(empty($cacheData)){//无效
                     $cacheUser['uid'] = $userData['uid'];
                     $cacheUser['username'] = 'jmzn_'.$phone;
                     $cacheUser['openid'] = '';
                     $key = "__JM".$userData['uid']."__".md5(date('Y-m-d H:i:s').$userData['uid']."_".$cacheUser['username']);
                     \cache($key,$cacheUser);
                 }else{
                    $key = $cacheData['token'];
                 }
             }
     }

    /*wap端登录*/
    public function login(){
        $returnCode = config('RETURNLOG');
        //接收参数
        $phone = empty($_REQUEST['phone']) ? '' : $_REQUEST['phone'];
        $code = empty($_REQUEST['code']) ? '' : $_REQUEST['code'];
        $wx_openid = empty($_REQUEST['openid']) ? '' : $_REQUEST['openid'];//微信openid 微信用户唯一标识
        //验证验证码
        $redisCode = Cache::get('CODE'.$_REQUEST['phone']);
        //特殊处理 【王建超手机号。固定验证码。IOS测试包处理】
        if($phone == '13102815205' && $code == '1234'){
            $redisCode = '1234';
        }
        if($redisCode == $code){//验证码 一致
            //查询用户是否存在
            $where['phone'] = $phone;
            $where['status'] = 1;
            $result = $this -> userModel -> is_user($where);
            $debug['user'] = $result;
            if(empty($result)){//用户不存在添加用户
                $debug['is_user'] = 0;
                //格式化数
                $addData['phone'] = $phone;
                $addData['wx_openid'] = $wx_openid;
                $addData['status'] = 1;
                $addData['uname'] = base64_encode('jmzn_'.$phone);
                $addData['rtime'] = time();
                $res = $this -> userModel -> addUser($addData);
                $debug['adduser'] = $res;
                if($res){//添加成功
                    $user['uid'] = $res;
                    $user['username'] = "jmzn_".$phone;
                    $token = "__JM".$res."__".md5(date('Y-m-d H:i:s').$res."_".$user['username']);
                    \cache($token,$user);
                    $data = $returnCode['SUCCESS'][0];
                    $data['data']['token'] = $token;
                    $data['data']['user'] = $user;
                }else{//添加失败
                    $data = $returnCode['ERROR'][0];
                    $data['data'] = array();
                }
            }else{
                $debug['is_user'] = 1;
                $user['uid'] = $result['uid'];;
                $user['username'] = base64_decode($result['uname']);
                $token = "__JM".$result['uid']."__".md5(date('Y-m-d H:i:s').$result['uid']."_".$result['uname']);
                \cache($token,$user);
                $data = $returnCode['SUCCESS'][0];
                $data['data']['token'] = $token;
                $data['data']['user'] = $user;
            }
        }else{
            $data = $redisCode['ERROR'][1];
            $data['data'] = array();
        }
        wapReturn($data);
    }

        /*  TODO   企业入驻
     *  @param  品牌  公司  姓名  城市  手机  验证码
     * */
    public function add_item_user(){
        $data['code'] = 400;
        $data['msg'] = '失败';
        //接收并格式化参数
//        $code = empty($_SESSION['CODE'.$_REQUEST['phone']]) ? null : $_SESSION['CODE'.$_REQUEST['phone']] ;
        $code = Cache::get('CODE'.$_REQUEST['phone']);
        if(empty($_REQUEST)){
            return json_encode($data);
        }
        $userData['bname'] = $_REQUEST['bname'];//品牌名
        $userData['cname'] = $_REQUEST['cname'];//企业名
        $userData['name'] = $_REQUEST['name'];//姓名
        $userData['city_id'] = $_REQUEST['city_id'];//品牌名
        $userData['phone'] = $_REQUEST['phone'];//手机号
        $userData['status'] = 1;//状态
        if($_REQUEST['code'] = $code){
            $res = $this -> userModel -> addUser($userData);
            if($res){
                $data['code'] = 200;
                $data['msg'] = '成功';
            }else{
                $data['code'] = 400;
                $data['msg'] = '失败';
            }
        }else{
                $data['code'] = 200;
                $data['msg'] = '验证码错误';
        }
        return json_encode($data);
    }

    public function get_code(){
        $phone = empty($_REQUEST['phone']) ? false : $_REQUEST['phone'];
        if($phone == false ){
            $data['code'] = 401;
            $data['code'] = '参数错误';
        }
        $str = sendMesasage($phone);
        $res = explode(',',$str);
        if($res[0] == 1){
            $data['code'] = 200;
            $data['msg'] = '成功';
        }else{
            $data['code'] = 400;
            $data['msg'] = '错误';
        }
        return json_encode($data);
    }

    /*退出登录*/
    public function logout(){
        $returnCode = config('RETURNLOG');
        //接收参数token
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        if(empty($token)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //删除token
        $res = Cache::rm($token);
        if($res){
        wapReturn($returnCode['SUCCESS'][0]);
        }
        wapReturn($returnCode['ERROR'][0]);
    }

}
