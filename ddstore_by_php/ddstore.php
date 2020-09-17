<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="liveJQ">
  <meta name="Keywords" content="书店，叮叮书店，网购图书，畅销书">
  <meta name="Description" content="叮叮书店是一个销售书籍的网上书店。">
  <meta name="robots" content="index,follow">
  <title>叮叮书店</title>
  <link href="images/logo.ico" rel="icon" type="image/x-ico">
  <link href="style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js/main.js"></script>
 </head>
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
        <div class="client"><a href="#"><?php require_once('book_sc_fns.php');check_valid_user();?></a><a href="login_form.php">登录</a><a href="register_form.php">注册</a><a href="logout.php">退出</a><div id="displaydate"></div><div id="displaytime">&nbsp;&nbsp;</div></div>
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
		<!--图片切换广告-->
		<div id="adv">
			<dl>
				<dt><a href="#" id="a1">1</a><a href="#" id="a2">2</a><a href="#" id="a3">3</a><a href="#" id="a4">4</a></dt>
				<dd><a href="#"><img src="images/b_ad1.jpg" alt="广告" id="advImage"></a>
				</dd>
			</dl>
		</div>
	<!--内容-->
	<div id="content-wrapper" class="container">
		<!--内容区-->
		<article>
			<section>
				<h2 id="title1">本周推荐</h2>
                <?php
					require_once('book_sc_fns.php');
					$conn = db_connect();
					$query = 'select * from 图书 where 是否推荐 = 1';
					$result = $conn->query($query);
					
					if(!$result){
						echo '<p>连接失败！ 请检查各项参数是否正确</p>';	
					}else if($result->num_rows==0){
						echo '<p>本周还未有推荐, 或许您可以随处看看</p>';
					}else{
						$num_results = $result->num_rows;
						for($i=0;$i<$num_results;$i++){
							$row = $result->fetch_assoc();
							echo '<section class="recommend">';
							echo '<h3>《'.$row['书名'].'》</h3>';
							echo '<a href="details.php?id='.$row['ISBN'].'"><img src="images/books/'.$row['ISBN'].'.jpg" alt="'.$row['书名'].'"></a><div class="recommend-content">';
							echo '<p style="color:white;">'.$row['编辑推荐'].'</p>';
						//	echo '<p style="color:white;">'.$row['作者简介'].'</p>';
							echo '</div>';
							echo '<div class="cartmore">';
							echo '	<a class="cart" href="add_cart.php?new='.$row['ISBN'].'">加入购物车</a> <a class="more" href="details.php?id='.$row['ISBN'].'">详细内容</a>';
							echo '</div>';
						echo '</section>';
						}
						echo '</section>';
					}

			echo '<section class="article-section">';
			echo '<h2 id="title2">最近新书<h2>';
					$query = 'select * from 图书 where 是否新书 = 1';
					$result = $conn->query($query);
					
					if(!$result){
						echo '<p>连接失败！ 请检查各项参数是否正确</p>';	
					}else if($result->num_rows==0){
						echo '<p>本周还未有新书, 或许您可以随处看看</p>';
					}else{
						$num_results = $result->num_rows;
						for($i=0;$i<$num_results;$i++){
							$row = $result->fetch_assoc();
							echo '<section>';
							echo '	<div class="effect-1">';
							echo '		<div class="image-box">';
							echo '		<img src="images/books/'.$row['ISBN'].'.jpg" alt="'.$row['书名'].'"></a>';
							echo '		</div>';
							echo '		<div class="text-desc">';
							echo '			<h3 style="font-size:0.75em;font-weight:500;family:"微软雅黑";">'.$row['书名'].'</h3>';
							echo '			<p style="font-size:0.7em;font-weight:lighter;color:white;">'.$row['编辑推荐'].'</p>';
							echo '		</div>
									</div>';
							echo '			<a class="btn" href="add_cart.php?new='.$row['ISBN'].'">加入购物车</a> <a class="btn" href="details.php?id='.$row['ISBN'].'">详细内容</a>';
							echo '</section>';
						}
						echo '</section>';
					}
					?>
           </article><aside><!--使用inline-block的这两个连续的标签,若要水平呈现多个元素，则必须去掉在两个标签代码之间的换行符（因为换行符会产生空格）-->
			<!--广告区-->
			<section id="advert">
				<a href="#"><img src="images/ad1.jpg" alt="广告"></a>
				<a href="#"><img src="images/ad2.jpg" alt="广告"></a>
				<a href="#"><img src="images/ad3.png" alt="广告"></a>
			</section>
				<div class="border"><img src="images/border.gif" alt="分隔线"></div>
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
			<div class="border"><img src="images/border.gif" alt="分隔线"></div>
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
			<div class="border"><img src="images/border.gif" alt="分隔线"></div>
			<!--关于书店-->
			<section class="about">
				<h2 id="title6">关于书店</h2>
				<img src="images/about.jpg" alt="叮叮书店"><p>叮叮书店成立于2010年6月，是由教育部主管、清华大学主办的综合出版单位。植根于“清华”这座久负盛名的高等学府，秉承清华人“自强不息，厚德载物”的人文精神。</p>
			</section>
			<div class="border"><img src="images/border.gif" alt="分隔线"></div>
		</aside>
	</div>
                    
                    <?php
                    require_once('book_sc_fns.php');
					$conn = db_connect();
		echo '<section class="sell-section">';  
		echo '	<h2 id="title3">最近促销</h2>';
		echo '     <article class="sell-center">';
					$query = 'select * from 图书 where  是否促销 = 1';
					$result = $conn->query($query);
					
					if(!$result){
						echo '<p>连接失败！ 请检查各项参数是否正确</p>';	
					}else if($result->num_rows==0){
						echo '<p>本周还未有促销, 或许您可以随处看看</p>';
					}else{
						$num_results = $result->num_rows;
						for($i=0,$j=1;$i<$num_results;$i++,$j++){
							$row = $result->fetch_assoc();
							echo '	<section id="sell-content">';
							echo '    	<h4>'.$j.'.</h4>';
							echo '		<a href="details.php?id='.$row['ISBN'].'"><img class="promotion" src="images/books/'.$row['ISBN'].'.jpg" alt="'.$row['书名'].'"></a>';
							echo ' 		<div class="anyelse">';
							echo '<span style="font-size:1.6em;font-weight:650;font-family:"宋体";">'.stripslashes($row['书名']).'</span>';
							echo '<p>作者：'.stripslashes($row['作者']).'</p>';
							echo '<p>ISBN：'.stripslashes($row['ISBN']).'</p>';
							echo '<p>出版社：'.stripslashes($row['出版']).'</p>';									
							echo '<p id="more-special"><strong>现价：&yen;'.round($row['折扣']*0.1*$row['定价'],2).'</strong>'.'  ('.stripslashes($row['折扣']).'折)'.'&nbsp;&nbsp;原价：<del>&yen;'.stripslashes($row['定价']).'</del></p>';
							echo '<div class="cart-more"><a class="sell-cart" href="add_cart.php?new='.$row['ISBN'].'">加入购物车</a> <a class="sell-more" href="details.php?id='.$row['ISBN'].'">详细内容</a></div>';
							echo '		</div>';
							echo '	</section>';
						}
						echo '	</article>';
						echo '	</section>';
					}
				?>
		

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
