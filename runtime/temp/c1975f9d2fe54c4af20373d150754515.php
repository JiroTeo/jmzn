<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"G:\www\jmzn\public/../application/admin\view\article\article_list.html";i:1563530213;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
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
                            <button class="layui-btn" onclick="xadmin.open('发布文章','article_add.html',800,600)">
                                <i class="layui-icon"></i>发布文章</button>
                        </div>

                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                                <thead>
                                    <tr>
                                        <th>封面图</th>
                                        <th>文章id</th>
                                        <th>所属用户</th>
                                        <th>所属项目</th>
                                        <th>文章标题</th>
                                        <th>发布时间</th>
                                        <th>文章类型</th>
                                        <th>阅读次数</th>
                                        <th>文章介绍</th>
                                        <th>查看留言</th>
                                        <th width="50px">文章排序</th>
                                        <th>是否推荐</th>
                                        <th>操作</th></tr>
                                </thead>
                                <tbody>
<?php foreach($data as $key =>$value): ?>
                                    <tr>
                                        <td>
<?php foreach($value['img'] as $v): ?>
                                            <img src="http://www.zhangjin.com\<?php echo $v; ?>" class="img" width="300">
<?php endforeach; ?>
                                        </td>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['username']; ?></td>
                                        <td><?php echo $value['item_id']; ?></td>
                                        <td><?php echo $value['title']; ?></td>
                                        <td><?php echo $value['addtime']; ?></td>
                                        <td><?php echo $value['type']; ?></td>
                                        <td><?php echo $value['read_num']; ?></td>
                                        <td><?php echo $value['sign']; ?></td>
                                        <td>
                                            <a href="<?php echo url('admin/article/get_article_comment'); ?>">查看留言</a>
                                        </td>
                                        <td>
<input type="text" id="<?php echo $value['id']; ?>" name="'order"  class="layui-input" value="<?php echo $value['order']; ?>">
                                        </td>
                                        <td>
<?php if($value['reco'] == 0): ?>
                                            <a href="<?php echo url('admin/article/change_article'); ?>?id=<?php echo $value['id']; ?>&reco=1&type=1">
                                            <button class="layui-btn"><i class="layui-icon"></i>推荐到web端首页</button></a>
<?php endif; if($value['reco'] == 1): ?>
                                            <a href="<?php echo url('admin/article/change_article'); ?>?id=<?php echo $value['id']; ?>&reco=0&type=1">
                                            <button class="layui-btn"style="background: #880000"><i class="layui-icon"></i>取消web首页推荐</button></a>
<?php endif; if($value['reco_wap'] == 0): ?>
                                            <a href="<?php echo url('admin/article/change_article'); ?>?id=<?php echo $value['id']; ?>&reco_wap=1&type=3">
                                            <button class="layui-btn" style="background: #008800"><i class="layui-icon"></i>推荐到wap列表页</button></a>
<?php endif; if($value['reco_wap'] == 1): ?>
                                            <a href="<?php echo url('admin/article/change_article'); ?>?id=<?php echo $value['id']; ?>&reco_wap=0&type=3">
                                            <button class="layui-btn"style="background: #0C0C0C"><i class="layui-icon"></i>取消web列表推荐</button></a>
<?php endif; ?>
                                        </td>
                                        <td class="td-manage">
                                            <a title="编辑" onclick="xadmin.open('编辑','../article/edit_article?id=<?php echo $value['id']; ?>')" href="javascript:;">
                                                <i class="iconfont">&#xe6b2;</i></a>
                                            &nbsp;
                                            <a title="查看" onclick="xadmin.open('预览','../article/article_detail?id=<?php echo $value['id']; ?>')" href="javascript:;">
                                                <i class="iconfont">&#xe6e6;</i></a>
                                            &nbsp;
                                            <a title="删除" onclick="member_del(this,'<?php echo $value['id']; ?>')" href="javascript:;">
                                                <i class="iconfont">&#xe69d;</i></a>
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
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script>


            $("input").blur(function(){
            var order = $(this).val();
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo url('admin/article/change_article'); ?>",
                data:{
                    order:order,
                    id:id,
                    type:2,
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

        /*用户-删除*/
        function member_del(obj, id) {
            layer.confirm('确认要删除吗？',
            function(index) {
               //发送ajax删除数据
                $.ajax({
                type: "POST",
                url: 'article_del',
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