<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\PHPTutorial\WWW\jmzn\jmzn\public/../application/index\view\login\settled.html";i:1566541662;s:66:"D:\PHPTutorial\WWW\jmzn\jmzn\application\index\view\defa\defa.html";i:1566522668;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo $title; ?></title>
  <meta name="keywords" content="
   
   ">
  <meta name="description" content="
    
    ">
  <script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/admin/lib/layui/layui.js"></script>
  <meta name="360-site-verification" content="8fa3cbfa5b4b4bdf0a95dd925cf2f8b5" />
  <script type="text/javascript" src="http://www.test.com\/statics/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="http://www.test.com\/statics/layer-v3.1.1/layer/layer.js" merge="true"> </script>
  <link rel="stylesheet" href="http://www.test.com\/statics/layer-v3.1.1/layer/theme/default/layer.css"/>

  
<link href="http://www.test.com\/statics/index/css/app.6e8fecf9baa6cf278e54a8181d44c5e4.css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/index/js/0.f5ed0d9d7e597a228142.js"></script>
<script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/index/js/17.2ca34d5d16f167d8013d.js"></script>
<link href="http://www.test.com\/statics/admin/css/xadmin.css" rel="stylesheet">
<style>
  .clearfix:after {
    display: block;
    clear: both;
    content: "";
    visibility: hidden;
    height: 0;
  }
  .clearfix {
    zoom: 1
  }
  .greyBg {
    width: 100%;
    padding: 20px 0 80px;
    background: #F4F5FA;
  }
  .enterBox {
    width: 1200px;
    height: 640px;
    margin: 0 auto;
    background: #fff;
  }
  .enterBox .title {
    height: 60px;
    border-bottom: 1px solid #E3E4E5;
    margin-bottom: 40px;
  }
  .enterBox .title h2 {
    width: 66px;
    height: 58px;
    line-height: 58px;
    border-bottom: 2px solid #4F74F4;
    font-size: 16px;
    color: #333;
    text-align: center;
    margin-left: 33px;
  }
  .enterBox .row{
    margin-bottom: 22px;
    position: relative;
  }
  .enterBox .row label{
    float: left;
    text-align: right;
    width: 80px;
    height: 40px;
    line-height: 40px;
    font-size: 14px;
    color: #606266;
    line-height: 40px;
    padding: 0 12px 0 0;
  }
  .enterBox .row .commonInp{
    float: left;
    width: 290px;
    height: 40px;
    line-height: 40px;
    outline: 0;
    padding: 0 15px;
    border-radius: 4px;
    border: 1px solid #dcdfe6;
  }
  .enterBox .enterContent {
    width: 430px;
    padding-left: 40px;
  }
  .enterBox .picYz {
    width: 105px;
    height: 40px;
    position: absolute;
    left: 308px;
    top: 1px;
    z-index: 10;
    cursor: pointer;
  }
  .enterBox .messageBtn {
    width: 125px;
    height: 22px;
    line-height: 22px;
    border-left: 1px solid #E3E4E5;
    text-align: center;
    position: absolute;
    right: 17px;
    top: 8px;
    color: #5389F7;
    cursor: pointer;
  }
  .enterBox .submitBtn {
    margin: 20px 0 0 81px;
    width: 98px;
    height: 40px;
    line-height: 40px;
    background-color: #409eff;
    color: #fff;
    border-radius: 4px;
  }
</style>

