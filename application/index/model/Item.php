<?php
namespace app\index\model;

use think\Model;
use think\Request;
class Item extends Model{

    private static $itemModel; //
    // 构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> itemModel = db('item');
    }

    /*  todo  获取项目数据（单条）    getItemData
     *  todo  格式化-个人中心-我的留言-数据格式
     *  todo  获取项目详情(单条)
     *  todo  格式化列表数据
     *  todo  格式化详情数据       formatDataDetail
     *  todo  统计项目总量
     *  todo  获取平局值
     *  todo  获取最大值
     *  todo  获取最小值
     *  todo  执行咨询数量+1
     *  todo  执行申请数量+1
     *  todo  获取项目列表                getItemDataList
     *  todo  格式化热门排行数据
     *  todo  格式化品牌精选-图片展示
     *  todo  格式化-首页-项目推荐
     * **/

    public function getItemData( $where = false , $type = false , $user = false ){
        $data = $this -> itemModel -> where($where) -> find();
        if(empty($data)){   return [];  }
        	switch ($type) {
                case 1://详情页面
                    $dataList = $this -> formatDataDetail($data,$user);
                    break;
                case 2://项目列表
                    $dataList = $this -> formatItemDataList($data);
                    break;

                default:
                    # code...
                    break;
            }
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

    /*格式化详情数据*/
    public function formatDataDetail($data,$user){
        //图片路径配置
        $perfix = config('IMAGE');
        //项目信息start
        $itemData['id'] = $data['id'];//唯一标识
        $itemData['item_name'] = $data['item_name'];//项目名称
        $itemData['followcount'] = $data['followcount'];//关注数量
        $itemData['apply'] = $data['apply'];  //申请加盟
        $itemData['fran_store_num'] = $data['fran_store_num'];//加盟店数量
        $itemData['shop_count'] = $data['shop_count'];//直营店数量
        $itemData['min_money'] = $data['min_money'];//最小投资金额
        $itemData['max_money'] = $data['max_money'];//最大投资金额
        $itemData['collectcount'] = $data['collectcount'];//收藏数量
        $itemData['count'] = $data['count'];//咨询数量
        $itemData['detail'] = $data['detail'];//项目详情
        $itemData['recommend'] = $data['recommend'];//项目介绍
        $itemData['crowd'] = $data['crowd'];//适合人群
        $itemData['cate_id'] = $data['cate_id'];//行业分类id
        $itemData['cate_pid'] = $data['cate_pid'];//行业分类id
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
            $itemData['image'][$key] = trim($value,'.');
        }
        //关注状态 && 收藏状态
        if(empty($_SESSION['jmzn_web'])){
            $itemData['is_foll'] = 0;//关注状态 1关注0未关注
            $itemData['is_like'] = 0;//收藏状态 1收藏0未收藏
        }else{
            $fwhere['ftype'] = 1;
            $fwhere['status'] = 1;
            $fwhere['tid'] = $data['id'];
            $fwhere['uid'] = $_SESSION['jmzn_web']['uid'];
            $foll = db('follow') -> where($fwhere) -> count();
            $itemData['is_foll'] = empty($foll) ? 0 : 1;//关注状态 1关注0未关注
            $fwhere['ftype'] = 2;
            $like = db('follow') -> where($fwhere) -> count();
            $itemData['is_like'] = empty($like) ? 0 : 1;//收藏状态 1收藏0未收藏
        }
        //上一条||下一条
        $itemData['prev'] = $this -> itemModel -> where(['id'=>['LT',$data['id']]]) -> order('id desc') -> field('id,item_name') -> find();
        $itemData['next'] = $this -> itemModel -> where(['id'=>['GT',$data['id']]]) -> order('id asc') -> field('id,item_name') -> find();

        //项目信息end   企业用户信息start
        $userData['brand'] = $data['brand'];
        $userData['company'] = $data['company'];
        $userData['logo'] = empty($data['logo']) ? '' : $perfix['PERFIX'].$data['logo'];
        $userData['character'] = $data['character'];
        $userData['money'] = $data['money'];
        $userData['scope'] = $data['scope'];
        $userData['brand_make_time'] = date("Y-m-d H:i:s",$data['brand_make_time']);
        $userData['address'] = $data['address'];
        $info['item'] = $itemData;
        $info['user'] = $userData;
        return $info;
    }
    /*统计项目总量*/
    public function itemCount($where=''){

        $count = $this -> itemModel -> where($where) -> count();
        return $count;
    }
    /*获取项目value的平均值*/
    public function getAvgCount($value = false  ,$where = false){
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

    /*  分页模式获取项目列表  */
    public function getItemDataListPage($where = false , $order = false , $num = 10 , $type = 4 , &$page = '' , $debug = false ){
        $itemData = $this -> itemModel -> where($where) -> order($order) -> paginate($num,false,
            ['query' => Request::instance()->param()]);
        $page = $itemData ->render();
        $data = iterator_to_array($itemData);
        if(empty($data)){return [];}//数据不存在返回array();
        switch ($type) {
            case 1://热门排行/品牌精选品牌名展示
                $dataList = $this -> formatHotItemDataList($data,$debug);
                break;
            case 2://品牌精选-图片展示
                $dataList = $this -> formatChoiceDataList($data,$debug);
                break;
            case 3://品牌精选-图片展示
                $dataList = $this -> formatRecoItemDataList($data,$debug);
                break;
            case 4://项目列表-格式化
                $dataList = $this -> formatItemDataList($data,$debug);
                break;
            default:
                # code...
                break;
        }
        return $dataList;

    }

    /*获取项目列表*/
    public function getItemDataList($where=false  , $order=false , $limit=false ,$type=0 , $user=[] , $debug = false ){
         $data = $this -> itemModel -> where($where) -> order($order) -> limit($limit) -> select();
         if(empty($data)){return [];}//数据不存在返回array();
         	switch ($type) {
                case 1://热门排行/品牌精选品牌名展示
                    $dataList = $this -> formatHotItemDataList($data,$debug);
                    break;
                case 2://品牌精选-图片展示
                    $dataList = $this -> formatChoiceDataList($data,$debug);
                    break;
                case 3://品牌精选-图片展示
                    $dataList = $this -> formatRecoItemDataList($data,$debug);
                    break;
                case 4://项目列表-格式化
                    $dataList = $this -> formatItemDataList($data,$debug);
                    break;
                default:
                    # code...
                    break;
            }
         return $dataList;
    }
    /*格式化热门排行数据*/
    public function formatHotItemDataList($data){
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['brand'] = $value['brand'];
            $dataList[$key]['read_num'] = $value['read_num'];
        }
        return $dataList;
    }

    /*格式化品牌精选-图片展示*/
    public function formatChoiceDataList($data){
        $pic = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['img'] = empty($value['id']) ? '' : trim($value['img'],'.');
        }
        return $dataList;
    }

    /*格式化-首页-项目推荐*/
    public function formatRecoItemDataList($data){
        $image = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['item_name'] = $value['item_name'];//标题
            $dataList[$key]['money'] = $value['min_money'].'~'.$value['max_money'];//投资金额
            $dataList[$key]['shop_count'] = $value['shop_count'];//店铺数量
            $dataList[$key]['img'] = empty($value['img']) ? '' : trim($value['img'],'.');//封面图
        }
        return $dataList;
    }

    /*格式化-项目列表*/
    public function formatItemDataList( $data = false , $debug = false ){
        $perfix = config('IMAGE');
        $dbCate = db('category');
        $where = [];
        if(count($data) == count($data,1)){//一维数组
                $dataList['id'] = $data['id'];//id
                $dataList['item_name'] = $data['item_name'];//标题
                $dataList['img'] = empty($data['img']) ? '' : trim($data['img'],'.');//封面图
                $dataList['fran_store_num'] = $data['fran_store_num'];//加盟店数量
                $dataList['money'] = $data['min_money'] . '~' . $data['max_money'] ;//投资金额
                $dataList['apply'] = $data['apply'];//申请加盟数量
                $dataList['shop_count'] = $data['shop_count'];//直营店数量
                $dataList['addtime'] = date("Y-m-d",$data['addtime']);//发布时间
                $dataList['read_num'] = $data['read_num'];//发布时间
                $dataList['cate_id'] = $data['cate_id'];//直营店数量
                //所属行业
                $where['id'] = $data['cate_id'];
                $dataList['cate_name'] = $dbCate -> where($where) -> value('name');//获取行业名
        }else{//多维数组
            foreach ($data as $key => $value) {
                $dataList[$key]['id'] = $value['id'];//id
                $dataList[$key]['item_name'] = $value['item_name'];//标题
                $dataList[$key]['img'] = empty($value['img']) ? '' : trim($value['img'],'.');//封面图
                $dataList[$key]['fran_store_num'] = $value['fran_store_num'];//加盟店数量
                $dataList[$key]['money'] = $value['min_money'] . '~' . $value['max_money'] ;//投资金额
                $dataList[$key]['apply'] = $value['apply'];//申请加盟数量
                $dataList[$key]['shop_count'] = $value['shop_count'];//直营店数量
                $dataList[$key]['addtime'] = date("Y-m-d",$value['addtime']);//发布时间
                $dataList[$key]['read_num'] = $value['read_num'];//发布时间
                $dataList[$key]['cate_id'] = $value['cate_id'];//直营店数量
                //所属行业
                $where['id'] = $value['cate_id'];
                $dataList[$key]['cate_name'] = $dbCate -> where($where) -> value('name');//获取行业名
            }
        }
        return $dataList;
    }
}