<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"D:\PHPTutorial\WWW\jmzn\jmzn\public/../application/index\view\login\login.html";i:1566477832;s:66:"D:\PHPTutorial\WWW\jmzn\jmzn\application\index\view\defa\defa.html";i:1566477832;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>登录</title>
  <meta name="keywords" content="
   {123}
   ">
  <meta name="description" content="
    {456}
    ">
  <script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/admin/lib/layui/layui.js"></script>
  <meta name="360-site-verification" content="8fa3cbfa5b4b4bdf0a95dd925cf2f8b5" />
  <script type="text/javascript" src="http://www.test.com\/statics/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="http://www.test.com\/statics/layer-v3.1.1/layer/layer.js" merge="true"> </script>
  <link rel="stylesheet" href="http://www.test.com\/statics/layer-v3.1.1/layer/theme/default/layer.css"/>

  
<link href="http://www.test.com\/statics/index/css/app.6e8fecf9baa6cf278e54a8181d44c5e4.css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/index/js/0.f5ed0d9d7e597a228142.js"></script>
<script type="text/javascript" charset="utf-8" async="" src="http://www.test.com\/statics/index/js/17.2ca34d5d16f167d8013d.js"></script>
<style>
  .modal{
    height: 500px;
    text-align: center;
    padding: 20px;
    color: #666;
    font-size: 16px;
    line-height: 28px;
  }
  .modal div{
    text-align: left;
  }
.confirmBtn{
  width: 200px;
  height: 40px;
  line-height: 40px;
  text-align: center;
  border-radius: 5px;
  background-color: #579EFA;
  color: #fff;
  font-size: 24px;
}
  .remarks{
    cursor: pointer;

  }
  b{
    font-weight: normal;
    color: #5389F7;
  }
</style>

</head>
<body>
<div id="app">
  
<div id="app">
  <div data-v-5eef6683="" class="common-header">
    <div data-v-5eef6683="" class="body wrapper">
      <div data-v-5eef6683="" class="left">
        欢迎来到加盟指南网！ 全国服务热线：400-619-8882
      </div>
      <div data-v-5eef6683="" class="right">
        <div data-v-5eef6683="" class="phoneVersion"><span data-v-5eef6683="" class="iconfont icon-phone"></span> <span
          data-v-5eef6683="">手机版</span>
          <img data-v-5eef6683="" src="http://www.test.com\/statics/index/img/wap_qrcode.475f601.jpg" alt="手机二维码" class="QRcode"></div>
        <div data-v-5eef6683="" class="weChatVersion">
          <span data-v-5eef6683="" class="iconfont icon-weChat"></span>
          <span data-v-5eef6683="">微信版</span>
          <img data-v-5eef6683="" src="http://www.test.com\/statics/index/img/wx_qrcode.d7de962.jpg" alt="微信二维码" class="QRcode">
        </div>
        <div data-v-5eef6683="">
          <a data-v-5eef6683="" href="<?php echo url('index/login/login'); ?>" class="router-link-exact-active router-link-active">登陆</a>
        </div>
      </div>
    </div>
  </div>
  <div data-v-f46e99e4="" class="personal">
    <div data-v-13f8abc6="" data-v-f46e99e4="" class="personalHeader">
      <div data-v-13f8abc6="" class="wrapper content"><a data-v-13f8abc6="" href="/" class="router-link-active"><img
        data-v-13f8abc6="" src="http://www.test.com\/statics/index/img/logo.45da167.png" alt="" class="logo"></a>
        <div data-v-13f8abc6="" class="tabs"><a data-v-13f8abc6="" href="/" class="router-link-active">首页</a> <a
          data-v-13f8abc6="" href="<?php echo url('index/index/rankinglist'); ?>" class="">找项目</a> <a data-v-13f8abc6="" href="/rankingList" class="">排行榜</a> <a
          data-v-13f8abc6="" href=“<?php echo url('index/article/index'); ?>” class="">行业资讯</a></div>
      </div>
    </div>
    
    
    <form action="<?php echo url('index/login/login'); ?>" method="post" id="postform">

    <div data-v-f46e99e4="" class="loginBg">
      <div data-v-f46e99e4="" class="loginBox"><h2 data-v-f46e99e4="">用户登录</h2>
        <div data-v-f46e99e4="" class="row"><i data-v-f46e99e4="" class="iconfont icon-phone"></i>
          <input data-v-f46e99e4="" name="phone" id="phone" type="text" placeholder="手机号码">
        </div>
        <div data-v-f46e99e4="" class="row"><i data-v-f46e99e4="" class="iconfont icon-yanzheng"></i>
          <input data-v-f46e99e4="" type="text" id="icode" name="icode" placeholder="请输入图片验证码">
          　<img src="<?php echo captcha_src(); ?>" width="95" height="45" onclick="this.src='<?php echo captcha_src(); ?>'">
        </div>
        <div data-v-f46e99e4="" class="row"><i data-v-f46e99e4="" class="iconfont icon-message"></i>
          <input data-v-f46e99e4="" name="pcode" id="pcode" type="text" placeholder="请输入短信验证码">
          <span data-v-f46e99e4="" id="time" onclick="getCode()" class="messageYz">获取验证码</span>
        </div>
          <div data-v-f46e99e4="" class="loginBtn" onclick="login()">登 录</div>
        <label role="checkbox">

          <div data-v-f46e99e4="" class="remarks">


            <div class="layui-input-block">
              <input type="checkbox" id="isOK" checked lay-skin="switch">
            </div>
            <span data-v-f46e99e4="">同意加盟指南<b id="showModal" >《服务协议》</b></span>
          </div>
        </label>

      </div>
    <div data-v-f46e99e4="" class="el-dialog__wrapper" style="display: none;">
      <div role="dialog" aria-modal="true" aria-label="服务协议" class="el-dialog el-dialog--center"
           style="margin-top: 15vh; width: 60%;">
        <div class="el-dialog__header"><span class="el-dialog__title">服务协议</span>
          <button type="button" aria-label="Close" class="el-dialog__headerbtn"><i
            class="el-dialog__close el-icon el-icon-close"></i></button>
        </div><!----><!---->
      </div>
    </div>
  </div>
    </form>
