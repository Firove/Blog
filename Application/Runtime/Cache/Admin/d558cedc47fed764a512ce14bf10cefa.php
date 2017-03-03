<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="/Blog/Application/Public/Admin/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Blog/Application/Public/Admin/css/artadd.css" />
		<link rel="stylesheet" type="text/css" href="/Blog/Application/Public/Admin/dist/css/wangEditor.min.css">
		<!--
        	<link rel="stylesheet" type="text/css" href="../static/highlightjs/dark.css">
        	描述：
        -->
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
            	<form action="<?php echo U('Admin/Art/add');?>" method="post" enctype="multipart/form-data">
            		标题：<input type="text" name="title" class="txt" /><br /><br />
            		
            		<p>栏目：</p><select name="cat_id" class="xiala">
            			<?php if(is_array($catlist)): $i = 0; $__LIST__ = $catlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cat_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							
						  </select><br /><br />
					标签：<input type="text" name="tags" class="txt" /><br /><br />
					头图：<input type="file" name="small_img" class="txt"/><br /><br />  
					<label style="vertical-align: top;">内容：</label><br />
            		<textarea id="textarea1" name="content">
    				</textarea><br /><br />
    				
            		<script type="text/javascript" src="/Blog/Application/Public/Front/js/jquery-3.1.1.min.js"></script>
    				<script type="text/javascript" src="/Blog/Application/Public/Admin/dist/js/wangEditor.min.js"></script>
    				<script type="text/javascript">
        				$(function () {
           					var editor = new wangEditor('textarea1');
           					editor.config.jsFilter = false;//关闭<script>标签过滤
           					editor.config.uploadImgUrl = "<?php echo U('Admin/Art/upload');?>";//打开上传本地图片
           					//editor.config.uploadHeaders = {'Accept': 'text/x-json'};
           					editor.config.uploadImgFileName = 'file';
            				editor.create();
        				});
    				</script>
            		
            		<input type="submit" class="btn" value="提交"/>
            	</form>
            	
			</div>
		</div>		
	</body>
</html>