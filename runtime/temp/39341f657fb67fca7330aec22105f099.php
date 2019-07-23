<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"G:\www\jmzn\public/../application/admin\view\image\image_list.html";i:1563437817;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
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
        <div class="x-nav">
            <span class="layui-breadcrumb">
                <a href="">首页</a>
                <a href="">演示</a>
                <a>
                    <cite>导航元素</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
                <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
            </a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">

                <div class="layui-col-md12">

                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form"  method="POST">

                                <button type="button" class="layui-btn" onclick="xadmin.open('添加广告','add_image.html',800,600)">
                                <i class="layui-icon"></i>添加广告</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;搜索：
                                <div class="layui-input-inline">
                                    <select name="" >
                                        <option value="">请选择要检索的页面</option>
                                        <option value="">请选择要检索的页面</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select name="" >
                                        <option value="">请选择广告所在位置</option>
                                        <option value="">请选择广告所在位置</option>
                                    </select>
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>

<!--                        <div class="layui-card-header">-->
<!--                            <button class="layui-btn" onclick="xadmin.open('添加用户','add_image.html',800,600)">-->
<!--                                <i class="layui-icon"></i>添加广告</button>-->
<!--                        </div>-->
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                                <thead>
                                    <tr>
                                        <th>广告id</th>
                                        <th>广告标题</th>
                                        <th>广告介绍</th>
                                        <th><center>广告图片</center></th>
                                        <th>展示终端</th>
                                        <th>展示页面</th>
                                        <th>展示位置</th>
                                        <th>广告类型</th>
                                        <th>链接内容</th>
                                        <th>添加时间</th>
                                        <th>备注</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach($data as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['title']; ?></td>
                                        <td><?php echo $value['sign']; ?></td>
                                        <td>
                                            <center>
                                                <img src="http://www.zhangjin.com\<?php echo $value['img']; ?>" style="max-width: 500px;max-height: 100px">
                                            </center>
                                        </td>
                                        <td><?php echo $value['tag']; ?></td>
                                        <td><?php echo $value['web_page']; ?></td>
                                        <td><?php echo $value['position']; ?></td>
                                        <td><?php echo $value['type']; ?></td>
                                        <td><?php echo $value['link']; ?></td>
                                        <td><?php echo $value['addtime']; ?></td>
                                        <td><?php echo $value['remarks']; ?></td>
                                        <td class="td-manage">
                                            <a title="查看" onclick="xadmin.open('编辑','edit_image_data?id=<?php echo $value['id']; ?>',800,600)" href="javascript:;">
                                                <i class="layui-icon">&#xe63c;</i></a>
                                            <a title="删除" onclick="member_del(this,'<?php echo $value['id']; ?>')" href="javascript:;">
                                                <i class="layui-icon">&#xe640;</i></a>
                                        </td>
                                    </tr>
<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div>
    <?php echo $page; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });

        /*用户-删除*/
        function member_del(obj, id) {
            layer.confirm('确认要删除吗？',
            function(index) {
               //发送ajax删除数据
                $.ajax({
                type: "POST",
                url:"<?php echo url('admin/image/del_image'); ?>",
                data:{
                    id:id,
                },
                });
                //发异步删除数据
                $(obj).parents("tr").remove();
                layer.msg('已删除!', {
                    icon: 1,
                    time: 1000
                });
            });
        }
        //项目排序
        $("input").blur(function(){
            var order = $(this).val();
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo url('admin/item/item_order'); ?>",
                data:{
                    order:order,
                    id:id,
                },
                success: function(data){
                if(data == 1){
                    alert('成功');return;
                }else{
                    alert('失败');return;
                }

             }
            });
        });

    </script>

</html>