<?php
namespace app\admin\model;

use think\Model;

class Group extends Model{

    private static $groupModel;
    //
    public function __construct(){
        parent::__construct();
        $this -> groupModel = db('group');
    }

    /*  JS接口 获取项目组数据    */
    public function getJsGroupData($where){
        $data = $this -> groupModel -> where($where) -> order('id asc') -> select();
        if(empty($data)){   return [] ; }
        foreach ($data as $key => $value) {
            $dataList[$value['id']] = $value['name'];
        }
        $dataList[999] = '默认广告';
        return $dataList;
    }
}