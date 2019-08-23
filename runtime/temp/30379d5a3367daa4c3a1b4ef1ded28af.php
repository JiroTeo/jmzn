<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"D:\PHPTutorial\WWW\jmzn\jmzn\public/../application/index\view\item\detail.html";i:1566551832;s:66:"D:\PHPTutorial\WWW\jmzn\jmzn\application\index\view\defa\defa.html";i:1566550863;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>项目详情</title>
  <meta name="keywords" content="
   "加盟指南,加盟指南栏目,加盟指南网,项目加盟指南,创业好项目加盟指南，招商外包服务，专业招商外包服务公司，只做招商外包服务"
   ">
  <meta name="description" content="
    "加盟指南网是为招商加盟企业提供招商外包服务的专业招商外包服务平台，平台设有加盟指南栏目,为加盟者提供各招商行业的加盟指南资讯,最新的加盟指南数据分析，创新的推送加盟线索招商外包服务模式对招商企业提供专业的招商外包服务,使其招商成功，招商外包服务热线:400-619-8882。"
    ">
  <script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/admin/lib/layui/layui.js"></script>
  <meta name="360-site-verification" content="8fa3cbfa5b4b4bdf0a95dd925cf2f8b5" />
  <script type="text/javascript" src="http://www.test.com\/statics/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="http://www.test.com\/statics/layer-v3.1.1/layer/layer.js" merge="true"> </script>
  <link rel="stylesheet" href="http://www.test.com\/statics/layer-v3.1.1/layer/theme/default/layer.css"/>

  
  <link href="http://www.test.com\/statics/index/css/app.6e8fecf9baa6cf278e54a8181d44c5e4.css" rel="stylesheet">
  <script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/index/js/0.f5ed0d9d7e597a228142.js"></script>
  <script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/index/js/17.2ca34d5d16f167d8013d.js"></script>
  
</head>
<style type="text/css">
  #app .tag{
    margin-top: 25px;
  }
