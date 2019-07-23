<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 定义SESSION保存目录
define('SESSION_PATH', __DIR__.'./runtime/session/');
// 响应头设置 我们就是通过设置header来跨域的 这就主要代码了 定义行为只是为了前台每次请求都能走这段代码
        header('Access-Control-Allow-Origin:*');
    	header('Access-Control-Allow-Methods:*');
	    header('Access-Control-Allow-Headers:*');
	    header('Access-Control-Allow-Credentials:false');

//处理OPTIONSQ请求

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
		header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
exit;

}


// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

// // 读取自动生成定义文件
// $build = include '../build.php';
// // 运行自动生成
// \think\Build::run($build);

//    require __DIR__.'/../thinkphp/base.php';



//	    Container::get('app') -> run() -> send();
