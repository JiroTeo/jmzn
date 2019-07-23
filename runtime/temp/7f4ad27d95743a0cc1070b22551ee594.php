<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"G:\www\jmzn\public/../application/admin\view\index\index.html";i:1563419078;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;s:53:"G:\www\jmzn\application\admin\view\public\footer.html";i:1563188997;}*/ ?>
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
    
    <body class="index">
        <!-- 顶部开始 -->
        <div class="container">
            <div class="logo">
                <a href="./index.html"><?php echo $_SESSION['admin']['username']; ?></a></div>
            <div class="left_open">
                <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
            </div>
            <ul class="layui-nav left fast-add" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">+新增</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('最大化','http://www.baidu.com','','',true)">
                                <i class="iconfont">&#xe6a2;</i>弹出最大化
                            </a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
                                <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
                                <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开','member-list.html')">
                                <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
                                <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav right" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;"><?php echo $_SESSION['admin']['username']; ?></a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a></dd>
                        <dd>
                            <a onclick="xadmin.open('切换帐号','../login/logout')">切换帐号</a></dd>
                        <dd>
                            <a href="../login/logout.html">退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item to-index">
                    <a href="/">前台首页</a></li>
            </ul>
        </div>
        <!-- 顶部结束 -->
        <!-- 中部开始 -->   
        <!-- 左侧菜单开始 -->
        <div class="left-nav">
            <div id="side-nav">
                <ul id="nav">
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>
                            <cite>会员管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('统计页面','welcome.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>统计页面</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('投资用户','<?php echo url('admin/user/user_list'); ?>?type=0',true)">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>普通用户列表</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('企业用户','<?php echo url('admin/user/user_list'); ?>?type=1',true)">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>企业用户</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('系统管理员','<?php echo url('admin/user/user_list'); ?>?type=2',true)">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>系统管理员</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="项目管理">&#xe6ba;</i>
                            <cite>项目管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('项目列表','../item/index.html')">-->
                                <a onclick="xadmin.add_tab('项目列表','<?php echo url('admin/item/index'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>项目列表</cite></a>
                            </li>
                        </ul>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('今日留言','../item/new_consult_item_list.html')">-->
                                <a onclick="xadmin.add_tab('今日留言','<?php echo url('admin/item/new_consult_item_list'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>今日留言</cite></a>
                            </li>
                        </ul>
<?php foreach($data as $key => $value): ?>
                        <ul class="sub-menu">
                        <li>
<!--                            <a onclick="xadmin.add_tab('<?php echo $value['name']; ?>','../item/group_item_list?id=<?php echo $value['id']; ?>')">-->
                            <a onclick="xadmin.add_tab('<?php echo $value['name']; ?>','<?php echo url('admin/item/group_item_list'); ?>?id=<?php echo $value['id']; ?>')">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite><?php echo $value['name']; ?></cite></a>
                        </li>
                    </ul>
<?php endforeach; ?>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('<?php echo $value['name']; ?>','../group/add_group')">-->
                                <a onclick="xadmin.add_tab('<?php echo $value['name']; ?>','<?php echo url('admin/group/add_group'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>创建项目组</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="文章管理">&#xe6fb;</i>
                            <cite>文章管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('文章列表','../article/article_list.html')">-->
                                <a onclick="xadmin.add_tab('文章列表','<?php echo url('admin/article/article_list'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>全部文章</cite></a>
                            </li>
<!--                            <li>-->
<!--                                <a onclick="xadmin.add_tab('今日留言','../article/article_list.html')">-->
<!--                                    <i class="iconfont">&#xe6a7;</i>-->
<!--                                    <cite>今日留言</cite></a>-->
<!--                            </li>-->
                            <li>
                                <a onclick="xadmin.add_tab('行业报告','<?php echo url('admin/article/article_list'); ?>?type=0.html')">
<!--                                <a onclick="xadmin.add_tab('行业报告','../article/article_list?type=0.html')">-->
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>行业报告</cite></a>
                            </li>
                            <li>
<!--                                <a onclick="xadmin.add_tab('加盟咨询','../article/article_list?type=1.html')">-->
                                    <a onclick="xadmin.add_tab('加盟咨询','<?php echo url('admin/article/article_list'); ?>?type=1')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>加盟资讯</cite></a>
                            </li>
                            <li>
<!--                                <a onclick="xadmin.add_tab('加盟攻略    ','../article/article_list?type=2.html')">-->
                                <a onclick="xadmin.add_tab('加盟攻略','<?php echo url('admin/article/article_list'); ?>?type=2')">

                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>加盟攻略</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="分类管理">&#xe699;</i>
                            <cite>分类管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('行业分类','../category/category_list.html')">-->
                                <a onclick="xadmin.add_tab('行业分类','<?php echo url('admin/category/category_list'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>行业分类</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="搜索记录">&#xe6ac;</i>
                            <cite>搜索记录</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('历史搜索','../search/index.html')">-->
                                <a onclick="xadmin.add_tab('历史搜索','<?php echo url('admin/search/index'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>历史搜索</cite></a>
                            </li>
                            <li>
<!--                                <a onclick="xadmin.add_tab('热门搜索','../search/index?type=1')">-->
                                <a onclick="xadmin.add_tab('热门搜索','<?php echo url('admin/search/index'); ?>?type=1')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>热门搜索</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="评估记录">&#xe812;</i>
                            <cite>评估记录</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('评估列表','<?php echo url('admin/search/assess_list'); ?>')">
<!--                                <a onclick="xadmin.add_tab('评估列表','../search/assess_list.html')">-->
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>评估列表</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="品牌管理">&#xe6c5;</i>
                            <cite>品牌管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('品牌列表','<?php echo url('admin/brand/brand_list'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>品牌列表</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="广告管理">&#xe6f7;</i>
                            <cite>广告管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('广告列表','<?php echo url('admin/image/image_list'); ?>')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>广告列表</cite></a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="站内信">&#xe69f;</i>
                            <cite>站内信</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('站内信','../news/index?status=1')">-->
                                <a onclick="xadmin.add_tab('站内信','<?php echo url('admin/news/index'); ?>?status=1')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>站内信</cite></a>
                            </li>
                        </ul>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('站内信','../news/index?status=0')">-->
                                <a onclick="xadmin.add_tab('站内信','<?php echo url('admin/news/index'); ?>?status=0')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>已删除</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="意见反馈">&#xe6b2;</i>
                            <cite>意见反馈</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('意见反馈','<?php echo url('admin/search/aboutus'); ?>?status=1')">
<!--                                <a onclick="xadmin.add_tab('意见反馈','../search/aboutus?status=1')">-->
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>意见反馈</cite></a>
                            </li>
                        </ul>
                        <ul class="sub-menu">
                            <li>
<!--                                <a onclick="xadmin.add_tab('意见反馈(已处理)','../search/aboutus?status=0')">-->
                                <a onclick="xadmin.add_tab('意见反馈(已处理)','<?php echo url('admin/search/aboutus'); ?>?status=0')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>意见反馈(已处理)</cite></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- <div class="x-slide_left"></div> -->
        <!-- 左侧菜单结束 -->

        <!-- 右侧主体开始 -->
        <div class="page-content">
            <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
                <ul class="layui-tab-title">
                    <li class="home">
                        <i class="layui-icon">&#xe68e;</i>我的桌面</li>
                </ul>
                <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                    <dl>
                        <dd data-type="this">关闭当前</dd>
                        <dd data-type="other">关闭其它</dd>
                        <dd data-type="all">关闭全部</dd></dl>
                </div>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        
                    </div>
                </div>
                <div id="tab_show"></div>
            </div>
        </div>
        <div class="page-content-bg"></div>
        <style id="theme_style"></style>
        <!-- 右侧主体结束 -->
        <!-- 中部结束 -->
        <script>//百度统计可去掉
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

</html>
