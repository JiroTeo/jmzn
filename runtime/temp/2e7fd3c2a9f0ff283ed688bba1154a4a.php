<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"G:\www\jmzn\public/../application/admin\view\brand\edit_barnd_data.html";i:1563188996;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
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
                <form class="layui-form" method="POST" action="<?php echo url('admin/brand/edit_barnd_data'); ?>" enctype="multipart/form-data">
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>品牌名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" value="<?php echo $data['name']; ?>" required="" lay-verify="required" autocomplete="off" class="layui-input">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                        </div>
                    </div>
                     <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>品牌LOGO</label>
                        <button type="button" class="layui-btn" id="test1">上传LOGO</button>
                        <div class="layui-upload-list" style="text-align: center;">
                            <img class="layui-upload-img" src="http://www.zhangjin.com\<?php echo $data['img']; ?>" id="demo1" style="width: 200px;">
                            <p id="demoText"></p>
                            <input type="hidden" name="img" value="<?php echo $data['img']; ?>" style="width: 500px" id="image">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>链接选择
                        </label>
                        <div class="layui-input-inline" style="width: 400px">
                            <input type="radio" value="1" title="外链" name="type" <?php if($data['type'] == 1): ?>checked <?php endif; ?> lay-verify="required" autocomplete="off" class="layui-input">
                            <input type="radio" value="2" title="项目" name="type" <?php if($data['type'] == 2): ?>checked <?php endif; ?> lay-verify="required" autocomplete="off" class="layui-input">
                            <input type="radio" value="3" title="文章" name="type" <?php if($data['type'] == 3): ?>checked <?php endif; ?> lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                     <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>链接内容
                        </label>
                        <div class="layui-input-inline" style="width: 400px">
                            <input type="text" name="link" value="<?php echo $data['link']; ?>" required="" lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <textarea placeholder="备注：前端页面不展示" style="width:400px" id="desc" name="remarks" class="layui-textarea"><?php echo $data['remarks']; ?></textarea>
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
});
        </script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    </body>

</html>