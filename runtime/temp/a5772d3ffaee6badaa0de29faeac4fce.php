<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"G:\www\jmzn\public/../application/admin\view\item\group_item_list.html";i:1563357311;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
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
                            <table class="layui-table layui-form">
                                <thead>
                                    <tr>
                                        <th>项目id</th>
                                        <th>封面图</th>
                                        <th>品牌名</th>
                                        <th>投资金额</th>
                                        <th>所属公司</th>
                                        <th>注册地址</th>
                                        <th>所属行业</th>
                                        <th>加盟区域</th>
                                        <th>公司性质</th>
                                        <th>是否推荐</th>
                                        <th>操作</th></tr>
                                </thead>
                                <tbody>
<?php foreach($data as $key =>$value): ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td>
                                            <img src="http://www.zhangjin.com\<?php echo $value['img']; ?>" class="img" width="300">
                                        </td>
                                        <td><?php echo $value['brand']; ?></td>
                                        <td><?php echo $value['money']; ?></td>
                                        <td><?php echo $value['company']; ?></td>
                                        <td><?php echo $value['address']; ?></td>
                                        <td><?php echo $value['cate_name']; ?></td>
                                        <td><?php echo $value['item_area']; ?></td>
                                        <td><?php echo $value['character']; ?></td>

                                        <td>
<?php if($value['reco_brand'] == 0): ?>
                                            <a href="<?php echo url('admin/group/changeGroupSub'); ?>?gid=<?php echo $gid; ?>&tid=<?php echo $value['id']; ?>&reco_brand=1">
                                                <button class="layui-btn"><i class="layui-icon"></i>精选展示[品牌]</button>
                                            </a>
<?php endif; if($value['reco_brand'] == 1): ?>
                                            <a href="<?php echo url('admin/group/changeGroupSub'); ?>?gid=<?php echo $gid; ?>&tid=<?php echo $value['id']; ?>&reco_brand=0">
                                                <button class="layui-btn"style="background: #880000"><i class="layui-icon">&#xe640;</i>取消展示[品牌]</button>
                                            </a>
<?php endif; if($value['reco_img'] == 0): ?>
                                            <a href="<?php echo url('admin/group/changeGroupSub'); ?>?gid=<?php echo $gid; ?>&tid=<?php echo $value['id']; ?>&reco_img=1">
                                                <button class="layui-btn"><i class="layui-icon"></i>精选展示[封面]</button>
                                            </a>
<?php endif; if($value['reco_img'] == 1): ?>
                                            <a href="<?php echo url('admin/group/changeGroupSub'); ?>?gid=<?php echo $gid; ?>&tid=<?php echo $value['id']; ?>&reco_img=0">
                                                <button class="layui-btn"style="background: #880000"><i class="layui-icon">&#xe640;</i>取消展示[封面]</button>
                                            </a>
<?php endif; ?>

                                        </td>
                                        <td class="td-manage">
                                            <a href="<?php echo url('admin/group/changeGroupSub'); ?>?gid=<?php echo $gid; ?>&tid=<?php echo $value['id']; ?>&status=0&type='del'">
                                                <i class="layui-icon">&#xe640;</i>
                                            </a>
                                        </td>
                                    </tr>
<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div>
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
                    layer.alert('成功');return;
                }else{
                    layer.alert('失败');return;
                }

             }
            });
        });

    </script>

</html>