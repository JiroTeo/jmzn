<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
//use think\Route;
////定义路由规则
//Route::rule([
//    'index'=>'index/index',
//    '/about'=>'index/about',
//    '/news'=>'index/news',
//    '/products'=>'index/service',
//    '/message'=>'index/customer',
//    '/contact'=>'index/contact',
////    如果隐藏id的话
//  '/contact/:id'=>'index/contact',
//
//],'','get|post');