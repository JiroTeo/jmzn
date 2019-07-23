<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class search extends Base{

    /*搜索记录列表*/
    public function index(){
        $logModel = db('search_log');
        $userModel = db('user');
        //分页搜索
        $type = empty($_GET['type']) ? 0 : $_GET['type'] ;
        if($type == 1){
            $where['status'] = 1;
        }
        $where['type'] = $type;
//        $logData = $logModel -> Distinct(true) -> where($where) -> order('id desc') -> paginate(10);
        $logData = $logModel -> group('uid,word') -> where($where) -> order('id desc') -> paginate(10);
//        $logData = $logModel -> where($where) -> order('id desc') -> paginate(10);
        $page = $logData -> render();
        //对象转换为数组
        $data = iterator_to_array($logData);
        $uWhere = array();
        foreach ($data as $key => $value) {
            $uWhere['uid'] = $value['uid'];
            $userData = $userModel -> where($uWhere) -> find();
            $data[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
            $data[$key]['phone'] = $userData['phone'];
            $data[$key]['username'] = empty($userData['uname']) ? '' : base64_decode($userData['uname']);
        }
        $this -> assign('data',$data);
        $this -> assign('type',$type);
        $this -> assign('page',$page);
        return view();

    }

    /*添加-删除热门记录*/
    public function add_hot_log(){
        $add['word'] = $_POST['keyword'];
        $add['type'] = 1;
        $add['addtime'] = time();
        $add['uid'] = 1;
        $insertId = db('search_log') -> insertGetId($add);
        if($insertId){
            $this -> success('添加成功');
        }else{
            $this -> error('添加失败');
        }
    }
    /*删除热门搜索*/
    /**
     * @return bool
     */
    public function del_host_log(){
        $where['id'] = $_POST['id'];
        $save['status'] = 0;
        $result = db('search_log') -> where($where) -> update($save);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    /*评估列表*/
    public function assess_list(){
        $assModel = db('assess');
        $cateModel = db('category');
        $cityModel = db('city');
        $data = $assModel  -> order('id desc') -> paginate(20);
        $page = $data -> render();
        $dataList = iterator_to_array($data);
        foreach ($dataList as $key => $value) {
            $cate_id = explode(',',$value['cate_id']);
            $like_cate_id = explode(',',$value['like_cate_id']);
            $cateName = '';
            foreach ($cate_id as $k => $v) {
                $where['id'] = $v;
                $cateName .= $cateModel -> where($where) -> value('name').'/';
            }
            $likeCateName = '';
            foreach ($like_cate_id as $k => $v) {
                $where['id'] = $v;
                $likeCateName .= $cateModel -> where($where) -> value('name').'/';
            }

            $dataList[$key]['cate_name'] = $cateName;
            $dataList[$key]['like_cate_name'] = $likeCateName;
            $dataList[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
            $cityWhere['id'] = $value['id'];
            $dataList[$key]['cityName'] = $cityModel -> where($cityWhere) -> value('cityname');
        }
        $this -> assign('data',$dataList);
        $this -> assign('page',$page);
        return view();
    }
    /*意见反馈*/
    public function aboutus(){
        $where['status'] = empty($_GET['status']) ? 0 : $_GET['status'];
        $usModel = db('aboutus');
        $data = $usModel -> where($where) -> order('addtime desc') -> paginate(10);
        $page = $data -> render();
        $dataList = iterator_to_array($data);
        foreach ($dataList as $key => $value) {
            $dataList[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
        }
        $this -> assign('data',$dataList);
        $this -> assign('page',$page);
        return view();
    }
    /*删除意见反馈*/
    public function del_aboutus(){
        $usModel = db('aboutus');
        $where['id'] = $_POST['id'];
        $eidt['status'] = 0;
        $res = $usModel -> where($where) -> update($eidt);
        if($res){
            return 1;
        }else{
            return 0;
        }
    }


}