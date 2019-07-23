<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class login extends Controller{

    // 构造方法
     public function __construct(){
        parent::__construct();
        // 实例化分类模型
        $this -> userModel = model('user');
        
    }

    /*登录首页*/
    public function index(){
        return view();
    }
    /*验证登录*/
    public function login(){
        // 接收参数
        $data = $_POST;
        if(!$data){
            $this -> error("别捣乱行吗？用户名和密码你至少填一个啊");
        }
        // 查询用户是否存在
        $where['status'] = 1;                               //用户状态。0无效已删除 1有效可以登录
        $where['uname'] = base64_encode($data['username']); //用户名   
        $where['password'] = md5($data['password']);        //用户密码
        $where['type'] = 2;                                 //用户类型 2为后台管理员
        $res= $this -> userModel -> findUser($where);
        if($res){
            $_SESSION['admin']['username'] = base64_decode($res['uname']);
            $_SESSION['admin']['uid'] = $res['uid'];
            $this -> success("登录成功,即将跳转到首页",$_SERVER['HTTP_HOST'].'/inv/public/index.php/admin/index/index');
        }else{
            $this -> error("登陆失败，用户名或者密码错误",$_SERVER['HTTP_REFERER']);
        }
        
    }

    /*退出登录*/
    public function logout(){
        // 注销用户 销毁session
        $_SESSION['admin'] = array();
        // dump($_SESSION);die;
        if(empty($_SESSION['admin'])){
            $this -> success('注销成功','index');
        }else{
            $this -> error('退出登录失败');
        }
    }
}
