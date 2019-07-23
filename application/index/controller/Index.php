<?php
namespace app\index\controller;
use Iosapi\Model\redis;
use think\Cache;
use think\Db;
use think\Controller;
class index extends Base{

    /*  todo    项目列表            data_list
     *  todo    区域二级联动        area
     *  todo    广告位              image_data_list
     *  todo    格式化广告信息      formatImageDataList
     *  todo    品牌聚焦接口        index_brand_list
     * **/

    public function __construct(){
        parent::_initialize();
    }

    public function index(){
        return view();
    }

    /*  首页接口   分类/行业资讯/项目推荐/品牌精选/品牌聚焦*/
    public function index_home(){
        //首页-行业资讯 start
        $artwhere['status'] = 1;
        $artwhere['reco'] = 1;
        //获取两条推荐的文章
        $artModel = model('article');
        $imgData = $artModel -> getArticleData($artwhere,'addtime desc',2,1);
        if($imgData) {
            foreach ($imgData as $key => $value) {
                $arData[$key]['rArticle'] = $imgData[$key];
                //获取最新的文章 定义读取条数
                $num = $key * 7;
                $limit = $num . ',7';
                $arData[$key]['aticle'] = $artModel->getArticleData('', 'addtime desc', $limit, 2);
            }
        }else{
            $arData = [];
        }
        $data['hot_art'] = $arData;
        //首页-行业资讯 end
        //推荐项目start
        $itemwhere['status'] = 1;
        $itemwhere['reco'] = 1;
        $data['hot_item'] = model('item') -> getItemDataList($itemwhere,'addtime desc',10,3);
        //推荐项目end
        //品牌精选start
        $bwhere['gid'] = config('CHOICE');
        $bwhere['status'] = 1;
        $bwhere['reco_img'] = 1;
        $imgIdStr = model('group') -> getItemIdStr($bwhere,'addtime desc',5);
        unset($bwhere['reco_img']);
        $bwhere['reco_brand'] = 1;
        $brandIdStr = model('group') -> getItemIdStr($bwhere,'addtime desc',7);
        //查询出内容
        $itemWhere['id'] = array('in',$brandIdStr);
        $itemWhere['status'] = 1;
        $brandItme['brand'] = model('item') -> getItemDataList($itemWhere,'id desc','',1);
        $itemWhere['id'] = array('in',$imgIdStr);
        $brandItme['image'] = model('item') -> getItemDataList($itemWhere,'id desc','',2);
        $data['group'] = $brandItme;
        //品牌精选end
        //品牌聚焦
        $dbBrand = db('brand');
        $brandwhere['status'] = 1 ;
        $brandData = $dbBrand -> where($brandwhere) -> order('addtime desc') -> select();
        //格式化 数据
        $perfix = config('IMAGE');
        $link = config('LINK')['WEB'];
        foreach ($brandData as $key => $value) {
            $dataList[$key]['name'] = $value['name'];
            $dataList[$key]['img'] = empty($value['img']) ? '' : $perfix['PERFIX'].$value['img'] ;
            $dataList[$key]['type'] = $value['type'];
            switch ($value['type']) {
                    case 1://外链
                        $dataList[$key]['link'] = empty($value['link']) ? 'javascript:;' : $value['link'];
                        break;
                    case 2://链接到项目
                        $dataList[$key]['link'] = empty($value['link']) ? '' : $link['ITEM'].trim($value['link']);
                        break;
                    case 3://链接到文章
                        $dataList[$key]['link'] = empty($value['link']) ? '' : $link['ARTICLE'].trim($value['link']);
                        break;
                    default://外链
                        $dataList[$key]['link'] = $value['link'];
                        break;
                }
            }
        $data['brand'] = empty($dataList) ? [] : $dataList;
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }


    /*区域二级联动*/
    public function area(){
        $city = db('city');
        $where['pid'] = empty($_REQUEST['pid']) ? 0 : $_REQUEST['pid'];
        $cityData = $city -> where($where) -> select();
        if($cityData){
            $rinfo = $this -> returnCode['SUCCESS'][0];
            $rinfo['data'] = $cityData;
        }else{
            $rinfo = $this -> returnCode['ERROR'][4];
        }
        wapReturn($rinfo);
    }

    /*广告位*/
    public function image_data_list(){
        //定义参数
        $position = config('ADPOS')['WEB']['POSITION'];
        $imageDb = \db('image');
        //接收参数
        $wp = empty($_REQUEST['wp']) ? wapReturn($this->returnCode['ERROR'][1]) : $_REQUEST['wp'];
        $where['web_page'] = $wp;
        $where['client'] = 1;
        $where['status'] = 1;
        foreach ($position as $key => $value) {
            $where['position'] = $key;
            $data = $imageDb -> where($where) -> order('addtime desc') -> select();
            $dataList[] = $this -> formatImageDataList($data);
        }
            $rinfo = $this -> returnCode['SUCCESS'][0];
            $rinfo['data'] = $dataList;
        wapReturn($rinfo);

    }

    /*格式化广告信息*/
    public function formatImageDataList($data){
        if(empty($data)){   return [];  }
        $link = config('LINK')['WEB'];
        $image = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['title'] = $value['title'];
            $dataList[$key]['sign'] = $value['sign'];
            $dataList[$key]['type'] = $value['type'];
            switch ($value['type']) {
                case 1://外链
                    $dataList[$key]['link'] = empty($value['link']) ? 'javascript:;' : $value['link'];
                    break;
                case 2://链接到项目
                    $dataList[$key]['link'] = empty($value['link']) ? '' : $link['ITEM'].trim($value['link']);
                    break;
                case 3://链接到文章
                    $dataList[$key]['link'] = empty($value['link']) ? '' :  $link['ARTICLE'].trim($value['link']);
                    break;
                default://外链
                    $dataList[$key]['link'] = $value['link'];
                    break;
            }

                $dataList[$key]['img'] = $image['PERFIX'].$value['img'];
            }
            return $dataList;
    }

    /*品牌聚焦接口*/
    public function index_brand_list(){
        $dbBrand = db('brand');
        $where['status'] = 1 ;
        $data = $dbBrand -> where($where) -> order('addtime desc') -> select();
        if(empty($data)){
            $rinfo = $this -> returnCode['ERROR'][1];
            wapReturn($rinfo);
        }
        //格式化 数据
        $perfix = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['name'] = $value['name'];
            $dataList[$key]['img'] = empty($value['img']) ? '' : $perfix['PERFIX'].$value['img'] ;
            $dataList[$key]['type'] = $value['type'];
            $dataList[$key]['link'] = $value['link'];
        }
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $dataList;
        wapReturn($rinfo);
    }
}
