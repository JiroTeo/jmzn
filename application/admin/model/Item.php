<?php
namespace app\admin\model;

use think\Model;

class item extends model{

    private static $itemModel; //

    //
    public function __construct(){
        parent::__construct();
        $this -> itemModel = db('item');
    }

    /*获取项目列表*/
    public function getItemData($where = false , $whereOr = false ){
        $itemData = $this -> itemModel -> whereOr($whereOr) -> where($where) -> order('id desc') -> paginate(10);
        //分页
        $page = $itemData->render();
        //转数组
        $data = iterator_to_array($itemData);
        $dataList['data'] = $this -> formarDataList($data);
        $dataList['page'] = $page;
        //格式化数据
        return $dataList;
    }

    /*格式化数据*/
    public function formarDataList($data){
        if(empty($data)){
            return array();
        }
        $userModel = \model('user');
        $cateModel = \model('category');
        $cityDb = db('city');
        $where = array();
        $cateWhere = array();
        $cityWhere = array();
        foreach ($data as $key => $value) {
//     area
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['name'] = $value['item_name'];
            $dataList[$key]['money'] = $value['min_money'].'~'.$value['max_money'];
            $dataList[$key]['img'] = $value['img'];
            $dataList[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
            $dataList[$key]['brand_make_time'] = date("Y-m-d",$value['brand_make_time']);
            $dataList[$key]['company'] = $value['company'];
            $dataList[$key]['address'] = $value['address'];
            $dataList[$key]['character'] = $value['character'];
            $dataList[$key]['reco'] = $value['reco'];
            $dataList[$key]['reco_brand'] = $value['reco_brand'];
            $dataList[$key]['order'] = $value['order'];
            $dataList[$key]['brand'] = $value['brand'];
            $dataList[$key]['reco_wap'] = $value['reco_wap'];
            //用户名
            $where['uid'] = $value['wid'];
            $userData = $userModel -> findUser($where);
            $dataList[$key]['username'] = empty($userData['uname']) ? '' : base64_decode($userData['uname']);
            //分类
            $cateWhere['id'] = $value['cate_id'];
            $cateData = $cateModel -> getCate($cateWhere);
            $dataList[$key]['cate_name'] = empty($cateData['name']) ? $value['cate_id'] : $cateData['name'];
            //加盟区域
            if(empty($value['item_area'])){
                $dataList[$key]['item_area'] = '全国';
            }else{
                $cityWhere['id'] = $value['item_area'];
                $dataList[$key]['item_area'] = $cityDb -> where($cityWhere) -> value('cityname');
            }
        }
        return $dataList;
    }

    /*修改项目信息*/
    public function editData($where,$data){
        $res = $this -> itemModel -> where($where) -> update($data);
        return $res;
    }
    /*项目详情*/
    public function itemDetail($where){
        $data = $this -> itemModel -> where($where) -> find();
        return $data;
    }

    /*删除组内项目*/
    public function delGroupItemData($tid){
        $groupSubModel = db('group_sub');
        $where['tid'] = $tid;
        $save['status'] = 0;
        $result = $groupSubModel -> where($where) -> update($save);
        return $result;
    }

    /*获取项目数据*/
    public function getItem($where){
        $data = $this -> itemModel -> where($where) -> find();
        if(empty($data)){ return array(); }
        //格式化数据
        $image = config('IMAGE');
        $dataList['id'] = $data['id'];
        $dataList['img'] = $image['PERFIX'].$data['img'];
        $dataList['brand'] = empty($data['brand']) ? '未填写' : $data['brand'];
        $dataList['money'] = $data['min_money']."~".$data['max_money'];
        $dataList['company'] = $data['company'];
        $dataList['address'] = $data['address'];
        $dataList['cate_id'] = $data['cate_id'];
        $cateWhere['id'] = $data['cate_id'];
        $dataList['cate_name'] = db('category') -> where($cateWhere) -> value('name');
        $dataList['cate_id'] = $data['cate_id'];
        $dataList['character'] = $data['character'];
        if(empty($data['item_area'])){
            $dataList['item_area'] = '全国';
        }else{
            $cityWhere['id'] = $data['item_area'];
            $dataList['item_area'] = db('city') -> where($cityWhere) -> value('cityname');
        }
        return $dataList;
    }

    /*  获取项目详情数据    */
    public function getItemDataOnice($where = false , $type = false){
        $data = $this -> itemModel -> where($where) -> find();
        if(empty($data)){   return [];  }
        //格式化数据
        $dataList = $this -> formatItemDataDetail($data);
        return $dataList;
    }

    /*  格式化项目详情数据   */
    public function formatItemDataDetail($data = false){
        $perfix = config('IMAGE');
        //项目信息start
        $itemData['id'] = $data['id'];//唯一标识
        $itemData['item_name'] = $data['item_name'];//项目名称
        $itemData['followcount'] = $data['followcount'];//关注数量
        $itemData['apply'] = $data['apply'];  //申请加盟
        $itemData['fran_store_num'] = $data['fran_store_num'];//加盟店数量
        $itemData['shop_count'] = $data['shop_count'];//直营店数量
        $itemData['money'] = $data['min_money'] . '~' .$data['max_money'] ;//最小投资金额
        $itemData['collectcount'] = $data['collectcount'];//收藏数量
        $itemData['count'] = $data['count'];//咨询数量
        $itemData['detail'] = $data['detail'];//项目详情
        $itemData['recommend'] = $data['recommend'];//项目介绍
        $itemData['crowd'] = $data['crowd'];//适合人群
        $itemData['cate_id'] = $data['cate_id'];//行业分类id
        $itemData['item_area'] = $data['item_area'];//加盟区域id
        //加盟区域
        $cityWhere['id'] = $data['item_area'];
        $area_name = db('city') -> where($cityWhere) -> value('cityname');
        $itemData['area_name'] = empty($area_name) ? '全国' : $area_name;
        //所属行业
        $cateWhere['id'] = $data['cate_id'];
        $itemData['cate_name'] = db('category') -> where($cateWhere) -> value('name');
        if($data['cate_id'] == $data['cate_pid']){
            $itemData['father_cate_name'] = '全部';
        }else{
            $itemData['father_cate_name'] = db('category') -> where(['id'=>$data['cate_pid']]) -> value('name');
        }
        //轮播图
        $image = explode(',',trim($data['image'],','));
        foreach ($image as $key => $value) {
            $itemData['image'][$key] =$value;
        }
        $itemData['reco_wap'] = $data['reco_wap'];//加盟区域id
        //项目信息end   企业用户信息start
        $userData['brand'] = $data['brand'];
        $userData['company'] = $data['company'];
        $userData['logo'] = empty($data['logo']) ? '' : $data['logo'];
        $userData['character'] = $data['character'];
        $userData['money'] = $data['money'];
        $userData['scope'] = $data['scope'];
        $userData['brand_make_time'] = date("Y-m-d H:i:s",$data['brand_make_time']);
        $userData['address'] = $data['address'];
        $info['item'] = $itemData;
        $info['user'] = $userData;
        return $info;
    }

}