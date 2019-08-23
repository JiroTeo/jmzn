<?php
namespace app\common\model;

use think\Model;

class User extends Model{

    private $userModel; //

    // 
    public function __construct(){
        parent::__construct();
        $this -> userModel = db('user');
    }

    /*  获取用户数据  && 格式化  */
    public function getUserData( $where = false , $type = false , $debug = false ){
        $data = $this -> userModel -> where($where) -> find();
        if(empty($data)){   return [] ; }
        //格式化数据
        switch ($type) {
            case 1:
                $dataList = $this -> formatUserData($data,$debug);
                break;

            default:
                # code...
                break;
        }
        return $dataList;
    }

    /*  获取用户信息某个字段  */
    public function getUserField($where = false , $field = false ){
        $value = $this -> userModel -> where($where) -> value($field);
        if($field == 'uname'){//uname解密
            $value = empty($value) ? '' : base64_decode($value);
        }
        return $value;
    }

    /*  格式化用户数据 【单条】*/
    public function formatUserData($data,$debug){
        $dataList['uid'] =  $data['uid'];
        $dataList['name'] =  $data['name'];
        $dataList['bname'] =  $data['bname'];
        $dataList['cname'] =  $data['cname'];
        $dataList['avatar'] =  empty($data['avatar']) ? '' : trim($data['avatar'],'.');
        $dataList['email'] =  $data['email'];
        $dataList['phone'] =  $data['phone'];
        $dataList['logo'] =  $data['logo'];
        $dataList['address'] =  $data['address'];
        $dataList['wx_openid'] =  $data['wx_openid'];
        $dataList['token'] =  $data['token'];
        $dataList['uname'] =  empty($data['uname']) ? '': base64_decode($data['uname']);
        $dataList['ncount'] =  $data['notice_count'];//可接收推送条数
        $dataList['rncount'] =  $data['read_notice_num'];//已读数量
        $dataList['rem'] =  $data['notice_count'] - $data['read_notice_num'];//差
        return $dataList;
    }

    /*  查询用户时候还有可阅读消息的剩余数量 && 处理 */
    public function parseModel($where = false , $debug = false  ){
        $data = $this -> userModel -> where($where) -> field('uid,notice_count,read_notice_num') -> find();
        //用户不存在
        if(empty($data)){
            return false ;
        }
        $num = $data['notice_count'] - $data['read_notice_num'];
        //剩余条数不足
        if($num < 1 ){
            return false ;
        }
        //执行已阅读条数+1
        $result = $this -> userModel -> where($where) -> setInc('read_notice_num');
        //返回剩余条数
        return $num;
    }

    /** 新建用户(wap && web 端)
     *  用户名为（jmzn_phone）
    */
    public function insertUserGetId( $phone = false , $openid = '' ){
        $add['phone'] = $phone;
        $add['wx_openid'] = $openid;
        $add['status'] = 1;
        $add['uname'] = base64_encode('jmzn_'.$phone);
        $add['rtime'] = time();
        $addUserRes = $this -> userModel -> insertGetId($add);
        return $addUserRes;
    }

    /*  统计用户数量    */
    public function userCount($where){
        $count = $this -> userModel -> where($where) -> count();
        return $count;
    }

    /*  修改用户信息  */
    public function editUserData( $where = false , $save = false ){
        $result = $this -> userModel -> where($where) -> update($save);
        return $result;
    }


}