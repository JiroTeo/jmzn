<?php
namespace app\wap\model;

use think\Model;

class follow extends Model{
     private static $followModel; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> followModel = db('follow');
    }

    /*获取tid*/
    public function getTid($where){
        $data = $this -> followModel -> where($where) -> select();
        $tid = '';
        foreach ($data as $index => $datum) {
            $tid .= $datum['tid'].',';
        }
        return $tid;
    }

    /*添加数据*/
    public function addData($where){

        $result = $this -> followModel -> where($where) -> find();
        if(empty($result)){
            $data = $where;
            $data['status'] = 1;
            $data['addtime'] = time();
            $followId = $this -> followModel -> insertGetId($data);
            return $followId;
        }else{
            $data['status'] = 1;
            $result = $this -> followModel -> where($where) -> update($data);
            return $result;
        }
    }

    /*删除关注/收藏*/
    public function delFollow($where){
        $edit['status'] = 0;
        $res = $this -> followModel -> where($where) -> update($edit);
        return $res;
    }
    /*统计数量*/
    public function getCount($where){
        $count = $this -> followModel -> where($where) -> count();
        return $count;
    }
}