<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"G:\www\jmzn\public/../application/admin\view\item\item_detail.html";i:1563188997;s:53:"G:\www\jmzn\application\admin\view\public\header.html";i:1563188997;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">

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
    

    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" method="POST" action="" enctype="multipart/form-data">
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>项目名字</label>
                        <div class="layui-input-inline">
                            <input value="<?php echo $data['item_name']; ?>" type="text"  name="item_name" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                            <input value="<?php echo $data['id']; ?>" type="hidden"  name="id" required="" lay-verify="required" autocomplete="off" class="layui-input">
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>封面图</label>
                        <div class="layui-input-inline">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn" id="test1">上传封面图</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" src="http://www.zhangjin.com\<?php echo $data['img']; ?>" style="width: 100px;" id="demo1">
                                    <p id="demoText"></p>
                                    <input type="hidden" name="img" value="<?php echo $data['img']; ?>" style="width: 500px" id="image">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>轮播图</label>
                        <div class="layui-input-inline">
                                <button type="button" class="layui-btn" id="test2">上传轮播图</button>
                                  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                                    预览图：
                                    <div class="layui-upload-list" id="demo2">
<?php foreach($data['image'] as $key =>$value): ?>
                                        <img src="http://www.zhangjin.com\/<?php echo $value; ?>" style="with:100px;height: 100px" class="layui-upload-img">
<?php endforeach; ?>
                                    </div>
                                 </blockquote>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>品牌名称</label>
                        <div class="layui-input-inline">
                            <input type="text" value="<?php echo $data['brand']; ?>"  name="brand" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>所属用户<?php echo $data['wid']; ?></label>
                        <div class="layui-input-inline">
                            <select name="wid" >
                                <option value="0">请选择用户</option>
<?php foreach($userData as $key =>$value): if($value['uid'] == $data['wid']): ?>
                                <option selected value="<?php echo $value['uid']; ?>"><?php echo $value['username']; ?></option>
    <?php else: ?>
                                <option value="<?php echo $value['uid']; ?>"><?php echo $value['username']; ?></option>
    <?php endif; endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>品牌logo</label>
                        <div class="layui-input-inline">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn" id="test3">LOGO</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" src="http://www.zhangjin.com\<?php echo $data['logo']; ?>" style="width: 100px;" id="demo3">
                                    <p id="demoText1"></p>
                                    <input type="hidden" name="logo" value="" style="width: 500px" id="logo">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>所属公司</label>
                        <div class="layui-input-inline">
                            <input value="<?php echo $data['company']; ?>" type="text"  name="company" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label  class="layui-form-label">
                            <span class="x-red"></span>官网链接</label>
                        <div class="layui-input-inline">
                            <input type="text"  value="<?php echo $data['href']; ?>" name="href" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>品牌注册时间</label>
                         <div class="layui-inline layui-show-xs-block">
                                <input class="layui-input" value="<?php echo $data['brand_make_time']; ?>"  autocomplete="off" placeholder="品牌注册时间" name="brand_make_time" id="brand_make_time" style="width: 190px">
                         </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>加盟店数量</label>
                        <div class="layui-input-inline">
                            <input type="number" value="<?php echo $data['fran_store_num']; ?>"  name="fran_store_num" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
                     <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>店铺数量</label>
                        <div class="layui-input-inline">
                            <input type="number" value="<?php echo $data['shop_count']; ?>"  name="shop_count" required="" lay-verify="required" autocomplete="off" class="layui-input"></div>
                    </div>
                    <input type="hidden" id="cate_pid" value="<?php echo $data['cate_pid']; ?>">
                    <input type="hidden" id="cate_id" value="<?php echo $data['cate_id']; ?>">
                    <div class="layui-form-item x-cate" id="category">
                              <label class="layui-form-label">行业分类</label>
                              <div class="layui-input-inline">
                                <select name="cate_pid" lay-filter="category">
                                  <option value="">分类</option>
                                </select>
                              </div>
                              <div class="layui-input-inline">
                                <select name="cate_id" lay-filter="child">
                                  <option value="">分类</option>
                                </select>
                              </div>
                    </div>

                    <input type="hidden" id="province" value="<?php echo $data['province']; ?>">
                    <input type="hidden" id="city" value="<?php echo $data['city']; ?>">
                    <div class="layui-form-item x-city" id="end">
                              <label class="layui-form-label">加盟区域</label>
                              <div class="layui-input-inline">
                                <select name="province" lay-filter="province">
                                  <option value="">全国</option>
                                </select>
                              </div>
                              <div class="layui-input-inline">
                                <select name="city" lay-filter="city">
                                  <option value="">全国</option>
                                </select>
                              </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>最小投资金额</label>
                        <div class="layui-input-inline">
                            <input type="address" value="<?php echo $data['min_money']; ?>"  name="min_money" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>最大投资金额</label>
                        <div class="layui-input-inline">
                            <input type="address"  value="<?php echo $data['max_money']; ?>" name="max_money" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>注册地址</label>
                        <div class="layui-input-inline">
                            <input type="address"  name="address" value="<?php echo $data['address']; ?>" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>经营范围</label>
                        <div class="layui-input-inline">
                            <input type="text"  name="scope" value="<?php echo $data['scope']; ?>" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>注册资金</label>
                        <div class="layui-input-inline">
                            <input type="text"  value="<?php echo $data['money']; ?>" name="money" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>公司性质</label>
                        <div class="layui-input-inline">
                            <input type="text"  name="character" value="<?php echo $data['character']; ?>" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="x-red"></span>适合人群</label>
                        <div class="layui-input-inline">
                            <input type="text"  name="crowd" value="<?php echo $data['crowd']; ?>" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span></div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label for="desc" class="layui-form-label">项目介绍</label>
                        <div class="layui-input-block">
                            <textarea placeholder="请输入内容" id="desc" name="recommend" class="layui-textarea"><?php echo $data['recommend']; ?></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
                    </div>

                </form>

            </div>
        </div>
