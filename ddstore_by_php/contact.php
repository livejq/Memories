<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>叮叮网:联系我们</title>
		<link href="images/logo.ico" rel="icon" type="images/ico-x">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
<body>
<body>
	<!--页眉-->
	<div id="head-wrapper">
		<!--网站logo-->
		<header class="container">
			<div id="logo">
				<a href="ddstore.php"><h1>叮叮书店</h1></a>
			</div>
			<div id="search">
				<form action="results.php" method="post">
				<input name="searchterm" type="search" placeholder="站内搜索"><select name="searchtype">
						<option value="全部分类">全部分类</option>
						<option value="书名">书名</option>
						<option value="作者">作者</option>
						<option value="ISBN">ISBN</option>
					</select><input name="submit" type="submit" value="" style="width:2.5em;">
				</form>
			</div>
		</header>
		<!--登录-->
        <div class="client"><a href="#"><?php require_once('ddstore_fns.php');check_valid_user();?></a><a href="login_form.php">登录</a><a href="register_form.php">注册</a><a href="logout.php">退出</a></div>
		<!--导航菜单-->
		<div id="nav">
			<nav class="container">
				<ul>
					<li><a href="ddstore.php">首页</a></li><li>
					<a>书籍分类</a>
						<?php require_once('book_sc_fns.php');$cat_array = get_categories();display_categories($cat_array); ?>
					</li><li>
					<a href="specials.php">特刊降价</a></li><li>
					<a href="contact_form.php">联系我们</a></li><li>
					<a href="about.php">关于我们</a></li><li id="menu-logo">
					<a href="my_cart.php">购物车<?php echo '<span style="color:#ff0000;margin-left:5px;font-weight;bolder;">'.$_SESSION['items'].'</span>';?></a></li>
				</ul>
			</nav>
		</div>
	</div>

	<!--内容-->
	<div id="content-wrapper" class="container">
		<!--内容区-->
		<article>
			<section>
				<a href="ddstore.php">首页</a>&gt;&gt;<span style="font-size:1.4em;">提交<span>
			</section>
			<section class="contacts">
				<h2 id="title15">提交结果：</h2>
				<section>
					<?php 
					
						
					    $name = $_POST['name'];
                        $sex = $_POST['sex'];
                        $age = $_POST['age'];
						$hobby = '';
                        $dzyj = $_POST['dzyj'];
                        $telephone = $_POST['telephone'];
                        $company = $_POST['company'];
                        $contents = $_POST['contents'];
						
                        switch($age):
                          case 1:
                            $age='18岁以下';
                            break;
                          case 2:
                            $age='18~28岁';
                            break;
                          case 3:
                            $age='28~38岁';
                            break;
                          case 4:
                            $age='38~48岁';
                            break;
                          case 5:
                            $age='48岁以上';
                            break;	
                          default:
                            echo '未知!';
                            break;
                        endswitch;	
						
						if(@count($_POST['interest'])==0)
                            $hobby .= '未选';
                        else{
                            $interest = $_POST['interest'];
                            for($i=0;$i<count($interest);$i++){
                                $hobby .= $interest[$i];
                                if(($i+1)!=count($interest))
                                    $hobby .= '、';
                            }
                        }
                       /*
					    echo '<div class="check">';
                        echo "<span>姓名：$name</span><br>";
                        echo "<span>性别：$sex</span><br>";
                        echo "<span>年龄：$age</span><br>";
                        echo "<span>爱好：";
                        if(@count($_POST['interest'])==0)
                            echo '未选';
                        else{
                            $interest = $_POST['interest'];
                            for($i=0;$i<count($interest);$i++){
                                echo $interest[$i];
                                if(($i+1)!=count($interest))
                                    echo '、';
                            }
                        }
                        echo '</span><br>';
                        echo "<span>电子邮件：$dzyj</span><br>";
                        echo "<span>固定电话：$telephone</span><br>";
                        echo "<span>公司：$company</span><br>";
                        echo "<span>内容：$contents</span><br><br>";
						
						echo '<span>您确定要提交上述信息？</span><br>';
						echo '<form action="confirm.php" method="post" >';
						echo '<input type="hidden" id="confirm" name="confirm" value="1">';
						echo '<div class="form-row-buttom">';
						echo '<input type="reset" value="取消" class="send">';
						echo '&nbsp;&nbsp;';
						echo '<input type="submit" value="确定" class="send"';
						echo 'onclick="this.form.confirm.value="2"">';
						echo '</div></form>';
						echo '</div><br><br>';
						*/
							/*$msg = '来自'.$name.'的一封邮件:';
							$msg .='<br>性别：'.$sex;
							$msg .='<br>年龄范围:'.$age;
							$msg .='<br>爱好:'.$hobby;
							$msg .='<br>邮箱地址:'.$dzyj;
							$msg .='<br>手机号码:'.$telephone;
							$msg .='<br>所属公司:'.$company;
							$msg .='<br>内容：'.$contents;
							*/
							$to = "15767232209@163.com";
							$subject = "网站反馈";
							$msg = "<html><head><meta charset='utf-8'></head><body style='background-color:gray;'><h4>来自 $name 的一封邮件:</h4><div style='padding-left:20px;padding-top:5px;font-size:0.7em;'><strong>性别：</strong>$sex<br><strong>年龄范围:</strong>$age<br><strong>爱好:</strong>$hobby<br><strong>邮箱地址:</strong>.$dzyj<br><strong>手机号码:</strong>$telephone<br><strong>所属公司:</strong>.$company<br><strong>内容：</strong>$contents<br></div></body></html>";	
							$headers = "X-Mailer:PHP";
							$headers .= "MIME-Version: 1.0";
							$headers .= "PHP-Version:phpversion()\r\n";
							$headers .= "Content-Type:text/html;charset=utf-8\r\n";
							$headers .= "From:15767232209@163.com\r\n";
							$headers .= "Reply-To:15767232209@163.com\r\n";
							
							/*
							$msg = wordwrap($msg,70);
							$mail = new PHPMailer;
							$mail->CharSet = "UTF-8";
							$mail->isSMTP();
							$mail->SMTPAuth = true;
							$mail->SMTPSecure = "SSL";
							$mail->Host = "smtp.163.com";
							$mail->Port = 25;
							$mail->Username = "15767232209@163.com";
							$mail->Password = "123boygirlabcde";
							$mail->addReplyTo($to,$name);
							$mail->Subject = $sub;
							$mail->AltBody = "为了查看该邮件，请切换到支持 HTML 的邮件客户端";
							$mail->msgHTML($msg);
							$mail->addAddress('reminder@sendmail.dingding.com','叮叮网');
							$mail->addAttachment("images/addressbook.png");
							!$mail->send()
							
							$result = html_mail("消息提醒<15767232209@163.com>","用户<1325286933@qq.com","这是一封测试邮件","<html><body><h1 style='color:red'>亲爱的用户：您有一则消息未读</h1></body></html>");	*/
							if(!@mail($to,$subject,$msg,$headers)){
								echo '<img class="warning" src="images/error.png">';			
								echo '<div id="sorry" style="font-size:1.5em;margin:30px 30px;"><p>遇到未知错误！无法提交相关信息</p><br/>'.'<a href="contact_form.php" style="font-size:1.0em">返回前一页</a></div>';
							}
							else{
								echo '<img class="warning" src="images/success.png">';			
								echo '<div id="sorry" style="font-size:1.9em;margin:30px 30px;"><p>提交成功！</p><br/>'.'<a href="ddstore.php" style="font-size:1.0em">返回主页</a></div>';
							}
                    ?>
            	</section>
           	</section>
		</article><aside><!--使用inline-block的这两个连续的标签,若要水平呈现多个元素，则必须去掉在两个标签代码之间的换行符（因为换行符会产生空格）-->
			<!--广告区-->
			<section id="advert">
				<a href="#"><img src="images/ad1.jpg" alt="广告"></a>
				<a href="#"><img src="images/ad2.jpg" alt="广告"></a>
				<a href="#"><img src="images/ad3.png" alt="广告"></a>
			</section>
			<!--畅销图书-->
			<section id="best-selling">
				<h2 id="title7">畅销图书</h2>
				<ul>
					<li><a class="selling" href="#">查令十字街 84 号（珍藏版）（汤唯、吴秀波主演北京遇上西雅图2）</a>
						<div class="curr">
							<div class="p-img">
								<a title="查令十字街 84 号（珍藏版）（汤唯、吴秀波主演北京遇上西雅图2）" href="#"><img src="images/查令十字街 84 号（珍藏版）（汤唯、吴秀波主演北京遇上西雅图2）.jpg" width="95";height="95"></a>
							</div> <div class="p-name" style="width:150px;">
								查令十字街 84 号（珍藏版）（汤唯、吴秀波主演北京遇上西雅图2）
								<strong>&yen;43.50</strong>
								<del>&yen;52.00</del>
							</div>
						</div>
					</li>
					<li><a class="selling" href="#">分享经济 供给侧改革的新经济方案</a>
						<div class="curr">
							<div class="p-img">
								<a title="分享经济 供给侧改革的新经济方案" href="#"><img src="images/分享经济 供给侧改革的新经济方案.jpg" width="95";height="95"></a>
							</div> <div class="p-name" style="width:150px;">
								分享经济 供给侧改革的新经济方案
								<strong style="margin-top:16px;">&yen;43.50</strong>
								<del>&yen;52.00</del>
							</div>
						</div>
					</li>
				</ul>
			</section>
			<!--图书分类-->
			<section class="aside-section">
				<h2 id="title4">图书分类</h2>
				<ul>
					<li><a href="category.php">编程语言</a></li>
					<li><a href="category.php">数据库</a></li>
					<li><a href="category.php">图形图像</a></li>
					<li><a href="category.php">网页制作</a></li>
					<li><a href="category.php">考试认证</a></li>
				</ul>
			</section><section class="aside-section">
				<h2 id="title5">合作伙伴</h2>
				<ul>
					<li><a href="#">中国电子商务研究中心</a></li>
					<li><a href="#">清华大学出版社</a></li>
					<li><a href="#">中国人民大学出版社</a></li>
					<li><a href="#">中国社会科学出版社</a></li>
				</ul>
			</section>
			<!--关于书店-->
			<section class="about">
				<h2 id="title6">关于书店</h2>
				<img src="images/about.jpg" alt="叮叮书店"><p>叮叮书店成立于2010年6月，是由教育部主管、清华大学主办的综合出版单位。植根于“清华”这座久负盛名的高等学府，秉承清华人“自强不息，厚德载物”的人文精神。</p>
			</section>
		</aside>
	</div>

	<!--页脚导航-->
	<div id="footer-wrapper">
		<footer class="container">
			<section>
				<a href="ddstore.php">首页</a> <a href="about.php">关于我们</a> <a href="#">服务条款</a> <a href="#">隐私策略</a> <a href="contact_form.php">联系我们</a>
			</section>
		</footer>
	</div>

	<!--版本标志-->
	<section id="copyright" class="container">
	Copyright &copy <a href="ddstore.php">叮叮书店</a> 2016-2018，All Rights Reserved | 京 ICP 证000001 号音像制品经营许可证
		<address>通信地址：广州航海学院学生宿舍b5栋810&nbsp;&nbsp;电话：15767232209&nbsp;&nbsp;网管信箱：1325286933@qq.com
		</address>
	</section>
</body>
</html>