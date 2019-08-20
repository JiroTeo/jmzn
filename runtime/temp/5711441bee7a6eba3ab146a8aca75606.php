<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"G:\www\jmzn\public/../application/admin\view\article\article_detail.html";i:1563188996;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0050)https://www.jiamengzhinan.com/#/consultDetail?id=2 -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1"><title>资讯详情</title>
	<link href="http://www.zhangjin.com\/statics/admin/css/app.articledetail.css" rel="stylesheet">
</head>
<body>


    <div data-v-b5d42fdc="" class="wrapper clearfix">
        <div data-v-b5d42fdc="" class="crumbs">资讯详情</div>
        <div data-v-b5d42fdc="" class="article fl">
        	<div data-v-b5d42fdc="" class="title"><?php echo $data['title']; ?>
        	</div>
	        <div data-v-b5d42fdc="" class="subhead between">
	        	<div data-v-b5d42fdc="">作者：<?php echo $data['username']; ?> &nbsp;&nbsp;
                    发布时间：<?php echo $data['addtime']; ?> &nbsp;&nbsp;
                    类型：<?php echo $data['type']; ?> &nbsp;&nbsp;
                    阅读量：<?php echo $data['read_num']; ?>
	        	</div>
	        </div>
            <div data-v-b5d42fdc="" class="content">
	        	<p>资讯简介：</p>
                <?php echo $data['sign']; ?>
			</div>
	        <div data-v-b5d42fdc="" class="content">
                <p>资讯详情：</p>
	        	<?php echo $data['detail']; ?>
			</div>
		</div>

	</div>
<div data-v-b5d42fdc="" class="wrapper">
	<div data-v-b5d42fdc="" class="articleConsult ">
	<div data-v-b5d42fdc="" class="title">
        文章评论

      </div>
      <div data-v-b5d42fdc="" class="consult">
      	<div data-v-b5d42fdc="" class="count">
          共<?php echo $commentNum; ?>条评论
        </div>

<?php if($comment != []): foreach($comment as $key => $value): ?>
          <div data-v-b5d42fdc="" class="consultItem clearfix">
              <img data-v-b5d42fdc="" src="http://www.zhangjin.com\<?php echo $value['avatar']; ?>" alt="" class="avatar fl">
              	<div data-v-b5d42fdc="" class="info fl">
              	<div data-v-b5d42fdc="" class="name">
              <?php echo $value['username']; ?><?php echo $value['uid']; ?>
              <div data-v-b5d42fdc="" data-id="item.id" class="fr noPraise"><span data-v-b5d42fdc="" class="iconfont icon-praise"></span> 0

              </div>
              </div>
                  <div data-v-b5d42fdc=""><?php echo $value['content']; ?>
                  </div>
<?php if($value['child'] != []): foreach($value['child'] as $k => $v): ?>
                <div data-v-b5d42fdc="" class="reply">
                    <div data-v-b5d42fdc=""><?php echo $v['username']; ?>：<?php echo $v['content']; ?></div>
                </div>
<?php endforeach; endif; ?>
                  <div data-v-b5d42fdc="" class="time clearfix"><span data-v-b5d42fdc="" class="fl"><?php echo $value['addtime']; ?></span>
                  </div>
              </div>
          </div>
<?php endforeach; endif; ?>

      </div>
          </div>
          </div>
          </div>
</body>
</html>
