<?php
namespace app\index\controller;
use think\Cache;
use think\Db;
use think\Controller;
class user extends Base{

    private $artModel;
    public function __construct(){
        parent::_initialize(); // TODO: Change the autogenerated stub
        // 实例化y用户模型
         $this->userModel = model('user');
    }


    /*  todo   消息统计             count
     *  todo   个人信息接口         userCenter
     *  todo    修改个人信息接口    edit_user_data
     * **/

    //统计接口[消息][我的关注][我的收藏][我的留言]
    public function count(){
        if(empty($this -> user)){//验证登录
            $rinfo = $this -> returnCode['ERROR'][5];
            wapReturn($rinfo);
        }
        $data['no'] = db('notice') -> where(['uid'=>$this -> user['uid']]) -> count();
        $data['fo'] = db('follow') -> where(['ftype'=>1,'uid'=>$this -> user['uid'],'status'=>1]) -> count();
        $data['co'] = db('follow') -> where(['ftype'=>2,'uid'=>$this -> user['uid'],'status'=>1]) -> count();
        $data['lm'] = db('consult') -> where(['type'=>1,'uid'=>$this -> user['uid'],'status'=>['neq',4]]) -> count();
        //足迹内容3条
        $logWhere['uid'] = $this -> user['uid'];
        $logWhere['status'] = 1;
        //获取访问过的项目id
        $trackModel = model('track');
        $idStr = $trackModel -> getMyTrackTid($logWhere);
        $where['id'] = array('in',$idStr);
        $data['track'] = model('item') -> getItemDataList( $where , 'addtime desc' , 3 , 4 , $this -> user , $this -> debug );//where/order/limit/type/user/debug
        //评论内容3条
        $comwhere['form_uid'] = $this -> user['uid'];
        $comwhere['status'] = 1;
        $comwhere['to_type'] = 0;
        //分页
        $data['comment'] = model('comment') -> getCommentData($comwhere,'addtime desc',3,1,$this->user,$this -> debug);

        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);

    }
    /*个人信息接口*/
    public function user_center(){
        //接收参数
        $user = $this -> user;
        if(empty($user)){
            $rinfo = $this -> returnCode['ERROR'][5];
            wapReturn($rinfo);
        }
        $uid = $this -> user['uid'];
        //获取用户信息
        $where['uid'] = $uid;
        $where['status'] = 1;
        $userData = $this -> userModel -> getUserDetail($where);
        if(empty($userData)){
            $rinfo = $this -> returnCode['ERROR'][4];
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        $rinfo['data'] = $userData;
        return json_encode($rinfo);
    }

    /*  修改个人信息接口    */
    public function change_user_data(){
        //验证登录
        if(empty($this -> user)){
            $rinfo = $this -> returnCode['ERROR'][5];
            wapReturn($rinfo);
        }
        //头像 昵称 性别
        $avatar = empty($_REQUEST['avatar']) ? false : $_REQUEST['avatar'];
        if(!empty($avatar)){
            $save['avatar'] = $avatar;
        }
        $name = empty($_REQUEST['name']) ? false : $_REQUEST['name'];
        if(!empty($name)) {
            $save['name'] = $name;
        }
        $username = empty($_REQUEST['username']) ? false : $_REQUEST['username'];
        if(!empty($username)){
            $save['uname'] = base64_encode($username);
        }
        $save['sex'] = empty($_REQUEST['sex']) ? 0 : 1 ;
        //查询用户信息是否存在
        $save['uid'] = $this -> user['uid'];
        $res = db('user') -> where($save) -> count();
        if($this -> debug == 1){
            echo db('user') -> getLastSql();
        }
        if(!empty($res)) {
            $rinfo = $this->returnCode['ERROR'][0];
            $rinfo['msg'] = '未发生任何变化';
            wapReturn($rinfo);
        }
        //修改用户信息
        $where['uid'] = $this -> user['uid'];
        unset($save['uid']);
        $res = $this -> userModel -> editUserData($where,$save);
        if(empty($res)){
            $rinfo = $this -> returnCode['ERROR'][0];
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        wapReturn($rinfo);
    }

    /*  修改企业信息  */
    public function change_ent_data(){
        //验证登录
        if(empty($this -> user)){
            $rinfo = $this -> returnCode['ERROR'][5];
            wapReturn($rinfo);
        }
        $type = db('user') -> where(['uid'=>$this -> user['uid']]) -> value('type');
        if($type != 1){//非企业用户
            $rinfo = $this -> returnCode['ERROR'][0];
            $rinfo['msg'] = '没有权限';
            wapReturn($rinfo);
        }
        //log
        $logo = empty($_REQUEST['logo']) ? false : $_REQUEST['logo'];
        if(!empty($logo)){
            $save['logo'] = $logo;
        }
        // cname
        $cname = empty($_REQUEST['cname']) ? false : $_REQUEST['cname'];
        if(!empty($cname)){
            $save['cname'] = $cname;
        }
        //bname
        $bname = empty($_REQUEST['bname']) ? false : $_REQUEST['bname'];
        if(!empty($bname)){
            $save['bname'] = $bname;
        }
        //address
        $address = empty($_REQUEST['address']) ? false : $_REQUEST['address'];
        if(!empty($address)){
            $save['address'] = $address;
        }
        //email
        $email = empty($_REQUEST['email']) ? false : $_REQUEST['email'];
        if(!empty($email)){
            $save['email'] = $cname;
        }
        //查询资料是否发生变化
        $save['uid'] = $this -> user['uid'];
        $res = db('user') -> where($save) -> count();
        if(!empty($res)){
            $rinfo = $this -> returnCode['ERROR'][0];
            $rinfo['msg'] = '未发生任何变化';
            wapReturn($rinfo);
        }
        //修改用户资料
        $where['uid'] = $this -> user['uid'];
        unset($save['uid']);
        $res = $this -> userModel -> editUserData($where,$save);
        if(empty($res)){
            $rinfo = $this -> returnCode['ERROR'][0];
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        wapReturn($rinfo);
    }

    /*  base64转存为图片  */
    public function upload_image(){
        $type = empty($_REQUEST['type']) ? 0 : $_REQUEST['type'];
        $base64Str = empty($_REQUEST['file']) ? wapReturn($this -> returnCode['ERROR'][4]) : $_REQUEST['file'];
        if(empty($type)){
            $fileName = getBase64Image($base64Str,'avatar/');
        }else{
            $fileName = getBase64Image($base64Str,'logo/');
        }
        if(empty($fileName)){
            $rinfo = $this -> returnCode['ERROR'][0];
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        $rinfo['data'] = trim($fileName,'.');
        wapReturn($rinfo);
    }
}