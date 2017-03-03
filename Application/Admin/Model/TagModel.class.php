<?php
namespace Admin\Model;
use Think\Model;
class TagModel extends Model{
	//$tag_name应该是数组型
	function insert($tag_name){
		$str="('".$tag_name[0]."')";
		for($i=1;$i<count($tag_name);$i++){
			$str.=",('".$tag_name[$i]."')";
		}
		$sql="insert ignore into tag(tag_name) values".$str;
		$Model = new \Think\Model();
		$numAffects=$Model->execute($sql);
		return $numAffects;		
	}
	
}
?>