<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"G:\www\jmzn\public/../application/admin\view\image\add_image.html";i:1563780518;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1565681034;}*/ ?>
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
        



        <script type="text/javascript" src="http://www.zhangjin.com\/statics/admin/js/jquery.min.js"></script>
<!--        <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>-->
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
                            <span class="x-red"></span>广告标题</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" placeholder="广告标题" required="" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                     <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>广告图</label>
                        <button type="button" class="layui-btn" id="test1">添加广告图</button>
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" id="demo1" style="width: 200px;">
                            <p id="demoText"></p>
                            <input type="hidden" name="img" value="" style="width: 500px" id="image">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>所展示页面</label>
                        <div class="layui-input-inline" style="width: 500px">
                            <input type="radio" name="type" lay-skin="primary" value="1" title="外链">
                            <input type="radio" name="type" lay-skin="primary" value="2" title="项目">
                            <input type="radio" name="type" lay-skin="primary" value="3" title="文章">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>Link</label>
                        <div class="layui-input-inline">
                            <input type="text" name="link" placeholder="请输入链接的id或者url" required="" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>选择终端</label>
                        <div class="layui-input-inline" style="width: 500px">
                            <input type="radio" name="client" lay-filter="show_web" value="1" title="web端">
                            <input type="radio" name="client" lay-filter="show_wap" value="2" title="wap端">
                            <input type="radio" name="position" value="defult" title="默认广告">
                        </div>
                    </div>


                    <div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="x-red"></span>所展示页面</label>
                            <div class="layui-input-inline" id="indexPage" style="width: 500px">
<!--                                <input type="radio" name="web_page" lay-skin="primary" value="2" title="行业资讯">-->
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                <span class="x-red"></span>所展示位置</label>
                            <div class="layui-input-inline" id="position" style="width: 500px">

                            </div>
                        </div>
                    </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">项目介绍</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" id="desc" name="sign" class="layui-textarea"></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
        </div>
        </form>
        </div>
        </div>
<script src="http://www.zhangjin.com\/dist/layedit.js" charset="utf-8"></script>
        <script>
layui.use('form', function () {
    var web;
    var form = layui.form;
    form.on('radio(show_web)', function () {
        $.ajax({
            type: "POST",
            url: "<?php echo url('admin/image/getconfaspos'); ?>",
            data:{
                f:'WEB',
                type:1,
            },
            success: function(data){
                web = jQuery.parseJSON(data);
                $("#indexPage").html(null);
                $("#position").html(null);
                layui.each(web.p,function (key,value) {
                    $("#indexPage").append("<label><div class='layui-unselect layui-form-radio'><input style='display: inline' type='radio' name='web_page' value='"+key+"' title='"+value+"'><div>"+value+"</div></div></label>");
                });
                layui.each(web.t,function (key,value) {
                    $("#position").append("<label><div class='layui-unselect layui-form-radio'><input style='display: inline' type='radio' name='position' value='"+key+"' title='"+value+"'><div>"+value+"</div></div></label>");
                });
            }
        });
    })
    form.on('radio(show_wap)', function () {
        $.ajax({
            type: "POST",
            url: "<?php echo url('admin/image/getconfaspos'); ?>",
            data:{
                f:'WAP',
                type:1,
            },
            success: function(data){
                wap = jQuery.parseJSON(data);
                $("#indexPage").html(null);
                $("#position").html(null);
                layui.each(wap.p,function (key,value) {
                    $("#indexPage").append("<label><div class='layui-unselect layui-form-radio'><input onclick='get_t("+key+")' style='display: inline' type='radio' name='web_page' value='"+key+"' title='"+value+"'><div>"+value+"</div></div></label>");
                    console.log(key,value)
                });
            }
        })
    })
});
function get_t(pos){
    $.ajax({
        type: "POST",
        url: "<?php echo url('admin/image/getconfaspos'); ?>",
        data:{
            f:'WAP',
            type:2,
            pos:pos
        },
        success: function(data){
            console.log(data);
            position = jQuery.parseJSON(data);
            $("#position").html(null);
            layui.each(position,function (key,value) {
                    $("#position").append("<label><div class='layui-unselect layui-form-radio'><input style='display: inline' type='radio' name='position' value='"+key+"' title='"+value+"'><div>"+value+"</div></div></label>");
                });
        }
    })
}



layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;

  //普通图片上传
  var uploadInst = upload.render({
    elem: '#test1'
    ,url: "<?php echo url('admin/index/uploadImage'); ?>"
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo1').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code > 0){
        return layer.msg('上传失败');
      }
      //上传成功
      $('#image').attr('value',res.data.src); //图片链接（base64）
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  });
  //
  var uploadInst = upload.render({
    elem: '#test3'
    ,url: "<?php echo url('admin/index/uploadImage'); ?>"
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo3').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code > 0){
        return layer.msg('上传失败');
      }
      //上传成功
      $('#logo').attr('value',res.data.src); //图片链接（base64）
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText2');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  });

  //多图片上传
  upload.render({
    elem: '#test2'
    ,url: "<?php echo url('admin/index/uploadImage'); ?>"
    ,multiple: true
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo2').append('<img src="'+ result +'" style="width: 100px;" alt="'+ file.name +'" class="layui-upload-img">')
      });
    }
    ,done: function(res){
      //上传完毕
           $('#demo2').append('<input type="hidden" name="image[]" value="'+res.data.src+'">');
    }
  });
});
        </script>

    </body>

</html>