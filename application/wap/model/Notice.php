<?php
namespace app\wap\model;

use think\Model;

class notice extends Model{

    private static $noticeModel; //

    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this->noticeModel = db('notice');
    }

    /*  todo 添加通知消息
     * */
    public function add_notice($data){
        //定义参数
        $where['id'] = $data['tid'];
        switch ($data['type']) {
              case 0://站内信
                  $data['content'] = '站内信';
                  break;
              case 1://评论
                  $data['content'] = '有人评论了您哦';
                  break;
              case 2://赞
                  $data['content'] = '有人赞了您';
                  break;
              case 3://咨询
                  $data['content'] = '有新的投资者向您咨询';
                  $data['uid'] = db('item') -> where($where) -> value('wid');
                  break;
              case 4://留言
                  $data['content'] = '您有新的留言';
                  $data['uid'] = db('item') -> where($where) -> value('wid');
                  break;
              case 5://收藏项目
                  $data['content'] = '有人收藏了您的项目';
                  $data['uid'] = db('item') -> where($where) -> value('wid');
                  break;
              case 6://收藏文章
                      $data['uid'] = db('article') -> where($where) -> value('uid');
                  $data['content'] = '您的文章被人收藏了';
                  break;
        }

        $data['read'] = 0;
        $data['status'] = 1;
        $data['addtime'] = time();
        $result = $this -> noticeModel -> insertGetId($data);
        return $result;
    }
    /*改变通知状态为已读*/
    public function read_notice($where){
        $edit['read'] = 1;
        $res = $this -> noticeModel -> where($where) -> update($edit);
        return $res;
    }

    /*删除消息*/
    public function delNotice($where){
        $del['status'] = 0;
        $res = $this -> noticeModel -> where($where) -> update($del);
        return $res;
    }

    /*统计数量*/
    public function count_notice($where){
        $countNum = $this -> noticeModel -> where($where) -> count();
        return $countNum;
    }

    /*获取通知信息*/
    public function getNoticeData($where){
        $data = $this -> noticeModel -> where($where) -> select();
        return $data;
    }


}