<?php
namespace Front\Controller;
use Think\Controller;
class ArtController extends Controller {	
	function artPage(){
		$url=U("Front/First/firstPage");
		if(empty($_GET['art_id'])||!is_numeric($_GET['art_id'])){
			header("location:$url");
			exit();
		}
		
		$art=M('Art');
		$maxId=$art->max('art_id');
		$minId=$art->min('art_id');
		$art_id=$_GET['art_id'];
		if($art_id>$maxId||$art_id<$minId){
			header("location:$url");
			exit();
		}
		$oneArt = $art->field('art_id,title,pubtime,content,small_img,cat_name')->join("left join cat on art.cat_id=cat.cat_id")->
			where("art_id=$art_id")->find();
			
		$relationship=M('Relationship');
		$tags=$relationship->field('relationship.tag_id,tag_name')->join('left join tag on relationship.tag_id=tag.tag_id')->where("art_id=$art_id")->select();
		$this->assign("tags",$tags);
		$this->assign("oneArt",$oneArt);
		$this->display();
	}
}
?>