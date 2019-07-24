<?php
namespace app\wap\controller;
use think\Cache;
use wechat\Wechat;
class wx extends Base {

    // 构造方法
     public function _initialize(){
         parent::_initialize();
     }
     public function index(){
         echo "找我是几个意思";
     }

    /*  获取用户微信   */
    public function getOpenId(){
        $wechat = [];
        // SDK实例对象
        $oauth = &load_wechat('Oauth');
        $callback = "wap.jiamengzhinan.com/wx/index";
        $state = 5;

        $scope = "snsapi_base";
        // 执行接口操作
        $result = $oauth->getOauthRedirect($callback, $state, $scope);
        // 处理返回结果
        if ($result === FALSE) {
            // 接口失败的处理
            return false;
        } else {
            // 接口成功的处理
            $this->redirect($result);
        }
    }

    /*  回调  */
    public function WxCallBack(){
        dump($_REQUEST);
    }

}
