<!doctype html>
<html lang="en">
 <head>
	<meta charset="UTF-8">
	<title>叮叮网:联系我们</title>
	<link href="images/logo.ico" rel="icon" type="images/ico-x">
	<link href="style.css" rel="stylesheet" type="text/css">
 </head>
 <body>
	<!--页眉-->
	<div id="head-wrapper">
		<!--网站logo-->
		<header class="container">
			<div id="logo">
				<a href="ddStore.php"><h1>叮叮书店</h1></a>
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
					<li><a href="ddStore.php">首页</a></li><li>
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
			<section><span style="font-size:1.6em;">您现在的位置:&nbsp;</span>
				<a href="ddStore.php">首页</a>&gt;&gt;<span style="font-size:1.4em;">联系我们<span>
			</section>
			<section class="contacts">
				<h2 id="title10">联系我们</h2>
				<section>
					<p class="details">叮叮书店成立于2010年6月，是由教育部主管、清华大学主办的综合出版单位。植根于“清华”这座久负盛名的高等学府，秉承清华人“自强不息，厚德载物”的人文精神。</p>
					<fieldset class="contact-form">
					<legend class="form-subtitle">需要填写以下内容</legend>
					<form action="contact.php" id="contact" method="post">
					<div id="center-left">	
						<div class="form-row">
							<label class="contact"><strong>姓名:</strong>
							<input type="text" id="name" name="name" required placeholder="必填" autofocus class="contact-input" style="width:60px;">
							</label>
						</div>
						<div class="form-row">
							<label class="contact"><strong>性别:</strong>
								<label>
								<input type="radio" id="sex1" name="sex" value="男" checked="checked">男
								</label>
								<label>
								<input type="radio" id="sex2" name="sex" value="女">女
								</label>
							</label>
						</div>
						<div class="form-row">
							<label class="contact"><strong>年龄范围:</strong>
							<select name="age" size="1" id="age">
								<option value="1">18岁以下</option>
								<option value="2" selected="selected">18-28岁</option>
								<option value="3">28-38岁</option>
								<option value="4">38-48岁</option>
								<option value="5">48岁以上</option>
							</select>
							</label>
						</div>
						<div class="form-row">
							<label class="contact"><strong>爱好:</strong>
							<label>
								<input type="checkbox" id="interest1" name="interest[]" value="网络">网络
							</label>
							<label>
								<input type="checkbox" id="interest2" name="interest[]" value="数据库">数据库
							</label>
							<label>
								<input type="checkbox" id="interest3" name="interest[]" value="编程">编程
							</label>
							</label>
						</div>
						<div class="form-row">
							<label class="contact"><strong>电子邮件:</strong>
								<input type="email" id="dzyj" name="dzyj" required placeholder="必填" class="contact-input">
							</label>
						</div>
						<div class="form-row">
							<label class="contact"><strong>固定电话:</strong>
								<input type="text" id="telephone" name="telephone" pattern="[0-9]{11}" required placeholder="必填" class="contact-input" style="width:100px;">
							</label>
						</div>
						<div class="form-row">
							<label class="contact"><strong>公司:</strong>
								<input type="text" id="company" name="company" required placeholder="必填" class="contact-input">
							</label>
						</div>
						<div class="form-row">
							<label class="contact"><strong>内容:</strong>
								<textarea id="contents" name="contents" cols="20" rows="3" class="contact-input"></textarea>
							</label>
						</div>
						<div class="form-row-buttom">
							<input type="reset" value="重置" class="send">&nbsp;&nbsp;
							<input type="submit" value="提交" class="send">
						</div>
					</div>
					</form>
					</fieldset>
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
				<a href="ddStore.php">首页</a> <a href="about.php">关于我们</a> <a href="#">服务条款</a> <a href="#">隐私策略</a> <a href="contact_form.php">联系我们</a>
			</section>
		</footer>
	</div>

	<!--版本标志-->
	<section id="copyright" class="container">
	Copyright &copy <a href="ddStore.php">叮叮书店</a> 2016-2018，All Rights Reserved | 京 ICP 证000001 号音像制品经营许可证
		<address>通信地址：广州航海学院学生宿舍b5栋810&nbsp;&nbsp;电话：15767232209&nbsp;&nbsp;网管信箱：1325286933@qq.com
		</address>
	</section>
 </body>
</html>