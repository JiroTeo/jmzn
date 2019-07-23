<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\View;

class brand extends Base{

    // 构造方法
    public function __construct(){
        parent::__construct();
        // 实例化分类模型
        $this -> dbBrand = db('brand');
    }

    /*  todo    品牌列表    brand_list
     *  todo    添加品牌    add_brand
     *  todo    删除品牌    edit_field_brand
     *  todo    修改品牌信息  edit_barnd_data
     * **/

    /*品牌列表*/
    public function brand_list(){
        //接收参数 && 定义条件 && 获取品牌信息
        $reco  = empty($_GET['reco']) ? 0 : $_GET['type'];
        $where['status'] = 1;
        $brandObj = $this -> dbBrand -> where($where) -> order('order asc,addtime desc') -> paginate(20);
        $page =  $brandObj -> render();
        $data = iterator_to_array($brandObj);
        $this -> assign('data',$data);
        $this -> assign('page',$page);
        return view();
    }

    /*添加品牌*/
    public function add_brand(){
        $data = input('post.');
        if(empty($data)){
            return view();
        }else{
            $data['addtime'] = time();
            $result = $this -> dbBrand -> insertGetId($data);
            if($result){
                $this -> success('添加成功');
            }else{
                $this -> error('添加失败');
            }
        }
    }

    /*修改品牌信息*/
    public function edit_barnd_data(){
        $data = input('post.');
        if(empty($data)){
            $where['id'] = input('get.id');
            $data = $this -> dbBrand -> where($where) -> find();
            $this -> assign('data',$data);
            return view();
        }else{
            $where['id'] = $data['id'];
            unset($data['id']);
            $result = $this -> dbBrand -> where($where) -> update($data);
            if($result){
                $this -> success('修改成功');
            }else{
                $this -> error('修改失败');
            }

        }
    }

    /*修改品牌字段*/
    public function edit_field_brand(){
        $where['id'] = input('get.id');
        $type = input('get.type');
        switch ($type) {
            case 1://删除品牌
                $save['status'] = 0;
                break;
            default:
                $this -> error('滚犊子');
                break;
        }
        $result = $this -> dbBrand -> where($where) -> update($save);
        if($result){
            $this -> success('操作成功');
        }else{
            $this -> error('操作失败');
        }

    }


}