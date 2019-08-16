<?php
namespace app\admin\model;

use think\Model;

class consult extends model{

    private $consultModel; //
    //
    public function __construct(){
        parent::__construct();
        $this -> consultModel = db('consult');
    }

    /*  获取项目的留言 */
    public function getItemConsultDataList($where = false , $order = false , $type = false ){
        $data = $this -> consultModel -> where($where) -> order($order) -> select();
        if(empty($data)){   return [];  }
        //格式化数据
        $dataList = $this -> formatConsultDataList($data);
        return $dataList;
    }

    /*  格式化留言列表数据   */
    public function formatConsultDataList($data = false , $type = false){
        $userModel = db('user');
        foreach ($data as $key => $value) {
            $cdata[$key]['id'] = $value['id'];
            $cdata[$key]['content'] = $value['content'];
            $cdata[$key]['addtime'] = date("Y-m-d h:i:s",$value['addtime']);
            //验证用户id
            if(empty($value['uid'])){
                $cdata[$key]['avatar'] = '';
                $cdata[$key]['username'] = substr_replace($value['phone'],'********',2,8);
            }else{
                $where['uid'] = $value['uid'];
                $userData = $userModel -> where($where) -> field('avatar,phone,uname') -> find();
                $cdata[$key]['avatar'] = empty($userData['avatar']) ? '' : $userData['avatar'] ;
                $cdata[$key]['username'] = empty($userData['username']) ? substr_replace($value['phone'],'********',2,8) : $userData['username'];
            }
        }
        return $cdata;
    }

    /*  获取一条项目咨询信息  */
    public function getConsultData($where = false , $type = false ){
        $consult = $this -> consultModel -> where($where) -> find();
        if(empty($consult)){    return [];  }
        switch ($type) {
            case 1:
                $dataList = $this -> formatConsultData($consult);
                break;

            default:
                # code...
                break;
        }
        return $dataList;
    }

    /*  格式化消息列表 */
    public function formatConsultData($data){
        $info['id'] = $data['id'];
        $info['name'] = $data['name'];
        $info['phone'] = $data['phone'];
        $info['content'] = $data['content'];
        return $info;
    }

}