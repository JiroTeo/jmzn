<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class category extends Base{

    // 构造方法
     public function __construct(){
        parent::__construct();
        // 实例化分类模型
        $this -> cateModel = model('category');
    }

//    类别列表
    public function category_list(){

        $where['status'] = 1;
        $where['pid'] = 0;
        $cateData =  db('category') -> where($where) -> paginate(10);
        $page = $cateData->render();
        $cateData = $cateData -> toArray();
        $data = $cateData['data'];
        if($data){
            foreach ($data as $key => $value) {
                $data[$key]['child'] = $this -> cateModel->getChildCate($value['id']);
                $data[$key]['name'] = $value['name'];
                $data[$key]['hot'] = empty($value['hot']) ? '设置为热门分类' : '取消热门分类' ;
                $data[$key]['reco'] = empty($value['reco']) ? '设置为推荐分类' : '取消推荐分类' ;
            }
        }
        $this -> assign('data',$data);
        $this -> assign('page',$page);
        return $this->view->fetch();
//        return view();
    }
   /*添加、编辑类别公用页面*/
    public function category_add(){

        // 通过$_POST来判断是执行添加操作还是渲染到页面
        if(empty($_POST)){//渲染到页面
            $this -> assign('pid',$_REQUEST['pid']);
            $this -> assign('path',$_REQUEST['path']);
            return view();
        }else{//执行添加操作
            //接收参数并且格式化添加数据
            $data = $_REQUEST;
            // dump($data);die;
            // 判断是否有图片上传
            if(!empty($_FILES['image_url']['size']) && $_FILES['image_url']['size'] != 0){//上传了图片就修改img如果没上传则不修改img字段
                // 实例化模型。调用上传文件函数
                $fileName = model('commen') -> uploade($_FILES);
                $addData['img'] = $fileName;
            }
            $addData['pid'] = $data['pid'];
            $addData['name'] = $data['name'];
            $addData['path'] = $data['path'];
            $res = $this -> cateModel -> saveData($addData);
            if($res){
                $this -> success('添加成功');
            }else{
                $this -> error('添加失败');
            }
        }
    }
    /*************************************
    *  删除类别
    *  删除主分类。子分类同样消食
    *  删除子分类不影响主分类
    ************************************/
    public function category_del(){
        if(isset($_GET['id'])){
            // 删除当前数据
            $where['id'] = $_GET['id'];
            $res = $this -> cateModel -> delCate($where);
            // 删除当前分类下所有的子分类
            $whe['pid'] = $_GET['id'];
            $result = $this -> cateModel -> delCate($whe);
            $this -> success('删除成功');
        }else{
            $this -> error('删除失败');
        }
    }

    // 修改分类  页面
    public  function cetegory_edit(){

    
        // 通过$_REQUEST['name']来判断是执行修改操作还是 将数据渲染到前台页面
        if(isset($_REQUEST['name'])){//修改操作
            // 接收参数
            $data = $_REQUEST;
            // 判断是否有图片上传
            if($_FILES['image_url']['size'] != 0){//上传了图片就修改img如果没上传则不修改img字段
                // 实例化模型。调用上传文件函数
                $fileName = model('commen') -> uploade($_FILES);
                $editData['img'] = $fileName;
            }

            // 定义条件     调用模型执行修改数据
            $where['id'] = $data['id'];
            $editData['name'] = $data['name'];
            $res = $this -> cateModel -> cateEdit($where,$editData);
            if($res){
                $this -> success("修改成功");
            }else{
                $this -> error('修改失败');
            }
        }else{//渲染页面
            // 定义条件查询出对应数据。并分配到前台页面
            $where['id'] = $_REQUEST['id'];
            $data = $this -> cateModel -> getCate($where);
            // dump($data);die;
            if(isset($data)){//分类存在
                $this -> assign('data',$data);
                return view();
            }else{//分类不存在
                $this -> error('分类不存在');
            }
        }
    }

    /*设置热门或者推荐*/
    public function set_hot(){
        $type = $_GET['type'];
        $id = $_GET['id'];
        $where['id'] = $id;
        $cateData = db('category') -> where($where) -> find();
        if($type == 1){//热门
            $edit['hot'] = empty($cateData['hot']) ? 1 : 0 ;
        }elseif($type == 2){//推荐
            $edit['reco'] = empty($cateData['reco']) ? 1 : 0 ;
        }
        $res = $this -> cateModel -> cateEdit($where,$edit);
        if($res){
            $this -> success('SET SUCCESS');
        }else{
            $this -> error("SET ERROR");
        }
    }

    /*设置排序*/
    public function cate_order(){
        $where['id'] = $_POST['id'];
        $eidtData['order'] = $_POST['order'];
        $res = db('category') -> where($where) -> update($eidtData);
        echo $res;
    }


    /*  接口：获取全部分类  */
    public function cateList(){
        $data = db('category') -> where(['pid'=>0,'status'=>1]) -> order('id asc') -> select();
        foreach ($data as $key => $value) {
            $child = $this -> getChildCateData(['pid'=>$value['id'],'status'=>1]);
            $dataList[$key]['name'] = $value['name'];
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['childList'] = $child;
        }
        wapReturn($dataList);
    }
    /*  获取子分类   */
    public function getChildCateData($where){
        $data = db('category') -> where($where) -> order('id asc') -> select();
        if(empty($data)){   return [];   }
        foreach ($data as $key => $value) {
            $dataList[$key]['name'] = $value['name'];
            $dataList[$key]['id'] = $value['id'];
        }
        return $dataList;
    }


}