</head>
<body>
<div id="app">
  
    
<a>
  <div class="personal">
    <PersonalHeader></PersonalHeader>
    <div class="greyBg">
      <div class="enterBox">
        <div class="title">
          <h2>企业入驻</h2>
        </div>
        <div class="enterContent">
            <div class="row clearfix">
              <label>品牌名</label>
              <input class="commonInp brand" type="text" placeholder="请输入品牌名" >
            </div>
            <div class="row clearfix">
              <label>公司名</label>
              <input class="commonInp company" type="text" placeholder="请输入公司名" >
            </div>
            <div class="row clearfix">
              <label>姓名</label>
              <input class="commonInp name" type="text" placeholder="请输入您的姓名" >
            </div>
            <div class="row clearfix">
              <label>注册地址</label>
              <input class="commonInp adress" type="text" placeholder="请输入公司注册地址" >
            </div>
            <div class="row clearfix">
              <label>手机号</label>
              <input class="commonInp" id="phone" type="text" placeholder="请输入手机号码" >
            </div>
            <div class="row clearfix">
              <label>图片验证</label>
              <input class="commonInp" type="text" id="icode" name="icode" placeholder="请输入图片验证码" >
              <img class="picYz" src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>'">
            </div>
            <div class="row clearfix">
              <label>验证码</label>
              <input class="commonInp" name="pcode" id="pcode" type="text" placeholder="请输入手机验证码" >
              <span class="messageBtn" id="time" onclick="getCode()">获取验证码</span>
            </div>
            <button class="submitBtn" onclick="apply()">提交申请</button>
        </div>
      </div>
    </div>
  </div>
</a>
<script>
    /**验证手机格式**/
    function validatePhone () {
        const phone = $('#phone').val();
        console.log('phone',phone);
        if (!phone) {
            layer.msg('请输入手机号码',{icon:2});
            return false;
        }
        if (phone.length != 11) {
            layer.msg('手机号码格式不正确',{icon:2});
            return false;
        }
        return true;
    };
    /**验证图片验证码**/
    function validateImgCode () {
        const icode = $('#icode').val();
        console.log('imgCode',icode);
        if (!icode) {
            layer.msg('请输入图片验证码',{icon:2});
            return false;
        }
        return true;
    };
    /**获取验证码**/
    let intervalID = '';
    function getCode (){
        //验证手机号
        if(!validatePhone()){
            return
        }
        //验证图片验证码
        if(!validateImgCode()){
            return
        }
        //手机号&&图片验证码
        var phone = $("#phone").val();
        var icode = $('#icode').val();
        let outTime = 60;
        if(intervalID){
            return;
        }
        //ajax获取短信验证码
        $.ajax({
            type: "POST",
            url: "<?php echo url('index/login/get_code'); ?>",
            data:{
                phone:phone,
                icode:icode,
            },
            success: function(data){
                console.log('data',data);
                if(data.code != 200){
                    console.log('msg',data.msg);
                    layer.msg(data.msg,{icon:1});
                    return ;
                }
                if(data.code == 200){
                    console.log('msg','验证码发送成功');
                    layer.msg('验证码发送成功',{icon:1});

                    //定时器
                    intervalID = setInterval(function(){
                        if(outTime == 0){
                            outTime = 60;
                            clearInterval(intervalID)
                            $(e).html('获取验证码');
                            return
                        }
                        outTime--;
                        $("#time").html(outTime+'S后可重新获取');
                    },1000)
                }
            }
        })
    }
    /**提交申请**/
    function apply(){
        var brand = $('.brand').val();
        var company = $('.company').val();
        var name = $('.name').val();
        var adress = $('.adress').val();
        var brand = $('.brand').val();
        var phone = $('#phone').val();
        var icode = $('#icode').val();
        var pcode = $("#pcode").val();
        if(!brand){
            layer.msg('请输入品牌名');
            return false;
        }
        if(!company){
            layer.msg('请输入公司名');
            return false;
        }
        if(!name){
            layer.msg('请输入您的姓名');
            return false;
        }
        if(!name){
            layer.msg('请输入公司注册地址');
            return false;
        }
        if(!validatePhone()){
            return false;
        }
        if(!icode){
            layer.msg('请输入图片验证码');
            return false;
        }
        if(!pcode){
            layer.msg('请输入手机验证码');
            return false;
        }

        //ajax请求
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