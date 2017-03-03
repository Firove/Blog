<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>一川烟草，满城风絮</title>
		<meta name="viewport" content="width=divice-width,initial-scale=1.0,user-scalable=no" />
		<link href="/Blog/Application/Public/Front/css/bootstrap.min.css" rel="stylesheet">
		<link href="/Blog/Application/Public/Front/css/firstPage.css" rel="stylesheet">
		<link href="/Blog/Application/Public/Admin/css/fenyelinks.css" rel="stylesheet">
		<link href="/Blog/Application/Public/Front/css/tag.css" rel="stylesheet">
		<link href="/Blog/Application/Public/Front/css/header.css" rel="stylesheet">
		<!--<script src="/Blog/Application/Public/Front/js/main.js"></script>-->
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
		<div class="jumbotron">
			
		</div>				
	</div>
</div>
	
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">						
					<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="row">
							<div class="media art">
								<div class="media-body">
									<h2 class="media-heading title"><a href="<?php echo U('Front/Art/artPage?art_id='.$vo['art_id']);?>"><?php echo ($vo["title"]); ?></a></h2>
									<span class="xiao">时间：<?php echo ($vo["pubtime"]); ?></span>&nbsp;&nbsp;
									<span class="xiao">栏目：<?php echo ($vo["cat_name"]); ?></span>&nbsp;&nbsp;
									<span class="xiao">标签：<?php echo ($vo["tag_str"]); ?></span>
									<div class="zhengwen"><?php echo ($vo["content"]); ?></div>
								</div>
								<div class="media-left media-middle" style="solid;padding-left: 5px;padding-right: 5px;">
									<a href="<?php echo U('Front/Art/artPage?art_id='.$vo['art_id']);?>">
										<img src="<?php echo ($vo['small_img']); ?>" class="media-object small-img"/>
									</a>
								</div>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>					
					<div class="wrap" style="margin-bottom: 20px;">
	            		<div class="nav">
	            			<?php echo ($show); ?>
	            		</div>
            		</div>					
				</div>
								
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<!--标签面板-->
					<div class="row">
						<div class="panel panel-default fntcol">
	<div class="panel-body">
		<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>&nbsp;&nbsp;<b>所有标签</b>
	<hr style="color: black;"/>
		<?php if(is_array($tg)): $i = 0; $__LIST__ = $tg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="biaoqian" href="<?php echo U('Front/First/firstPage?tag_id='.$vo['tag_id'].'&cz=1');?>">
				<?php echo ($vo["tag_name"]); ?>(<?php echo ($vo["art_num"]); ?>)
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
								
	</div>
							
</div>

					</div><br />
					<!--标签面板-->
					<!--列表面板-->
					<div class="row">
						<div class="panel panel-default fntcol">
							<div class="panel-body">
								<span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span>&nbsp;&nbsp;<b>博客分类</b>
							<hr style="color: black;"/>
								<?php if(is_array($catlist)): $i = 0; $__LIST__ = $catlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="cat" href="<?php echo U('Front/First/firstPage?cat_id='.$vo['cat_id'].'&cz=2');?>">
										<?php echo ($vo["cat_name"]); ?>(<?php echo ($vo["art_num"]); ?>)<br /><br />
									</a><?php endforeach; endif; else: echo "" ;endif; ?>
														
							</div>
							
						</div>
					</div>
					<!--列表面板结束-->
				</div>
			</div>
		</div>
		
		
		
		<script src="/Blog/Application/Public/Front/js/jquery-3.1.1.min.js"></script>
		<script src="/Blog/Application/Public/Front/js/bootstrap.min.js"></script>
	</body>
	
</html>