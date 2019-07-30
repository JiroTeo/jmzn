<?php
namespace app\wap\controller;
use think\Cache;
use wechat\Wechat;
class wx extends Base {

    private $appid;
    private $secret;
    private $callbacedata = [];
    // 构造方法
     public function _initialize(){
         parent::_initialize();
         $this -> appid = config('wechat')['appid'];
         $this -> secret = config('wechat')['appsecret'];
         $this -> callbacedata = [];
     }

    /**
     * @return mixed
     */
    public function index(){
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);//客户端
        $user_IP = empty($_SERVER["HTTP_VIA"]) ? $_SERVER["REMOTE_ADDR"] : $_SERVER["HTTP_X_FORWARDED_FOR"] ;//userIp
        dump($agent);
        dump($user_IP);
        $key = md5('jmzn'.$agent.$user_IP);
        echo "md5(jmzn".$agent.$user_IP.")";
    }

    /*  获取用户微信   */
    public function getOpenId(){
        $rinfo = $this -> returnCode['ERROR'][2];
        $rinfo['data'] = [];
        //处理回调
        $code = empty($_GET['code']) ? false : $_GET['code'];
        if(empty($code)){//验证是否为回调 ： 否=》拼接url 请求url
            $state = empty($_REQUEST['state']) ? 1 : $_REQUEST['state'];
            $callback = "https://wap.jiamengzhinan.com/wx/getOpenId";
            $scope = "snsapi_base";
            // 拼接url
            $url ="https://open.weixin.qq.com/connect/oauth2/authorize?";
            $url .= "appid=".$this -> appid;
            $url .= "&redirect_uri=".urlencode($callback);
            $url .= "&response_type=code";
            $url .= "&scope=".$scope;
            $url .= "&state=".$state."#wechat_redirect";
            $resullt = $this->redirect($url);
//            $result = $oauth->getOauthRedirect($callback, $state, $scope);
        }else{//回调 是=》 接收参数&&获取返回参数
            //拼接url
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?";
            $url .= "appid={$this->appid}";
            $url .= "&secret={$this->secret}";
            $url .= "&code={$code}";
            $url .= "&grant_type=authorization_code";
            $result = $this -> httpGet($url);
            if(empty($result)){
                wapReturn($this -> returnCode['ERROR'][0]);
            }else{
                $data = json_decode($result);
                $index = 'https://wap.jiamengzhinan.com';
                //存储redis
                $openid = $data -> openid;//微信的openid
                $user_IP = empty($_SERVER["HTTP_VIA"]) ? $_SERVER["REMOTE_ADDR"] : $_SERVER["HTTP_X_FORWARDED_FOR"] ;//userIp
                $agent = strtolower($_SERVER['HTTP_USER_AGENT']);//客户端
                $key = md5('jmzn'.$agent.$user_IP);
                \cache($key,$openid,600);//存储在redis10分钟1
                //redisend
                $this->redirect($index);
            }
        }
    }
//        ["access_token"] => string(89) "23_RFcFyHytJDsRc61otW3lUiCADnCD_RJPyClOymg9NUQgMI8qlxU2MthIf6_de6oyl2djmnhBUhy3TvsKlLQxRw"
//        ["expires_in"] => int(7200)
//        ["refresh_token"] => string(89) "23_-BcJimeJLVID0s9rAXNmpUG-A6cg-KgBV8Bjk35j3cPCcKawOtzjU1sRraOF5aSJDioHyTQcBH3wlHIKCLTMwg"
//        ["openid"] => string(28) "oJ2kZ5zRnaIPmWeoS4ESyUO3t-tg"
//        ["scope"] => string(15) "snsapi_userinfo"
//        ["unionid"] => string(28) "or95C1fIfTFFVHSE9u_i2sFPkPwQ"
//            ["access_token"] => string(89) "23_nzG0b2NRFSedAlUiA2DFBtwlb1Z6-arf_LRzSaWNGUOwdxtG3yLBVRF0poOjevmW_0qZBnJrry682hAMNWrUKw"
//            ["expires_in"] => int(7200)
//            ["refresh_token"] => string(89) "23_kbmlEY-OcgxwNrATuk8sh2UEXhhDozoeW7F-FEsltLzdRI_IfsM6p_6NalIjpwa7Xif7hbasPUL9IpdFV4c8Og"
//            ["openid"] => string(28) "oJ2kZ5zRnaIPmWeoS4ESyUO3t-tg"
//            ["scope"] => string(11) "snsapi_base"
//    }

    static public function httpGet($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSLVERSION, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        list($content, $status) = array(curl_exec($curl), curl_getinfo($curl), curl_close($curl));
        return (intval($status["http_code"]) === 200) ? $content : false;
    }


}
