<?php
namespace app\index\controller;
use think\Cache;
use think\Controller;
use think\Model;
class base extends Controller {

    //保护方法
    protected $returnCode = '';
    protected $user = '';
    protected $debug = false;
    //前置操作方法
    function _initialize(){
        //定义参数
        $this -> debug = empty($_REQUEST['debug']) ? false : $_REQUEST['debug'];
        $this -> returnCode = config('RETURNLOG');//返回码
        //用户信息（验证登录）
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        $this -> user = Cache::get($token);

    }
}