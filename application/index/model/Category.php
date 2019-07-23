<?php
namespace app\index\model;

use think\Model;

class category extends Model{

    private static $cateModel; //

    //构造方法 实例化数据库
    public function __construct()
    {
        parent::__construct();
        $this->cateModel = db('category');
    }

    /* @param   获取分类名字
     * @param   获取分类数据
     * @param   格式化分类数据
     * @param   通过条件获取分类的子级id
     * @param   获取分类的全部数据
     * @param   回调
     * **/

    /*  获取分类数据 单条*/
    public function getCateData($where){
        $cateData = $this -> cateModel -> where($where) -> find();
        if(empty($cateData)){   return [];  }
        return $cateData;
    }

    /*获取分类名字*/
    public function getCateName($where){
        $cateName = $this -> cateModel -> where($where) -> value('name');
        return $cateName;
    }

    /*获取分类数据*/
    public function getCate($where){
        $cateData = $this -> cateModel -> where($where) -> select();
        if(empty($cateData)){   return array(); }//如果为null指甲返回array();
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
        $imgConf = config('IMAGE');
        foreach ($data as $key => $value) {
            $formatData[$key]['id'] = $value['id'];
            $formatData[$key]['name'] = $value['name'];
            $formatData[$key]['img_url'] = empty($value['img']) ? '' : $imgConf['PERFIX'].ltrim($value['img'],'.');
        }
        return $formatData;
    }

    /*通过条件获取分类的子级id todo hold*/
    public function getChildIdByWhere($where){
        $childDataList = $this -> cateModel -> where($where) -> select();
        $childIdStr = '';
        foreach ($childDataList as $key => $value) {
            $childIdStr .= $value['id'].',';
        }
        return trim($childIdStr,',');
    }

    /*获取行业分类的全部数据*/
    public function getCataDataList($where){
        $data = $this -> cateModel -> where($where) ->select();
        if(empty($data)){   return []; }//如果为null指甲返回array();
        //格式化行业分类数据
        $formatData = $this -> formatCateData($data);
        //回调获取所有子分类
        $getChildWhere = [];
        foreach ($formatData as $key => $value) {
            $getChildWhere['pid'] = $value['id'];
            //获取子分类
            $formatData[$key]['child'] = $this -> getChildCateDataList($getChildWhere);
        }
        return $formatData;
    }

    /*回调函数*/
    public function getChildCateDataList($where){
        $data = $this -> cateModel -> where($where) -> select();
        if(empty($data)){   return array(); }//如果为null指甲返回array();
        //格式化数据
        $dataList = $this -> formatCateData($data);
        return $dataList;
    }

    /*  十大品牌分类  */
    public function getBrandRanking($where = false , $order = false ,$limit = false ,$type = false ){
        $cateData = $this -> cateModel -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($cateData)){   return [];  }
        foreach ($cateData as $key => $value) {
            $ids[$key]['name'] =  $value['name'];
            $ids[$key]['id'] =  $value['id'];
            $ids[$key]['ids'] =  $this -> getChildIdByWhere(['pid'=>$value['id'],'status'=>1]).','.$value['id'];
        }
        return $ids;
    }


}