</div>
</div>
<script  type="text/javascript">

  /**
   * 登陆
   */
  function login(){
    var phone = $('#phone').val();
    //验证input不能为null
    if(!validatePhone()){
      return false;
    }
    //验证短信验证码是否有填写
    var pcode = $("#pcode").val();
    if(!pcode){
      console.log('phoneCode','请输入短信验证码');
      layer.msg('请输入短信验证码');
      return false;
    }
    //协议阅读
    const isOK = $("#isOK")[0].checked;
    console.log("isOK",isOK);
    if(!isOK){
      layer.msg('请先阅读并同意服务协议',{icon:2});
      return;
    }
    //提交表单
    // $("#postform").submit();
    //ajax 提交表单
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/login/login'); ?>",
      data:{
        phone:phone,
        code:pcode,
      },
      success: function(data){
        console.log('data',data);
        if(data.code != 200){
          console.log('msg',data.msg);
        }else{
          window.location.href = "/";
        }
      }
    })

  }
  /**
   * 验证手机格式
   * @param {Object} phone
   */
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
  }

  /**
   *  验证图片验证码
   *  @param {object} icode
   * **/
  function validateImgCode () {
    const icode = $('#icode').val();
    console.log('imgCode',icode);
    if (!icode) {
      layer.msg('请输入图片验证码',{icon:2});
      return false;
    }
    return true;
  }

  /**
   * 获取验证码
   */
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
          let outTime = 60;
          if(intervalID){

            return;
          }
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

  $("#showModal").click(function (event) {
    console.log(event)
    layer.open({
      title: ['服务协议','text-align:center'],
      type: 1,
      // skin: 'layui-layer-rim', //加上边框
      area: ['800px', '500px'], //宽高
      btn: ['确定'],
      btnAlign: 'c',
      content:'      <div class="modal">\n' +
              '        <div>欢迎阅读加盟指南（河北当当科技有限公司）服务条款协议(下称"本协议")，您应当在使用服务之前认真阅读本协议全部内容，且对本协议中加粗字体显示的内容，加盟指南督促您应重点阅读。本协议阐述之条款和条件适用于您使用加盟指南（www.jiamengzhinan.com）所提供的 信息发布、交流的各种工具、平台和服务(下称"服务")。</div>\n' +
              '        <div>1. 接受条款。</div>\n' +
              '        <div>以任何方式进入并使用加盟指南服务即表示您已充分阅读、理解并同意自己已经与加盟指南订立 本协议，且您将受本协议的条款和条件("条款")约束。加盟指南可随时自行全权决定更改"条款"。如"条款"有任何变更，加盟指南仅将在网站上发布新条款予以公示，不再单独通知予您。如您不同意相关变更，则必须停止使用"服务"。经修订的"条款"一经在加盟指南网站公布后，立即自动生效。一旦您继续使用"服务"，则表示您已接受经修订的"条款"，当您与加盟指南发生争议时，应以最新的"条款"为准。除另行明确声明外，任何使"服务"范围扩大或功能增强的新内容均受本协议约束。本协议内容包括协议\t正文及所有加盟指南已经发布或将来可能发布的各类规则。所有规则为本协议不可分割的一部分，与本协议正文具有同等法律效力。</div>\n' +
              '        <div>2. 服务使用对象。</div>\n' +
              '        <div>"服务"仅供能够根据相关法律订立具有法律约束力的合约的自然人、法人或其他组织使用。因此，您的年龄必须在十八周岁或以上，才可使用加盟指南服务。如不符合本项条件，请勿使用"服务"。加盟指南可随时自行全权决定拒绝向任何服务对象提供"服 务"。"服务"不会提供给被暂时或永久中止资格的加盟指南会员。</div>\n' +
              '        <div>3. 收费。</div>\n' +
              '        <div>加盟指南保留在根据第1条通知您后，收取"服务"费用的权利。您因进行交易、向加盟指南获 取有偿服务或接触加盟指南服务器而发生的所有应纳税赋，以及相关硬件、软件、通讯、网络服务及其他方面的费用均由您自行承担。加盟指南保留在无须发出书面通知，仅在加盟指南网站公示的情况下，暂时或永久地更改或停止部分或全部"服务"的权利。</div>\n' +
              '        <div>4. 加盟指南网站仅作为信息发布地点。</div>\n' +
              '        <div>您完全了解加盟指南网站上的信息系用户自行发布，且可能存在风险和瑕疵。加盟指南网站仅作 为用户展示品牌形象，以及获取各类与创业相关的服务的地点。但是，加盟指南不能控制服务所涉及的项目的风险、安全或合法性，信息的真实性或准确性，以及达成服务交易双方履行其在协议项下的各项义务的能力。加盟指南不能也不会控制产生协议关系的各方能否履行协议义务。此外，您应注意到，与外国国民、未成年人或以欺诈手段行事的人进行交易的风险是客观存在的。您应自行谨慎判断确定相关信息的真实性、合法性和有效性，并自行承担因此产生的责任与损失。</div>\n' +
              '        <div>5. 您的资料和您的服务项目。</div>\n' +
              '        <div>"您的资料"包括您在注册、交易或列举服务项目过程中、在任何公开信息场合或通过任何电子邮件形式，向加盟指南或其他用户提供的任何资料，包括数据、文本、软件、音乐、声响、照片、图画、影像、词句或其他材料。您应对"您的资料"负全部责任，而加盟指南仅作为您在网上发布和刊登"您的资料"的被动渠道。但是，倘若加盟指南认为"您的资料"可能使加盟指南承担任何法律或道义上的责任，或可能 使加盟指南 (全部或部分地)失去加盟指南的互联网服务供应商或其他供应商的服务，或您未在加盟指南规定的期限内登录或再次登录网站，则加盟指南可自行全权决定对"您的资料"采取加盟指南认为必要或适当的任何行动，包括但不限于删除该类资料。您特此保证，您对提交给加盟指南的"您的资料"拥有全部权利，包括全部版权。您确认，加盟指南没有责任去认定或决定您提交给加盟指南的资料哪些是应当受到保护的，对享有"服务"的其他用户使用"您的资料"，加盟指南也不必负责。</div>\n' +
              '        <div>5. 您的资料和您的服务项目。</div>\n' +
              '        <div>"您的资料"包括您在注册、交易或列举服务项目过程中、在任何公开信息场合或通过任何电子邮件形式，向加盟指南或其他用户提供的任何资料，包括数据、文本、软件、音乐、声响、照片、图画、影像、词句或其他材料。您应对"您的资料"负全部责任，而加盟指南仅作为您在网上发布和刊登"您的资料"的被动渠道。但是，倘若加盟指南认为"您的资料"可能使加盟指南承担任何法律或道义上的责任，或可能 使加盟指南 (全部或部分地)失去加盟指南的互联网服务供应商或其他供应商的服务，或您未在加盟指南规定的期限内登录或再次登录网站，则加盟指南可自行全权决定对"您的资料"采取加盟指南认为必要或适当的任何行动，包括但不限于删除该类资料。您特此保证，您对提交给加盟指南的"您的资料"拥有全部权利，包括全部版权。您确认，加盟指南没有责任去认定或决定您提交给加盟指南的资料哪些是应当受到保护的，对享有"服务"的其他用户使用"您的资料"，加盟指南也不必负责。</div>\n' +
              '        <div>5.1 注册义务。</div>\n' +
              '        <div>如您在加盟指南网站注册，您同意：</div>\n' +
              '        <div>(a) 根据加盟指南网站刊载的会员资料表格的要求，提供关于您或贵公司的真实、准确、完整和反映当前情况的资料；</div>\n' +
              '        <div>(b) 维持并及时更新会员资料，使其保持真实、准确、完整和反映当前情况。倘若您提供任何不真实、不准确、不完整或不能反映当前情况的资料，或加盟指南有合理理由怀疑该等资料不真实、不准确、不完整或不能反映当前情况，加盟指南有权暂停或终止您的注册身份及资料，并拒绝您在目前或将来对"服务"(或其任何部份)以任何形式使用。如您代表一家公司或其他法律主体在加盟指南登记，则您声明和保证，您有权使该公司或其他法律主体受本协议"条款"约束。</div>\n' +
              '        <div>5.2 会员注册名、密码和保密。</div>\n' +
              '        <div>在您按照注册页面提示填写信息、阅读并同意本协议并完成全部注册程序后或以其他加盟指南允许 的方式实际使用加盟指南网站服务时，您即成为加盟指南会员（亦称会员），加盟指南根据会员注册名和密码确认您的身份。您须自行负责对您的会员注册名和密码保密，且须对您在会员注册名和密码下发生的所有活动（包括但不限于发布信息资料、网上点击同意或提交各类规则协议、网上续签协议或购买服务等）承担 责任。您同意：</div>\n' +
              '        <div>(a)\t如发现任何人未经授权使用您的会员注册名或密码，或发生违反保密规定的任何其他情况，您会立即通知加盟指南；及</div>\n' +
              '        <div>(b) 确保您在每个上网时段结束时，以正确步骤离开网站。加盟指南不能也不会对因您未能遵守本款规定而发生的任何损失或损毁负责。您理解加盟指南对您的请求采取行动需要合理时间，加盟指南对在采取行动前已经产生的后果（包括但不限于您的任何损失）不承担任何责任。</div>\n' +
              '        <div>5.3 关于您的资料的规则。</div>\n' +
              '        <div>您同意，"您的资料"和您发布在加盟指南网站上的任何"服务"（泛指一切可供依法交易的、有形的或无形的、以各种形态存在的某种具体的物品或服务内容，或某种权利或利益，或某种票据或证券，或某种服务或行为。本协议中"物品"一词均含此义</div>\n' +
              '        <div>a. 不会有欺诈成份，与售卖伪造或盗窃无涉；</div>\n' +
              '        <div>b. 不会侵犯任何第三者对该物品、服务享有的物权，或版权、专利、商标、商业秘密或其他知识产权，或隐私权、名誉权等任何权利；</div>\n' +
              '        <div>c. 不会违反任何法律、法规、条例或规章 (包括但不限于关于规范出口管理、贸易配额、保护消费者、不正当竞争或虚假广告的法律、法规、条例或规章)；</div>\n' +
              '        <div>d. 不会含有诽谤（包括商业诽谤）、恐吓或骚扰的内容；</div>\n' +
              '        <div>e. 不会含有淫秽、或包含任何儿童色情内容；</div>\n' +
              '        <div>f. 不会含有蓄意毁坏、恶意干扰、秘密地截取或侵占任何系统、数据或个人资料的任何病毒、伪装破坏程序、电脑蠕虫、定时程序炸弹或其他电脑程序；</div>\n' +
              '        <div>g. 不会直接或间接与下述各项货物或服务连接，或包含对下述各项货物或服务的描述：</div>\n' +
              '        <div>(i) 本协议项下禁止的货物或服务；或</div>\n' +
              '        <div>(ii) 您无权连接或包含的货物或服务。</div>\n' +
              '        <div>此外，您同意不会：</div>\n' +
              '        <div>(h)\t在与任何连锁信件、大量胡乱邮寄的电子邮件、滥发电子邮件或任何复制或多余的信息有关的方面使用"服务"；</div>\n' +
              '        <div>(i) 未经其他人士同意，利用"服务"收集其他人士的电子邮件地址及其他资料；或</div>\n' +
              '        <div>(j) 利用"服务"制作虚假的电子邮件地址，或以其他形式试图在发送人的身份或信息的来源方面误导其他人士。</div>\n' +
              '        <div>5.4 被禁止物品。</div>\n' +
              '        <div>您不得在加盟指南网站公布或通过加盟指南网站买卖：(a) 可能使加盟指南违反任何相关法律、法规、条例或规章的任何物品、服务；或 (b) 加盟指南认为应禁止或不适合通过本网站买卖的任何物品、服务。</div>\n' +
              '        <div>5.5 授权</div>\n' +
              '        <div>a. 在本协议项下，用户允许加盟指南基于向用户持续提供更优质服务、广告、市场营销等目的使用用户所提供的个人信息，同意并授权加盟指南基于前述目的，在法律法规允许的范围内，将用户的个人信息提供给与加盟指南所提供服务相关的第三方、或实际向用户提供服务的用户或其他服务提供方使用。用户同意并授权加盟指南以及与加盟指南所提供服务相关的第三方基于向用户持续提供更优质服务之目的，向用户送达各类广告、通知等信息，包含并不限于：</div>\n' +
              '        <div>1） 通知、公示、公告等；</div>\n' +
              '        <div>2） 站内信、客户端推送的消息等；</div>\n' +
              '        <div>3） 根据您预留于加盟指南的联系方式发出的电子邮件、短信、彩信、微信、函件、APP信息推送等。加盟指南所有的通知均可通过重要页面公告、电子邮件或常规的信件传送等方式进行；该等通知于发送之日视为已送达企业用户。</div>\n' +
              '        <div>b. 用户在此授权加盟指南，在全球范围内的，以任何方式，包括但不限于使用、复制、改写、发布、翻译、展示等形式，使用用户公示于加盟指南平台的各类信息或制作其派生作品，和/或以现在已知或日后开发的任何形式、媒体或技术，将上述信息纳入其它作品内（以下简称“许可使用权”）。用户授予加盟指南的许可使用权为无偿的及永久的，并同意加盟指南有权对许可使用权的部分或全部进行再授权。</div>\n' +
              '        <div>c. 用户承诺其有权做出上述授权，确保加盟指南行使许可使用权、或使用加盟指南平台上的上述信息不会侵犯任意第三人的知识产权、肖像权、隐私权或其他合法权利。若有第三人对加盟指南进行侵权投诉的，用户有义务出面进行处理并承担责任，若由于用户未能及时处理或由于用户违反承诺，导致国家机关或相关机构对加盟指南予以罚款或者裁决、判决加盟指南向第三人支付赔偿款，则用户应当按照加盟指南承担罚款或者支付赔偿款的两倍向加盟指南支付赔偿款，并且由用户向加盟指南支付由此而产生律师费、差旅费、保全费、公证费、调查费、评估费、鉴定费、仲裁费、诉讼费等全部费用。</div>\n' +
              '        <div>d. 用户同意并授权在使用加盟指南用户服务的同时接受加盟指南及加盟指南指定第三方向其登记的电子邮件、手机、通信地址发送商业信息。</div>\n' +
              '        <div>6. 您完全理解并同意不可撤销地授予加盟指南及其关联公司下列权利：</div>\n' +
              '        <div>6.1 对于您提供的资料，您授予加盟指南及其关联公司独家的、全球通用的、永久的、免费的许可使用权利 (并有权在多个层面对该权利进行再授权)，使加盟指南及其关联公司有权(全部或部份地)使用、复制、修订、改写、发布、翻译、分发、执行和展示"您的资料"或制作其派生作品，和/或以现在已知或日后开发的任何形式、媒体或技术，将"您的资 料"纳入其他作品内。</div>\n' +
              '        <div>6.2 当您违反本协议或与加盟指南签订的其他协议的约定，加盟指南有权以任何方式通知关联公司、产品（包括但不限于加盟指南以及加盟指南旗下其它网络平台或产品等，下同），要求其对您的权益采取限制措施包括但不限于要求将您在关联公司、产品帐户内的款项支付给加盟指南指定的对象，要求关联公司、产品中 止、终止对您提供部分或全部服务，且在其经营或实际控制的任何网站公示您的违约情况。</div>\n' +
              '        <div>6.3 同样，当您向加盟指南关联公司、产品作出任何形式的承诺，且相关公司、产品已确认您违反了该承诺，则加盟指南有权立即按您的承诺约定的方式对您的账户采取限制措施，包括但不限于中止或终止向您提供服务，并公示相关公司确认的您的违约情况。您了解并同意，加盟指南无须就相关确认与您核对事实，或另行征 得您的同意，且加盟指南无须就此限制措施或公示行为向您承担任何的责任。</div>\n' +
              '        <div>7. 隐私。</div>\n' +
              '        <div>尽管有第6条所规定的许可使用权，但基于保护您的隐私是加盟指南的一项基本原则，为此中国加 盟网还将根据加盟指南的隐私声明使用"您的资料"。加盟指南隐私声明的全部条款属于本协议的一部份，因此，您必须仔细阅读。请注意，您一旦自愿地在中国加盟网交易地点披露"您的资料"，该等资料即可能被其他人士获取和使用。</div>\n' +
              '        <div>8. 信息发布及交易程序。</div>\n' +
              '        <div>8.1 添加产品、服务描述条目。产品、服务描述是由您提供的在加盟指南网站上展示的文字描述、图画和/或照片，可以是</div>\n' +
              '        <div>(a) 对您拥有而您希望出售的产品、服务的描述；或</div>\n' +
              '        <div>(b) 对您正寻找的产品、服务的描述。您可在加盟指南网站发布任一类产品、服务描述，或两种类型同时发布，条件是，您必须将该等产品、服务描述归入正确的类目 内。加盟指南不对产品、服务描述的准确性或内容负责。</div>\n' +
              '        <div>8.2 就交易进行协商。交易各方通过在加盟指南网站上明确描述需求和供应情况，进行相互协商。除非在特殊情况下，诸如用户在发布信息后实质性地更改对物品、服务的描述或澄清任何文字输入错误，或您未能证实交易所涉及的用户的身份等，否则您在交易时所做出的承诺不得撤回。</div>\n' +
              '        <div>8.3 处理争议。</div>\n' +
              '        <div>(i)加盟指南不涉及用户间因交易、协议而产生的法律关系及法律纠纷，不会且不能牵涉进交易 各方的交易当中。倘若您与一名或一名以上用户，或与您通过加盟指南网站获取其服务的第三者服务供应商发生争议，您免除加盟指南(及加盟指南代理人和雇员) 在因该等争议而引起的，或在任何方面与该等争议有关的不同种类和性质的任何(实际和后果性的) 权利主张、要求和损害赔偿等方面的责任。</div>\n' +
              '        <div>(ii)加盟指南有权受理并调处您与其他用户因交易产生的争议，同时有权单方面独立判断其他用户对您的投诉及(或)索偿是否成立，若加盟指南判断索偿成立，则您应及时使用自有资金进行偿付，否则加盟指南有权使用您交纳的保证金（如有）或扣减已购加盟指南及其关联公司、产品或服务中未履行部分的费用的相应金额或您在加盟指南网站所有账户下的其他资金(或权益)等进行相应偿付。加盟指南没有使用自用资金进行偿付的义务，但若进行了该等支付，您应及时赔偿加盟指南的全部损失，否则加盟指南有权通过前述方式抵减相应资金或权益，如仍无法弥补加盟指南损失，则加盟指南保留继续追偿的权利。因中国加盟网非司法机构，您完全理解并承认，加盟指南对证据的鉴别能力及对纠纷的处理能力有限，受理贸易争议完全是基于您之委托，不保证争议处理结果符合您的 期望，亦不对争议处理结果承担任何责任。加盟指南有权决定是否参与争议的调处。</div>\n' +
              '        <div>(iii)加盟指南有权通过电子邮件等联系方式向您了解情况，并将所了解的情况通过电子邮件等方式通知对方，您有义务配合加盟指南的工作，否则加盟指南有权做 出对您不利的处理结果，或将结果作为证据提供给司法机关。</div>\n' +
              '        <div>(ⅳ)经生效法律文书确认用户存在违法或违反本协议行为或者加盟指南自行判断用户涉嫌存在违法或违反本协议行为的，加盟指南有权在加盟指南上以网络 发布形式公布用户的违法行为并做出处罚（包括但不限于限权、终止服务等）。</div>\n' +
              '        <div>8.4 运用常识。</div>\n' +
              '        <div>加盟指南不能亦不试图对其他用户通过"服务"提供的资料进行控制。就其本质而言，其他用户的资料，可能是令人反感的、有害的或不准确的，且在某些情况下可能带有错误的标识说明或以欺诈方式加上标识说明。加盟指南希望您在使用加盟指南网站时，小心谨慎并运用常识。</div>\n' +
              '        <div>9. 交易系统。</div>\n' +
              '        <div>9.1 不得操纵交易。</div>\n' +
              '        <div>您同意不利用帮助实现蒙蔽或欺骗意图的同伙、网络推手等(下属的客户或第三方)，操纵与另一交易方所进行的商业谈判的结果。</div>\n' +
              '        <div>9.2 系统完整性。</div>\n' +
              '        <div>您同意，您不得使用任何装置、软件或例行程序干预或试图干预加盟指南的正常运作或正在加盟指南网站上进行的任何交易。您不得采取对任何将不合理或不合比例的庞大负载加诸加盟指南网络结构的行动。您不得向任何第三者披露您的密码，或与任何第三 者共用您的密码，或为任何未经批准的目的使用您的密码。</div>\n' +
              '        <div>9.3 反馈。</div>\n' +
              '        <div>您不得采取任何可能损害信息反馈系统的完整性的行动，诸如：利用第二会员身份标识或第三者为您 本身留下正面反馈；利用第二会员身份标识或第三者为其他用户留下负面反馈、留言\t(反馈数据轰炸)；或在用户未能履行交易范围以外的某些行动时，留下负面的反馈、留言 (反馈恶意强加)。</div>\n' +
              '        <div>9.4 不作商业性利用。</div>\n' +
              '        <div>您同意，您不得对任何资料作商业性利用，包括但不限于在未经加盟指南授权高层管理人员事先书面批准的情况下，复制在加盟指南网站上展示的任何资料并用于商业用途。</div>\n' +
              '        <div>10. 终止或访问限制。</div>\n' +
              '        <div>您同意，在加盟指南未向您收费的情况下，加盟指南可自行全权决定以任何理由 (包括但不限于加盟指南认为您已违反本协议的字面意义和精神，或您以不符合本协议的字面意义和精神的方式行事，或您在超过90天的时间内未以您的帐号及密码登录网站) 终止您的"服务"密码、帐户 (或其任何部份) 或您对"服务"的使用，并删除和丢弃您在使用"服务"中提交的"您的资料"。您同意，在加盟指南向您收费的情况下，加盟指南应基于合理的怀疑且经电子邮件通知的情况下实施上述终止服务的行为。加盟指南同时可自行全权决定，在发出通知或不发出通知的情况下，随时停止提供"服务"或其任何部份。您同意，根据本协议的任何规定终止您使用"服务"之措施可在不发出事先通知的情况下实施，并承认和同意，加盟指南可立即使您的帐户无效，或撤销您的帐户以及在您的帐户内的所有相关资料和档案，和/或禁止您进一步接入该等档案或"服务"。帐号终止后，加盟指南没有义务为您保留原帐号中或与之相关的任何信息，或转发任何未曾阅读或发送的信息给您或第三方。此外，您同意，中国加盟网不会就终止您接入"服务"而对您或任何第三者承担任何责任。第12、13、14和22各条应在本协议终止后继续有效。</div>\n' +
              '        <div>11. 违反规则会有什么后果？</div>\n' +
              '        <div>在不限制其他补救措施的前提下，发生下述任一情况，加盟指南可立即发出警告，暂时中止、永久 中止或终止您的会员资格，删除您的任何现有产品、服务信息，以及您在网站上展示的任何其他资料：</div>\n' +
              '        <div>(i) 您违反本协议；</div>\n' +
              '        <div>(ii) 加盟指南无法核实或鉴定您向加盟指南提供的任何资料；或</div>\n' +
              '        <div>(iii) 加盟指南相信您的行为可能会使您、加盟指南用户或通过加盟指南或加盟指南网站提供服务的第三者服务供应商发生任何法律责任。在不限制任何其他补救措施的前提下，倘若发现您从事涉及加盟指南网站的诈骗活动，加盟指南可暂停或终止您的帐户。</div>\n' +
              '        <div>12. 服务"按现状"提供。</div>\n' +
              '        <div>加盟指南会尽一切努力使您在使用加盟指南网站的过程中得到乐趣。遗憾的是，加盟指南不能 随时预见到任何技术上的问题或其他困难。该等困难可能会导致数据损失或其他服务中断。为此，您明确理解和同意，您使用"服务"的风险由您自行承担。"服务"以"按现状"和"按可得到"的基础提供。加盟指南明确声明不作出任何种类的所有明示或暗示的保证，包括但不限于关于适销性、适用于某一特定用途和无侵权行为等方面的保证。加盟指南对下述内容不作保证：(i)"服务"会符合您的要求；(ii)"服务"不会中断，且适时、安全和不带任何错误； (iii) 通过使用"服务"而可能获取的结果将是准确或可信赖的；及 (iv)您通过"服务"而购买或获取的任何产品、服务、资料或其他材料的质量将符合您的预期。通过使用"服务"而下载或以其他形式获取任何材料是由您自行全权决定进行的，且与此有关的风险由您自行承担，对于因您下载任何该等材料而发生的您的电脑系统的任何损毁或任何数据损失，您将自行承担责任。您从加盟指南或通过或从"服务"获取的任何口头或书面意见或资料，均不产生未在本协议内明确载明的任何保证。</div>\n' +
              '        <div>13. 责任范围。</div>\n' +
              '        <div>您明确理解和同意，加盟指南不对因下述任一情况而发生的任何损害赔偿承担责任，包括但不限于 利润、商誉、使用、数据等方面的损失或其他无形损失的损害赔偿 (无论加盟指南是否已被告知该等损害赔偿的可能性)：</div>\n' +
              '        <div>(i) 使用或未能使用"服务"；</div>\n' +
              '        <div>(ii) 因通过或从"服务"购买或获取任何货物、样品、数据、资料或服务，或通过或从"服务"接收任何信息或缔结任何交易所产生的获取替代货物和服务的费用；</div>\n' +
              '        <div>(iii) 未经批准接入或更改您的传输资料或数据；</div>\n' +
              '        <div>(iv) 任何第三者对"服务"的声明或关于"服务"的行为；或</div>\n' +
              '        <div>(v) 因任何原因而引起的与"服务"有关的任何其他事宜，包括疏忽。</div>\n' +
              '        <div>14. 赔偿。</div>\n' +
              '        <div>您同意，因您违反本协议或经在此提及而纳入本协议的其他文件，或因您违反了法律或侵害了第三方的权利，而使第三方对加盟指南及其子公司、分公司、董事、职员、代理人提出索赔要求（包括司法费用和其他专业人士的费用），您必须赔偿给加盟指南及其 子公司、分公司、董事、职员、代理人，使其等免遭损失。</div>\n' +
              '        <div>15. 遵守法律。</div>\n' +
              '        <div>您应遵守与您使用"服务"，以及与您购买和销售任何物品、服务以及提供商贸信息有关的所有相关的法律、法规、条例和规章。</div>\n' +
              '        <div>16. 无代理关系。</div>\n' +
              '        <div>您与加盟指南仅为独立订约人关系。本协议无意结成或创设任何代理、合伙、合营、雇用与被雇用或特许权授予与被授予关系。</div>\n' +
              '        <div>17. 广告和金融服务。</div>\n' +
              '        <div>您与在"服务"上或通过"服务"物色的刊登广告人士通讯或进行业务往来或参与其推广活动，包括就相关货物或服务付款和交付相关货物或服务，以及与该等业务往来相关的任何其他条款、条件、保证或声明，仅限于在您和该刊登广告人士之间发生。您同意，对于因任何该等业务往来或因在"服务"上出现该等刊登广告人士而发生的任何种类的任何损失或损毁，加盟指南无需负责或承担任何责任。您如打算通过"服务"创设或参与与任何公司、投资有关的任何服务，或通过"服务"收取或要求与任何公司、投资或有关的任何新闻信息、警戒性信息或其他资料，敬请注意，中国加盟网不会就通过"服务"传送的任何该等资料的准确性、有用性或可用性、可获利性负责或承担任何责任，且不会对根据该等资料而作出的任何交易或投资决策负责或 承担任何责任。</div>\n' +
              '        <div>18. 链接。</div>\n' +
              '        <div>"服务"或第三者均可提供与其他万维网网站或资源的链接。由于加盟指南并不控制该等网站和资源，您承认并同意，加盟指南并不对该等外在网站或资源的可用性负责，且不认可该等网站或资源上或可从该等网站或资源获取的任何内容、宣传、产品、服务或其他材料，也不对其等负责或承担任何责任。您进一步承认和同意，对于任何因使用或信赖从此类网站或资源上获取的此类内容、宣传、产品、服务或其他材料而造 成（或声称造成）的任何直接或间接损失，加盟指南均不承担责任。</div>\n' +
              '        <div>19. 通知。</div>\n' +
              '        <div>除非另有明确规定，任何通知应以电子邮件形式发送，(就加盟指南而言) 电子邮件地址为jiamengzhinan@126.com，或 (就您而言)发送到您在登记过程中向加盟指南提供的电子邮件地址，或有关方指明的该等其他地址。在电子邮件发出二十四 (24)小时后，通知应被视为已送达，除非发送人被告知相关电子邮件地址已作废。或者，加盟指南可通过邮资预付挂号邮件并要求回执的方式，将通知发到您在登记过 程中向加盟指南提供的地址。在该情况下，在付邮当日三 (3) 天后通知被视为已送达。</div>\n' +
              '        <div>20. 不可抗力。</div>\n' +
              '        <div>对于因加盟指南合理控制范围以外的原因，包括但不限于自然灾害、罢工或骚乱、物质短缺或定量配给、暴动、战争行为、政府行为、通讯或其他设施故障或严重伤亡事故等，致使加盟指南延迟或未能履约的，加盟指南不对您承担任何责任。</div>\n' +
              '        <div>21. 转让。</div>\n' +
              '        <div>加盟指南转让本协议无需经您同意。</div>\n' +
              '        <div>22. 其他规定。</div>\n' +
              '        <div>本协议取代您和加盟指南先前就相同事项订立的任何书面或口头协议。本协议各方面应受中华人民共和国大陆地区法律的管辖。倘若本协议任何规定被裁定为无效或不可强制执行，该项规定应被撤销，而其余规定应予执行。条款标题仅为方便参阅而设，并不以任何方式界定、限制、解释或描述该条款的范围或限度。加盟指南未就您或其他人士的某项违约行为采取行动，并不表明加盟指南撤回就任何继后或类似的违约事 件采取行动的权利。</div>\n' +
              '        <div>23. 诉讼。</div>\n' +
              '        <div>因本协议或加盟指南服务所引起或与其有关的任何争议应向河北省石家庄市裕华区人民法院提起诉讼，并以中华人民共和国法律为管辖法律。</div>\n' +
              '\n' +
              '      </div>'
    });
    return false;
  })
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