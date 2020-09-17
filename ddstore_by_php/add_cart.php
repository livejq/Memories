<?php
	require_once('book_sc_fns.php');
	@$new = $_GET['new'];
	
	
	if(!isset($_SESSION))
		session_start();
	
	if($new){
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
			$_SESSION['items'] = 0;
			$_SESSION['total_price'] = 0.00;	
		}	
		if(isset($_SESSION['cart'][$new])){
			$_SESSION['cart'][$new]++;	
		}else{
			$_SESSION['cart'][$new] = 1;	
		}
		
		$_SESSION['total_price'] = calculate_price($_SESSION['cart']);
		$_SESSION['items'] = calculate_items($_SESSION['cart']);
	}
	
	do_html_header('加入购物车 - 叮叮网');
	$book = get_book_details($new);
	do_html_add_successful($book);
	do_html_footer();
	
?>