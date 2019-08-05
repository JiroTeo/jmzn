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
        $dataList['email'] =  $data['email'];
        $dataList['phone'] =  $data['phone'];
        $dataList['uname'] =  empty($data['uname']) ? '': base64_decode($data['uname']);
        return $dataList;
    }

    /*  查询用户时候还有可阅读消息的剩余数量 && 处理 */
    protected function parseModel($where = false , $debug = false  ){
        $data = $this -> userModel -> where($where) -> field('id,notice_count,read_notice_num') -> find();
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

}