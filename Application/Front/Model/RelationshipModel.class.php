<?php
namespace Front\Model;
use Think\Model;
class RelationshipModel extends Model{
	//$tag_id应该是数组型,$art_id是一个整型
	function select(){
		$model=M();
		$sql="select art_id,GROUP_CONCAT(tag_name) as tag_str from relationship left join tag on relationship.tag_id=tag.tag_id group by art_id";
		$arr=$model->query($sql);
		return $arr;
	}
}
?>