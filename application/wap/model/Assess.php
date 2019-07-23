<?php
namespace app\wap\model;

use think\Model;

class assess extends Model{

    private static $assModel; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> assModel = db('assess');
    }

    /*添加评估*/
    public function addAssData($data){
        $res = $this -> assModel -> insertGetId($data);
        return $res;
    }

    /*获取评估数据的某个字段*/
    public function getAssValue($where,$value){
        $value = $this -> assModel -> where($where) -> value($value);
        return $value;
    }

    /*  获取某一条评估数据   */
    public function getAssEssData($where = false ){
        $data = $this -> assModel -> where($where) -> find();
        if(empty($data)){   return [];  }
        return $data;
    }

}