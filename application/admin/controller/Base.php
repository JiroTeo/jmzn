<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class base extends Controller {
    //前置操作方法
    function _initialize(){
        if(empty($_SESSION['admin']['username'])){
            $this->error('请先登陆','login/index');//未登录则自动跳转到登陆页面
        }
    }
}