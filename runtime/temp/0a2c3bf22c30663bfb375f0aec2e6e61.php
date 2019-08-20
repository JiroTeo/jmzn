<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"G:\www\jmzn\public/../application/admin\view\image\add_adve_pos.html";i:1563760185;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">

<!doctype html>
<html class="x-admin-sm">
    <head>
        <!-- #include -->
        <meta charset="UTF-8">
        <title>后台管理页面</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        



        <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://www.zhangjin.com\/statics/admin/css/theme5.css" />
        <link rel="stylesheet" type="text/css" href="http://www.zhangjin.com\/statics/admin/css/xadmin.css" />
        <link rel="stylesheet" type="text/css" href="http://www.zhangjin.com\/statics/admin/css/font.css" />
        <script type="text/javascript" src="http://www.zhangjin.com\/statics/admin/lib/layui/layui.js"></script>
        <script type="text/javascript" src="http://www.zhangjin.com\/statics/admin/js/xadmin.js"></script>

        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            // 是否开启刷新记忆tab功能
            // var is_remember = false;
        </script>
    </head>
    
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" method="POST" enctype="multipart/form-data">
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>TITLE</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" placeholder="title" required="" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>REMARKS</label>
                        <div class="layui-input-inline">
                            <input type="text" name="remark" placeholder="REMARKS" required="" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
        </div>
        </form>
        </div>
        </div>
    </body>

</html>