</style>
<body>
<div id="app">
  
  <div data-v-5eef6683="" class="common-header">
    <div data-v-5eef6683="" class="body wrapper">
      <div data-v-5eef6683="" class="left">
        欢迎来到加盟指南网！ 全国服务热线：400-619-8882
      </div>
      <div data-v-5eef6683="" class="right">
        <div data-v-5eef6683="" class="phoneVersion">
          <span data-v-5eef6683="" class="iconfont icon-phone">
          </span>
          <span
                  data-v-5eef6683="">手机版
              </span>
          <img data-v-5eef6683="" src="http://www.test.com\/statics/index/img/wap_qrcode.475f601.jpg" alt="手机二维码"
               class="QRcode">
        </div>
        <div data-v-5eef6683="" class="weChatVersion">
          <span data-v-5eef6683="" class="iconfont icon-weChat">
          </span>
          <span data-v-5eef6683="">微信版
          </span>
          <img data-v-5eef6683="" src="http://www.test.com\/statics/index/img/wx_qrcode.d7de962.jpg" alt="微信二维码"
               class="QRcode">
        </div>
        <div data-v-5eef6683="">
          <?php if($_SESSION['jmzn_web']['uid'] !== false): ?>
          <a data-v-5eef6683="" href="<?php echo url('index/user/index'); ?>" class=""><span data-v-5eef6683="" class="name">您好，<?php echo $_SESSION['jmzn_web']['username']; ?></span></a>
          &nbsp;&nbsp;<a href="<?php echo url('index/login/logout'); ?>"><span data-v-5eef6683="">退出登陆</span></a>
          <?php else: ?>
          <a data-v-5eef6683="" href="<?php echo url('index/login/login'); ?>" class="">登陆</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div data-v-645de51c="" class="list">
    <div data-v-3a1bbf91="" data-v-64375f02="" class="search ">
      <div data-v-3a1bbf91="" class="wrapper">
        <a data-v-3a1bbf91="" href="/"
           class="router-link-exact-active router-link-active"><img
                data-v-3a1bbf91="" src="http://www.test.com\/statics/index/img/logo.45da167.png" title="加盟指南" class="logo"></a>
        <div data-v-3a1bbf91="">
          <div data-v-3a1bbf91=""
               class="input-with-select el-input el-input-group el-input-group--append el-input--prefix el-input--suffix">
            <!----><input type="text" autocomplete="off" placeholder="请输入内容" class="el-input__inner">
            <span class="el-input__prefix"><i data-v-3a1bbf91="" class="el-input__icon el-icon-search"></i><!----></span>
            <!---->
            <div class="el-input-group__append">
              <button data-v-3a1bbf91="" type="button" class="el-button el-button--default"><!----><!---->
                <span><a data-v-3a1bbf91="" href="javascript" class="">搜索</a></span>
              </button>
            </div><!---->
          </div>
          <div data-v-3a1bbf91="" class="tag">
            <span data-v-3a1bbf91="" class="name">热门搜索：</span>
            <?php foreach($hotLog as $key => $value): ?>
            <a href="<?php echo url('index/item/index'); ?>?keyword=<?php echo $value['word']; ?>"><span data-v-3a1bbf91=""><?php echo $value['word']; ?></span></a>
            <?php endforeach; ?>
          </div>
        </div>
        <a data-v-3a1bbf91="" href="<?php echo url('index/assess/index'); ?>" class="">
          <img data-v-3a1bbf91="" src="data:image/png;base64,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" alt="" class="evaluate"></a>
      </div>
    </div>
    <div data-v-645de51c="" class="commonNav">
      <div data-v-645de51c="" class="wrapper">
        <div data-v-645de51c="" class="part">
          <a data-v-645de51c="" href="/" class="router-link-active">
            <span data-v-645de51c="">首页</span><i data-v-645de51c=""></i>
          </a>
          <a data-v-645de51c="" href="<?php echo url('index/item/index'); ?>" class="<?php if($title=='找项目'): ?>active router-link-exact-active router-link-active<?php endif; ?>">
            <span data-v-645de51c="">找项目</span>
            <img data-v-645de51c="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAARCAMAAACLgl7OAAAAP1BMVEVHcEz/egD/fQD/fgD/fQD/fQD/fgD/fgD/fQD/cwD//v3/n03/hxz/7eL/vX7/4c7/x5v/kS3/rGH/0Kr/28JveqjrAAAACnRSTlMAMC//2PjAl+sIVJiFyAAAAKhJREFUKM+NkdsOhCAMRNGixKHl6v9/64KCrm40Ow9kQk+m0Cr1j0ajJ7pp0mZs5cXQg8yy1Wd61FwJQy8ypf/uXCSKjn+IoQfAEll0wPkzQl+B6Fwi66WHadX+h+xcBkeIICSBb8CkWhTEewFnYQpC4WhxAnuLNRMlfAH6BgREXqWGHI+8AixAsQn9Q0MHbLlgW0115TwG9TbHbdSvg66reCqWdQ91lx88RQo8unUbdwAAAABJRU5ErkJggg==" class="hot"><i data-v-645de51c=""></i>
          </a>
          <a data-v-645de51c="" href="<?php echo url('index/index/rankinglist'); ?>" class="<?php if($title=='排行榜'): ?>active router-link-exact-active router-link-active<?php endif; ?>">
            <span data-v-645de51c="">排行榜</span>
            <i data-v-645de51c=""></i>
          </a>
          <a data-v-645de51c="" href="<?php echo url('index/article/index'); ?>" class="<?php if($title=='行业资讯'): ?>active router-link-exact-active router-link-active<?php endif; ?>">
            <span data-v-645de51c="">行业资讯</span> <i data-v-645de51c=""></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  
    
