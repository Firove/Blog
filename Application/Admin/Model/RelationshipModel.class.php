<?php
namespace Admin\Model;
use Think\Model;
class RelationshipModel extends Model{
	//$tag_id应该是数组型,$art_id是一个整型
	function insert($art_id,$tag_id){
		$str="(".$art_id.",".$tag_id[0].")";
		
		for($i=1;$i<count($tag_id);$i++){
			$str.=",(".$art_id.",".$tag_id[$i].")";
		}
		$sql="insert ignore into relationship(art_id,tag_id) values".$str;
		$Model = new \Think\Model();
		$numAffects=$Model->execute($sql);
		return $numAffects;		
	}
}
?>