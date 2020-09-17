<?php
	//define('METHOD','SOAP');
	define('METHOD','REST');
	
	define('CACHE','E:\\aws_cache');
	define('ASSOCIATED','liveJQ');
	define('DEVTAG','');
	
	if(DEVTAG==''){
		die("You need to sign up for an Amazon.com developer tag at 
			<a href=\"https://aws.amazon.com/\">Amazon</a>
			when you install this software. You should probably sign up for an associate ID
			at the same time. Edit the file constants.php.");		
	}
	
	$categoryList = array(5 => 'Computer & Internet',3510 => 'Web Development',295223 => 'PHP',
					17 => 'Literature and Fiction',3 => 'Business & Investing', 53 => 'Non Fiction',
					23 => 'Romance',75 => 'Science',21 =>'Reference',6 => 'Food & Wine',27 =>'Travel',
					16272 => 'Science Fiction'
					);
					
?>