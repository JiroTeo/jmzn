<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class user extends Base{

    // 构造方法
     public function __construct(){
        parent::__construct();
        // 实例化分类模型
        $this -> userModel = model('user');
    }


    /*用户列表*/
    public function user_list(){
        //接收参数
        $data = input('post.');
        $res = empty($data);
        if(empty($res)){
            $start = empty($data['start']) ? 1554949251 : strtotime($data['start']) ;
            $end = empty($data['end']) ? time() : strtotime($data['end']) ;
            $where['rtime'] = [['egt',$start],['elt',$end],'and'];
            $whereOr['name'] = ['like',"%".$data['keyword']."%"];
            $whereOr['uname'] = ['like',"%".base64_encode($data['keyword'])."%"];
            $whereOr['cname'] = ['like',"%".$data['keyword']."%"];
            $whereOr['bname'] = ['like',"%".$data['keyword']."%"];
            $whereOr['phone'] = ['like',"%".$data['keyword']."%"];
        }
        $whereOr = empty($whereOr) ? false : $whereOr;
        // 查询所有 有效用户
        $where['status'] = 1 ;
        $where['type'] = empty($_GET['type']) ? 0 : $_GET['type'];
        $dataList = $this -> userModel -> getUserList($whereOr,$where);
        $this->assign("data", $dataList['data']);
        $this->assign("page", $dataList['page']);
        return view();
    }

//    添加系统管理员
    public function user_add(){
//        return "创建后台管理员";
        if($_POST){
            $add['uname'] = base64_encode($_POST['username']);
            $add['password'] = md5($_POST['password']);
            $add['email'] = $_POST['email'];
            $add['phone'] = $_POST['phone'];
            $add['type'] = 2;
            $add['status'] = 1;
            $res = db('user') -> insert($add);
            if($res){
                $this  -> success("新增后台管理员成功");
            }else{
                $this -> error("用户建立失败");
            }
        }else{
            return view();
        }
    }

//    删除系统管理员
    public function user_del(){
        $db = db('user');
        $update['status'] = 0;
        $res = $db -> where('uid',$_GET['id']) ->update($update);
        if($res){
            $this  -> success('删除管理员成功');
        }else{
            $this -> error('删除失败');
        }
    }

    /*管理员管理*/
    public function admin_list(){
        $where['status'] = 1;
        $where['type'] = 2;
        $adminData = db('user') -> where($where) -> paginate(15);
        $page = $adminData -> render();
        $this -> assign('data',$adminData);
        $this -> assign('page',$page);
        return view();

    }
}