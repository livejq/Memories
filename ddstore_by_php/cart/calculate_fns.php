<?php
function calculate_price($cart){
	$price = 0.00;
	if(is_array($cart)){
		$conn = db_connect();
		foreach($cart as $isbn =>$qty){
			$query = "select 定价,折扣 from 图书 where ISBN = '".$isbn."'";
			$result = $conn->query($query);
			if($result){
				$item = $result->fetch_object();
				$item_price = round($item->定价*0.1*$item->折扣,2);
				$price += $item_price*$qty;
			}
		}
	}
	return $price;
}

function calculate_items($cart){
	$items = 0;
	if(is_array($cart)){
		foreach($cart as $isbn => $qty){
			$items += $qty;	
		}
	}
	return $items;
}
?>