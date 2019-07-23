<?php
	
/**
 * Created by PhpStorm.
 * UserModel: Administrator
 * Date: 2019/7/22
 * Time: 18:01
 */
namespace wechat;

use think\Cache;

/**
 * @package 微信授权控制器
 */
class WechatOauth {
	//微信授权配置信息
	private $appId = 'wx7e7ede5ffa32bca1';
	private $appSecret = '69908f6daef82a371d265db70edaf840';
	
     public function _initialize(){

     }
	/**
	 * 获取openid
	 * @return string|mixed
	 */
	public function getUserAccessUserInfo($code = ""){
		if(empty($code)){
			$baseUrl = request()->url(true);
			$url = $this->getSingleAuthorizeUrl($baseUrl, "123");
			Header("Location: $url");
			exit();
		}else{
			$access_token = $this->getAccessToken();
			return $this->getUserInfo($access_token);
		}
	}
	/**
	 * 微信授权链接
	 * @param  string $redirect_uri 要跳转的地址
	 * @return [type]               授权链接
	 */
	public function getSingleAuthorizeUrl($redirect_url = "",$state = '1') {
		$redirect_url = urlencode($redirect_url);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appId . "&redirect_uri=".$redirect_url."&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";
	}
	/**
	 * 获取token
	 * @return [type] 返回token
	 */
	public function getAccessToken() {
		$keyname = "-access-token";
		if (Cache::has($keyname)){
			$data = json_decode(Cache::get($keyname));
			$access_token = $data->access_token;
		}else {
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
			$res = json_decode($this->httpGet($url));
			$access_token = $res->access_token;
			if ($access_token) {
				$res->expire_time = time() + 7198;
				$res->access_token = $access_token;
				$expire = 60 * 119;
				Cache::set($keyname,json_encode($res),$expire);
			}
		}
		return $access_token;
	}
	
	/**
	 * 发送curl请求
	 * @param $url string
	 * @param return array|mixed
	 */
	public function https_request($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$AjaxReturn = curl_exec($curl);
		//获取access_token和openid,转换为数组
		$data = json_decode($AjaxReturn,true);
		curl_close($curl);
		return $data;
	}
	/**
	 * @explain
	 * 通过code获取用户openid以及用户的微信号信息
	 * @return array|mixed
	 * @remark
	 * 获取到用户的openid之后可以判断用户是否有数据，可以直接跳过获取access_token,也可以继续获取access_token
	 * access_token每日获取次数是有限制的，access_token有时间限制，可以存储到数据库7200s. 7200s后access_token失效
	 **/
	public function getUserInfo($access_token = [])
	{
		if(!$access_token){
			return [
				'code' => 0,
				'msg' => '微信授权失败',
			];
		}
		$userinfo_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token['access_token'].'&openid='.$access_token['openid'].'&lang=zh_CN';
		$userinfo_json = $this->https_request($userinfo_url);
		
		//获取用户的基本信息，并将用户的唯一标识保存在session中
		if(!$userinfo_json){
			return [
				'code' => 0,
				'msg' => '获取用户信息失败！',
			];
		}
		return $userinfo_json;
	}
	
	private function getParams($params){
		ksort($params);
		$sign = '';
		foreach ($params as $key => $val) {
			if ($key != 'sign' && isset($val)) {
				$sign .= $key . "=" . $val . "&";
			}
		}
		return rtrim($sign, '&');
	}
	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
	
	/***
	 * 获取小程序的Opendid
	 * @param $code
	 * @return mixed
	 */
	public function getUserOpendIdinfo($code){
		$url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$this->appId."&secret=".$this->appSecret."&js_code=".$code."&grant_type=authorization_code";

		return json_decode($this->httpGet($url),true);
	}
	
	/***
	 * @param $url
	 * @return bool|string
	 */
	private function httpGet($url) {
		$curl = curl_init();
		$cainfo = ROOT_PATH.'/public/cert/cacert.pem';
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		// 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
		// 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_CAINFO, $cainfo);
		curl_setopt($curl, CURLOPT_URL, $url);
		
		$res = curl_exec($curl);
		curl_close($curl);
		
		return $res;
	}
}