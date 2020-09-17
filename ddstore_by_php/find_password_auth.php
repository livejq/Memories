<?php
	require_once('ddstore_fns.php');
	@$username = $_POST['username'];
	session_start();
	
	if(empty($username)){
		$_SESSION['error_msg'] = '请先输入用户名！';
		header("location:find_password_form.php");
	}
	else{
	$db_conn = db_connect();
	$result = $db_conn->query("select * from 用户 where 用户名='".$username."'");
	
	if(!$result){
		$_SESSION['error_msg'] = '查询失败！请检查各参数是否正确';
		header("location:find_password_form.php");	
	}else if($result->num_rows==0){
		$_SESSION['error_msg'] = '该用户名不存在，请重新输入！';
		header("location:find_password_form.php");
	}else{
		$row = $result->fetch_assoc();
		
		$to = trim($row['邮箱']);
		$subject = "验证码";
		$codes = randomkeys(6);	
		$_SESSION['codes'] = $codes;
		$_SESSION['name'] = $username;
			
$msg = "<html><head><meta charset='utf-8'></head><body style='background-color:#cc9900;'><h2 style='color:#ff0000;margin-left:20px;'>叮叮网</h2><br><br><div style='width:97px;background-color:#00cc00;margin:0px auto;font-size:1.5em;'>验证码：</div><br><div style='width:100px;margin:0px auto;font-size:1.5em;'>$codes</div><p style='font-size:1.2em;text-index:2em;margin-top:50px;text-indent:2em;'>【叮叮网】您正在找回登录密码，验证码告知他人将导致数据信息被盗，请勿泄漏</p></body></html>";
	
		$headers = "X-Mailer:PHP";
		$headers .= "MIME-Version: 1.0";
		$headers .= "PHP-Version:phpversion()\r\n";
		$headers .= "Content-type:text/html;charset=utf-8\r\n";
		$headers .= "From:15767232209@163.com\r\n";
		$headers .= "Reply-To:15767232209@163.com\r\n";
		$headers .= "To:$to\r\n";
							
							
		if(!@mail($to,$subject,$msg,$headers)){
			$_SESSION['error_msg'] = '获取失败！请检查网络是否可用';
			header("location:find_password_form.php");	
		}else{
			$_SESSION['success_msg'] = '获取成功！请注意邮箱查收';
			header("location:find_password_form.php");	
		}
	}
	}
	
?>