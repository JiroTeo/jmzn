<?php
namespace app\wap\model;

use think\Model;

class item extends Model{

    private static $itemModel; //
    // 构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> itemModel = db('item');
    }

    /*添加项目专题*/
    public function addItemData($data){
        $res = $this -> itemModel -> insert($data);
        return empty($res) ? false : $res;
    }
    /*获取项目数据（单条）*/
    public function getItemData($where){
        $data = $this -> itemModel -> where($where) -> find();
        if(empty($data)){
            return array();
        }
        //格式化数据
        $dataList= $this -> formatData($data);
        return $dataList;
    }
    /*格式化-个人中心-我的留言-项目格式*/
    public function formatData($data){
        $dataList['title'] = $data['item_name'];
        $dataList['img_url'] = empty($data['img']) ? '' : 'https://www.jiamengzhinan.com'.trim($data['img'],'.');
        $dataList['sign'] = $data['recommend'];
        $dataList['id'] = $data['id'];
        $dataList['shop_count'] = $data['shop_count'];
        $dataList['apply'] = $data['apply'];
        $dataList['detail'] = $data['detail'];
        $dataList['min_money'] = $data['min_money'];
        $dataList['max_money'] = $data['max_money'];
        $dataList['addtime'] = date($data['id'],$data['addtime']);
        $where['uid'] = $data['wid'];
        $userData = db('user') -> where($where) -> find();
        $dataList['avatar'] = empty($userData['avatar']) ? 'https://www.jiamengzhinan.com/uploads/defultavatar.jpg' : 'https://www.jiamengzhineng.com'.trim($userData['avatar'],'.');
        $dataList['username'] = empty($userData['uname']) ? '' : base64_decode($userData['uname']);
        $dataList['uid'] = $data['wid'];

        return $dataList;
    }

    /*获取专题数据*/
    public function getItem($where,$limit=false){
        $itmeData = $this -> itemModel -> where($where) -> limit($limit) -> order('addtime desc') -> select();
        $data = $this -> formatItemData($itmeData);
        return $data;
    }
    /*获取专题数据详情*/
    public function itemDetail($where,$user){
        $data = $this -> itemModel -> where($where) -> find();
        //项目浏览量+1
        $this -> itemModel -> where($where) -> setInc('read_num');
        //格式化专题详情数据
        return $this -> formatDataDetail($data,$user);

    }

    /*格式化列表数据*/
    public function formatItemData($data){
        if(empty($data)){
            return array();
        }
        //假数据 start
        $formatData = array();
        //end
        $cateModel = \model('category');
        foreach ($data as $key => $value) {
            $formatData[$key]['id'] = $value['id'];
            $formatData[$key]['name'] = $value['item_name'];
            $formatData[$key]['title'] = $value['item_name'];
            $formatData[$key]['sign'] = $value['recommend'];
            $formatData[$key]['min_money'] = $value['min_money'];
            $formatData[$key]['max_money'] = $value['max_money'];
            $formatData[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
            $formatData[$key]['cate_id'] = $value['cate_id'];
            $where['id'] = $value['cate_id'];
            $formatData[$key]['cate'] = $cateModel -> getCateName($where);
            $formatData[$key]['apply'] = $value['apply'];
            $formatData[$key]['shop_count'] = $value['shop_count'];
            $formatData[$key]['img_url'] = 'https://'.$_SERVER['SERVER_NAME'].trim($value['img'],'.');
            $formatData[$key]['con_status'] = 1;
        }
        return isset($formatData) ? $formatData : array();
    }

    /*格式化详情数据*/
    public function formatDataDetail($data,$user){
        if(empty($data)){
            return array();
        }
        $formatData = array();
        $formatData['id'] = $data['id'];//唯一标识
        $formatData['item_name'] = $data['item_name'];//项目名称
        $formatData['img_url'] = 'http://'.$_SERVER['SERVER_NAME'].trim($data['img'],'.');//图片地址
        $formatData['recommend'] = $data['recommend'];//项目介绍
        $formatData['href'] = $data['href'];//项目官网
        $formatData['followcount'] = $data['followcount'];//关注数量
        $formatData['apply'] = $data['apply'];  //申请加盟
        $formatData['fran_store_num'] = $data['fran_store_num'];//加盟店数量
        $formatData['shop_count'] = $data['shop_count'];//直营店数量
        $formatData['cate_name'] = '餐饮';//所属行业    TODO
        $formatData['cate_id'] = $data['cate_id'];//所属行业    TODO
        $formatData['shop_num'] = $data['shop_count'] + $data['fran_store_num'];
        $formatData['area_name'] = '石家庄';//地区   TODO
        $formatData['crowd'] = $data['crowd'];//适合人群
        $formatData['company'] = $data['company'];//所属公司
        $formatData['character'] = $data['character'];//公司性质
        $formatData['money'] = $data['money'];//注册资金
        $formatData['scope'] = $data['scope'];//经营范围
        $formatData['address'] = $data['address'];//注册地址
        $formatData['collectcount'] = $data['collectcount'];//收藏数量
        $formatData['count'] = $data['count'];//咨询数量
        $formatData['brand_make_time'] = $data['brand_make_time'];//品牌注册时间
        $formatData['detail'] = $data['detail'];//项目详情
        $formatData['item_area'] = $data['item_area'];//加盟区域
        $formatData['cost'] = $data['cost'];//最小投资金额
        $formatData['min_money'] = $data['min_money'];//最小投资金额
        $formatData['max_money'] = $data['max_money'];//最大投资金额
        $formatData['adv'] = $data['adv'];//加盟优势
        $formatData['path'] = $data['path'];//加盟流程
        if(empty($user)){
            $formatData['is_foll'] = 0;//关注状态 1关注0未关注
            $formatData['is_like'] = 0;//收藏状态 1收藏0未收藏
        }else{
            $followModel = \model('follow');
            $where['status'] = 1;
            $where['uid'] = $user['uid'];
            $where['tid'] = $data['id'];
            $where['ftype'] = 1;
            $result = $followModel -> getCount($where);
            $formatData['is_foll'] = empty($result) ? 0 : 1;
            $where['ftype'] = 2;
            $res = $followModel -> getCount($where);
            $formatData['is_like'] = empty($res) ? 0 : 1;
        }




        $image = explode(',',trim($data['image'],','));//轮播数组
        foreach ($image as $key => $value) {
            $arr[] = 'https://'.$_SERVER['SERVER_NAME'].$value;
        }$formatData['image'] = $arr;

        return $formatData;
    }

    /*统计项目总量*/
    public function itemCount($where=''){

        $count = $this -> itemModel -> where($where) -> count();
        return $count;
    }

    /*获取项目value的平均值*/
    public function getAvgCount($value ,$where = ''){
        $avgCount = $this -> itemModel ->  where($where) -> avg($value);
        return $avgCount;
    }
    /*获取项目value的最大值*/
    public function getMaxCount($value ,$where = ''){
        $maxCount = $this -> itemModel -> where($where) -> max($value);
        return $maxCount;
    }
    /*获取项目value的最小值*/
    public function getMinCount($value ,$where = ''){
        $minCount = $this -> itemModel -> where($where) -> min($value);
        return $minCount;
    }

    /*执行咨询数量+1*/
    public function addCount($where){
        $res = $this -> itemModel -> where($where) -> setInc('count');
        return $res;
    }
    /*执行申请数量+1*/
     public function addApply($where){
        $res = $this -> itemModel -> where($where) -> setInc('apply');
        return $res;
    }

}