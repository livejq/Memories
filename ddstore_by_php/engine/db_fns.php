<?php
function db_connect(){
	$db = new mysqli('localhost','root','liveJQ','book_sc');
	if(!$db){
		throw new Exception('抱歉！无法连接MySQL服务器');	
	}else{
		return $db;
	}
}

function db_result_to_array($result){
	$res_array = array();
	
	for($count=0;$row=$result->fetch_assoc();$count++){
		$res_array[$count] = $row;	
	}
	
	return $res_array;
}
?>