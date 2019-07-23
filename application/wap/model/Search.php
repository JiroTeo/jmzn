<?php
namespace app\wap\model;

use think\Model;

class search extends Model{

    private static $logModels; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> logModel = db('search_log');
    }

    /*获取历史记录shuju*/
    public function getLog($where){
        $data=$this -> logModel-> where($where) -> Distinct(true)->field('id,word')-> limit(10) -> order('id desc')->select();
        return $data;

    }

    /*删除历史纪录*/
    public function delLogData($where){
        $data['status'] = 0;
        $res = $this -> logModel -> where($where) -> update($where);
        return $res;
    }
    /*格式化数据*/
    public function formatSearchData($data){
        $formatData = array();
        if(empty($data)){
            $formatData[0]['id'] = 1;
            $formatData[0]['word'] = '餐饮';
            $formatData[1]['id'] = 1;
            $formatData[1]['word'] = '机器人教育';
            $formatData[2]['id'] = 1;
            $formatData[2]['word'] = '服装';
            return $formatData;
        }
        foreach ($data as $index => $datum) {
            $formatData[$index]['id'] = $datum['id'];
            $formatData[$index]['word'] = $datum['word'];
        }
        return $formatData;
    }
}