<link href="http://www.test.com\/statics/admin/css/xadmin.css" rel="stylesheet">
<style type="text/css">
  .photoBox{
    display: block;
    width: 286px;
    height: 286px;
    margin-bottom: 12px;
    overflow: hidden;
  }
  .photoBox img{
    margin-bottom: 0!important;
  }
  .el-radio{
    margin-right: 15px!important;
  }
  .el-radio__label{
    padding-left: 0!important;
  }
  .consultBg{
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    position: fixed;
    left: 0;
    top: 0;
    z-index: 9990;
  }
  .consultCase{
    width: 386px;
    height: 520px;
    padding: 0 15px 0 25px;
    background: #fff;
    border-radius: 2px;
    position: absolute;
    left: 50%;
    top: 50%;
    margin:-260px 0 0 -213px;
    z-index: 9992;
  }
  .consultCase h2{
    padding: 20px 20px 30px;
    text-align:center;
    font-size: 18px;
  }
  .consultCase .close{
    width: 20px;
    height: 20px;
    background: url(http://www.test.com\/statics/index/image/close.png) no-repeat;
    background-size: 100%;
    position: absolute;
    right: 15px;
    top: 15px;
    z-index: 10;
    cursor: pointer;
  }
  .consultCase .row{
    margin-bottom: 16px;
  }
  .consultCase .name{
    width: 70px;
    line-height: 41px;
    text-align: right;
    color: #666;
    margin-right: 10px;
  }
  .consultCase .name i{
    color: #f00;
  }
  .consultCase .commonInp{
    width: 290px;
    height: 39px;
    line-height: 39px;
    text-indent: 10px;
    border: 1px solid #dcdfe6;
    border-radius: 4px;
  }
  .consultCase .picInp{
    width: 180px;
  }
  .consultCase .picBtn{
    float: left;
    width: 105px;
    height: 41px;
    line-height: 41px;
    margin-left: 5px;
  }
  .consultCase .checkBtn{
    float: left;
    width: 103px;
    height: 39px;
    font-size: 12px;
    line-height: 39px;
    border: 1px solid #dcdfe6;
    border-radius: 4px;
    text-align: center;
    margin-left: 5px;
  }
  .textArea{
    width: 270px;
    height: 60px;
    padding: 10px;
    border: 1px solid #dcdfe6;
    border-radius: 2px;
    resize: none;
    margin-left: 80px;
  }
  .commitBtn{
    display: block;
    width: 75px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background-color: #409eff;
    color: #fff;
    border-radius: 4px;
    margin: 0 auto;
  }
  .consultBox {
    width: 885px;
    height: auto;
    padding-bottom: 20px;
    background: #fff;
    margin: 20px 0;
  }
  .consultBox .title {
    height: 62px;
    line-height: 62px;
    background: #F0F7FF;
    padding: 0 21px 0 24px;
    font-size: 14px;
    color: #999;
  }
  .consultBox .title h3 {
    font-size: 18px;
    color: #000;
  }
  .consultBox .consultDL {
    margin: 0 20px;
    padding: 27px 0;
    border-bottom: 1px dashed #E3E4E5;
  }
  .consultBox .consultDL dt {
    width: 56px;
    height: 56px;
  }
  .consultBox .consultDL dt img {
    display: block;
    width: 56px;
    height: 56px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
  }
  .consultBox .consultDL dd {
    width: 760px;
  }
  .consultBox .consultDL dd .inf {
    height: 30px;
    line-height: 30px;
    color: #999;
  }
  .consultBox .consultDL dd .inf span:nth-child(1) {
    font-size: 16px;
    color: #333;
  }
  .consultBox .consultDL dd .word {
    margin-top: 3px;
    line-height: 26px;
  }
  .consultBox .lookBtn {
    display: block;
    width: 80px;
    text-align: center;
    color: #999;
    margin: 20px auto 0;
    cursor: pointer;
  }
</style>
<div id="app">
  <div data-v-4b135571="" class="list">
    <div data-v-4b135571="" class="greyBg">
      <div data-v-4b135571="" class="wrapper clearfix">
        <p data-v-4b135571="" class="adress">您的位置：
          <a data-v-4b135571="" href="<?php echo url('index/index/rankinglist'); ?>?cateid=undefined" class=""><?php echo $data['father_cate_name']; ?></a> &gt;
          <a data-v-4b135571="" href="<?php echo url('index/index/rankinglist'); ?>?cateid=undefined&amp;childid=undefined" class=""><?php echo $data['cate_name']; ?></a> &gt;
        </p>
        <div data-v-4b135571="" class="detailLeft">
          <div data-v-4b135571="" class="itemBox clearfix">
            <div data-v-4b135571="" class="itemPic">
              <div class="photoBox">
                <?php foreach($data['image'] as $key => $value): ?>
                <img data-v-4b135571="" src="<?php echo $value; ?>" class="bigPic">
                <?php endforeach; ?>
              </div>
              <div data-v-4b135571="" class="between">
                <?php foreach($data['image'] as $key => $value): ?>
                <label data-v-4b135571="" class="border">
                  <img data-v-4b135571="" src="<?php echo $value; ?>">
                  <span data-v-4b135571="" class="border"></span>
                </label>
                <?php endforeach; ?>
              </div>
            </div>
            <div data-v-4b135571="" class="itemDesc"><h2 data-v-4b135571=""></h2>
              <p data-v-4b135571="" class="price"><?php echo $data['min_money']; ?>~<?php echo $data['max_money']; ?>万元</p>
              <p data-v-4b135571="" class="suit"><span data-v-4b135571="">所属行业：<?php echo $data['cate_name']; ?></span>
                <span data-v-4b135571="">适合人群：<?php echo $data['crowd']; ?></span>
              </p>
              <div data-v-4b135571="" class="numBox around">
                <label data-v-4b135571="" class="block">
                  <b data-v-4b135571=""><?php echo $data['shop_count']; ?>家</b> <i data-v-4b135571="">直营店</i>
                </label>
                <span data-v-4b135571="" class="line"></span>
                <label data-v-4b135571="" class="block">
                  <b data-v-4b135571=""><?php echo $data['fran_store_num']; ?>家</b> <i data-v-4b135571="">加盟店</i>
                </label>
                <span data-v-4b135571="" class="line"></span>
                <label data-v-4b135571="" class="block">
                  <b data-v-4b135571=""><?php echo $data['item_area']; ?></b> <i data-v-4b135571="">加盟区域</i>
                </label>
                <span data-v-4b135571="" class="line"></span>
                <label data-v-4b135571="" class="block"><b data-v-4b135571=""><?php echo $data['apply']; ?>人</b> <i data-v-4b135571="">申请加盟</i></label>
              </div>
              <div data-v-4b135571="" class="btnsBox between">
                <span data-v-4b135571="" class="consultBtn" onclick="showConsultModal(1)">立即咨询</span>
                <span data-v-4b135571="" class="planBtn" onclick="showConsultModal(2)">获取开店方案</span>
                <span data-v-4b135571="" id="followlike" class="collectBtn <?php if($data['is_like'] == 1): ?> on <?php endif; ?>"><i data-v-4b135571="" class="iconfont icon-collect"></i></span><!--关注-->
                <input type="hidden" id="is_like"value="<?php echo $data['is_like']; ?>">
                <span data-v-4b135571="" id="followfoll" class="focusBtn <?php if($data['is_foll'] == 1): ?> on <?php endif; ?>"><i data-v-4b135571="" class="iconfont icon-focus"></i></span><!--收藏-->
                <input type="hidden" id="is_foll"value="<?php echo $data['is_foll']; ?>">
              </div>
                <p data-v-4b135571="" class="yellowWord">
                  <span data-v-4b135571="">项目关注 <b data-v-4b135571=""><?php echo $data['followcount']; ?></b></span>
                  <span data-v-4b135571="">项目收藏 <b data-v-4b135571=""><?php echo $data['collectcount']; ?></b></span>
                  <span data-v-4b135571="">项目咨询 <b data-v-4b135571=""></b><?php echo $data['count']; ?></span>
                </p>
            </div>
          </div>
          <div data-v-4b135571="" class="introBox">
            <h3 data-v-4b135571="">项目详情</h3>
            <div data-v-4b135571="" class="content">
              <?php echo $data['detail']; ?>
            </div>
          </div>
          <div data-v-4b135571="" class="consultBox">
            <div data-v-4b135571="" class="title between"><h3 data-v-4b135571="">用户咨询</h3>
              <span data-v-4b135571=""><?php echo $data['apply']; ?>人申请加盟</span>
            </div>
            <?php foreach($consult as $key => $value): ?>
            <dl class="consultDL between" v-for="(item,i) in consult.data">
              <dt><img src="<?php echo $value['avatar']; ?>"></dt>
              <dd>
                <p class="inf between">
                  <span><?php echo $value['username']; ?></span>
                  <span><?php echo $value['addtime']; ?></span>
                </p>
                <p class="word"><?php echo $value['content']; ?></p>
              </dd>
            </dl>
            <?php endforeach; ?>
<!--            <span class="lookBtn" v-if="consult.count>4">查看更多 <i class="el-icon-caret-bottom"></i></span>-->
            <div class="layui-card-body ">
              <div class="page">
                <div>
                  <?php echo $page; ?>
                </div>
              </div>
            </div>
          </div>
          <div data-v-4b135571="" class="onceBox">
            <div data-v-4b135571="" class="title"><h3 data-v-4b135571="">立即咨询</h3></div>
            <div data-v-4b135571="" class="conContent clearfix between">
              <div data-v-4b135571="" class="row clearfix clearfix">
                <div data-v-4b135571="" class="column between">
                  <label data-v-4b135571="">姓名</label> 
                  <input data-v-4b135571="" type="text" name="name" id="cname" placeholder="请输入您的姓名" class="nameInp">
                  <div data-v-4b135571="" class="fr" style="line-height:40px;margin-left:7px;">
                    <label class="el-radio sexLabel">
                      <input type="radio" name="csex" checked="">
                      <span class="el-radio__label">男</span>
                    </label>
                    <label class="el-radio sexLabel">
                      <input type="radio" name="csex">
                      <span class="el-radio__label">女</span>
                    </label>
                  </div>
                </div>
                <div data-v-4b135571="" class="column between"><label data-v-4b135571="" class="leave">留言</label>
                  <textarea data-v-4b135571="" id="consult" placeholder="请输入留言内容"></textarea></div>
              </div>
              <div data-v-4b135571="" class="row clearfix clearfix">
                <div data-v-4b135571="" class="column between"><label data-v-4b135571="">手机号</label>
                  <input data-v-4b135571="" type="text" id="phone" placeholder="请输入您的手机号" class="textInp phone"></div>
                <div data-v-4b135571="" class="column between"><label data-v-4b135571="">图片验证</label>
                  <input data-v-4b135571="" id="icode" type="text" placeholder="请输入图片验证验证码" class="checkInp">
                  <img src="<?php echo captcha_src(); ?>" class="captcha" width="95" height="45" onclick="this.src='<?php echo captcha_src(); ?>'">
                </div>
                <div data-v-4b135571="" class="column between">
                  <label data-v-4b135571="">验证码</label>
                  <div data-v-4b135571="" class="between" style="width: 322px;">
                    <input data-v-4b135571="" id="pcode" type="text" placeholder="请输入手机验证码" class="checkInp">
                    <span data-v-4b135571="" class="checkBtn" onclick="getCode(this)">获取验证码</span></div>
                </div>
              </div>
            </div>
            <div data-v-4b135571="" class="commitBtn" onclick="submitConsultData()">提交</div>
          </div>
        </div>
        <div data-v-4b135571="" class="detailRight">
          <div data-v-4b135571="" class="companyInf">
            <div data-v-4b135571="" class="title between"><h3 data-v-4b135571="">公司信息</h3></div>
            <dl data-v-4b135571="">
              <dt data-v-4b135571="">
                <img data-v-4b135571="" src="<?php echo $user['logo']; ?>">
                <p data-v-4b135571=""></p></dt>
              <dd data-v-4b135571=""><p data-v-4b135571="">公司性质：<?php echo $user['character']; ?></p>
                <p data-v-4b135571="">注册资金：<?php echo $user['money']; ?>万元</p>
                <p data-v-4b135571="">经营范围：<?php echo $user['scope']; ?></p>
                <p data-v-4b135571="">品牌注册时间：<?php echo $user['brand_make_time']; ?></p>
                <p data-v-4b135571="">注册地址：<?php echo $user['address']; ?></p></dd>
            </dl>
          </div>
          <div data-v-673d4749="" data-v-4b135571="" class="hotOrder hotOrder">
            <div data-v-673d4749="" class="title clearfix"><span data-v-673d4749="" class="fl">加盟项目排行榜</span>
              <a data-v-673d4749="" href="<?php echo url('index/item/index'); ?>" class="fr more"> 更多
                <span data-v-673d4749="" class="el-icon-arrow-right"></span>
              </a>
            </div>
            <div data-v-673d4749="" class="list">
              <?php foreach($ranking as $key => $value): ?>
              <a data-v-673d4749="" href="<?php echo url('index/item/detail'); ?>?id=<?php echo $value['id']; ?>" class="item clearfix">
                <div data-v-673d4749="" class="order fl"><?php echo $key+1; ?></div>
                <div data-v-673d4749="" class="name fl"><?php echo $value['brand']; ?></div>
                <div data-v-673d4749="" class="count fr"><?php echo $value['read_num']; ?></div>
              </a>
              <?php endforeach; ?>
            </div>
          </div>
          <div data-v-2e73e232="" data-v-4b135571="" class="industryList IndustryList">
            <div data-v-2e73e232="" class="title clearfix">
              <span data-v-2e73e232="" class="fl">行业资讯</span>
              <a data-v-2e73e232="" href="<?php echo url('index/article/index'); ?>?type=1" class="fr more"> 更多
                <span data-v-2e73e232="" class="el-icon-arrow-right"></span></a>
            </div>
            <div data-v-2e73e232="" class="special">
              <a data-v-2e73e232="" href="<?php echo url('index/article/detail'); ?>?id=<?php echo $artData['rArticle']['id']; ?>" class="">
                <img data-v-2e73e232="" src="<?php echo $artData['rArticle']['img']; ?>" alt="">
                <div data-v-2e73e232="">{<?php echo $artData['rArticle']['title']; ?>}</div>
              </a>
            </div>
            <ul data-v-2e73e232="">
              <?php foreach($artData['list'] as $key => $value): ?>
              <li data-v-2e73e232="">
                <a data-v-2e73e232="" href="<?php echo url('index/article/detail'); ?>?id=100" class=""><?php echo $value['title']; ?></a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- 立即咨询 -->
<div class="consultBg" id="consultModal" style="display: none">
<!--    <form action="<?php echo url('index/Consult/addConsultData'); ?>" method="post" id="addconsult" accept-charset="utf-8">-->
      <input type="hidden" id="tid" value="<?php echo $data['id']; ?>">
      <div class="consultCase">
        <h2>立即咨询</h2>
        <span class="close" onclick="hideConsultModal()"></span>

        <div class="row clearfix">
          <label class="fl name"><i>*</i> 姓名</label>
          <input class="fl commonInp" type="text" name="name" id="name" placeholder="请输入您的姓名">
        </div>
        <div class="row clearfix">
          <label class="fl name"><i>*</i> 性别</label>
          <div class="fl" style="line-height:40px;">
            <label class="el-radio sexLabel">
              <input type="radio" name="sex" value="1" checked="">
              <span class="el-radio__label">男</span>
            </label>
            <label class="el-radio sexLabel">
              <input type="radio" name="sex">
              <span class="el-radio__label" value="0">女</span>
            </label>
          </div>
        </div>
        <div class="row clearfix">
          <label class="fl name"><i>*</i> 手机号</label>
          <input class="fl commonInp phone" id="mobile" type="text" name="mobile" placeholder="请输入您的手机号">
        </div>
        <div class="row clearfix">
          <label class="fl name"><i>*</i> 图片验证</label>
          <input class="fl commonInp picInp" type="text" id="imgCode" name="imgCode" placeholder="请输入图片验证码">
          　<img src="<?php echo captcha_src(); ?>" width="95" height="45" onclick="this.src='<?php echo captcha_src(); ?>'">
        </div>
        <div class="row clearfix">
          <label class="fl name"><i>*</i> 验证码</label>
          <input class="fl commonInp picInp" type="text" id="code" name="code" placeholder="请输入手机验证码">
          <span class="checkBtn" onclick="getMobileCode(this)">获取验证码</span>
        </div>
        <div class="row">
          <textarea class="textArea" name="content" id="content" placeholder="请输入您要咨询的内容"></textarea>
        </div>
        <div class="commitBtn" onclick="submitForm()">
<!--          <button class="commitBtn" onclick="submitForm()" type="button">-->
          提交
<!--          </button>-->
        </div>
  </div>
<!--  </form>-->
</div>


<script type="text/javascript">
  function showConsultModal(){
    $("#consultModal").css({display: 'block'});
  }
  function hideConsultModal(){
    $("#consultModal").css({display: 'none'});
      $("#consultModal input").val("");
  }
  function submitForm(){
    var name = $("#name ").val();
    var mobile = $("#mobile ").val();
    var code = $("#code ").val();
    var content = $("#content ").val();
    var item_id = $("#tid").val();

    // if(name && mobile && code && content ){
    //   $("#addconsult").submit();
    // }else{
    //   console.log('请输入');
    //   layer.msg('请输入');
    // }
    $("#formData").serializeArray();
    console.log('  $("#formData").serializeArray()',  $("#formData").serializeArray());
    // 所有的数据 自行提交吧
    var forData = $("#formData").serializeArray();
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/consult/add_consult'); ?>",
      data:{
        name:name,
        phone:mobile,
        code:code,
        content:content,
        item_id:item_id,
      },
      success: function(data){
        console.log('data',data);
        if(data.code != 200){
          layer.msg(data.msg);
          console.log('msg',data.msg);
        }else{
          layer.msg(data.msg);
          console.log('msg',data.msg);
          hideConsultModal()

        }
      }
    });

  }
  //banner
  $('.itemPic .between>label:first').addClass('active');
  $(".itemPic .between>label").click(function(){
    $(this).addClass("active").siblings().removeClass("active");
    $(".photoBox").children(":eq("+$(this).index()+")").show().siblings().hide();
  });
  //收藏
  $('.collectBtn').click(function(){
    //获取收藏状态
    var tid = $("#tid").val();
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/follow/modify_foolow'); ?>",
      data:{
        tid:tid,
        type:2,
      },
      success: function(data){
        console.log('data',data);
        if(data.code == 301){
          layer.msg('未登录.请先登录');
          window.location.href = "<?php echo url('index/login/login'); ?>";
        }
        if(data.code == 400){
          layer.msg('内部错误');
        }
        if(data.code == 200){
          if($("#followlike").is('.on')){
            //取消收藏
            $("#followlike").removeClass('on');
            layer.msg('取消收藏成功');
          }else{
            //收藏
            $("#followlike").addClass('on');
            layer.msg('收藏成功');
          }

        }
      }
    });
  })
  //关注
  $('.focusBtn').click(function(){
    var tid = $("#tid").val();
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/follow/modify_foolow'); ?>",
      data:{
        tid:tid,
        type:2,
      },
      success: function(data){
        console.log('data',data);
        if(data.code == 301){
          layer.msg('未登录.请先登录');
          window.location.href = "<?php echo url('index/login/login'); ?>";
        }
        if(data.code == 400){
          layer.msg('内部错误');
        }
        if(data.code == 200){
          console.log('code',data.code);

          if($("#followfoll").is('.on')){
            //取消收藏
            $("#followfoll").removeClass('on');
            layer.msg('取消关注');
          }else{
            //收藏
            $("#followfoll").addClass('on');
            layer.msg('关注成功成功');
          }
        }
      }
    });
  })
  //验证手机格式
  function validatePhone (phone) {
    console.log('validatePhone',phone);
    console.log('validatePhon=======e',phone);
    // layer.msg('请输入手机号码',{icon:2});
    if (!phone) {
      layer.msg('请输入手机号码',{icon:2});
      console.log('请输入手机号');
      return false;
    }
    if (phone.length != 11) {
      console.log('手机号格式不正确');
      layer.msg('手机号码格式不正确',{icon:2});
      return false;
    }
    return true;
  }
  //验证图片验证码
  function validateImgCode(imgCode){
      console.log('imgcode',imgCode);
      if(!imgCode){
        layer.msg('请输入图片验证码',{icon:2});
        console.log('请输入图片验证码');
        return false;
      }
      return true
  }

  //获取验证码
  let intervalID = '';
  function getCode (e){
    //验证手机号
    console.log('页脚立即咨询');
    var phone = $("#phone").val();
    console.log('phone',phone);
    var resPhone = validatePhone(phone);
    if(!resPhone){
      return
    }
    //验证图片验证码
    var imgCode = $("#icode").val();
    console.log('imgCode',imgCode);
    var resImg = validateImgCode(imgCode);
    if(!resImg){
      return
    }
    //请求短信接口
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/login/get_code'); ?>",
      data:{
        phone:phone,
        icode:imgCode,
      },
      success: function(data){
        console.log('data',data);
        if(data.code != 200){
          console.log('msg',data.msg);
          layer.msg(data.msg,{icon:2});
          return ;
        }
        if(data.code == 200){
          console.log('msg','验证码发送成功');
          layer.msg('验证码发送成功',{icon:1});
          let outTime = 60;
          console.log($(e));
          intervalID = setInterval(function(){
            if(outTime == 0){
              outTime = 60;
              clearInterval(intervalID)
              $(e).html('获取验证码');
              return
            }
            outTime--;
            $(e).html(outTime+'S后可重新获取');
          },1000);
        }
      }
    })
  }

  function getMobileCode(e) {
    //验证手机号
    console.log('立即咨询');
    var phone = $("#mobile").val();
    console.log('phone',phone);
    var resPhone = validatePhone(phone);
    if(!resPhone){
      return
    }
    //验证图片验证码
    var imgCode = $("#imgCode").val();
    console.log('imgCode',imgCode);
    var resImg = validateImgCode(imgCode);
    if(!resImg){
      return
    }
    //请 求短信接口
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/login/get_code'); ?>",
      data:{
        phone:phone,
        icode:imgCode,
      },
      success: function(data){
        console.log('data',data);
        if(data.code != 200){
          console.log('msg',data.msg);
          layer.msg(data.msg,{icon:2});
          return ;

        }
        if(data.code == 200){
          console.log('msg','验证码发送成功');
          layer.msg('验证码发送成功',{icon:1});
          let outTime = 60;
          console.log($(e));
          intervalID = setInterval(function(){
            if(outTime == 0){
              outTime = 60;
              clearInterval(intervalID)
              $(e).html('获取验证码');
              return
            }
            outTime--;
            $(e).html(outTime+'S后可重新获取');
          },1000);
        }
      }
    })
  }

  function submitConsultData(){
    // csex
    var sex = $('input:radio[name="csex"]:checked').val();
    var tid = $("#tid").val();
    var cname = $("#cname").val();
    var consult = $("#consult").val();
    var pcode = $("#pcode").val();
    var phone = $("#phone").val();
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/consult/add_consult'); ?>",
      data:{
        name:cname,
        phone:phone,
        code:pcode,
        content:consult,
        item_id:tid,
        sex:sex,
      },
      success: function(data){
        console.log('data',data);
        if(data.code != 200){
          layer.msg(data.msg);
          console.log('msg',data.msg);
        }else{
          layer.msg(data.msg);
          console.log('msg',data.msg);
        }
      }
    });
  }
