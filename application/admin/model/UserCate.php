<?php
namespace app\admin\model;

use think\Model;
use app\common\model\User as userModel;
class UserCate extends Model{

    private $userCate; //

    // 
    public function __construct(){
        parent::__construct();
        $this->UserCate = db('user_cate');
    }

    /*//获取用户id*/
    public function getUserId($where = false , $type = false , $debug = false ){
        $data = $this -> UserCate -> where($where) -> select();
        if(empty($data)){   return []; }
        switch ($type) {
            case 1://获取uid 字符串格式
                $dataList = $this -> getUidForArr($data,$debug);
                break;

            default:
                # code...
                break;
        }
        return $dataList;
    }

    /*  获取用户id  数组格式    */
    public function getUidForArr($data , $debug){
        $uidStr = '';
        foreach ($data as $key => $value) {
            $uidStr .= $value['uid'].',';
        }
        return trim($uidStr,',');
    }


}