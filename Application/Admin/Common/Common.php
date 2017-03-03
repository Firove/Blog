<?php

    function check(){
    	$url1=U('Front/First/firstPage');
    	session_start();
		if(empty($_SESSION['user_id'])){
			header("Location:$url1");
			exit();
		}
	}
?>
       