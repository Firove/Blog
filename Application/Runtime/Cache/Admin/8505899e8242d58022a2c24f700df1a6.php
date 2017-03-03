<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>栏目列表</title>
		<link rel="stylesheet" type="text/css" href="/Blog/Application/Public/Admin/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Blog/Application/Public/Admin/css/catlist.css" />
		
	</head>
	<body>
		
		<div id="top">
			<h1>MyBlog后台管理系统</h1>
		</div>
		

		
		<div id="content">
			
		<div id='left'>
				<div class="block">
					<h3>栏目管理</h3>
					<a href="<?php echo U('Admin/Cat/catlist');?>">栏目列表</a><br />
					<a href="<?php echo U('Admin/Cat/catAdd');?>">添加栏目</a>
				</div>
				<div class="block">
					<h3>文章管理</h3>
					<a href="<?php echo U('Admin/Art/artList');?>">文章列表</a><br />
					<a href="<?php echo U('Admin/Art/artAdd');?>">发布文章</a>
				</div>
				<div class="block">
					<h3>其他</h3>
					<a href="<?php echo U('Admin/Tag/tagList');?>">标签管理</a><br />
					<a href="#">留言管理</a><br />
					<a href="#">友情链接</a><br />
				</div>
				<div class="block">
					<h3>个人中心</h3>
					<a href="#">修改密码</a><br />
					<a href="#">退出登录</a>
				</div>	
		</div>

            <div id='right'>
            	<table border="1px" cellspacing="0" cellpadding="0">
            		<tr><th style="width: 400px;">栏目名称</th><th style="width: 80px;">文章数</th><th style="width: 120px;">操作</th></tr>
            		<?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo["cat_name"]); ?></td><td><?php echo ($vo["art_num"]); ?></td><td><a href="<?php echo U('Admin/Cat/delete?cat_id='.$vo[cat_id]);?>">删除</a>&nbsp;|&nbsp;
            			<a href="<?php echo U('Admin/Cat/catedit?cat_id='.$vo[cat_id].'&cat_name='.$vo[cat_name]);?>">修改</a></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
            	</table>

			</div>
		</div>
		

		
	</body>
</html>