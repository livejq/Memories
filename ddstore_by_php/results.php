<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>叮叮网: <?php echo trim($_POST['searchterm']);?></title>
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
				<a href="ddstore.php">首页</a>&gt;&gt;<span style="font-size:1.4em;"><?php echo trim($_POST['searchterm']);?><span>
			</section>
			<section>
				<h2 id="title14">查询结果：</h2>
<?php 
					require_once('ddstore_fns.php');
                 	$searchtype = $_POST['searchtype'];
                    $searchterm = trim($_POST['searchterm']);
                    if(!$searchtype||!$searchterm){
                        echo '<p>您未输入有效的相关信息!  请返回相关页面重新输入搜索。</p>';
                        exit;
                    }
                    
                    if(!get_magic_quotes_gpc()){
                        $searchtype = addslashes($searchtype);
                        $searchterm = addslashes($searchterm);	
                    }
                    
                    $db = db_connect();
                    
                    /*if(mysqli_connect_errno()){
                        echo '<p>无法连接数据库! 请稍后重试。</p>';
                        exit;	
                    }*/
                    if($searchtype=='全部分类'){
						$querys = "select * from 图书 where ISBN like '%".$searchterm."%' or 作者 like '%".$searchterm."%' or 书名 like '%".$searchterm."%'";
					}
					else{
						$querys = "select * from 图书 where ".$searchtype." like '%".$searchterm."%'";
					}
                    $result = $db->query($querys);//or die($db->error());
                    $num_results = $result->num_rows;
                    
                    if($num_results==0){
                        echo '<img class="warning" src="images/warning.png">';			
						echo '<div id="sorry"><p>抱歉，没有找到与'.$searchterm.'相关的商品，建议适当减少筛选条件。</p><br/>'.'<a href="ddstore.php">返回上一步</a></div>';
					}
					else{
						for($i=0;$i<$num_results;$i++){
							$row = $result->fetch_assoc();
							echo '<section class="result">';
							echo '<a href="details.php"><img src="images/books/'.trim($row['ISBN']).'.jpg" alt='.htmlspecialchars(stripslashes($row['书名'])).'></a>'.'<div class="result-content">';
							echo '<h3>《'.htmlspecialchars(stripslashes($row['书名'])).'》</h3>';
							echo '<p>作者：'.stripslashes($row['作者']).'</p>';
							echo '<p>ISBN：'.stripslashes($row['ISBN']).'</p>';
							echo '<p>出版社：'.stripslashes($row['出版']).'</p>';
							echo '<p>'.stripslashes($row['编辑推荐']).'</p>';									
							echo '<p><strong>现价：&yen;'.round($row['折扣']*0.1*$row['定价'],2).'</strong>'.'  ('.stripslashes($row['折扣']).')折'.'&nbsp;&nbsp;原价：<del>&yen;'.stripslashes($row['定价']).'</del></p>';
							echo '</div>';
							echo '<div class="cartmore"><a class="cart" href="cart.php">加入购物车</a> <a class="more" href="details.php">详细内容</a></div>';
							echo '</section>';
						}
							 $result->free();
					}
                    $db->close();
						 
?>
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
		<address>通信地址：清华大学学研大厦 A 座 读者服务部&nbsp;&nbsp;电话：（010）62781733&nbsp;&nbsp;网管信箱：netadmin@tup.tsinghuA.edu.cn
		</address>
	</section>
</body>
</html>