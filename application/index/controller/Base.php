<?php
namespace app\index\controller;
use think\Cache;
use think\Controller;
use app\index\model\Search as logModel;
class base extends Controller {

    //保护方法
    protected $returnCode = '';
    protected $user = '';
    //前置操作方法
    function _initialize(){
        //RETURNLOG
        $this -> returnCode = config('RETURNLOG');
        //session
        $username = empty($_SESSION['jmzn_web']['username']) ? '请登录' : $_SESSION['jmzn_web']['username'];
        $_SESSION['jmzn_web']['uid'] = empty($_SESSION['jmzn_web']['uid']) ? false : $_SESSION['jmzn_web']['uid'];
        //热门搜索
        $logModel = new logModel();
        $hotLog = $logModel -> getLog(['type'=>1,'status'=>1]);
        //分配变量
        $this -> assign('username',$username);
        $this -> assign('hotLog',$hotLog);
        $this -> assign('title','加盟指南');
    }
}