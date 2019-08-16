<?php
namespace app\index\controller;
use think\Cache;
use think\Controller;
class base extends Controller {

    //保护方法
    protected $returnCode = '';
    protected $user = '';
    protected $debug = false;
    //前置操作方法
    function _initialize(){
        $username = empty($_SESSION['jmzn_web']['username']) ? '请登录' : $_SESSION['jmzn_web']['username'];
        $this -> assign('username',$username);
    }
}