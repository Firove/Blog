<?php
namespace Admin\Controller;
use Think\Controller;
require_once './Application/Admin/Common/Common.php';
class ArtController extends Controller {
    public function artAdd(){
    	check();
		
    	$cat=M('Cat');
		$catlist=$cat->select();
		$this->assign('catlist',$catlist);
    	$this->display();

    }
	
	public function upload(){

		if(!isset($_FILES['file']) OR !is_uploaded_file($_FILES['file']['tmp_name'])) 
			exit('错误1');

		if($_FILES['file']['error'] > 0) 
			exit('错误2');

		if($_FILES['file']['size'] > 4194304) 
			exit('错误3');

		switch ( getimagesize($_FILES['file']['tmp_name'])[2] ) {
			case 1: $ext = 'gif'; break;
			case 2: $ext = 'jpg'; break;
			case 3: $ext = 'png'; break;
			default: die('仅允许上传 png gif jpg 格式的图片'); break;
		}
	// 文件路径 文件名
		$imgName = time();
		$savePath = str_replace( "\\", "/", realpath('./') ) . '/upload';
    	if( !is_dir($savePath) ) mkdir($savePath, 0777, true );
    	// 移动文件
		if( !move_uploaded_file($_FILES['file']['tmp_name'], $savePath.'/'.$imgName.'.'.$ext ))
			exit('错误4');
	// 返回文件地址
		exit('http://'.$_SERVER['HTTP_HOST'].'/Blog/upload/'.$imgName.'.'.$ext);
	}
	
	//上传头图
	function smallImgUpload(&$small_img){

		if(is_uploaded_file($_FILES['small_img']['tmp_name'])){
			$pathinfo=pathinfo($_FILES['small_img']['name']);
			$ext=$pathinfo['extension'];
			if(!$ext=='jpg'&&!$ext=='png'&&!$ext=='gif'){
				die("仅允许上传 png gif jpg 格式的图片");
				exit();
			}
			$imgName = time();
			$savePath = str_replace( "\\", "/", realpath('./') ) . '/upload';				
			$destination=$savePath.'/toutu'.$imgName.'.'.$ext;
			move_uploaded_file(($_FILES['small_img']['tmp_name']),$destination);
			//echo $_FILES['small_img']['name'];
			$small_img='http://'.$_SERVER['HTTP_HOST'].'/Blog/upload/toutu'.$imgName.'.'.$ext;
		}
		
	}

	
	public function add(){
		
		check();
		
		$url=U('Admin/Art/artAdd');
		if(empty($_POST)||empty($_POST['title'])||empty($_POST['content'])||empty($_POST['cat_id'])){	
			header("Location:$url");
			exit();
		}		
		
		$small_img='';
		$this->smallImgUpload($small_img);
				
		$title=$_POST['title'];
		$cat_id=$_POST['cat_id'];
		$content=$_POST['content'];
		$pubtime=date('Y-m-d G:i:s');
		$data['title']=$title;
		$data['cat_id']=$cat_id;
		if(!empty($small_img)){
			$data['small_img']=$small_img;
		}
		
		$data['content']=$content;
		$data['pubtime']=$pubtime;		
		$art=M('Art');
		$art_id=$art->data($data)->add();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$tag=D('Tag');
		$relationship=D('Relationship');
		//存入tag,更新relationship表
		$this->tagInsert($art_id,$tag,$relationship);
		//更新tag表的文章数,并删除没有文章的tag
		$this->tagArtNum($tag,$relationship);		
		//计算栏目下的文章数
		$this->catArtNum($art);
		header("Location:$url");
	}
	
