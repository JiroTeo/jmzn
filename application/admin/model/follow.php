<?php
namespace app\admin\model;

use think\Model;

class follow extends model{

    private static $followModel; // 

    // 
    public function __construct(){
        parent::__construct();
        $this -> followModel = db('follow');
    }

    /*查询关注数量*/
    public function countFoll($where){
        // 根据条件统计数量
        $count = $this -> followModel -> where('where') -> count();
        return $count;
    }
}