<?php
namespace app\index\model;

use think\Model;

class follow extends Model{
     private $followModel; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> followModel = db('follow');
    }

    /*  关注、收藏 OR 取消关注。收藏  */ //关注收藏类型1关注项目2收藏项目3收藏文章
    public function addOrRemove($uid = false ,$tid = false ,$ftype = 1){
        $condition['uid'] = $uid;
        $condition['tid'] = $tid;
        $condition['ftype'] = $ftype;
        //查询数据是否存在
        $data = $this -> followModel -> where($condition) -> find();
        if(empty($data)){//不存在 执行添加
            $result = $this -> followModel -> insertGetId($condition);
        }else{//存在 执行修改状态
            $modify['status'] = empty($data['status']) ? 1 : 0 ;
            $result = $this -> followModel -> where($condition) -> update($modify);
        }
        return empty($result) ? false : true ;
    }


    /*获取tid*/
    public function getTid($where){
        $data = $this -> followModel -> where($where) -> select();
        $tid = '';
        foreach ($data as $index => $datum) {
            $tid .= $datum['tid'].',';
        }
        return trim($tid,',');
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