<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class common{

    /*公共页面  页头*/
    public function header(){
        return view();
    }
    /*公共页面  侧导航*/
    public function min_meun(){
        return view();
    }

    /*公共页面 页脚*/
    public function footer(){
        return view();
    }
//
}