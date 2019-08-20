<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"G:\www\jmzn\public/../application/admin\view\item\detail.html";i:1563188997;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0045)https://www.jiamengzhinan.com/#/detail?id=141 -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>项目详情</title>
		<link href="http://www.zhangjin.com\/statics/admin/css/item_detail.css" rel="stylesheet">
	<div id="app">
        <div data-v-4e6bee46="" class="list">


        <div data-v-4e6bee46="" class="greyBg">
        	<div data-v-4e6bee46="" class="wrapper clearfix"><p data-v-4e6bee46="" class="adress">项目详情</p>
        	<div data-v-4e6bee46="" class="detailLeft">
        	<div data-v-4e6bee46="" class="itemBox clearfix">
                <div data-v-4e6bee46="" class="itemPic"><img data-v-4e6bee46="" src="http://www.zhangjin.com\<?php echo $image['0']; ?>" class="bigPic">
                    <div data-v-4e6bee46="" class="between">
        <?php foreach($image as $value): ?>
                        <label data-v-4e6bee46="" class="active">
                            <img data-v-4e6bee46="" src="http://www.zhangjin.com\<?php echo $value; ?>">
                            <span data-v-4e6bee46="" class="border"></span></label>
        <?php endforeach; ?>
                    </div>
                </div>
            <div data-v-4e6bee46="" class="itemDesc">
        	<h2 data-v-4e6bee46=""><?php echo $idata['item_name']; ?></h2>
        	<p data-v-4e6bee46="" class="price"><?php echo $idata['money']; ?>万元</p>
        	<p data-v-4e6bee46="" class="suit">
                <span data-v-4e6bee46="">所属行业：<?php echo $idata['cate_name']; ?></span>
                <span data-v-4e6bee46="">适合人群：<?php echo $idata['crowd']; ?></span>
            </p>
        	<div data-v-4e6bee46="" class="numBox around">
                <label data-v-4e6bee46="" class="block">
                    <b data-v-4e6bee46=""><?php echo $idata['shop_count']; ?>家</b> <i data-v-4e6bee46="">直营店</i>
                </label><span data-v-4e6bee46="" class="line"></span>
                <label data-v-4e6bee46="" class="block">
                    <b data-v-4e6bee46=""><?php echo $idata['fran_store_num']; ?>家</b> <i data-v-4e6bee46="">加盟店</i>
                </label> <span data-v-4e6bee46="" class="line"></span>
                <label data-v-4e6bee46="" class="block">
                    <b data-v-4e6bee46=""><?php echo $idata['area_name']; ?></b>
                    <i data-v-4e6bee46="">加盟区域</i>
                </label> <span data-v-4e6bee46="" class="line"></span>
                <label data-v-4e6bee46="" class="block"><b data-v-4e6bee46=""><?php echo $idata['apply']; ?>人</b>
                    <i data-v-4e6bee46="">申请加盟</i>
                </label>
        	</div>
                <p data-v-4e6bee46="" class="yellowWord">
                    <span data-v-4e6bee46="">项目关注 <b data-v-4e6bee46=""><?php echo $idata['followcount']; ?></b></span>
                    <span data-v-4e6bee46="">项目收藏 <b data-v-4e6bee46=""><?php echo $idata['collectcount']; ?></b></span>
                    <span data-v-4e6bee46="">项目咨询 <b data-v-4e6bee46=""><?php echo $idata['count']; ?></b></span>
                </p>
    </div>
    </div>
        <div data-v-4e6bee46="" class="introBox"><h3 data-v-4e6bee46="">项目简介</h3>
        	<div data-v-4e6bee46="" class="content">
                <?php echo $idata['recommend']; ?>
        	</div>
        </div>
        <div data-v-4e6bee46="" class="introBox"><h3 data-v-4e6bee46="">项目详情</h3>
        	<div data-v-4e6bee46="" class="content">
                <?php echo $idata['detail']; ?>
        	</div>
        </div>
        <div data-v-4e6bee46="" class="consultBox">
        	<div data-v-4e6bee46="" class="title between">
                <h3 data-v-4e6bee46="">用户咨询</h3>
                <span data-v-4e6bee46=""><?php echo $idata['apply']; ?>人申请加盟</span>
        	</div>
<?php if($cdata != []): foreach($cdata as $key => $value): ?>
            <dl data-v-4e6bee46="" class="consultDL between">
                <dt data-v-4e6bee46="">
                    <img data-v-4e6bee46="" src="http://www.zhangjin.com\<?php echo $value['avatar']; ?>">
                </dt>
                <dd data-v-4e6bee46="">
                    <p data-v-4e6bee46="" class="inf between">
                        <span data-v-4e6bee46=""><?php echo $value['username']; ?></span>
                        <span data-v-4e6bee46=""><?php echo $value['addtime']; ?></span></p>
                    <p data-v-4e6bee46="" class="word"><?php echo $value['content']; ?></p>
                </dd>
            </dl>
<?php endforeach; endif; ?>
        </div>
    </div>
        <div data-v-4e6bee46="" class="detailRight">
        	<div data-v-4e6bee46="" class="companyInf">
        	<div data-v-4e6bee46="" class="title between">
                <h3 data-v-4e6bee46="">公司信息</h3>
        	</div>
        	<dl data-v-4e6bee46="">
                <dt data-v-4e6bee46="">
                    <img data-v-4e6bee46="" src="http://www.zhangjin.com\<?php echo $udata['logo']; ?>">
                    <p data-v-4e6bee46=""><?php echo $udata['company']; ?></p>
                </dt>
                <dd data-v-4e6bee46="">
                    <p data-v-4e6bee46="">公司性质：<?php echo $udata['character']; ?></p>
                    <p data-v-4e6bee46="">注册资金：<?php echo $udata['money']; ?>万元</p>
                    <p data-v-4e6bee46="">经营范围：<?php echo $udata['scope']; ?></p>
                    <p data-v-4e6bee46="">品牌注册时间：<?php echo $udata['brand_make_time']; ?></p>
                    <p data-v-4e6bee46="">注册地址：<?php echo $udata['address']; ?></p>
                </dd>
            </dl>
        </div>

        	</div>
        	</div>
        	</div>
        	</div>


</div>
</body>
</html>