<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>管理员登录</title>
		<link rel="stylesheet" href="/Blog/Application/Public/Front/css/login.css" />
	</head>
	<body>
		<div id='top'>
			<h1 style="line-height: 180px;">MyBlog后台管理系统登录</h1>
		</div>
		<div style="height: 72px;background-color: black;"></div>
		<div id='loginDiv'>
			<form action="<?php echo U('Front/Login/confirm');?>" method="post">
			账号：<input type="text" name="user_id" class="txt"/><br /><br />
			密码：<input type="password" name="user_pwd" class="txt"/><br /><br />
			<input type="submit" value="登录" class="btn"/>
		</form>
		</div>
		
	</body>
</html>