<?php
namespace app\wap\controller;
use think\Db;
use think\Controller;
class category{

    private $cateModel;

    public function __construct(){
        // 实例化y用户模型
        $this->cateModel = model('category');
    }

    /**/
    public function cate_list(){
        //获取分类
        $where['status'] = 1;
        $where['pid'] = isset($_REQUEST['pid']) ? $_REQUEST['pid'] : 0 ;
        $data['cate'] = $this -> cateModel -> getCate($where,'');
        //热门分类
        $hot['hot'] = 1;
        $hot['status'] = 1;
        $data['hot'] = $this -> cateModel -> getCate($hot,'');
        //推荐分类
        $reco['reco'] = 1;
        $reco['status'] = 1;
        $data['reco'] = $this -> cateModel -> getCate($reco,'');
        $reData['code'] = 200;
        $reData['msg'] = '成功';
        $reData['data'] = $data;
        return json_encode($reData);
    }
    /*获取分类数据*/
    public function get_cate_data(){
        $pid = empty($_REQUEST['pid']) ? 0 : $_REQUEST['pid'];
        $where['pid'] = $pid;
        $where['status'] = 1;
        $data['data'] = $this -> cateModel -> getCate($where,'');
        $data['code'] = 200;
        $data['msg'] = '成功';
        wapReturn($data);
    }


}