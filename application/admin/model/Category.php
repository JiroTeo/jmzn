<?php
namespace app\admin\model;

use think\Model;

class Category extends Model
{

    private static $cateModel; // 日志模型(旧)

    // 
    public function __construct(){
        parent::__construct();
        $this -> cateModel = db('category');
    }
    //获取分类数据组
    public  function find($where){
        $data = $this -> cateModel -> where($where) -> select();
        return $data;
    }

    /*查询分类数据*/
    public function getCate($where){
        // 根据条件查询数据
        $data = $this -> cateModel -> where($where) -> find();
        return $data;
    }

    /*添加分类*/
    public function saveData($data){
        // 验证pid pid不存在则为顶级分类pid为0 pid存在直接存储
       if($data['pid'] != 0){
            // 插入数据并且获取id
            $getID = $this -> cateModel -> insertGetId($data); 
            // 修改path字段
            $upData['path'] = $data['path'].$getID.',';
            $result = $this -> cateModel -> where('id',$getID) -> update($upData);
       }else{
            $addData['pid'] = 0;
            $addData['path'] = '0,';
            $addData['name'] = $data['name'];
            $result = $this -> cateModel -> insertGetId($addData);
       }
       return $result;
    }

    /*删除分类*/
    public function delCate($where){
        $data['status'] = 0;
        $result = $this -> cateModel -> where($where) -> update($data);
        // echo $this -> getLastSql();die;
        return $result;
    }

    /*修改分类数据*/
    public function cateEdit($where,$data){
        // 修改数据
        $res = $this -> cateModel -> where($where) -> update($data);
        return $res;
    }

    /*获取子分类*/
    public function getChildCate($pid){
        $ChildWhere['pid'] = $pid;
        $ChildWhere['status'] = 1;
        $res = $this -> cateModel -> where($ChildWhere) -> select();
        foreach ($res as $key => $value) {
            $res[$key]['hot'] = empty($value['hot']) ? '设置为热门分类' : '取消热门分类' ;
            $res[$key]['reco'] = empty($value['reco']) ? '设置为推荐分类' : '取消推荐分类' ;
        }
        if($res){
            return $res;
        }else{
            return $res;
        }
    }
    /*获取分类列表*/
    public function getCateList($where){
        $data = $this -> cateModel -> where($where) -> select();
        return $data;
    }

    /*  js接口 获取分类*/
    public function getJsCateData($where){
        $data = $this -> cateModel -> where($where) -> order('reco desc , id asc , order desc ') -> select();
        if(empty($data)){   return [];  }
        foreach ($data as $key => $value) {
            $dataList[$value['id']] = $value['name'];
        }
        $dataList[999] = '默认广告';
        return $dataList;
    }

}