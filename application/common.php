<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/*定义wapReturn*/
function wapReturn($data){
    $jsonData = json_encode($data);
    exit($jsonData);
}

 /*图片上传*/
function uploadeFile($pathDir=''){
    $key = key($_FILES);    //获取数组下标
    $file = request()->file( $key ); //获取文件内容
    // 移动到框架应用根目录/public/uploads/ 目录下
    $fileName = '';
    $path = './uploads/'.$pathDir;
    if( !is_dir( $path ) ){
        @mkdir( $path, 0777, true ); //如果目录不存在，则生成
    }
    $fileName =   uniqid() . '.png';
    $image = \think\Image::open( $file );
//    $image->thumb(300,300,\think\Image::THUMB_CENTER)->save( $path . $fileName );//压缩并保存文件
    $image->save( $path . $fileName );
    return $path.$fileName;
}

/*短信发送接口*/
function sendMesasage($phone){
    $code = mt_rand(1000, 9999);
    // 数据缓存
    cache('CODE'.$phone,$code,600);
    // 发送手机验证码
    date_default_timezone_set('PRC');   //设置时区
    // 模板信息
    $url     = "http://www.api.zthysms.com/sendSms.do";    //提交地址\
    $content = '【加盟指南】您的身份验证码是'.$code.'为了您的账号安全，请勿将验证码告知他人';
//    $tkey     = date('YmdHis');
    $username = 'zkqc888hy';                               //用户名
    $password = md5('YgTf6X');     //用户密码
//    $password = md5(md5('YgTf6X').$tkey);     //用户密码
    $data     = array(
        'username'  => $username, //用户名
        'password'  => $password, //密码
        'tkey'      => '', //tKey
        'mobile'    => $phone,
        'content'   => $content
    );
    $ret = httpPost($url, $data);  //调用发送短信接口
    return $ret;
}

function httpPost($url, $data) { // 模拟提交数据函数

		$curl = curl_init(); // 启动一个CURL会话
		curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
		curl_setopt($curl, CURLOPT_POST, true); // 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS,  http_build_query($data)); // Post提交的数据包
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_HEADER, false); // 显示返回的Header区域内容
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
		$result = curl_exec($curl); // 执行操作
		if (curl_errno($curl)) {
			echo 'Error POST'.curl_error($curl);
		}
		curl_close($curl); // 关键CURL会话
		return $result; // 返回数据
}

/*  验证手机号   */
function verifMobile( $mobile = false ){
    $phone = "/^1[3456789]\d{9}$/";
    $result = preg_match($phone,$mobile);
    return $result;
}
/*  验证手机验证码   */
function verifCode( $code = false , $key = false ){
    $cacheCode = \think\Cache::get($key);
    if( empty($code) || $code != $cacheCode ){
        return false;
    }
    return true;
}

/*  验证图片验证码*/
function verifImgCode($key,$imageCode){
    $verifCode = \think\Cache::get($key);
    $result = (empty($verifCode) || strtolower($verifCode) !== strtolower($imageCode)) ? false : true ;
    return $result;
}

/*  生成图片验证码 */
function createImageCode(){
    header("Cache-Control: no-cache, must-revalidate");
    // 声明图像大小
    $img_height=70;
    $img_width=25;
    $authnum='';
    // 验证码内容
    $ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
    $list=explode(",",$ychar);
    for($i=0;$i<4;$i++){
        $randnum=rand(0,35);
        $authnum.=$list[$randnum];
    }

    // 生成一个基本大小图像
    $aimg = imagecreate($img_height,$img_width);
    // 图像填充颜色
    imagecolorallocate($aimg, 255,255,255);
    $black = imagecolorallocate($aimg, 0,0,0);

    for ($i=1; $i<=100; $i++) {
        imagestring($aimg,1,mt_rand(1,$img_height),mt_rand(1,$img_width),"@",imagecolorallocate($aimg,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255)));
    }

    //为了区别于背景，这里的颜色不超过200，上面的不小于200
    $imageCodeStr = '';
    for ($i=0;$i<strlen($authnum);$i++){
        imagestring($aimg, mt_rand(3,5),$i*$img_height/4+mt_rand(2,7),mt_rand(1,$img_width/2-2), $authnum[$i],imagecolorallocate($aimg,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200)));
        $imageCodeStr .= $authnum[$i];
    }
    //验证码存储到redis
    $imageCodeKey = 'jmzn_'.strtolower($imageCodeStr).'_imageCode';
    cache($imageCodeKey,$imageCodeStr,600);
    //存储验证码end
    imagerectangle($aimg,0,0,$img_height-1,$img_width-1,$black);//画一个矩形

    $path = './uploads/imageCode/';
    if( !is_dir( $path ) ){
        @mkdir( $path, 0777, true ); //如果目录不存在，则生成
    }
    $fileName = $path . date("YmdHis") .'-' . uniqid() . '.png';
    $result = ImagePNG($aimg,$fileName);       //生成png格式
    if(empty($result)){
        return false;
    }else{
        return $fileName;
    }
}
/*通过base64上传文件*/
function getBase64Image($base64Str,$pathDir){

        $img = str_replace('data:image/png;base64,', '', $base64Str);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
     	$path = './uploads/'.$pathDir;
     	if( !is_dir( $path ) ){
         	@mkdir( $path, 0777, true ); //如果目录不存在，则生成
     	}
     	$date = date('Ymd/');
     	if( !is_dir( $path.$date ) ){
         	@mkdir( $path.$date, 0777, true ); //如果目录不存在，则生成
     	}
     	$fileName = $path . $date . uniqid() . '.png';
        if(@file_exists($fileName)){
            @unlink($fileName);
        }@clearstatcache();
        $fp=fopen($fileName,'w');
        $result = fwrite($fp,$data);
        fclose($fp);
        return (empty($result)) ? '' : $fileName ;
}

/* 广告配置 (一) */
function getAdConfig(){
    $adveDb = db('adve_pos');
    $data = $adveDb -> where(['status'=>1,'pid'=>0]) -> field('id,name,pid,remark') -> select();
    foreach ($data as $key => $value) {
        $data[$key]['c'] = getAdChildConf(['status'=>1,'pid'=>$value['id']]);
    }
    return $data;
}
/*  广告配置（二） 获取子数据   */
function  getAdChildConf($where = false ){
    $adveDb = db('adve_pos');
    $data = $adveDb -> where($where) -> order('id asc') -> field('id,name,pid,remark') ->  select();
    foreach ($data as $key => $value) {
        $child = getAdChildConf(['status'=>1,'pid'=>$value['id']]);
        if(!empty($child)){
            $data[$key]['c'] = $child;
        }
    }
    return $data;
}


