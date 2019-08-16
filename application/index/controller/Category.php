<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Request;

class category extends Base {

    private $cateModel;

    public function _initialize(){
        //继承构造方法
        parent::_initialize();
        // 实例化model
        $this->cateModel = model('category');
    }
    /*
     *  todo  获取分类数据
     *  todo  获取全部分类
     * **/

    /*根据pid来获取分类数据*/
    public function get_cate_data(){
        //接收参数
        $pid = empty($_REQUEST['d']) ? 0 : $_REQUEST['d'];
        $where['pid'] = $pid;
        $where['status'] = 1;
        $data = $this -> cateModel -> getCate($where);
        if(empty($data)){
            $dataList = $this -> returnCode['ERROR'][4];
        }else{
            $dataList = $this -> returnCode['SUCCESS'][0];
        }
        $dataList['data'] = empty($data) ? array() : $data ;
        wapReturn($dataList);
    }

    /*获取全部分类*/
    public function  get_cate_list(){
        $code = $this -> returnCode;
        $where['status'] = 1;
        $where['pid'] = 0;
        $cateDataList = $this -> cateModel -> getCataDataList($where);
        if(empty($cateDataList)){
            $dataList = $code['ERROR'][4];
            $dataList['data'] = array();
        }else{
            $dataList = $code['SUCCESS'][0];
            $dataList['data'] = $cateDataList;
        }
        wapReturn($dataList);
    }

    /*  十大品牌排行榜 */
    public function brand_ranking(){
        $cateData = $this -> cateModel -> getBrandRanking(['pid'=>0],'order desc,id desc');
        foreach ($cateData as $key => $value) {
            $dataList[$key]['cate_id'] = $value['id'];
            $dataList[$key]['cate_name'] = $value['name'];
            $where['cate_id'] = array('in',$value['ids']);
            $where['status'] = 1;
            $dataList[$key]['item_data'] = model('item') -> getItemDataList($where,'read_num desc , id desc',10,1);
        }
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $dataList;
        wapReturn($rinfo);

    }


}