<?php
function register($username,$password,$email){
	$conn = db_connect();
	$result = $conn->query("select * from 用户 where 用户名='".$username."'");
	
	if(!$result){
		echo ('查询失败！请检查各项参数是否正确');	
	}
	if($result->num_rows>0){
		echo ('该用户名已存在，请重新申请！');
	}
	$result2 = $conn->query("insert into 用户 values('".$username."',sha1('".$password."'),'".$email."')");
	if(!$result2){
		echo ('注册失败！请检查后重新尝试');	
	}
	return true;
}
?>
<?php
function login($username,$password){
	$conn = db_connect();
	$result = $conn->query("select * from 用户 where 用户名 = '".$username."' and 密码 = sha1('".$password."')");
	if(!$result){
		exit('未知错误！请检查连接MySQL服务的各项参数！');	
	}
	else if($result->num_rows>0){
		return $username;	
	}else{
		return;	
	}
		
}
?>
<?php
function check_valid_user(){
	if(!isset($_SESSION))
		session_start();
	if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
			$_SESSION['items'] = 0;
			$_SESSION['total_price'] = 0.00;	
		}	
	if(empty($_SESSION['valid_user'])){
		if(empty($_COOKIE['username'])||empty($_COOKIE['password'])){
			echo "未登录，请先";
		}
		else{
			$user=login($_COOKIE['username'],$_COOKIE['password']);
			if(empty($user)){
				echo "未登录，请先";
			}else{
				$_SESSION['valid_user'] = $user;
				echo 'Hi ！'.$_SESSION['valid_user'].',欢迎回来';
			}
		}
	}else{
		echo 'Hi ！'.$_SESSION['valid_user'].',欢迎回来';	
	}
}
?>