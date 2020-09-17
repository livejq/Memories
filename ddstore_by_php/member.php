<?php
	require_once('ddstore_fns.php');
	session_start();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	@$autologin = $_POST['autologin'];
	
	if($username&&$password){
			$user=login($username,$password);
			$_SESSION['valid_user'] = $user;
			if(empty($user)){
				$_SESSION['error_msg']='用户名或密码错误！请核对后重试';
				header("location:login_form.php");
			}else{
				if(!empty($autologin)){
					setcookie("username",$username,time()+3600*24*7);
					setcookie("password",$password,time()+3600*24*7);	
				}
				do_html_header('登录成功 - 叮叮网');
	echo '<div class="login_successful" class="container"><p>登录成功!...3秒后跳转至<mark>叮叮首页</mark></p></div>';
				header("refresh:3;url=ddstore.php");
			}
	}
?>