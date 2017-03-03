<?php
namespace Admin\Controller;
use Think\Controller;
require_once './Application/Admin/Common/Common.php';
class CatController extends Controller {
    public function catlist(){
    	check();
    	$art=M('Art');
    	$cat=M('Cat');
		$cats=$cat->select();
		$this->assign("cats",$cats);
    	$this->display();   
    }
	
	public function catedit(){
		check();
		$cat_id=I('get.cat_id');
		$cat_name=I('get.cat_name');
		$this->assign("cat_id",$cat_id);
		$this->assign("cat_name",$cat_name);
		$this->display(); 
	}
	 
	public function update(){
		check();
		if(IS_POST){
			$cat_id=I('get.cat_id');
			$cat_name=I('post.cat_name');
			$data['cat_id']=$cat_id;
			$data['cat_name']=$cat_name;
			$cat=M('Cat');
			$cat->data($data)->save();
			$url=U('Admin/Cat/catlist');
			header("Location:$url");	
		}
	}
		
	public function catAdd(){
		check();
		$this->display();	
	}
	
	public function add(){
		check();
		if(IS_POST){
			if(empty(I('post.cat_name'))){
				$url=U('Admin/Cat/catAdd');
				header("Location:$url");
				exit();
			}	
			$cat_name=I('post.cat_name');
			$data['cat_name']=$cat_name;
			$cat=M('Cat');
			$cat->data($data)->add();
			$url=U('Admin/Cat/catlist');
			header("Location:$url");
		}	
	}
	
	public function delete(){
		check();
		$cat_id=I('get.cat_id');
		$url=U('Admin/Cat/catlist');
		$art=M('Art');
		$artMount=$art->where("cat_id=$cat_id")->count("art_id");
		//还要判断栏目下面是否有文章
		if($artMount>0){
			header("refresh:2;url=$url");			
			echo "栏目下有文章不能删除<br/>2秒后跳转";
//			for($i=3;$i>0;$i++){
//				echo "<br/>$i秒后自动跳转";
//				sleep(1);
//			}
//			include('$url');
			exit();
		}
		
		$cat=M('Cat');
		$cat->delete($cat_id);
		header("Location:$url");
	}		
}