</script>

  
  <div data-v-4dfbcb4e="" class="common-footer">
    <div data-v-4dfbcb4e="" class="links ">
      <div data-v-4dfbcb4e="" class="wrapper">
        <div data-v-4dfbcb4e="" class="left">
          <a data-v-4dfbcb4e="" href="<?php echo url('index/aboutus/aboutus'); ?>" class="">关于我们</a> <a
                data-v-4dfbcb4e="" href="<?php echo url('index/aboutus/aboutus'); ?>" class="">产品服务</a>
          <a data-v-4dfbcb4e="" href="<?php echo url('index/aboutus/aboutus'); ?>" class="">产品优势</a>
          <a data-v-4dfbcb4e="" href="<?php echo url('index/aboutus/aboutus'); ?>" class="">客户合作</a>
          <a data-v-4dfbcb4e="" href="<?php echo url('index/aboutus/aboutus'); ?>"
             class="">联系我们</a>
        </div>
        <div data-v-4dfbcb4e="" class="right">
          客服热线：400-619-8882
        </div>
      </div>
    </div>
    <div data-v-4dfbcb4e="" class="body wrapper">
      <div data-v-4dfbcb4e="" class="left">
        <div data-v-4dfbcb4e="">友情提示：创业有风险，投资需谨慎
        </div>
        <div data-v-4dfbcb4e="">Copyright © 2019 jinrongbaijia.com All Rights Reserved.冀ICP备17023127号-7
        </div>
        <div data-v-4dfbcb4e="">法律支持：河北盈华律师事务所
        </div>
        <a data-v-4dfbcb4e="" href="http://www.bcpcn.com/product/rz/bq/BCP30497889F2859242.html" target="_blank"><img
                data-v-4dfbcb4e="" src="http://www.bcpcn.com/bcptags/img/csrz.gif" border="0" class="csrz"></a>
      </div>
      <div data-v-4dfbcb4e="" class="right">
        <div data-v-4dfbcb4e="" class="item">
          <img data-v-4dfbcb4e="" src="http://www.test.com\/statics/index/img/wx_qrcode.d7de962.jpg" alt="" class="QRcode">
          <div data-v-4dfbcb4e="">微信公众号</div>
        </div>
        <div data-v-4dfbcb4e="" class="item">
          <img data-v-4dfbcb4e="" src="http://www.test.com\/statics/index/img/wap_qrcode.475f601.jpg" alt="" class="QRcode">
          <div data-v-4dfbcb4e="">手机版
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

</body>
</html>