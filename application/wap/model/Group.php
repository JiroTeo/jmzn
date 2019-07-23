<?php
namespace app\wap\model;

use think\Model;

class group extends Model{
    private static $groupModel; //分组
    private static $groupListModel; //关联组
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> groupModel = db('group');
        $this -> groupListModel = db('group');
    }

    /*查询分组*/
    public function getGroup($where){
        $groupData = $this -> groupModel -> where($where)-> select();
        $data = $this -> formatGroupData($groupData);
        return isset($data) ? $data : array() ;
    }

    /*格式化数据*/
    public function formatGroupData($data){
        $formatData = array();
        //假数据 start
        if(empty($data)){
            $formatData[0]['id'] = 0;
            $formatData[0]['name'] = '一个专题';
            $formatData[0]['sign'] = '我就是一个专题';
            $formatData[0]['img_url'] = 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1560780595993&di=f00e0be96964d8d601b35e1a293be31a&imgtype=0&src=http%3A%2F%2Fpic3.16pic.com%2F00%2F09%2F60%2F16pic_960620_b.jpg';
            return $formatData;
        }

        //end
        foreach ($data as $key => $value) {
            $formatData[$key]['id'] = $value['id'];
            $formatData[$key]['name'] = $value['name'];
            $formatData[$key]['sign'] = $value['sign'];
            $formatData[$key]['img_url'] = 'https://'.$_SERVER['SERVER_NAME']. $value['img'];
        }
        return isset($formatData) ? $formatData : array();

    }
}