<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>文章</title>
		<meta name="viewport" content="width=divice-width,initial-scale=1.0,user-scalable=no" />
		<link href="/Blog/Application/Public/Front/css/bootstrap.min.css" rel="stylesheet">
		<link href="/Blog/Application/Public/Front/css/header.css" rel="stylesheet">
		<link href="/Blog/Application/Public/Front/css/artPage.css" rel="stylesheet">
		<link href="/Blog/Application/Public/Front/css/tag.css" rel="stylesheet">
	</head>
	<body>
			<!--<header role="banner">-->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs_navbar">
					<span class="sr-only">唉</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span  class="navbar-brand">梅子黄时雨</span>
			</div>
			<div class="collapse navbar-collapse navbar-responsive-collapse" id="bs_navbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo U('Front/First/firstPage');?>">首页</a></li>
					<!--每次传入一个$nav_id来判断导航应该在的位置-->
					<!--<?php if($nav_id == 0): ?><li class="active"><a href="<?php echo U('Front/First/firstPage');?>">首页</a></li>
						<?php else: ?>
						<li><a href="<?php echo U('Front/First/firstPage');?>">首页</a></li><?php endif; ?>
					
					<?php if($nav_id == 1): ?><li class="active"><a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span>&nbsp;博客分类</a></li>
					<?php else: ?>
						<li><a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span>&nbsp;博客分类</a></li><?php endif; ?>
					
					<?php if($nav_id == 2): ?><li class="active"><a href="#"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span>全部标签</a></li>
					<?php else: ?>
						<li><a href="#"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span>&nbsp;全部标签</a></li><?php endif; ?>-->
					
					<li><a href="<?php echo U('Front/Login/login');?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;管理</a></li>
				</ul>
			</div>			
		</div>		
	</nav>	
<!--</header>-->
		<div class="container">
			<div class="row">
				<div class="col-md-12">	
					<div class="jumbotron" style="background-image: url('<?php echo ($oneArt['small_img']); ?>');background-size: 100% 100%;background-repeat: none;">
						
					</div>				
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="content">
					<span class="title"><?php echo ($oneArt['title']); ?></span><br />
					<span class="xiao">时间：<?php echo ($oneArt['pubtime']); ?></span>&nbsp;&nbsp;<span class="xiao">栏目：<?php echo ($oneArt['cat_name']); ?></span>&nbsp;&nbsp;
					<span class="xiao">标签：
						<?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="biaoqian" href="<?php echo U('Front/First/firstPage?cz=1&tag_id='.$vo['tag_id']);?>"><?php echo ($vo["tag_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</span>
					<br /><br />
					<div class="zhengwen">
						<?php echo ($oneArt['content']); ?>
					</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<!-- 多说评论框 start -->
					<div class="ds-thread" data-thread-key="<?php echo ($oneArt['art_id']); ?>" data-title="<?php echo ($oneArt['title']); ?>" data-url="<?php echo U('Front/Art/artPage?art_id='.$oneArt['art_id']);?>"></div>
					<!-- 多说评论框 end -->
					<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
					<script type="text/javascript">
					var duoshuoQuery = {short_name:"firove"};
					(function() {
						var ds = document.createElement('script');
						ds.type = 'text/javascript';ds.async = true;
						ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
						ds.charset = 'UTF-8';
						(document.getElementsByTagName('head')[0] 
						 || document.getElementsByTagName('body')[0]).appendChild(ds);
					})();
					</script>
				<!-- 多说公共JS代码 end -->				
				</div>
			</div>
			
			
		<script src="/Blog/Application/Public/Front/js/jquery-3.1.1.min.js"></script>
		<script src="/Blog/Application/Public/Front/js/bootstrap.min.js"></script>
	</body>
</html>