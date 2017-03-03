<?php
namespace Front\Controller;
use Think\Controller;
class LoginController extends Controller {
	function login(){
		$this->display();
	}
	function confirm(){
		$url=U('Admin/Cat/catlist');
		$url1=U('Front/First/firstPage');
		if(empty($_POST['user_id'])||empty($_POST['user_pwd'])){
	
			header("Location:$url1");
			exit();
		}
		$user_id=$_POST['user_id'];
		$user_pwd=$_POST['user_pwd'];
		if($user_id=='123'&&$user_pwd=='123456'){
			header("Location:$url");
			session_start();
			$_SESSION['user_id']=$user_id;
		}else{
			header("Location:$url1");
		}
		
	}
}


?>