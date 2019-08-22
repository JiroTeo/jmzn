<?php
namespace app\index\controller;
use think\Cache;
use think\Controller;
class base extends Controller {

    //保护方法
    protected $returnCode = '';
    protected $user = '';
    //前置操作方法
    function _initialize(){
        //RETURNLOG
        $this -> returnCode = config('RETURNLOG');
        $username = empty($_SESSION['jmzn_web']['username']) ? '请登录' : $_SESSION['jmzn_web']['username'];
        $_SESSION['jmzn_web']['uid'] = empty($_SESSION['jmzn_web']['uid']) ? 25 : $_SESSION['jmzn_web']['uid'];
        $this -> assign('username',$username);
        $this -> assign('title','加盟指南');
    }
}