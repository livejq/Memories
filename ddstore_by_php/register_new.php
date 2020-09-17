<?php
	require_once('ddstore_fns.php');
	
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$password2 = trim($_POST['password2']);
	
	session_start();
	try{
		if(!filled_out($_POST)){
			throw new Exception('您还未填好相关信息，请填好后重试！');	
		}
		if(!valid_email($email)){
			throw new Exception('您填写的邮箱地址不合法，请修改后重试！');
		}
		if($password!=$password2){
			throw new Exception('您填写的密码不一致，请修改后重试！');	
		}
		if((strlen($password)<6)||(strlen($password)>12)){
			throw new Exception('您填写的密码不符合规定长度，请修改后重试！');	
		}
		register($username,$password,$email);
		
		$_session['valid_user'] = $username;
		
		do_html_header('注册成功 - 叮叮网');
				echo '<div class="login_successful"><p>注册成功!...3秒后跳转至<mark>登录页面</mark></p></div>';
				header("refresh:3;url=login_form.php");
	}
	catch(Exception $e){
		do_html_header("错误提示 - 叮叮书店");
		echo '<div class="login_successful"><p>$e->'.$e->getMessage().'</p></div>';
		exit;
	}
?>