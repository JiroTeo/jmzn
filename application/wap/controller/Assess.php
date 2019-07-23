<?php
namespace app\wap\controller;
use think\Cache;
use think\Db;
use think\Controller;
class assess{

    private $assModel;
    private $itemModel;
    private $cateModel;
    public function __construct(){
        // 实例化y用户模型
        $this->assModel = model('assess');
        $this->itemModel = model('item');
        $this->cateModel = model('category');

    }

    /*发布并进行评估
     *  @param  name        姓名
     *  @param  city_id     城市id
     *  @param  cate_id     分类id 1，2，3，4，
     *  @param  money       投资金额
     *  @param  phone       手机号
     *  @param  resources   资源
     * */
    public function index(){
        $returnCode = config("RETURNLOG");
        //接收&&验证参数
        $code = $_REQUEST['code'];
        $cacheCode = Cache::get('CODE'.$_REQUEST['phone']);
//        验证 验证码是否一致
        if($code  != $cacheCode){//验证码错误直接跳出
            $dataList = $returnCode['ERROR'][1];
            $dataList['msg'] = '验证码错误';
            wapReturn($dataList);
        }
//        name='zj'&city_id='10'&cate_id='1'&money='15'&phone='15862411578'&code='0124'&resources='互联网'
        $data['name'] = $_REQUEST['name'];
        $data['city_id'] = $_REQUEST['city_id'];
        $data['like_cate_id'] = $_REQUEST['like_cate_id'];
        $data['cate_id'] = $_REQUEST['cate_id'];
        $data['money'] = $_REQUEST['money'];
        $data['phone'] = $_REQUEST['phone'];
        $data['resources'] = empty($_REQUEST['resources']) ? '' : $_REQUEST['resources'];
        $data['addtime'] = time();
        $res = $this -> assModel -> addAssData($data);
        //返回数据start
        if($res){
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = $res;
        }else{
            $dataList = $returnCode['ERROR'][4];
            $dataList['data'] = 0;
        }
        wapReturn($dataList);
    }
    /*  评估数据
     *  全部项目统计
     *  饼形图
     *  进度条图
     *  分布式数据统计
     * */
    public function assAllData(){
        $returnCode = config('RETURNLOG');
        //平台项目总量
        $itemCount = $this -> itemModel -> itemCount();
        $data['itemCount'] = $itemCount;

        //项目占比-饼状图
        $getCateIdStrWhere['pid'] = 0;
        $getCateIdStrWhere['status'] = 1;
        $getCateIdStr = $this -> cateModel -> getChildIdByWhere($getCateIdStrWhere);
        $getAllCateArr = explode(',',$getCateIdStr);//分割成数组
        $allCateIdFormat = $this -> getChildIdFormat($getAllCateArr);
        $allCateCount = $this -> getItemCountData($allCateIdFormat,1);
        $data['all_cate_count'] = $allCateCount;
        //项目符合度-进度条图
        //项目符合度-进度条图
        //获取意向行业和所属行业的id
        $id = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
        $where['id'] = $id;
        $assdata = $this -> assModel -> getAssEssData($where);
        $idStr = $assdata['cate_id'].','.$assdata['like_cate_id'];
        $cateIdArr = array_unique(explode(',',$idStr));//分割成数组 并且排重
        //遍历获取所关联行业的最大平均值和最小平均值
        $money = $assdata['money'];//预算值
        foreach ($cateIdArr as $key => $value) {
            $cateData = $this -> cateModel -> getCateData(['id'=>$value]);
            $fit[$key]['name'] = $cateData['name'];
            $fit[$key]['id'] = $cateData['id'];
            //获取子分类
            $cIds = $value.',';
            $cIds .= $this->cateModel -> getChildIdByWhere(['pid'=>$value,'status'=>1]);//当前分类下的全部子分类
            $min_avg = $this -> itemModel -> getAvgCount('min_money',['id'=>['in',$cIds],'status'=>1]);//获取最小平均值
            $max_avg = $this -> itemModel -> getAvgCount('max_money',['id'=>['in',$cIds],'status'=>1]);//获取最大平均值
            $avg = ( $max_avg + $min_avg ) / 2 ;//平均值
            $D_value = $money - $avg;//预算-平均=差值
            if($D_value < 0){//负数   小于平均值
                //转整数 算出和平均值的百分比
                $per = (-1 * $D_value) / $avg ;
                $fit[$key]['data'] = number_format(50 - $per,2);
            }else{//整数  大于平均值
                if(0 < $money - $max_avg){
                    $fit[$key]['data'] = number_format(100,2);
                }else{
                    $per = $D_value / $avg ;
                    $fit[$key]['data'] = number_format(50 + $per,2);
                }
            }
//            echo '平均'.$avg."<br/>";
//            echo '预算'.$assdata['money']."<br/>";
//            echo '差'.$D_value."<br/>";
        }

        //排序
        foreach ($fit as $key => $row) {
            $volume[$key]  = $row['data'];
            $edition[$key] = $row['name'];
        }
        array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $fit);
        $data['like_cate_count'] = $fit;