	function artList(){
		check();
		$art=M('Art');
		$count=$art->count('art_id');
		$page= new \Think\Page($count,20);
		$show=$page->show();
		$list = $art->field('art_id,title,pubtime')->order('art_id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('show',$show);// 赋值分页输出
		//$page->setConfig('header','篇文章');
		$this->display();
		
	}
	
	function delete(){
		check();
		$art=M('Art');
		$url=U('Admin/Art/artList');
		$art_id=I('get.art_id');
		$art->where("art_id=$art_id")->delete();
		//更新关系表
		$relationship=D('Relationship');
		$relationship->where("art_id=$art_id")->delete();
		//更新tag表
		$tag=D('tag');
		$this->tagArtNum($tag,$relationship);
		//更新cat表
		$this->catArtNum($art);		
		header("Location:$url");
	}
	
	function artEdit(){
		check();
		$art_id=I('get.art_id');
		$cat=M('Cat');
		$catlist=$cat->select();
		$this->assign('catlist',$catlist);
		
		$art=M('Art');
		$tag=D('Tag');
		$relationship=D('Relationship');
		//找出该文章对应的标签名并连接起来
		$arrTag=$relationship->join("left join tag on relationship.tag_id=tag.tag_id")->where("art_id=$art_id")->getField('tag_name',true);
		$tags=implode(';', $arrTag);
		
		
		
		$oneArt=$art->field("art_id,title,cat_id,small_img,content")->where("art_id=$art_id")->find();
		$oneArt['tags']=$tags;
		$this->assign('oneArt',$oneArt);
		$this->display();	
	}
	
	function update(){
		check();
		if(empty($_POST)||empty($_POST['title'])||empty($_POST['content'])||empty($_POST['cat_id'])){	
			exit();
		}
		$url=U('Admin/Art/artList');
		$art_id=I('get.art_id');
		$small_img='';		
		$this->smallImgUpload($small_img);
		$title=$_POST['title'];
		$cat_id=$_POST['cat_id'];
		$content=$_POST['content'];
		
		$data['art_id']=$art_id;
		$data['title']=$title;
		$data['cat_id']=$cat_id;	
		if(!empty($small_img)){
			$data['small_img']=$small_img;
		}		
		$data['content']=$content;
		
		$art=M('Art');
		$art->data($data)->save();
		
		$tag=D('Tag');
		$relationship=D('Relationship');
		//存入tag,更新relationship表
		$this->tagInsert($art_id,$tag,$relationship);		
		//更新tag表的文章数,并删除没有文章的tag
		$this->tagArtNum($tag,$relationship);		
		//计算栏目下的文章数
		$this->catArtNum($art);						
		header("Location:$url");	
	}
	//计算栏目下的文章数
	function catArtNum($art){

		$cat=M('Cat');
		$artCatNum=$art->field("cat_id,count(*) as art_num")->group('cat_id')->select();
		foreach($artCatNum as $val){
			$cat->save($val);
			$cat_id[]=$val['cat_id'];		
		}
		$map['cat_id']=array('not in',$cat_id);
		//将没有文章的栏目数目置0
		foreach($map as $val){
			$data['cat_id']=$val;
			$data['art_num']=0;
			$cat->save($data);
		}
	}
	
	function tagArtNum(&$tag,$relationship){

		$artTagNum=$relationship->field("tag_id,count(*) as art_num")->group('tag_id')->select();
		foreach($artTagNum as $val){
			$tag_id[]=$val['tag_id'];
			$tag->save($val);
		}
		$map['tag_id'] = array('not in',$tag_id);
		$tag->where($map)->delete();
		//批量删除没有文章的tag
		//$tag->where('art_num = 0')->delete();
	}
	//更新tag表和relationship表
	function tagInsert($art_id,&$tag,&$relationship){
		if(!empty($_POST['tags'])){
			//插入tag表，去除其中的重复元素
			$tags =preg_replace("/\s|　/","",$_POST['tags']);
			
			if(!empty($tags)){			
				$arrTags=explode(';', str_replace(array('；',',','，'),';',$tags));
				//去除元素中的空元素
				$arrTags=array_diff($arrTags,['']);
				//去除数组中的重复值
				$arrTags=array_unique($arrTags);
				//如果表是空的时，下面这一个得到的值为null,而不是空数组
				$allTags=$tag->getField('tag_name',true);
				if(!isset($allTags)){
					$allTags=array();
				}
				//返回在第一个数组但不在第二个数组中的元素的数组
				$arrTagsDiff=array_diff($arrTags,$allTags);
				if(count($arrTagsDiff)){
					sort($arrTagsDiff);				
					$tag->insert($arrTagsDiff);
				}
				
				//找出本文章对应的tag_id
				$data2['tag_name']=array('in',$arrTags);
				//$arrTag_id是一个索引数组			
				$arrTag_id=$tag->where($data2)->getField('tag_id',true);
				//删除relationship表中有的$art_id对应的关系
				$relationship->where("art_id=$art_id")->delete();
				//插入relationship表
				$relationship->insert($art_id,$arrTag_id);					
			}				
		}
	}
	
}