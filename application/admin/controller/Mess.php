<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
// 短信类库
use api\sendapi;
class mess{

/**********************************
*	@param username 	用户名
*	@param password 	32位小写二次加密 md5(md5(password)+tkey)
*	@param mobile		手机号码
*	@param content 		短信内容
*	@param tKey 		当前时间。精确到秒的,10位时间戳格式
*	@param time 		定时发送时间 为空的话即时发送
*	@param ext 			扩展号 纯数字最多8位
*	@param extend 		用户自定义信息。在用户获取状态报告时返回
********************************************************/


	public function test(){
    // 发送手机验证码
    date_default_timezone_set('PRC'); //设置时区
    // 模板信息
    $url     = "http://api.mix2.zthysms.com/v2/sendSms";    //接口地址
    $content = '【盛禾金服】您的身份验证码是012541为了您的账号安全，请勿将验证码告知他人';
    $tKey     = time();         //必须参数 时间戳
    $password = md5(md5("vgfO4yFp") . $tKey);
    $data     = array(
        'tpId'      => '841', //模板id
        'username'  => 'kr999hy', //用户名
        'password'  => $password, //密码
        'tKey'      => $tKey, //tKey
        'signature' => '河南快瑞网络科技有限公司',
        'mobile'    => '18332224517',
        'ext'       => '',
        'content'   => $content
    );

    $ComModel = model('commen');

    $ret = $ComModel -> httpPost($url, $data);  //调用发送短信接口
		ltrim($ret,'{');
		rtrim($ret,'}');
		$res = explode(':', $ret);
		dump($res);
	}

}