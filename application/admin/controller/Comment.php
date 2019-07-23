<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class comment extends Base{

    // 构造方法
    public function __construct(){
        parent::__construct();
        // 实例化分类模型
        $this->commentModel = model('comment');
    }

    /*查看留言*/
    public function get_consult(){
        echo '你是来查看留言的吗';
        echo '这是你传过来的参数吗？';
        dump($_GET);
    }
}