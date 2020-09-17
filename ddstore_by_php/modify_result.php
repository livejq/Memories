<?php
	require_once('ddstore_fns.php');
	$password = trim($_POST['password']);
	$password2 = trim($_POST['password2']);
	
	session_start();
	@$name = $_SESSION['name'];
	unset($_SESSION['name']);
	
	if($password!=$password2){
		$_SESSION['error_msg'] = '您两次输入的密码不一致';
		header("location:modify_form.php");
	}else if((strlen($password)<6)||(strlen($password)>12)){
		$_SESSION['error_msg'] = '您填写的密码不符合规定长度，请修改后重试！';
		header("location:modify_form.php");
		
	}else{
		$update = db_connect();
		$result = $update->query("update 用户 set 密码 = sha1('".$password."') where 用户名 = '".$name."'");
		if(!$result){
			$_SESSION['error_msg'] = '请检查各项参数是否正确';
			header("location:modify_form.php");
		}else{
			do_html_header('修改成功 - 叮叮网');
				echo '<div class="login_successful"><p>修改成功!...3秒后跳转至<mark>登录页面</mark></p></div>';
				header("refresh:3;url=login_form.php");
		}
	}
?>