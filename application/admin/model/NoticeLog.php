<?php
namespace app\admin\model;

use think\Model;
use app\admin\model\User as userModel;
use app\admin\model\Consult as consultModel;
class NoticeLog extends Model{

    private $noticeLog; //

    // 
    public function __construct(){
        parent::__construct();
        $this->noticeLog = db('notice_log');
    }

    /*  获取推送记录  */
    public function getNoticeLogList($where=false , $order = false , $num = 30 ,$type = false ){
        $dataLog = $this -> noticeLog -> where($where) -> order($order) -> order($order) -> paginate($num);
        //获取分页 && 对象转数组
        $page = $dataLog->render();
        $data = iterator_to_array($dataLog);
        if(empty($data)){   return [];  }
        //格式化数据
        switch ($type) {
            case 1:
                $info['data'] = $this -> formatNoticeLogDataList($data);
                break;

            default:
                # code...
                break;
        }
        $info['page'] = $page;
        return $info;
    }

    /*  格式化推送信息 */
    public function formatNoticeLogDataList($data){
        $userModel = new userModel();
        $consultModel = new consultModel();
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['uid'] = $value['uid'];
            $dataList[$key]['tid'] = $value['tid'];
            $dataList[$key]['addtime'] = date("Y-m-d H:i:s",$value['addtime']);
            //用户信息
            $userData = $userModel -> getUserData(['uid'=>$value['uid']]);
            //消息内容
            $consultData = $consultModel -> getConsultData(['id'=>$value['tid']],1);
            $dataList[$key]['username'] = empty($userData['username']) ? '' : $userData['username'];
            $dataList[$key]['content'] = $consultData['content'];
            $dataList[$key]['name'] = $consultData['name'];
            $dataList[$key]['phone'] = $consultData['phone'];
        }
        return $dataList;
    }


}