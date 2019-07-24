<?php
namespace app\wap\controller;
use think\Cache;
use wechat\WechatOauth;
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
        // SDK实例对象
        $oauth = &load_wechat('Oauth');
        $callback = self::$url . "/wx/Wxlogin/WxCallBack";
        $state = input('state');
        $scope = "snsapi_userinfo";
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
