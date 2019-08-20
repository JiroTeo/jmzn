<?php
namespace app\admin\controller;
use app\admin\model\UserCate;
use think\Db;
use think\Controller;
use app\admin\model\UserPush as userPush;
use app\admin\model\NoticeLog as noticeLog;
class   news extends Base{

    /*站内信列表*/
    public function index(){

        $newModel = db('news');
        $userModel = db('user');
        $newsDataWhere['status'] = $_GET['status'];
        $newData = $newModel -> order('status desc,id desc') -> where($newsDataWhere) -> paginate(10);
        $page = $newData -> render();
        $data = iterator_to_array($newData);
        $where = array();
        foreach ($data as $key => $value) {
            $where['uid'] = $value['uid'];
            $user = $userModel -> where($where) -> find();
            $data[$key]['username'] = empty($user['uname']) ? '' : base64_decode($user['uname']);
            $data[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
        }
        $this -> assign('data',$data);
        $this -> assign('page',$page);
        $this -> assign('status',$_GET['status']);
        return view();
    }
    /*发布站内通知*/
    public function add_news(){
        if(empty($_POST)){
            return view();
        }else{
            //接收参数
            $add['uid'] =  $_SESSION['admin']['uid'];
            $add['title'] =  $_POST['title'];
            $add['content'] =  $_POST['content'];
            $add['status'] =  1;
            $add['addtime'] =  time();
            $newId = db('news') -> insertGetId($add);
            if(empty($newId)){
                $this -> error('发布失败');
            }else{
                $this -> addNotice($newId);
                $this -> success('发布成功');
            }
        }
    }
    /*删除站内信*/
    public function del_news(){
        $where['id'] = $_POST['id'];
        $data['status'] = 0;
        $result = db('news') -> where($where) -> update($data);
        if($result){
            echo  1;
        }else{
            echo 0;
        }
    }

    /*执行给所有用户添加站内信操作*/
    public function addNotice($tid){
        $noticeModel = db('notice');
        $where['status'] = 1;
        $userData = db('user') -> where($where) -> select();
        $add['content'] = '站内通知';
        $add['form_uid'] = 1;
        $add['read'] = 0;
        $add['status'] = 1;
        $add['tid'] = $tid;
        foreach ($userData as $key => $value) {
            $add['addtime'] = time();
            $add['uid'] = $value['uid'];
            $noticeModel -> insertGetId($add);
        }
    }

    /*  推送的通知列表 */
    public function user_con_list(){
       //推送记录notice_log
        $noticeLog = new noticeLog();
        //获取推送记录
        $info = $noticeLog -> getNoticeLogList(false,'id desc',30,1);
        $data = $info['data'];//数据
        $page = $info['page'];//分页

        $this -> assign('data',$data);
        $this -> assign('page',$page);
        return view();
    }

    /*  推送消息    */
    public function push_consult(){
        $data = input('post.');

        if(empty($data)){
            return view();
        }else{
            if(empty($data['to_uid']) && empty($data['cate_id'])){
                $this -> error('请填写正确的用户或者分组');
            }
            $strUid = '';
            //验证手机号
            $addData['item_id'] = 0;
            $addData['addtime'] = time();
            $addData['type'] = 2;//站内通知
            $addData['read'] = 0;
            $addData['status'] = 1;
            $addData['name'] = $data['name'];
            $addData['content'] = $data['content'];
            $addData['sex'] = $data['sex'];
            $addData['phone'] = $data['phone'];
            //
            if(!empty($data['cate_id'])){
                $userCateModel = new UserCate();
                //数组拼接成字符串
                $cate_id = implode(',',$data['cate_id']);
                $where['cate_id'] = ['in',$cate_id];
                $uidStr  = $userCateModel -> getUserId($where,1);
                if(!empty($uidStr)){
                    $strUid .= $uidStr;
                }
            }
            if(!empty($data['to_uid'])){
                $strUid .= ',';
                foreach ($data['to_uid'] as $key => $value) {
                    $strUid .= $value.',';
                }
            }
            $to_uid = explode(',',trim($strUid,','));
            $to_uid_arr = array_unique($to_uid);
            //验证to_uid  排重
            $consultDb = db('consult');
            $logDb = db('notice_log');
            foreach ($to_uid_arr as $key => $value) {
                $addData['to_uid'] = $value;
                $consultId = $consultDb -> insertGetId($addData);
                //添加log
                $logAdd['type'] = 1;
                $logAdd['uid'] = $value;
                $logAdd['tid'] = $consultId;
                $logAdd['addtime'] = time();
                $logDb -> insertGetId($logAdd);
            }
            $this -> success('SUCCESS');

        }
    }

    /*  推送用户管理  */
    public function user_list(){

        $userPush = new userPush();
        $dataList = $userPush -> getUserPushDatList(false,'lastLog desc',10);
        $page = $dataList['page'];
        $data = $dataList['data'];
        $this -> assign('data',$data);
        $this -> assign('page',$page);
        return view();
    }

    /*  修改用户数据  */
    public function edit(){
        $userPush = new userPush();
        $data = input('post.');
        if($data){
            $where['id'] =  $data['id'];
            unset($data['id']);
            $res = $userPush -> updateUserPushData($where,$data);
            if($res){
                $this -> success('SUCCESS');
            }else{
                $this -> error('ERROR');
            }
        }else{
            $id = $this -> request -> param('id');
            $where['id'] = $id;
            $data = $userPush -> getUserPushData($where,1);
            $this -> assign('data',$data);
            return view();
        }
    }
}