<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"G:\www\jmzn\public/../application/admin\view\item\new_consult_item_list.html";i:1563188997;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
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
                        <div class="layui-card-header">

<!--                            <button class="layui-btn layui-btn-danger" onclick="delAll()">-->
<!--                                <i class="layui-icon"></i>批量删除</button>-->
                            <button class="layui-btn" onclick="xadmin.open('添加用户','add_item.html',800,600)">
                                <i class="layui-icon"></i>发布文章</button>
                        </div>
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                                <thead>
                                    <tr>
                                        <th>
                                            封面图</th>
                                        <th>项目id</th>
                                        <th>所属用户</th>
                                        <th>投资金额</th>
                                        <th>发布时间</th>
                                        <th>所属公司</th>
                                        <th>品牌注册时间</th>
                                        <th>注册地址</th>
                                        <th>所属行业</th>
                                        <th>加盟区域</th>
                                        <th>公司性质</th>
                                        <th>更多关联信息</th>
                                        <th>添加富文本</th>
                                        <th>操作</th></tr>
                                </thead>
                                <tbody>
<?php foreach($data as $key =>$value): ?>
                                    <tr>
                                        <td>
                                            <img src="http://www.zhangjin.com\<?php echo $value['img']; ?>" class="img" width="300">
                                        </td>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['username']; ?></td>
                                        <td><?php echo $value['money']; ?></td>
                                        <td><?php echo $value['addtime']; ?></td>
                                        <td><?php echo $value['company']; ?></td>
                                        <td><?php echo $value['brand_make_time']; ?></td>
                                        <td><?php echo $value['address']; ?></td>
                                        <td><?php echo $value['cate_name']; ?></td>
                                        <td><?php echo $value['item_area']; ?></td>
                                        <td><?php echo $value['character']; ?></td>
                                        <td>


    <p><a href="javascript:;"  onclick="xadmin.open('查看留言信息','../item/get_consult?id=<?php echo $value['id']; ?>',800,600)">留言信息</a></p>
    <p><a href="javascript:;"  onclick="xadmin.open('添加到分组','../group/add_item_group?id=<?php echo $value['id']; ?>',800,600)">添加分组</a></p>
    <p><a href="javascript:;"  onclick="xadmin.open('添加文章','../article/article_add?id=<?php echo $value['id']; ?>',800,600)" >开店攻略</a></p>
                                        </td>
                                        <td>
                                            <a href="add_text?type=4&id=<?php echo $value['id']; ?>">项目详情</a><br>
                                            <a href="add_text?type=1&id=<?php echo $value['id']; ?>">加盟优势</a><br>
                                            <a href="add_text?type=2&id=<?php echo $value['id']; ?>">加盟攻略</a><br>
                                            <a href="add_text?type=3&id=<?php echo $value['id']; ?>">加盟费用</a><br>
                                        </td>
                                        <td class="td-manage">
                                            <a title="查看" onclick="xadmin.open('编辑','item_detail?id=<?php echo $value['id']; ?>')" href="javascript:;">
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
                                    <?php echo $page; ?></div>
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

        /*用户-停用*/
        function member_stop(obj, id) {
            layer.confirm('确认要停用吗？',
            function(index) {

                if ($(obj).attr('title') == '启用') {

                    //发异步把用户状态进行更改
                    $(obj).attr('title', '停用');
                    $(obj).find('i').html('&#xe62f;');

                    $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                    layer.msg('已停用!', {
                        icon: 5,
                        time: 1000
                    });

                } else {
                    $(obj).attr('title', '启用');
                    $(obj).find('i').html('&#xe601;');

                    $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                    layer.msg('已启用!', {
                        icon: 5,
                        time: 1000
                    });
                }

            });
        }

        /*用户-删除*/
        function member_del(obj, id) {
            layer.confirm('确认要删除吗？',
            function(index) {
               //发送ajax删除数据
                $.ajax({
                type: "POST",
                url: 'del_item',
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

        function delAll(argument) {

            var data = tableCheck.getData();

            layer.confirm('确认要删除吗？' + data,
            function(index) {
                //捉到所有被选中的，发异步进行删除
                layer.msg('删除成功', {
                    icon: 1
                });
                $(".layui-form-checked").not('.header').parents('tr').remove();
            });
        }</script>

</html>