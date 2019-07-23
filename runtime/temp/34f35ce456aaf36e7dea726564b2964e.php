<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"G:\www\jmzn\public/../application/admin\view\group\add_group.html";i:1563188996;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">

    <head>
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
    
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" action="add_group" method="post" enctype="multipart/form-data">
                  <div class="layui-form-item">
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>分组名字
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="group" name="name" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">
                      </div>
                  </div>

                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                          <span class="x-red">*</span>分组介绍
                      </label>
                      <div class="layui-input-inline">
                          <textarea placeholder="请输入内容" id="desc" name="sign" class="layui-textarea"></textarea>
                      </div>
                  </div>
                    <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                          <span class="x-red">*</span>添加封面图
                      </label>
                      <div class="layui-input-inline">
                          <input type="file" name="img">
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <button  class="layui-btn"  lay-submit="">
                          增加
                      </button>
                  </div>
              </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //自定义验证规则
                form.verify({
                    nikename: function(value) {
                        if (value.length < 5) {
                            return '昵称至少得5个字符啊';
                        }
                    },
                    pass: [/(.+){6,12}$/, '密码必须6到12位'],
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(add)',
                function(data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    layer.alert("增加成功", {
                        icon: 6
                    },
                    function() {
                        //关闭当前frame
                        xadmin.close();

                        // 可以对父窗口进行刷新
                        xadmin.father_reload();
                    });
                    return false;
                });

            });</script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

</html>
