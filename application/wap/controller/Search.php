<?php
namespace app\wap\controller;
use think\Cache;
use think\Db;
use think\Controller;
class search extends Controller{

    private $logModel;
    public function __construct(){
         parent::__construct();
         // 实例化y用户模型
         $this->logModel = model('search');
    }
    /*搜索首页
     *  热门搜索
     *  搜索记录    存在库里。登录状态才展示
    */
    public function index(){
        //热门搜索
        $where['type'] = 1;
        $where['status'] = 1;
        $data['hot'] = $this -> logModel -> getLog($where);

        //判断是否登录
        $token =  empty($_REQUEST['token']) ? false : $_REQUEST['token'];
        $user = Cache::get($token);
        $user['uid'] = 1;
        if(empty($user)){//未登录  没有log
            $data['log'] = array();
        }else{
            $logWhere['uid'] = $user['uid'];
            $logWhere['status'] = 1;
            $logWhere['type'] = 0;
            $data['log'] = $this -> logModel -> getLog($logWhere);
        }
        $jsonData['code'] = 200;
        $jsonData['msg'] = '成功';
        $jsonData['data'] = $data;
        return json_encode($jsonData);
    }

    /*
     *  删除历史记录
     * */
    public function logDel(){
        if(isset($_SESSION['wap']['uid'])){
            $where['uid'] = $_SESSION['uid'];
            $res = $this -> logModel -> delLogData($where);
            if(empty($res)){
                $code['code'] = 200;
                $code['msg'] = '成功';
            }else{
                $code['code'] = 400;
                $code['msg'] = '失败';
            }
        }else{
            $code['code'] = 400;
            $code['msg'] = '失败';
        }
$code['code'] = 200;
                $code['msg'] = '成功';
        return json_encode($code);
    }
}