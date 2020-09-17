<?php
	require_once('book_sc_fns.php');
	@$new = $_GET['new'];
	
	if(!isset($_SESSION))
		session_start();
	
	if($new){
		if(isset($_SESSION['cart'][$new])){
			$_SESSION['cart'][$new]++;	
		}else{
			$_SESSION['cart'][$new] = 1;	
		}
		
		$_SESSION['total_price'] = calculate_price($_SESSION['cart']);
		$_SESSION['items'] = calculate_items($_SESSION['cart']);
	}
	
	if(isset($_POST['save'])){
		foreach($_SESSION['cart'] as $isbn => $qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart'][$isbn]);	
			}else{
				$_SESSION['cart'][$isbn] = $_POST[$isbn];	
			}
		}
		
		$_SESSION['total_price'] = calculate_price($_SESSION['cart']);
		$_SESSION['items'] = calculate_items($_SESSION['cart']);
	}

	do_html_header('我的购物车 - 叮叮网');
	
	if(@($_SESSION['cart'])&&@(array_count_values($_SESSION['cart']))){
		display_cart($_SESSION['cart']);
		
	}else{
		echo "<p style=\"font-size:1.7em;font-family:\"宋体\";fong-weight:lighter\" class=\"container\">您还没有添加任何商品！</p>";		
	}
	do_html_footer();
?>