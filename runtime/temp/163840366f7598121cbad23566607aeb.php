<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"G:\www\jmzn\public/../application/admin\view\article\article_add.html";i:1563188996;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
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
    <link href="http://www.zhangjin.com\/statics/admin/editor/Content/Layui-KnifeZ/css/layui.css" rel="stylesheet" />
    <script src="http://www.zhangjin.com\/statics/admin/editor/Content/Layui-KnifeZ/layui.js"></script>
    <script src="http://www.zhangjin.com\/statics/admin/editor/Content/ace/ace.js"></script>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" method="POST" enctype="multipart/form-data">
                    <div class="layui-form-item">
                        <label for="" class="layui-form-label">
                            <span class="x-red"></span>文章名字</label>
                        <div class="layui-input-inline">
                            <input type="text" id="" name="title" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>封面图</label>
                        <div class="layui-input-inline">
                                <button type="button" class="layui-btn" id="test2">上传封面图</button>
                                  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                                    预览图：
                                    <div class="layui-upload-list" id="demo2"></div>
                                 </blockquote>
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label for="" class="layui-form-label">
                            <span class="x-red"></span>文章类型</label>
                        <div class="layui-input-inline">
                            <select id="shipping" name="type" class="valid">
                                <option value="0">行业报告</option>
                                <option value="1">加盟资讯</option>
                                <option value="2">加盟攻略</option>
                                </select>
                        </div>
                    </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">项目介绍</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" id="desc" name="sign" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">项目内容</label>
            <div class="layui-input-block">
                <textarea id="layeditDemo" name="detail"></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <button class="layui-btn" lay-filter="add" lay-submit="">增加</button></div>
        </form>
        </div>
        </div>
        <script>
       layui.use('upload', function(){
          var $ = layui.jquery
          ,upload = layui.upload;

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
                   $('#demo2').append('<input type="hidden" name="img[]" value="'+res.data.src+'">');
            }
          });
        });

        layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#brand_make_time' //指定元素
            });
        });

            layui.use(['layedit', 'layer', 'jquery'], function () {
            var $ = layui.jquery;
            var layedit = layui.layedit;
            layedit.set({
                //暴露layupload参数设置接口 --详细查看layupload参数说明
                uploadImage: {
                    url: "<?php echo url('admin/index/uploadImage'); ?>",
                    accept: 'image',
                    acceptMime: 'image/*',
                    exts: 'jpg|png|gif|bmp|jpeg',
                    size: '10240'
                }
                , uploadVideo: {
                    url: '/Attachment/LayUploadFile',
                    accept: 'video',
                    acceptMime: 'video/*',
                    exts: 'mp4|flv|avi|rm|rmvb',
                    size: '20480'
                }
                //右键删除图片/视频时的回调参数，post到后台删除服务器文件等操作，
                //传递参数：
                //图片： imgpath --图片路径
                //视频： filepath --视频路径 imgpath --封面路径
                , calldel: {
                    url: '/Attachment/DeleteFile'
                }
                //开发者模式 --默认为false
                , devmode: true
                //插入代码设置
                , codeConfig: {
                    hide: true,  //是否显示编码语言选择框
                    default: 'javascript' //hide为true时的默认语言格式
                }
                , tool: [
                    'html', 'code', 'strong', 'italic', 'underline', 'del', 'addhr', '|', 'fontFomatt', 'colorpicker', 'face'
                    , '|', 'left', 'center', 'right', '|', 'link', 'unlink', 'image_alt', 'video', 'anchors'
                    , '|', 'fullScreen'
                ]
                , height: '90%'
            });
            var ieditor = layedit.build('layeditDemo');
        })
        </script>
    </body>

</html>