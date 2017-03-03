<?php

namespace Admin\Controller;
use Think\Controller;
require_once './Application/Admin/Common/Common.php';
class TagController extends Controller {
	function tagList(){
		check();
		$tag=D('Tag');
		$tags=$tag->select();
		$this->assign("tags",$tags);
		$this->display();
	}
	function tagEdit(){
		check();
		$tag_id=I('get.tag_id');
		$tag=D('Tag');
		$arr=$tag->field('tag_name')->where("tag_id=$tag_id")->find();
		$this->assign('tag_id',$tag_id);
		$this->assign('tag_name',$arr['tag_name']);
		$this->display();
	}
	
	function update(){
		check();
		$url=U('Admin/Tag/taglist');
		$tag_id=I('get.tag_id');
		if(!empty(I('post.tag_name'))){
			$tag_name=I('post.tag_name');
			$tag=D('Tag');
			$data['tag_id']=$tag_id;
			$data['tag_name']=$tag_name;
			$tag->data($data)->save();
			header("Location:$url");
			exit();
		}
		header("Location:$url");
	}
	
}
?>