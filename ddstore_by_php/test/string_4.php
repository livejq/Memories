<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>String_4</title>
<?php 
	$feedback = 'I\'m glad to send my advices to you!"What a big surprise for me!"he\'d like to say."<br/>"';
	echo $feedback;//n12br()将一串长字符串中的\n换成<br/>,HTML忽略纯空格
	
	//addslashes()所有引号都加上反斜杠
	$feedback_2 = addslashes(trim($feedback));
	echo $feedback_2;
	//stripslashes()会移除这些
	$feedback_3 = stripslashes(trim($feedback_2));//ltrim和rtrim
	echo $feedback_3;
	
	//分割
	$fromaddress = 'From:webserver@example.com';
	$address = explode('@',$fromaddress);
	foreach($address as $i):
	echo $i.'<br/>';
	endforeach;
	//连接
	$ar = implode('@',$address);
	echo $ar.'<br/>';
	/*
	//一次只能取出一些片段（称为令牌），但更容易取出一个单词
	$token = strtok($feedback,'"');
	echo $token.'<br/>';
	while($token!=""):
	$token = strtok(" ");
	echo $token.'<br/>';
	endwhile;
	
	//比较（部分匹配和其它情况）
	echo strcmp(2,12).'<br/>';//按字典顺序
	echo strcmp('abc','ABC').'<br/>';
	//返回0相等，正数：前者大，负数：后者大
	echo strcasecmp(2,12).'<br/>';
	echo strcasecmp('abc','ABC').'<br/>';//不区分大小写
	
	echo strnatcmp(2,12).'<br/>';
	//nature,自然排序，按人们的习惯
	echo strnatcmp('abc','ABC').'<br/>';
	
	//起点和终点之间的字符
	echo substr('ok!good luck',-1).'<br/>';
	echo substr('ok!gook luck',0,2).'<br/>';
	echo strlen('abc').'<br/>';
	
	//查找字符串
	echo strstr($feedback,'glad').'<br/>';
	echo strchr($feedback,'glad').'<br/>';
	echo stristr('DIRECT,direct,ok?','direct').'<br/>';
	//i=ignore,忽略大小写
	echo strrchr($feedback,'to').'<br/>';
	echo strpos('Hello world!','o').'<br/>';
	$say = 'Hello world!';
	echo strpos($say,'wod').'<br/>';//返回子字符串中第一个与之开头相匹配的字符位置，无返回false
	echo strpos($say,'o',5).'<br/>';//affset参数指定开始搜索位置
	//strrpos()与strpos几乎相同，但返回的是最后一次目标关键字子字符串的位置
	$result = strpos($say,'h');//区分大小写
	if($result===false){
		echo 'Not found.'.'<br/>';
	}else{
		echo 'Found at position.'.'<br/>';
	}
	//替换子字符串
	$fb = str_replace('to','%!@*',$feedback);
	echo $fb.'<br/>';
	$sub = substr_replace($say,'X',1,4);
	echo $sub.'<br/>';
	*/
	print '两种风格的正则表达式,POSIX和Perl'.'<br/>';
	
		
?>
</head>
<body>
</body>
</html>