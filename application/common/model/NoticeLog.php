<?php
namespace app\common\model;

use think\Model;

class NoticeLog extends Model{

    private $logModel; //

    // 
    public function __construct(){
        parent::__construct();
        $this -> logModel = db('notice_log');
    }

    /*  修改notice_log     */
    public function editNoticeLogField($where = false , $save = false ){
        $result = $this -> logModel -> where($where) -> update($save);
        return empty($result) ? false : $result;
    }


}