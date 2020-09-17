<?php
	require_once('ddstore_fns.php');
	$codes = $_POST['codes'];
	session_start();
	$codes2 = $_SESSION['codes'];
	unset($_SESSION['codes']);
	
	if($codes==$codes2){
		header("location:modify_form.php");
	}else{
		$_SESSION['error_msg'] = '验证码错误！请重试';
		header("location:find_password_form.php");
	}
	
?>