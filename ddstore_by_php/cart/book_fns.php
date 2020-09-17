<?php
function get_categories(){
	$conn = db_connect();
	$query = "select catid,catname from 目录;";
	$result = @$conn->query($query);
	if(!$result){
		return false;
	}
	$num_cats = @$result->num_rows;
	if($num_cats==0){
		return false;	
	}
	$result = db_result_to_array($result);
	return $result;
}

function get_books($catid){
	$conn = db_connect();
	$query = "select * from 图书 where catid = '".$catid."'";
	$result = @$conn->query($query);
	if(!$result){
		return false;
	}else{
		$num_cats = @$result->num_rows;
		if($num_cats==0){
			return false;	
		}else{
			$result = db_result_to_array($result);
			return $result;
		}
	}
}

function get_book_details($isbn){
	$conn = db_connect();
	$query = "select * from 图书 where ISBN = '".$isbn."'";
	$result = @$conn->query($query);
	if(!$result){
		return false;
	}else{
		$num_cats = @$result->num_rows;
		if($num_cats==0){
			return false;	
		}else{
			$row = $result->fetch_assoc();;
			return $row;
		}
	}
}

function get_category_name($catid){
	$conn = db_connect();
	$query = "select catname from 目录 where catid = '".$catid."'";
	
	$result = @$conn->query($query);
	
	if(!$result){
		return false;	
	}
	$num_cats = $result->num_rows;
	if($num_cats==0){
		return false;	
	}
	$row = $result->fetch_object();
	return $row->catname;
}
?>