<script src="http://www.zhangjin.com\/dist/layedit.js" charset="utf-8"></script>
<script type="text/javascript" src="http://www.zhangjin.com\/statics/admin/js/xcity.js"></script>
<script type="text/javascript" src="http://www.zhangjin.com\/statics/admin/js/xcate.js"></script>
        <script>
            var category = '';
            var catePid = $("#cate_pid").attr("value");
            var cateid = $("#cate_id").attr("value");
            var provinceId = $("#province").attr("value");
            var cityId = $("#city").attr("value");
            $( $.ajax({
                type: "POST",
                url: "<?php echo url('admin/category/cateList'); ?>",
                success: function(data){
                category = jQuery.parseJSON(data);
             }
            }));
            layui.use(['form','code'], function(){
                form = layui.form;
                layui.code();
                $('#category').xcate(category,catePid,cateid);

            });
          layui.use(['form','code'], function(){
            form = layui.form;

            layui.code();

            $('#end').xcity(provinceId,cityId);

          });



layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;

  //普通图片上传
  var uploadInst = upload.render({
    elem: '#test1'
    ,url: "<?php echo url('admin/index/uploadImage'); ?>"
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo1').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code > 0){
        return layer.msg('上传失败');
      }
      //上传成功
      $('#image').attr('value',res.data.src); //图片链接（base64）
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  });
  //
  var uploadInst = upload.render({
    elem: '#test3'
    ,url: "<?php echo url('admin/index/uploadImage'); ?>"
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo3').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code > 0){
        return layer.msg('上传失败');
      }
      //上传成功
      $('#logo').attr('value',res.data.src); //图片链接（base64）
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText2');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  });

  //多图片上传
  upload.render({
    elem: '#test2'
    ,url: "<?php echo url('admin/index/uploadImage'); ?>"
    ,multiple: true
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      $('#demo2').empty();
      obj.preview(function(index, file, result){
        $('#demo2').append('<img src="'+ result +'" style="width: 100px;height: 100px" alt="'+ file.name +'" class="layui-upload-img">')
      });
    }
    ,done: function(res){
      //上传完毕
           $('#demo2').append('<input type="hidden" name="image[]" value="'+res.data.src+'">');
    }
  });
});
        layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#brand_make_time' //指定元素
            });

        });

        // layui.use(['layer', 'jquery', 'form'], function () {
		// 	var layer = layui.layer,
		// 			$ = layui.jquery,
		// 			form = layui.form;
        //
		// 	form.on('select(uid)', function(data){
		// 	    if(data.value == 1){
		// 			$("#searchSessionNum").attr("disabled","true");
		// 			form.render('select');
		// 		}else{
		// 			$("#searchSessionNum").removeAttr("disabled");
		// 			form.render('select');//select是固定写法 不是选择器
		// 		}
		// 	});
		// });


        </script>
    </body>

</html>