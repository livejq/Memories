<?php
	require_once('ddstore_fns.php');
	session_start();
	
	$old_user = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	setcookie("username");
	setcookie("password");
	$result_dest = session_destroy();
	
	if(!empty($old_user)){
		if($result_dest){
			header("location:ddstore.php");	
		}else{
			do_html_header('无法退出 - 叮叮网');
	echo '<div class="login_successful"><p>退出失败!...3秒后跳转至<mark>叮叮首页</mark></p></div>';
			header("refresh:3;url=ddstore.php");
		}
	}else{
		header("location:login_form.php");
	}
?>