        //分布图
        //获取符合度最高的行业
        $getCidWherer['pid'] = $fit[0]['id'];
        $getCidWherer['status'] = 1;
        $cateIdStr = model('category') ->getChildIdByWhere($getCidWherer);
        $getCountWhere['id'] = array('in',trim($cateIdStr,','));
        $minCount = $this -> itemModel -> getMinCount('min_money',$getCountWhere);//最小值
        $maxCount = $this -> itemModel -> getMaxCount('max_money',$getCountWhere);//最大值
        $avgMinCount = $this -> itemModel -> getAvgCount('min_money',$getCountWhere);//最小平均值
        $avgMaxCount = $this -> itemModel -> getAvgCount('max_money',$getCountWhere);//最大平均值
        $avgCount = ($avgMinCount+$avgMaxCount)/2;
        $data['dcs'] = array(round($avgCount,2),round($minCount,2),round($avgMaxCount,2),round($avgMinCount,2),round($maxCount,2));
        $dataList['code'] = 200;
        $dataList['msg'] = '成功';
        $dataList['data'] = $data;
        wapReturn($dataList);

    }
    /*获取父级分类下的所有子分类并且格式化*/
    public function getChildIdFormat($data){
         foreach ($data as $key => $value) {
             if(!empty($value)){
                 $getCateNameWhere['id'] = $value;
                 $getCateNameWhere['status'] = 1;
                 $cateName = $this -> cateModel -> getCateName($getCateNameWhere);
                 $getChildIdWhere['pid'] = $value;
                 $getChildIdWhere['status'] = 1;
                 $childId = $this -> cateModel -> getChildIdByWhere($getChildIdWhere);
                 if(!empty($childId)){
                     $childIdArr[] = array('childId'=>$childId,'name'=>$cateName,'id'=>$value,);
                  }
             }
        }
         return empty($childIdArr) ? array() : $childIdArr;
    }
    /*统计类别下的项目*/
    public function getItemCountData($childIdArr,$type){
        if(empty($childIdArr)){
            if($type ==1){
                $cateItmeData[0]['data'] = '80';
            }else{
                $cateItmeData[0]['data'] = '80%';
            }
            $cateItmeData[0]['name'] = 15;
            $cateItmeData[0]['id'] = 15;
        }
        //统计类别下的项目
        $getItemData = array();
        foreach ($childIdArr as $key => $value) {
            $getItemData['cate_id'] = array('in',rtrim($value['childId'],','));
            $getItemData['status'] = 1;
            $cateItmeData[$key]['data'] = $this -> itemModel -> itemCount($getItemData);
            $cateItmeData[$key]['name'] = $value['name'];
            $cateItmeData[$key]['id'] = $value['id'];
        }
        return $cateItmeData;
    }

    /*柱状图统计*/
    public function getCateAvgCount(){
        $returnCode = config('RETURNLOG');
        //接收参数并且算出id
        $id = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
        $where['id'] = $id;
        $cateId = $this -> assModel -> getAssValue($where,'cate_id');//获取分类id
        $likeCateId = $this -> assModel -> getAssValue($where,'like_cate_id');//获取分类id
        $idStr = $cateId.','.$likeCateId;
        $cateIdArr = array_unique(explode(',',$idStr));//分割成数组 并且排重
        $cateIdStr = implode(',',$cateIdArr);
        $where['id'] = array('in',$cateIdStr);
        $where['status'] = 1;
        $cateData = $this -> cateModel -> getCate($where,false);
        //获取一条数据
        $cate_id = empty($_REQUEST['cate_id']) ? $cateData[0]['id'] : $_REQUEST['cate_id'];
        $getChildIdWhere['pid'] = $cate_id;
        $childIdStr = $this -> cateModel -> getChildIdByWhere($getChildIdWhere);
        $childIdStr = trim($childIdStr,',');
        $getAvgWhere['cate_id'] = array('in',$childIdStr);
        $getAvgWhere['status'] = 1;
        $minAvfCount = $this -> itemModel -> getAvgCount('min_money',$getAvgWhere);//最小平均值
        $maxAvfCount = $this -> itemModel -> getAvgCount('max_money',$getAvgWhere);//最小平均值
        $avgfCount = ($minAvfCount + $maxAvfCount) / 2;
        $fullCount = $maxAvfCount / 0.8 ;
        if(empty($minAvfCount)){
            $dataList = $returnCode['ERROR'][0];
            $dataList['data'] = array();
        }else{
            $data['min'] = number_format($minAvfCount,2);
            $data['max'] = number_format($maxAvfCount,2);
            $data['avg'] = number_format($avgfCount,2);
            $data['full'] = number_format($fullCount,2);
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = $data;
        }
        wapReturn($dataList);
    }


}