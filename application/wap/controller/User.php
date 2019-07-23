<?php
namespace app\wap\controller;
use think\Cache;
use think\Db;
use think\Controller;
class user{

    private $artModel;
    public function __construct(){
         // 实例化y用户模型
         $this->userModel = model('user');
    }

    /*个人信息接口*/
    public function userCenter(){
        $returnCode = config('RETURNLOG');
        $data['data'] = array();
        //接收参数
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        if(empty($token)){
            wapReturn($returnCode['ERROR'][5]);
        }else{
            $user = Cache::get($token);
        }
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }else{
            $uid = $user['uid'];
        }

        if(empty($uid)){
            return json_encode($data);
        }
        //获取用户信息
        $where['uid'] = $uid;
        $where['status'] = 1;
        $userData = $this -> userModel -> getUser($where);
        if($userData){
            $data['code'] = 200;
            $data['msg'] = '成功';
            $data['data'] = $userData;
        }
        return json_encode($data);
    }

    /*修改信息接口*/
    public function edit_user_data(){
        $returnCode = config("RETURNLOG");
        //接收参数  type 1头像2昵称3姓名4性别
        $type = empty($_REQUEST['type']) ? false : $_REQUEST['type'];
        $token = $_REQUEST['token'];
        $user = Cache::get($token);
        if(empty($user)){//token不存在提示未登录
            $dataList = $returnCode['ERROR']['5'];
            wapReturn($dataList);
        }
        $uid = $user['uid'];
        switch ($type) {
	    case 1: //修改头像
            $path = 'avatar/';
            $image_name = uploadeFile($path);//调用文件上传类
            $save['avatar'] = $image_name;
		    break;
        case 2://修改昵称
                if(!isset($_REQUEST['username'])){
                    wapReturn($returnCode['ERROR'][1]);
                }
                $save['uname'] = base64_encode($_REQUEST['username']);
		    break;
		case 3://修改姓名
                if(!isset($_REQUEST['name'])){
                    wapReturn($returnCode['ERROR'][1]);
                }
                $save['name'] = $_REQUEST['name'];
		    break;
		case 4://修改性别
                if(!isset($_REQUEST['sex'])){
                    wapReturn($returnCode['ERROR'][1]);
                }
                $save['sex'] = $_REQUEST['sex'];
		    break;
		//企业用户修改信息
        case 5://公司log
                $path = 'logo/';//存储公司logo的dir
                $image_name = uploadeFile($path);//调用文件上传类
                $save['logo'] = $image_name;
		    break;
		case 6://企业名称
                if(!isset($_REQUEST['cname'])){
                    wapReturn($returnCode['ERROR'][1]);
                }
                $save['cname'] = $_REQUEST['cname'];
		    break;
		case 7://品牌
                if(!isset($_REQUEST['bname'])){
                    wapReturn($returnCode['ERROR'][1]);
                }
                $save['bname'] = $_REQUEST['bname'];
		    break;
		case 8://注册地址
                if(!isset($_REQUEST['address'])){
                    wapReturn($returnCode['ERROR'][1]);
                }
                $save['address'] = $_REQUEST['address'];
		    break;
		case 9://联系邮箱
                if(!isset($_REQUEST['email'])){
                    wapReturn($returnCode['ERROR'][1]);
                }
                $save['email'] = $_REQUEST['email'];
		    break;
	    default:
		    wapReturn($returnCode['ERROR']['1']);
		break;
}
        $where['uid'] = $uid;
        $res = $this -> userModel -> editUserData($where,$save);
        if($res){
            $dataList = $returnCode['SUCCESS'][0];
        }else{
            $dataList = $returnCode['ERROR'][0];
        }
        wapReturn($dataList);
    }
}