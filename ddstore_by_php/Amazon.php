<?php
	session_start();
	
	require_once('aws_fns.php');
	
	$external = array('action','ASIN','mode','browseNode','page','search');
	
	foreach($external as $e){
		if(@$_REQUEST[$e]){
			$$e = $_REQUEST[$e];	
		}else{
			$$e = '';	
		}
		$$e = trim($$e);
	}
	
	if($mode==''){
		$mode = 'Book';	
	}
	if($browseNode==''){
		$browseNode = 53;	
	}
	if($page==''){
		$page = 1;	
	}
	if(!preg_match('/^[A-Z0-9]+$/',$ASIN)){
		$ASIN = '';
	}
	if(!preg_match('/^[a-z]+$/',$mode)){
		$mode = 'Book';	
	}
	$page = intval($page);$browseNode = intval($browseNode);
	
	$search = safeString($search);//?????????????????????
	
	if(!isset($_SESSION['cart'])){
		session_register('cart');
		$_SESSION['cart'] = array();	
	}
	
	if($action=='addtocart'){
		addToCart($_SESSION['cart'],$ASIN,$mode);	
	}
	if($action=='deletefromcart'){
		deleteFromCart($_SESSION['cart'],$ASIN);	
	}
	if($action=='emptycart'){
		$_SESSION['cart'] = array();	
	}
	
	require_once('topbar.php');
	
	switch($action){
		case 'detail':
			showCategories($mode);
			showDetail($ASIN,$mode);
			break;
			
		case 'addtocart':
		case 'deletefromcart':
		case 'emptycart':
		case 'showcart':
			echo "<hr /><h1>Your Shopping Cart</h1>";
			showCart($_SESSION['cart'],$mode);
			break;
			
		case  'image':
			showCategories($mode);
			echo "<h1>Large Product Image</h1>";
			showImage($ASIN,$mode);
			break;
			
		case 'search':
			showCategories($mode);
			echo "<h1>Search Results For ".$search."</h1>";
			showSearch($search,$page,$mode);
			break;
			
		case 'browsenode':
		default:
			showCategories($mode);
			$category = getCategoryName($browseNode);
			if(!$category||($category=='Best Selling Book')){
				echo "<h1>Current Best Sellers</h1>";	
			}else{
				echo "<h1>Current Best Sellers in ".$category."</h1>";
			}
			showBrowseNode($browseNode,$page,$mode);
			break;
	}
	require('bottom.php');
?>