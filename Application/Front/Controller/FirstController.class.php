<?php
namespace Front\Controller;
use Think\Controller;
class FirstController extends Controller {
	function firstPage(){
		$url=U('Front/First/firstPage');  
		$art=M('Art');
		$tag=M('Tag');
		$relationship=D('Relationship');
		//这里的select是自定义的select,获取每篇文章对应的tag字符串		
		$arr=$relationship->select();
		$cat=M('Cat');
		$catlist=$cat->select();
		$this->assign('catlist',$catlist);
		
		if(!empty($_GET['cz'])){
			$cz=$_GET['cz'];
			if($cz==1){
				if(!empty($_GET['tag_id'])&&is_numeric($_GET['tag_id'])){
					$maxId=$tag->max('tag_id');
					$minId=$tag->min('tag_id');
					$tag_id=$_GET['tag_id'];
					if($tag_id>$maxId||$tag_id<$minId){
						header("location:$url");
						exit();
					}
						
					$count=$tag->field('art_num')->where("tag_id=$tag_id")->find();
					$count=$count['art_num'];
					$page= new \Think\Page($count,8);
					$show=$page->show();
					$list=$art->field('art.art_id,title,pubtime,content,small_img,cat_name')->join("right join relationship on art.art_id=relationship.art_id")->join("left join cat on art.cat_id=cat.cat_id")->where("tag_id=$tag_id")->order('art_id desc')->limit($page->firstRow.','.$page->listRows)->select();
				}else{
					header("location:$url");
					exit();
				}
			}else if($cz==2){
				if(!empty($_GET['cat_id'])&&is_numeric($_GET['cat_id'])){
					$cat_id=$_GET['cat_id'];
					
					$maxId=$cat->max('cat_id');
					$minId=$cat->min('cat_id');
					if($cat_id>$maxId||$cat_id<$minId){
						header("location:$url");
						exit();
					}
					
					
					$count=$cat->field('art_num')->where("cat_id=$cat_id")->find();
					$count=$count['art_num'];
					$page= new \Think\Page($count,8);
					$show=$page->show();
					$list = $art->field('art_id,title,pubtime,content,small_img,cat_name')->join("left join cat on art.cat_id=cat.cat_id")->order('art_id desc')->where("art.cat_id=$cat_id")->limit($page->firstRow.','.$page->listRows)->select();
					
				}else{
					header("location:$url");
					exit();
				}
				
			}else{
				 	
				header("Location:$url");
				exit();
			}
			
		}else{		
		//首页获取文章列表
			$count=$art->count('art_id');
			$page= new \Think\Page($count,8);
			$show=$page->show();
			$list = $art->field('art_id,title,pubtime,content,small_img,cat_name')->join("left join cat on art.cat_id=cat.cat_id")->order('art_id desc')->limit($page->firstRow.','.$page->listRows)->select();
			
		}
		
		//拼接list数组
		for($i=0;$i<count($list);$i++){
			//$list[$i]['content']=mb_substr($list[$i]['content'], 0, 5);
			$list[$i]['content']=strip_tags($list[$i]['content']);
			$list[$i]['content']=mb_substr($list[$i]['content'], 0, 60,'utf-8').'...';
	
			foreach($arr as $val){
				if($list[$i]['art_id']==$val['art_id']){
					$list[$i]['tag_str']=$val['tag_str'];
					break;
				}
			}				 
		}
//		exit();
		//exit();
		$tg=$tag->select();
		$this->assign('tg',$tg);
//		echo "<pre>";
//		print_r($list);
//		echo "<pre>";
//		exit();
		
		$this->assign('list',$list);// 赋值数据集
		$this->assign('show',$show);// 赋值分页输出
		
		$this->display();
	}
    
}