<?php
namespace app\wap\model;

use think\Cache;
use think\Model;

class track extends Model{

    private static $articleModel; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> trackModel = db('track_log');
    }

    /*添加项目到足迹*/
    public function addTrack($where){
        //查询浏览记录是否存在
        $trackData = $this -> trackModel -> where($where) -> find();
        $result = false;
        if(empty($trackData)){//足迹不存在 添加
            $addData = $where;
            $addData['status'] = 1;
            $addData['addtime'] = time();
            $result = $this -> trackModel -> insertGetId($addData);

        }else{//足迹存在
            //验证status 0无效1有效
            if($trackData['status'] = 0){//无效改变为有效。有效不处理
                $save['status'] = 1;
                $result = $this -> trackModel -> update($save);
            }
        }
        return $result;
    }

    /*  TODO 获取我的足迹
     *
     * */
    public function getMyTrackTid($where){
        $trackData = $this -> trackModel -> where($where) -> order('addtime desc') -> select();
        $idStr = '';
        foreach ($trackData as $key => $val) {
            $idStr .= $val['tid'].',';
        }
        return trim($idStr,'.');
    }

    /*  TODO 清空我的足迹
     * */
    public function clearTrackLog($where){
        $save['status'] = 0;
        $res = $this -> trackModel -> where($where) -> update($save);
        return $res;

    }
}