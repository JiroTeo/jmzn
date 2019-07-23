<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"G:\www\jmzn\public/../application/admin\view\item\index.html";i:1563516235;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
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
                            <form  method="POST">

                                <button type="button" class="layui-btn" onclick="xadmin.open('添加用户','add_item.html',800,600)">
                                <i class="layui-icon"></i>发布项目</button>
                                <a href="?reco=1">
                                <button type="button" class="layui-btn" >
                                <i class="iconfont">&#xe6ac;</i>&nbsp;查看推荐项目</button></a>
                                <a href="?reco_brand=1">
                                <button type="button" class="layui-btn" >
                                <i class="iconfont">&#xe6ac;</i>&nbsp;查看品牌推荐</button></a>
                                &nbsp;&nbsp;&nbsp;&nbsp;搜索：
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="keyword"  placeholder="请输入需要检索的内容" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-body ">
<!--                            <table class="layui-table layui-form">-->
                            <table class="layui-table">
                                <thead>
                                    <tr>
                                        <th>项目id</th>
                                        <th>封面图</th>
                                        <th>所属用户</th>
                                        <th>投资金额</th>
                                        <th>发布时间</th>
                                        <th>所属公司</th>
                                        <th>品牌注册时间</th>
                                        <th>注册地址</th>
                                        <th>所属行业</th>
                                        <th>加盟区域</th>
<!--                                        <th>公司性质</th>-->
                                        <th>排序</th>
                                        <th>是否推荐</th>
                                        <th>添加富文本</th>
                                        <th>操作</th></tr>
                                </thead>
                                <tbody>
<?php foreach($data as $key =>$value): ?>
                                    <tr style="height:150px;">
                                        <td><?php echo $value['id']; ?></td>
                                        <td>
                                            <img src="http://www.zhangjin.com\<?php echo $value['img']; ?>" class="img" width="300">
                                        </td>
                                        <td><?php echo $value['username']; ?></td>
                                        <td><?php echo $value['money']; ?></td>
                                        <td><?php echo $value['addtime']; ?></td>
                                        <td><?php echo $value['company']; ?></td>
                                        <td><?php echo $value['brand_make_time']; ?></td>
                                        <td><?php echo $value['address']; ?></td>
                                        <td><?php echo $value['cate_name']; ?></td>
                                        <td><?php echo $value['item_area']; ?></td>
<!--                                        <td><?php echo $value['character']; ?></td>-->
                                        <td>
                                            <input type="text" id="<?php echo $value['id']; ?>" name="'order" onblur="input_blur(this,this.value,'<?php echo $value['id']; ?>')" class="layui-input" value="<?php echo $value['order']; ?>">
                                        </td>

                                        <td>
<?php if($value['reco'] == 0): ?>
                                            <a href="<?php echo url('admin/item/change_edit'); ?>?id=<?php echo $value['id']; ?>&reco=1">
                                            <button class="layui-btn"><i class="layui-icon"></i>web端首页推荐</button></a>
<?php endif; if($value['reco'] != 0): ?>
                                            <a href="<?php echo url('admin/item/change_edit'); ?>?id=<?php echo $value['id']; ?>&reco=0">
                                            <button class="layui-btn"style="background: #880000"><i class="iconfont">&#xe69a;</i>&nbsp;取消web端首页推荐</button></a>
<?php endif; if($value['reco_brand'] == 0): ?>
                                            <a href="<?php echo url('admin/item/change_edit'); ?>?id=<?php echo $value['id']; ?>&reco_brand=1">
                                                <button class="layui-btn layui-btn-warm" ><i class="iconfont">&#xe730;</i>&nbsp;设置web排行榜推荐品牌</button>
                                            </a>
<?php else: ?>
                                            <a href="<?php echo url('admin/item/change_edit'); ?>?id=<?php echo $value['id']; ?>&reco_brand=0">
                                                <button class="layui-btn"style="background:black"><i class="iconfont">&#xe6a0;</i>&nbsp;取消web排行榜品牌推荐</button>
                                            </a>
<?php endif; if($value['reco_wap'] == 0): ?>
                                            <a href="change_edit?id=<?php echo $value['id']; ?>&reco_wap=1">
                                                <button class="layui-btn"style="background: #7b4397"><i class="iconfont">&#xe756;</i>&nbsp;设置为wap端首页推荐</button>
                                            </a>
<?php else: ?>
                                            <a href="change_edit?id=<?php echo $value['id']; ?>&reco_wap=0">
                                                <button class="layui-btn"style="background: #3c3c3c"><i class="iconfont">&#xe756;</i>&nbsp;取消wap端首页推荐</button>
                                            </a>
<?php endif; ?>

                                            <a href="add_text?type=4&id=<?php echo $value['id']; ?>">
                                                <button class="layui-btn"style="background: #01AAED"><i class="iconfont">&#xe744;</i>&nbsp;添加项目详情</button>
                                            </a>
                                            <a href="javascript:;"  onclick="xadmin.open('添加到分组','../group/add_item_group?id=<?php echo $value['id']; ?>',800,600)">
                                                <button class="layui-btn" style="background: #FF00FF"><i class="iconfont">&#xe6f7;</i>&nbsp;关联分组管理</button>
                                            </a>
                                            <a href="javascript:;"  onclick="xadmin.open('添加文章','../article/article_add?id=<?php echo $value['id']; ?>',800,600)" >
                                                <button class="layui-btn" style="background: #008800"><i class="iconfont">&#xe69e;</i>&nbsp;修改开店攻略</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:;"  onclick="xadmin.open('加盟优势','../item/add_text?type=1&id=<?php echo $value['id']; ?>',800,600)" >
                                            加盟优势</a><br>
                                            <a href="javascript:;"  onclick="xadmin.open('加盟优势','../item/add_text?type=2&id=<?php echo $value['id']; ?>',800,600)" >
                                                加盟攻略</a><br>
                                            <a href="javascript:;"  onclick="xadmin.open('加盟优势','../item/add_text?type=3&id=<?php echo $value['id']; ?>',800,600)" >
                                                加盟费用</a><br>
                                        </td>
                                        <td class="td-manage">

                                            <a title="查看" onclick="xadmin.open('查看','detail?id=<?php echo $value['id']; ?>')" href="javascript:;">
                                                <i class="layui-icon">&#xe63c;</i>
                                            </a>
                                            <a title="编辑" onclick="xadmin.open('编辑','item_detail?id=<?php echo $value['id']; ?>',800,600)" href="javascript:;">
                                                <i class="iconfont">&#xe69e;</i>
                                            </a>
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
    <script>
        layui.use(['laydate', 'form'],
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
    function input_blur(obj,order,id){

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
    }

    </script>

</html>