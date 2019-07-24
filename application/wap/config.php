<?php
//配置文件
return [
	"wechat" => [
		'token' => 'jmzn', //填写你设定的token
	    'appid' => 'wx7e7ede5ffa32bca1', //填写高级调用功能的app id, 请在微信开发模式后台查询
	    'appsecret' => '69908f6daef82a371d265db70edaf840', //填写高级调用功能的密钥
//	    'encodingaeskey' => 'jqzylRlSU7v3ixqf8MdcFxt28XBTWyvbkSIU9J87SPO', //填写加密用的EncodingAESKey（可选，接口传输选择加密时必需）
	    'mch_id' => '',  //微信支付，商户ID（可选）
	    'partnerkey' => '',  //微信支付，密钥（可选）
	    'ssl_cer' => '', //微信支付，双向证书（可选，操作退款或打款时必需）
	    'ssl_key' => '',  //微信支付，双向证书（可选，操作退款或打款时必需）
	    'cachepath' => '', //设置SDK缓存目录（可选，默认位置在./Wechat/Cache下，请保证写权限）
		],
		 // 视图输出字符串内容替换
    'view_replace_str'       => [
    	'__PUBLIC__' => '/index',
        '__WXPUBLIC__' => '/wx',
        '__ROOT__' => '',
        '__CDN__' => '',
        '__YM__' => '.jinfubaijia.com',
        '__WXURL__' => 'https://wx.jinfubaijia.com',
        '__V__' => '1.0.0',
    ],
];