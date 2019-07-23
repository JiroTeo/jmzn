<?php
namespace app\wap\model;

use think\Model;

class category extends Model{

    private static $cateModel; //

    //构造方法 实例化数据库
    public function __construct()
    {
        parent::__construct();
        $this->cateModel = db('category');
    }

    /*获取分类名字*/
    public function getCateName($where){
        $cateName = $this -> cateModel -> where($where) -> value('name');
        return $cateName;
    }

    /*获取分类数据*/
    public function getCate($where){
        $cateData = $this -> cateModel -> where($where) -> select();
        $data = $this -> formatCateData($cateData);
        return $data;
    }
    /*获取子分类数据*/
    public function getChildData($pid){
        $where['pid'] =  $pid;
        $where['status'] =  1;
        $childData = $this -> cateModel -> where($where) -> select();
        $data = $this -> formatCateData($childData);
        return $data;
    }

    /*格式化数据*/
    public function formatCateData($data){
        $formatData = array();
        foreach ($data as $key => $value) {
            $formatData[$key]['id'] = $value['id'];
            $formatData[$key]['name'] = $value['name'];
            $formatData[$key]['img_url'] = "https://www.jiamengzhinan.com/".$value['img'];
        }
        return $formatData;
    }

    /*通过条件获取分类*/
    public function getChildIdByWhere($where){
        $childDataList = $this -> cateModel -> where($where) -> select();
        $childIdStr = '';
        foreach ($childDataList as $key => $value) {
            $childIdStr .= $value['id'].',';
        }
        return $childIdStr;
    }

    /*  获取分类数据 单条*/
    public function getCateData($where){
        $cateData = $this -> cateModel -> where($where) -> find();
        if(empty($cateData)){   return [];  }
        return $cateData;
    }
}