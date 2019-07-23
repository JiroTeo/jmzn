<?php
namespace app\index\model;

use think\Model;

class group extends Model{

    /*  todo    查询出分组所关联的项目 return idstr
     *  @param
     * **/

    private static $groupModel; //分组
    private static $groupSubModel; //关联组
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> groupModel = db('group');
        $this -> groupSubModel = db('group_sub');
    }

    /*  查询出分组所关联的项目 return idstr    */
    public function getItemIdStr($where,$order='',$limit='',$type='',$user=[]){
        $data = $this -> groupSubModel -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($data)){   return array(); }
        $idStr = '';
        foreach ($data as $key => $value) {
            $idStr .= $value['tid'].',';
        }
        return rtrim($idStr,',');
    }
}