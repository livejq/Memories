<?php
	require_once('book_sc_fns.php');
	/*if(!isset($_SESSION)){
		session_start();
	}*/
	$catid = $_GET['catid'];
	$name = get_category_name($catid);
	
	do_html_header($name.' - 叮叮书店');
	do_html_section($name);
	$book_array = get_books($catid);
	
	display_books($book_array);
	/*
	if(isset($_SESSION['admin_user'])){
		display_button("index.php","continue","Continue Shopping");
		display_button("index.php","continue","Continue Shopping");
		display_button("index.php","continue","Continue Shopping");
	}else{
		display_button("index.php","continue","Continue Shopping");	
	}
	*/
	
	do_html_aside();
	do_html_footer();
?>