<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"D:\PHPTutorial\WWW\jmzn\jmzn\public/../application/index\view\article\detail.html";i:1566550863;s:66:"D:\PHPTutorial\WWW\jmzn\jmzn\application\index\view\defa\defa.html";i:1566550863;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>文章详情</title>
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
  .submitBtn{
    width: 120px;
    height: 40px;
    line-height: 40px;
    font-size: 14px;
    border-left: 1px solid #5389F7;
    text-align: center;
    color: #fff;
    background-color: #5389F7;
    cursor: pointer;
    border-radius: 5px;
  }
  .consultDetail {
    background-color: #F4F5FA;
    padding-bottom: 125px;
  }

  /* tabbar */
  .commonNav {
    width: 100%;
    height: 40px;
    line-height: 40px;
    background: #2F333B;
    font-size: 16px;
    color: #fff;
  }
  .commonNav .all {
    float: left;
    width: 240px;
    height: 40px;
    text-align: center;
    background: #51575D;
  }
  .commonNav .all img, .commonNav .all label {
    display: inline-block;
    vertical-align: middle;
  }
  .commonNav .all img {
    margin: -2px 14px 0 0;
  }
  .commonNav .part a {
    float: left;
    width: 160px;
    height: 40px;
    position: relative;
    color: #fff;
    text-align: center;
  }
  .commonNav .part a.active {
    background: #1A1D21;
  }
  .commonNav .part a.active i {
    width: 34px;
    height: 2px;
    background: -webkit-gradient(linear, 100% 0, 0 0, from(#579EFA), to(#4F74F4));
    background: -webkit-linear-gradient(to bottom, #579EFA, #4F74F4);
    background: -moz-linear-gradient(to bottom, #579EFA, #4F74F4);
    background: -o-linear-gradient(to bottom, #579EFA, #4F74F4);
    background: linear-gradient(to bottom, #579EFA, #4F74F4);
    position: absolute;
    left: 50%;
    margin-left: -17px;
    bottom: 2px;
    z-index: 1;
  }
  .commonNav .issueBtn {
    float: right;
    color: #FEAB17;
  }

  /* tabbar */
  /* 面包屑 */
  .crumbs {
    color: #999;
    font-size: 14px;
    line-height: 60px;
  }

  /* 面包屑 */
  /* 文章 */
  .article {
    width: 895px;
    background-color: #fff;
    padding-top: 41px;
  }
  .article .title {
    font-weight: bold;
    font-size: 22px;
    padding: 0 41px;
  }
  .article .subhead {
    font-size: 12px;
    color: #999;
    padding: 25px 41px;
  }
  .article .collectBtn {
    width: 78px;
    height: 28px;
    line-height: 28px;
    text-align: center;
    border: 1px solid #E3E4E5;
    border-radius: 2px;
    cursor: pointer;
  }
  .article .collectBtn i, .article .collectBtn b {
    display: inline-block;
    vertical-align: middle;
    font-weight: normal;
  }
  .article .collectBtn i {
    margin: -2px 5px 0 0;
    font-size: 18px;
    color: #C8C9CC;
  }
  .article .collectActive {
    color: #5389F7;
  }
  .article .collectActive i {
    color: #5389F7;
  }
  .article .content {
    min-height: 160px;
    padding: 0 41px 30px 41px;
    border-bottom: 1px solid #E3E4E5;
    line-height: 26px;
  }
  .article .footer {
    height: 90px;
    line-height: 90px;
    font-size: 14px;
    color: #4D4D4D;
    padding: 0 41px;
  }
  .article .footer>div{
   max-width: 50%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
  .article .footer span {
    font-weight: bold;
  }

  /* 文章 */
  /* 文章评论 */
  .articleConsult {
    width: 895px;
    background-color: #fff;
    margin-top: 20px;
  }
  .articleConsult .title {
    height: 22px;
    font-size: 18px;
    font-weight: bold;
    padding: 20px 40px;
    background-color: #F0F7FF;
  }
  .articleConsult .content {
    padding: 32px 40px;
  }
  .articleConsult .content textarea {
    width: 771px;
    height: 90px;
    padding: 20px;
    border: 1px solid #E3E4E5;
    resize: none;
    margin-bottom: 23px;
  }
  .articleConsult .consult {
    padding: 0 41px;
  }
  .articleConsult .consult .count {
    font-size: 14px;
    line-height: 30px;
    color: #999;
    border-bottom: 1px solid #E3E4E5;
  }
  .articleConsult .consult .consultItem {
    padding: 30px 0;
  }
  .articleConsult .consult .consultItem .avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
  }
  .articleConsult .consult .consultItem .info {
    width: 730px;
    font-size: 14px;
    line-height: 30px;
    color: #999;
    margin-left: 27px;
  }
  .articleConsult .consult .consultItem .info .name {
    color: #333;
    font-weight: bold;
    font-size: 16px;
  }
  .articleConsult .consult .consultItem .info .name .noPraise {
    font-weight: normal;
    font-size: 14px;
    color: #C8C9CC;
    cursor: pointer;
  }
  .articleConsult .consult .consultItem .info .name .noPraise span {
    font-size: 20px;
    position: relative;
    top: 1px;
  }
  .articleConsult .consult .consultItem .info .reply {
    color: #808080;
    padding: 9px 23px;
    background-color: #F4F5FA;
    margin-top: 9px;
  }
  .articleConsult .consult .consultItem .info .time {
    margin-top: 9px;
  }
  .articleConsult .consult .consultItem .info .time .replyBtn {
    color: #5389F7;
    text-decoration: underline;
    cursor: pointer;
  }
  .hotConsult {
    width: 295px;
    min-height: 420px;
    background-color: #fff;
  }
  .hotConsult .title {
    height: 50px;
    line-height: 50px;
    font-size: 14px;
    font-weight: bold;
    padding: 0 19px;
    border-bottom: 1px solid #E3E4E5;
  }
  .hotConsult .title .more {
    color: #999;
    font-size: 12px;
    font-weight: normal;
  }

  .list {
    padding: 13px 20px 23px 20px;
  }
  .list .item {
    padding-top: 10px;
    display: block;
  }
  .list .item .order {
    width: 18px;
    height: 21px;
    text-align: center;
    line-height: 21px;
    font-size: 12px;
    color: #999;
  }
  .list .item .name {
    width: 89%;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-left: 10px;
  }
  .list .item .count {
    color: #999;
    font-size: 12px;
  }
  .list .item:nth-child(-n+3) .order {
    color: #fff;
    background: url("/statics/index/image/icon_hotConsult.jpg") 100% 100% no-repeat;
  }
  /* 文章评论 */
</style>

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
          <img data-v-3a1bbf91="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAA9CAMAAADf2dYGAAADAFBMVEVHcEwjQogOKnMCGXIAAIAMJ2wAG2clQ4kAAAAADF4BF20EF3IMJXIlQokkQosAFnQAFXAlQ4ofOHQBFnIeOXUNH3MfN3QdN3cfOHQfN3IAFW8iPYUAGXMgOHQjQ4kgOXQfOXMdN3UBF3IWLXMfOXQfOHQfOHQiOIgfOHQmP4kfOHMgOXQqQYwkPYgfOHQfOHQeOHQgNnQqRI0fOHQkQokeN3kdOXMeN3IpQY0eN3QcNnMkPIUkQokkQokdNXMEGHOuudYjQYkkQ4ocMnYeNH8kQokjQYnV2+ofOHPY3+0kQonZ3uzM1OX+/v7u8vmWo8rd4u/w9PgkQoofOHQfN3K+yODx9voeOXNrfK+crdAeOHXs8Pbn7PX5+/0kQ4rv8vi7xNxAUpiCmMbM1Ojl6vQkQ4ogOHTT2umJmMFGXZ+erdD6+fre5PAkQorc4uzE0uglQookQokiPHwkQom4wtrDzOAiPX/X6Pg2T5JziLnN1eYgOHW5yuTQ3/G0z+wfOHW3zualweEfOXS+0eeru9nDzeKZs9ggOHX////09vv4+fzo7fby9fr6+/3s8fj3+Pv+/v79/f7u8vf7/f/q8Pfr7vZBU7fl6/Pw8/g5VrE9VbT2+v4ygtcydco9R7gxW6/09vrj7vjt9Ps6fNAqXK/i7/sxbMEnYbUwVaorZrrd5e/f5/Qye9AbIbDo8/zu9/7y+f3I3e8zVK86TrA6bb8uX7MpWK0Of9ozf9TD0OhGqfQ/ecnP5fnn8Po9vfzh5/DR3Ow0TagqU6g7j9xBnOUzcMU/k+ATeNYSas3d7Pksa70cgNo1ZLkxPLbU7Po/iNZNs/UkLrRIvP4jPq+bodPv9/drcsLA5PeAh8stN7ZKyPsrftWMj9B2fcZhnN1ddcEbidcjS60PVrU4XrhOmd9MVLtCrPYSI6idvOMoitYhh9eX0fe4vd6BlM0jcciEr+GusttEaL5WkdR2pNsWN6UOP6kNKaWSsuEUZLxuwfWW2fWg3/gaasMROa2zt9pbicw25lg2AAAAiHRSTlMAkAcKAgkF5gEDDwwSyTkVGKyEG0wOYCJqOBYcE1ZzcJQdHyVCinMwjyVH5jUreX5kLUBa3Rg1PS9EMxWBvSophEviMChgVr9Q1NLLqPnxZt36zJZKn/SHTH9t7OL0s+GTO27M7G6bslVPcf7no/y714qDmnSXxvlhYZ6oru72xtC+suiZp7HW9ovh1AAADvVJREFUaN7UmHlQE1kexzsJpAnkghiOJIIGMWCIBwQBAUEUHVEEndXVxVuc8T7KnZpynVpnd8rakCYJCQkJKG5WESSKOtxKjYiKUiyuOh6l67neMzXjXHv9sdfvve5AOJyJf234At1Nd7rz+/TveL/3COJHFBDg58fjcblsf39OEC2Ovz+by+Xx/PwCAoiRIszB5fr7BwVJpYGBgXz4k0qDghAKlwckASOGA7nDP0gayOcrRDIkkYLPD5RysFdGjFMYfwRJgQIwxEiwk4kwCk0yUhzCZXOkgQqZSBymUcUjpcxSAgygoPjijQyXMBx8hUyiWfrLX70/B/T+/NX5a2ZJxDIFkHBHBgni4CIOcdiG+atW5OUZDAZT8cIFRfNWL40TixUQXiOCBAeWv5QPUbVpVV6puaxMry8uLnFYjJYFBVkpErGIL6V9MhI4ggJF4rEblpvLwBt6vakYSCwWq81YuDgeSNzRNRI4FGKJav5m036TSW8yOZ3FTqfDASTWBYtTGBLfLl0BTIIoxEqlcK6+xIlV4oDIssCvDXyyDFJeQZP4cJpgDkgQmUSp3LhF7wSHQGQBidFKUZTNRlHWgqVKpVgh9W0ScAj0V5AgEmXmxo9WmMvMoDKDvpghQepYrVJKZHymdPn2CAIJotk0N0+n05WCzGZMYgF32OHHWrBbg0h82iV0pkNgzVq2qrRUp2NQEI1hM0p3o9FG2Quy4pV9aeK+NU0oZA96mkaIFRdH7zX02RShUIr2SXK5x2fhdiG//1++PImQy/mEXMiI/daRxUYVS5m/ChhMRrvr3Ke0XMeO2e02h0nvtFDWotUpKLgGgKwnSfxlsyNpwWEwicVi0XtyBrY4m9yBPyggyf5v5mSQ5Epe//8sUkDAnUQkcyvJQCePHx8e7aVDINPFa+bqdGbXPx4+u/DFl18+fvz4iwuXnj17+PCHb179+pyjmKKKsuLAJZx+khyBliQFoF2M9SQGyRYIaBCBYBGyCwSmpRNDQOAjuUkeXCvJ3BmAxhkIEr1XjRTL+2kQ2iGzslbozJ9e7b7c+kdQa2sr3rS2XgYd+OaYkzIWLB3okr4vDA4mtSyWgAEREAQNAsFBg/AAKG4ISA5JZieAV4ODt+Kwk7vNl8pBY3PJXOzE0er3RqXuUatDvQBBGQIOKS099n33vQMH2toOuHWv7TicuHe5+6HLSVH7NKh9ZHMZELkwl9wqhE0wtp7FgGgRRF9oIZAEksxgDwZRZZPkeohKd/hhELiupZ0E5yPxwbjJ6FXsVb/3kyAoshQy5e5Cnf7V67arYHrbYazj6O/48TYAu9z9ymQ1blkqxoXLnSQ8bIpgEEhfjrDwBs5thRN0Gu0A80BgeRp4aRfUBq3bYPoBTCwSRAapTfOw8rfqMV5EFgeaLBRZjh/A9qqqi9cudFVhdVVdPHP1dRXQdH9/zGEt3BSGY8sNEgf2DQXZERlJgwTDeWRXErx7si8OaTfx4FIGh0gDFwTzhgFJcGcVralq9TtepYhMrNqXp3P993B7V037tT9f7K3BqkPHPTWA1F112mRd8AHEFgyKPAYEvi1+KIiAYA8KLXQph4WkxX5izSbSIYbiMI6ATwwEwdV3JaAnaNxXUn/nRWThFBFL4ueU6s61t7c39bZfO3uxubYOqbYKQOrqarq6/vUaQBbOV8lEKEkC+tI1bShItiAXXieLzJbLVUzcoMwfmCNyNGBgHA0xCKTfd8HMhclqdYw3RQuKr1ginKMDkK6m3uamM59fqq6uBTW3dL34/FJtbU9Pzz97TusRiFjmAZJOaonhc2SRPIPMQIFOv++hIO6ERrE5CCQHVXStB0i0Wh3lzTCCcl1Ce6Sprqm3penM2QstLc3N1c3V52teYKi6uic9tEcGgOxCxg4C0TBjMgzuBE8YzybeDJKiHZgInjmCn8goUb3Xm4EdFy2xckOBTmd/9ORp83kEcvTo75HOI++0tFQ31z555HJQSxarUL/VB5JBbn2DR9zS7nwzCKpbONF5O1k5PwYyak+MdyDQMMpS9uWZS0u+/ndDQ+d3AHIegxxFIABV3dzyt68dRmpB1nQahClbO/ALHQISDK2HIBgq7cpFzBgxHAgP8nlRGuNZLQd2O4FiOBAvWy0MoohfV2ow62++bKjo/O7F2UsIpLq65XwNeAR5p+WvN01WaskHTGjRIFKoRcOBEEKU43AgT3hjsmOzs2fIsWbTD0qCIkHmjh0CMn38aK9DS6TabjaUlZ6+caOisfLi2cOdRyswSO+Zs1fhuOEvFadhZC+eFy/zyJEU9L4TIrUIBBqsbGSkFN6zHDqmdDkcxKMD9vAgsweEILkSml8BXSfiiJxIeGiGx2Conu5lsvMVmsV5m01m26OXjZWNT5ueNlQgNTQ0tF/t7ayobPj7Axs0wKaCeIUokOMGATM1OCfcTeNWj/6rT8JhQeIEngJXpECLks1SpWtJIR8NoKhncCf7nli2dyBBfNHY/EKT02T+T/2N8vLGxsbKCkadnY0VlZU3bnylpyijfk6KwmNATGCxOMROFis9jS5VqETNYA0W6hZn0zso2CzWcEaksVgziLT1qMuS5sRp0G05bz+tws2vKH6eyeHQO+7UXylHqqRVgaDKr7y8YzHaqUNLssJEni2K780PYTqizF9uMhoN1IP66wfLnz8v79fBu/WPtp2yU7bieWtkeFHId0Gga5TFLVu1wmYz2G4erL97EKuc3tXXP9jmRDPF5flKutXyTRBmyi4SazZtL7TYTM7T959fr6+/fv3ulSt34eDK7W8pp72DKinMmuVepfPJ1Qf3MrxMEi3M2rLQZtE7zn178/79Ow9u37595/7NrzpMFrudKpqHloD5Ug4aRXwTBJNAvsskStXa7UULHRan3uR0UB3btrnsllu3rPaOjqI5mxKmKCW49fXZhS16oRGv/CozE9Z+tG6LnbIaLRaHw2Gx3Dp0yPiHD+fmC2dmRiuZGbvPgrhJRBJldOY04cbtJbaODpfL1eGiTu0HnTzy8cbMzMxoicjr1V+//ycJThMwePdyc7HFZoeAchnLDPsN+0+e+PDjtapoJcqQQRxc1OwRbC5sxof1n06KgbExcSrhNxN3r+MIIgItgoRNQHLPCJN/1r80B6enc0aBZtInfjGt/2GpiW+7HI8W6TIzE9YZ9HoDkslyqgxITh46ceLIJ2uj+1ZMPe6c/C5ayQkfBbPqd2NjY5NDQkJiwgnuxCljQ4nQ5NSYyX6JUVEhIVFRk34eFZUYNjF0Qnh4SExISGwEQYyDu4hpgJBMTJk4ITSUPzEiYjSz6DNtPA04Bh4aizdT36oGy5TRM5ctMTgNZWazwaB3ntoPsXXyxJHPPvvTb5hZ7gAOzphJE2gQ9iRpaipBhBDElHC/8MSwqbERoWNG82fy2RzOO6kcTnIoh8MmQqcQ48ZFAMD/qjW/17atKI5frNQPssiGLOtHFmFrsmTZEEmOsR17YAo2zCFr1xKnbrwF2qYkHQ3tS0tZWQpj3cCKXCfLxgx5iQN5aSFNHgsO6atf8jYC+xf6F2x72blXcVqSEeq3+OJgO/6lj873fO+5uscuhFjNYFlVFDmZRUkdEJiqLIs8EiOR6ekIGSJjQSxz+JcqmY+OCc4SMK7x+dWmC4Vw/ejfw+bGbndnd7vTab/o/hL75OxkmDWzrAeikBMXJiBIr8nlimbDWbfzfivEZUEfpRTU57zGalFVBGAKUYkyZSmihBgAsTibV8IUlSERqfSumJTC4XDEDONR/mjr8nYW1DtX11zXaaw1//nrCBJku3PY6XTb+8uz6v+UWVaWiqietFDagCwBEZkiUrHaS1GdKxshlNd0SCFeEky/FxEfiwIYv5JDZg/EBoQ8REgjIBwv4DEEKZjWihRVqELJ3YcHQ5KMxH64sua2HJDWzuGu+3rjNcZot7vPLgujzOkyS5kOIDtFQIaiWlIxszpFJVNwIJKkS4wkSWlE17RsQZYtUZYziJclPopMJit7HnACYsGr4SSiJJLYvC7DiGBXCGR5VjTUfqzreKU4tdpo4Yg4R++697d2dyFB2u39vTdP4/SZFJE1jhMjPgxC8wmIvw5/ICgODsSSeAmp4bQtFVlaECxZEBjE21wtiioccTg7cwISgueCiIZqNWJ9JvGsafDwCm+xvJTQ2Vw/IJcwyCQBWV/9893fR/e3drYAo71/+Gzy0We0V558MFkYPEjIyHrSIibk3XEJirIl3jYtSFGa1QLIp5nkVGNp+UMG8SQWlJj2QFCZPR7YBEORADESeFTOlYScKAgFSekLhAGQNaflNhuNDYCo7+NwtLef/Dh7Lz56pl7MG3j+SJnHICxJShaDaJYFrlVTkaQIbElXUCVlwmpV0W2+aqRC4NAAqAELcwwChCwwwj/wN4reXISQCgqzFxZAeDLXxwILQJiJqXXHrW82QVxrjrvS3d7uPll+Pl7C5Ql1qs4Kk8wUFtJnIhLF2c0T10ooICBBo4UqgyQum85FaTZvwydlSAcjIGps9RRIhiQHKlrk21N6WeTD+SHUDwjUW/HHc86N662W6266rd9+f9XZ23t4Z1glu27n99V8GJGowlXVnCnLBoPKqWrCAOlH8SQId6ImIb9eUwxGtywkZimFRdgLDFnXZYMXEtNJsA8zbMAMldT0IkrySLENvg8QsiN6++fFmbu/4i3QFShTXr1989NsTFW9HZ5zC18VfBJGASQkKCEJK0kQQPIZiZLIKVaJzIUMtqChNJVHQt6HVAb5i4h6P/wF/LYvMiQp/Dhl0pneo/62RGOx75bqL1YODh5cW3p58MfL5ctFvMdOUwPUHuQL4E3q4Pg1p95srcx///zBSsu9emss2Efde2GWvCPB4PCk02w49fnxr++2Nus3HpdGThYig9J5Rmr5kbGvmgDiTI7fXIKUv/40ji9mDUwH3fsWoZFP7317ZW19biY2/HCu4XwDU+EFvuRwDgm+7Lg4NXXrtqrenPly8VGcDg0Ux8niPUSPpuMTE6Xg58FgfCyexhy+gQLxSHCnKQ23Udz3y+AOZtw65x+kVuzjJa/vEu7EZsigcTi8/uUB4uiRAEqvNx53x/c6yi/Ukf4H+VF7tsE7fckAAAAASUVORK5CYII=" alt="" class="evaluate"></a>
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
  
    
      <div class="wrapper clearfix">
        <div class="crumbs">您的位置：<a href="<?php echo url('index/article/index'); ?>">行业咨询</a> > <?php echo $data['mode']; ?></div>
        <div class="article fl">
          <div class="title"><?php echo $data['title']; ?></div>
          <div class="subhead between">
            <div>作者：<?php echo $data['username']; ?> &nbsp;&nbsp; 发布时间：<?php echo $data['addtime']; ?> &nbsp;&nbsp; 阅读量：<?php echo $data['read_num']; ?></div>
            <input type="hidden" id="is_fow" value="<?php echo $data['is_fow']; ?>">
            <span id="followlike" class="collectBtn <?php if($data['is_fow'] == 1): ?>collectActive<?php endif; ?>" onclick="modifyFollow('<?php echo $data['id']; ?>')">
              <i class="iconfont icon-collect"></i>
              <b id="state"><?php if($data['is_fow'] == 1): ?>已收藏<?php else: ?>收藏<?php endif; ?></b>
            </span>
          </div>
          <div class="content" v-html="data.detail">
              <?php echo $data['detail']; ?>
          </div>
          <div class="footer ">
              <div class="fl">
                <span>上一篇：</span>
                <a href="<?php echo url('index/article/detail'); ?>?id=<?php echo $data['prev']['id']; ?>"><?php echo $data['prev']['title']; ?></a>
              </div>
              <div class="fr">
                <span>下一篇：</span>
                <a href="<?php echo url('index/article/detail'); ?>?id=<?php echo $data['next']['id']; ?>"><?php echo $data['next']['title']; ?></a>
              </div>
          </div>
        </div>
        <div class="fr">
          <div class="hotConsult">
            <div class="title clearfix" >
              <span class="fl" >热门资讯</span>
              <a class="fr more" to="/newsList?type=1"> 更多 <span class="el-icon-arrow-right"></span></a>
            </div>
            <div class="list">
              <?php foreach($hotArt as $key => $value): ?>
              <a  href="<?php echo url('index/item/detail'); ?>?id=<?php echo $value['id']; ?>" class="item clearfix" v-for="(item,index) in data" :key="'hot'+item.id" >
                <div class="order fl"><?php echo $key+1; ?></div>
                <div class="name fl"><?php echo $value['title']; ?></div>
                <!--            <div class="count fr">{{item.read_num}}</div>-->
              </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="wrapper">
        <div class="articleConsult ">
          <div class="title">
            文章评论
          </div>

          <div class="content">
            <textarea cols="30" rows="10"placeholder="请输入评论内容" name="content" id="content"></textarea>
              <input type="hidden" id="topic_id" value="<?php echo $data['id']; ?>">
              <input type="hidden" id="to_uid" value="<?php echo $data['id']; ?>">
            <div class=" clearfix">
              <button class="submitBtn fr" onclick="addComment()">提交评论</button>
            </div>
          </div>

          <div class="consult" v-if="commentList.length>0">
            <div class="count">
              共<?php echo $comment['count']; ?>条评论
            </div>
            <?php if($comment['data'] !== []): foreach($comment['data'] as $key => $value): ?>
            <div class="consultItem clearfix" v-for="(item,index) in commentList">
              <img class="avatar fl" src="<?php echo $value['userAvatar']; ?>" alt="">
              <div class="info fl">
                <div class="name">
                  <?php echo $value['username']; ?>
                  <div class="fr noPraise" data-id="item.id" onclick="addLike('<?php echo $value['id']; ?>')">
                    <span class="iconfont icon-praise"></span> <?php echo $value['likes']; ?>
                  </div>
                </div>
                <div ><?php echo $value['content']; ?></div>
                <?php if($value['comment'] !== []): foreach($value['comment'] as $k => $v): ?>
                <div class="reply" v-if="item.comment.length>0">
                  <div ><?php echo $v['username']; ?>：<?php echo $v['content']; ?></div>
                </div>
                <?php endforeach; endif; ?>
              </div>
            </div>
            <?php endforeach; endif; ?>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
  function addComment() {
    var content = $("#content").val();
    if(!content){
      layer.msg('请输入评论内容',{icon:2})
      return false;
    }
    // add_comment
    var topic_id = $("#topic_id").val();
    var to_uid = $("#to_uid").val();
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/comment/add_comment'); ?>",
      data:{
        'topic_id':topic_id,
        'to_uid':to_uid,
        'content':content
      },
      success: function(data){
        console.log('data',data);
        if(data.code == 200){
          layer.msg('发表成功',{icon:1});
          window.location.reload();
        }else{
          layer.msg(data.msg,{icon:2});
        }
      }
    })
  }

  /**
   *  评论点赞
   *  @param id
   * */
  function addLike(id) {
    console.log('id',id);
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/comment/add_likes'); ?>",
      data:{
        'id':id,
      },
      success: function(data){
        console.log('data',data);
        if(data.code == 200){
        }
      }
    })
  }
  
  
  function modifyFollow(id) {
    var state = $("#is_fow").val();
    console.log(state);
    $.ajax({
      type: "POST",
      url: "<?php echo url('index/follow/modify_foolow'); ?>",
      data:{
        'tid':id,
        'type':3
      },
      success: function(data){
        if(data.code == 200){
          if(state == 0){
            $("#is_fow").val(1);
            layer.msg('收藏成功',{icon:1});
            $("#state").html('已收藏');
            $("#followlike").addClass('collectActive');
            console.log('添加属性');
          }else{
            $("#is_fow").val(0);
            layer.msg('取消收藏',{icon:1});
            $("#state").html('收藏');
            $("#followlike").removeClass('collectActive');
            console.log('清除属性');
          }
        }else{
          layer.msg(data.msg,{icon:1});
        }
        console.log('data',data);
      }
    })
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