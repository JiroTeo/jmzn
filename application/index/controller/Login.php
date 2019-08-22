<?php
namespace app\index\controller;
use think\Cache;
use think\Request;
use think\captcha\Captcha;
class login extends Base {

    // 构造方法
     public function _initialize(){
         parent::_initialize();
         // 实例化y用户模型
         $this->userModel = model('user');
     }

    /*  重构登录注册  */
    public function login(){
        $info = input('post.');
        if(!empty($info)){
            //验证手机号
            $resPhone = verifMobile($info['phone']);
            if(empty($resPhone)){

            }
        }else{
            return view();
        }
    }

    /*  企业入驻    */
    public function login_qy(){
        $info = $this -> request -> param();
        if($info){
            echo "企业入驻";
        }else{
            echo "企业入驻";
        }
    }


    /*登录*/
    public function login_bf(){
        //接收参数
        $phone = empty($_REQUEST['phone']) ? false : trim($_REQUEST['phone']);
        $code = empty($_REQUEST['code']) ? false : trim($_REQUEST['code']);
        //验证手机号
        $resPhone = verifMobile($phone);
        if(empty($resPhone)){
            $rinfo = $this -> returnCode['ERROR'][1];
            $rinfo['msg'] = '手机号错误';
            wapReturn($rinfo);
        }
        //验证验证码
        $codeKey = 'CODE'.$phone;
        $resCode = verifCode($code,$codeKey);
        if(empty($resCode)){
            $rinfo = $this -> returnCode['ERROR'][1];
            $rinfo['msg'] = '验证码错误';
            wapReturn($rinfo);
        }
        //查询用户是否存在
        $where['phone'] = $phone;
        $where['status'] = 1;
        $resUser = $this -> userModel -> is_user($where);
        $perfix = config('IMAGE');
        if(empty($resUser)){//用户不存在执行注册操作
            $addUser['phone'] = $phone;
            $addUser['status'] = 1;
            $addUser['rtime'] = time();
            $addUser['uname'] = base64_encode('jmzn_'.$phone);
            $userId = $this -> userModel -> addUser($addUser);
            if(empty($userId)){//注册失败
                $rinfo = $this -> returnCode['ERROR'][0];
                $rinfo['msg'] = '注册失败';
                wapReturn($rinfo);
            }
            //注册成功
            $user['uid'] = $userId;
            $user['username'] = $addUser['uname'];
            $user['avatar'] = $perfix['AVATAR'];
            $user['phone'] = $phone;
            $token = '__JM'.$userId."__".md5(date('YmdHis').$userId.'_'.base64_encode('jmzn_'.$phone));
            \cache($token,$user,7776000);//存储三个月

        }else{//用户存在执行登录操作
            $user['uid'] = $resUser['uid'];
            $user['phone'] = $resUser['phone'];
            $user['avatar'] = empty($resUser['avatar']) ? $perfix['AVATAR'] : $perfix['PERFIX'].trim($resUser['avatar'] , '.');
            $user['username'] = base64_decode($resUser['uname']);
            $token = '__JM'.$resUser['uid']."__".md5(date('YmdHis').$resUser['uid'].'_'.$resUser['uname']);
            \cache($token,$user,7776000);//存储三个月

        }
        $data['user'] = $user;
        $data['token'] = $token;
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }

    /*  企业入驻    */
    public function ent_resi(){
        //get code&&phone  && verify
        $code = empty($_REQUEST['code']) ? false : trim($_REQUEST['code']);
        $phone  = empty($_REQUEST['phone']) ? false : $_REQUEST['phone'];
        //验证 手机号&&验证码
        $resPhone = verifMobile($phone);
        if(empty($resPhone)){
            $rinfo = $this -> returnCode['ERROR'][1];
            $rinfo['msg'] = '手机号格式错误';
            wapReturn($rinfo);
        }
        $codeKey = 'CODE'.$phone;
        $resCode = verifCode($code,$codeKey);
        if(empty($resCode)){
            $rinfo = $this -> returnCode['ERROR'][1];
            $rinfo['msg'] = '手机验证码错误';
            wapReturn($rinfo);
        }
        // 根据手机号查询用户是否存在
        $where['phone'] = $phone;
        $resUser = $this -> userModel -> is_user($where);
        //定义参数 查询用户是否存在 && 执行 添加||修改
            $data['bname'] = empty($_REQUEST['bname']) ? '' : $_REQUEST['bname'];
            $data['cname'] = empty($_REQUEST['cname']) ? '' : $_REQUEST['cname'];
            $data['name'] = empty($_REQUEST['name']) ? '' : $_REQUEST['name'];
            $data['address'] = empty($_REQUEST['address']) ? '' : $_REQUEST['address'];
            $data['phone'] = $phone;
            $data['status'] = 1;
            $data['type'] = 1;
        if(empty($resUser)){//用户不存在 执行添加
            $result = $this -> userModel -> addUser($data);
            $rinfo = empty($result) ? $this -> returnCode['ERROR'][0] : $this -> returnCode['SUCCESS'][0];
        }else{//用户存在 执行修改
            $result = $this -> userModel -> editUserData($where,$data);
            $rinfo = empty($result) ? $this -> returnCode['ERROR'][0] : $this -> returnCode['SUCCESS'][0];
        }
        wapReturn($rinfo);
    }

    public function get_code(){
        //接收参数
        $phone = empty($_REQUEST['phone']) ? false : $_REQUEST['phone'];
        $icode = empty($_REQUEST['icode']) ? false : strtolower(trim($_REQUEST['icode']));
        //验证手机号
        $resPhone = verifMobile($phone);
        if(empty($resPhone)){
            $rinfo = $this -> returnCode['ERROR'][1];
            $rinfo['msg'] = '手机号错误';
            return $rinfo;
        }
        //验证图片验证码
        $icodeRes = captcha_check($icode);
        if(empty($icodeRes)){
            $rinfo = $this -> returnCode['ERROR'][1];
            $rinfo['msg'] = '图片验证码错误';
            return $rinfo;
        }
        //发送短信
        $str = sendMesasage($phone);
        $res = explode(',',$str);
        if($res[0] == 1){
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }else{
            $rinfo = $this -> returnCode['ERROR'][0];
            $rinfo['msg'] = '获取验证码失败';
        }
        return $rinfo;
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

    /*  获取图片验证码 */
    public function imageCode(){
        $fileName = createImageCode();
        if(empty($fileName)){
            $rinfo = $this -> returnCode['ERROR'][0];
            $fileName = '';
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        $rinfo['data'] = config('IMAGE')['PERFIX'].trim($fileName,'.');
        wapReturn($rinfo);
    }
}
