d<?php
function do_html_header($title){
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php if(!isset($title))echo '无法加载标题';else echo $title;?></title>
	<link href="images/logo.ico" rel="icon" type="images/ico-x">
	<link href="style.css" rel="stylesheet" type="text/css">
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
        <div class="client"><a href="#"><?php require_once('ddstore_fns.php');check_valid_user();?></a><a href="login_form.php">登录</a><a href="register_form.php">注册</a><a href="logout.php">退出</a><div id="displaydate"></div><div id="displaytime">&nbsp;&nbsp;</div></div>
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
<?php
}


function display_login_form(){
?>
	<form action="member.php" method="post">
	<div id="login_form">
    	<h3>密码登录</h3>
		<div class="login">
			<label class="username"><img src="images/user.png">
				<input type="text" id="username" name="username" required placeholder="用户名">
			</label>
		</div>
        <div class="error_msg">
        	<?php if(!isset($_SESSION)){session_start();}if(isset($_SESSION['error_msg'])){echo $_SESSION['error_msg'];unset($_SESSION['error_msg']);}?>
        </div>
		<div class="login">
			<label class="password"><img src="images/password.png">
				<input type="password" id="password" name="password" required placeholder="密码:6~12位字符" >
			</label>
		</div>
        <div class="check_box">
        	<label>
				<input type="checkbox" id="autologin" name="autologin" value="7天内自动登录">7天内自动登录
			</label>
        </div>
    	<div class="log_in">
        		<input type="submit" value="登录">
        </div>
    	<div class="other"><a href="register_form.php">立即注册</a>&nbsp;&nbsp;&nbsp;<a href="find_password_form.php">忘记密码？</a></div>
    </div>
    </form>
<?php
}

function display_registration_form(){
?>
	<form action="register_new.php" method="post">
	<div id="register_form">
    	<h3>注册信息</h3>
		<div class="register">
			<label class="username"><img src="images/user.png">
				<input type="text" id="username" name="username" required placeholder="用户名（最多12个字符）">
			</label>
		</div>
		<div class="register">
			<label class="password"><img src="images/password.png">
				<input type="password" id="password" name="password" required placeholder="密码（6~12位字符）" >
			</label>
		</div>
        <div class="register">
			<label class="password"><img src="images/password.png">
				<input type="password" id="password2" name="password2" required placeholder="确认密码">
			</label>
		</div>
        <div class="register">
			<label class="email"><img src="images/email.png">
				<input type="email" id="email" name="email" required placeholder="邮箱">
			</label>
		</div>
    	<div class="registry">
        	<input type="submit" value="注册">
        </div>
    </div>
    </form>

<?php
}

function display_find_password(){
?>
	<div id="find_password">
	<form action="find_password_auth.php" method="post">
    	<h3>用户验证</h3>
		<div class="find">
			<label class="username"><img src="images/user.png">
				<input type="text" id="username" name="username" required placeholder="用户名（最多12个字符）">
			</label>
		</div>
         <div class="error_msg">
        	<?php if(!isset($_SESSION)){session_start();}if(isset($_SESSION['error_msg'])){echo $_SESSION['error_msg'];unset($_SESSION['error_msg']);}?>
		</div>
        <div class="get_codes">
              <input type="submit" value="获取验证码">
         </div></form><form action="confirm.php" method="post"><div class="fill_codes"><input type="text" id="codes" name="codes" required placeholder="验证码"style="width:60px"></div>
          <div class="success_msg">
			<?php if(!isset($_SESSION)){session_start();}if(isset($_SESSION['success_msg'])){echo $_SESSION['success_msg'];unset($_SESSION['success_msg']);}?>
        </div>
           <div class="finding">
                <input type="submit" value="确定">
           </div>
        </form>
    </div>
<?php
}

function display_modify_form(){
?>
	<form action="modify_result.php" method="post">
	<div id="register_form">
    	<h3>修改密码</h3>
		<div class="register">
			<label class="password"><img src="images/password.png">
				<input type="password" id="password" name="password" required placeholder="(新)密码（6~12位字符）" >
			</label>
		</div>
        <div class="register">
			<label class="password"><img src="images/password.png">
				<input type="password" id="password2" name="password2" required placeholder="确认密码">
			</label>
		</div>
        <div class="error_msg">
        <?php if(!isset($_SESSION)){session_start();}if(isset($_SESSION['error_msg'])){echo $_SESSION['error_msg'];unset($_SESSION['error_msg']);}?>
        </div>
    	<div class="registry">
        	<input type="submit" value="确定">
        </div>
    </div>
    </form>
<?php
}

function do_html_footer(){
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
<?php
}

function do_html_special($name){
?>
	<!--内容-->
	<div id="content-wrapper" class="container">
		<!--内容区-->
		<article>
			<section>
				<a href="#">书籍分类</a>&gt;&gt;<span style="font-size:1.4em;"><?php echo $name;?><span>
			</section>
			<section>
				<h2 id="title9"><?php echo $name;?>：</h2>
<?php
}

function do_html_section($name){
?>
	<!--内容-->
	<div id="content-wrapper" class="container">
		<!--内容区-->
		<article>
			<section>
				<a href="#">书籍分类</a>&gt;&gt;<span style="font-size:1.4em;"><?php echo $name;?><span>
			</section>
			<section>
				<h2 id="title14"><?php echo $name;?>：</h2>
<?php
}

function do_html_aside(){
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
<?php
}

function do_html_pagebar(){
?>
<section class="piclist">
<div id="pagebar">
					<a href="#" class="arrow">上一页</a>
					<a href="#">1</a>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">4</a>
					<a href="#">5</a>
					<a href="#">6</a>
					<a href="#">7</a>
					<a href="#">8</a>
					<a href="#">9</a>
					<a href="#">10</a>
					<a href="#" class="arrow">下一页</a>
				</div>
</section>
<?php
}
?>


<?php
function display_categories($cat_array){
	
	if(!is_array($cat_array)){
		echo "<ul>";
		echo "<li>";
    	echo "无法获取目录";
		echo "</li>";
		echo "</ul>";
		return;
    }else{
			echo "<ul>";
			foreach($cat_array as $row){
				$url = "show_cat.php?catid=".$row['catid'];
				$title = $row['catname'];
				echo "<li>";
				do_html_url($url,$title);
				echo "</li>";	
			}
			echo "</ul";
	}
}
?>

<?php
function display_books($book_array){
	
	if(!is_array($book_array)){
    	echo "<p>无法获取图书</p>";
		return;
    }else{
			foreach($book_array as $row){
							echo '<section class="result">';
							echo '<a href="details.php?id='.$row['ISBN'].'"><img src="images/books/'.trim($row['ISBN']).'.jpg" alt='.htmlspecialchars(stripslashes($row['书名'])).'></a>'.'<div class="result-content">';
							echo '<h3>《'.htmlspecialchars(stripslashes($row['书名'])).'》</h3>';
							echo '<p>作者：'.stripslashes($row['作者']).'</p>';
							echo '<p>ISBN：'.stripslashes($row['ISBN']).'</p>';
							echo '<p>出版社：'.stripslashes($row['出版']).'</p>';
							echo '<p>'.stripslashes($row['编辑推荐']).'</p>';									
							echo '<p><strong>现价：&yen;'.round($row['折扣']*0.1*$row['定价'],2).'</strong>'.'  ('.stripslashes($row['折扣']).'折)'.'&nbsp;&nbsp;原价：<del>&yen;'.stripslashes($row['定价']).'</del></p>';
							echo '</div>';
							echo '<div class="cartmore"><a class="cart" href="add_cart.php?new='.$row['ISBN'].'">加入购物车</a> <a class="more" href="details.php?id='.$row['ISBN'].'">详细内容</a></div>';
							echo '</section>';
						}
						do_html_pagebar();
						if(!isset($_SESSION)){
							session_start();	
						}
						$_SESSION['page_url'] = $_SERVER['REQUEST_URI'];
	}
}
?>


<?php
function display_cart($cart,$change = true,$images = 1){
	
	echo '<div id="cart-wrapper" class="cart-content">
			<article>
			<section><span style="font-size:1.6em;">您现在的位置:&nbsp;</span>
				<a href="ddstore.php">首页</a>&gt;&gt;<span style="font-size:1.4em;">购物车<span>
			</section>
			<section>
				<h2 id="title13">我的购物车</h2>
				<section>
					<table class="cart-table">
                    <form action="my_cart.php" method="post">
						<tr class="cart-title">
							<th colspan="'.($images+1).'">商品信息</th>
							<th>单价(元)</th>
							<th>数量</th>
							<th>金额(元)</th>
						</tr>';
                                     
						foreach($cart as $isbn => $qty){
							$book = get_book_details($isbn);
							echo "<tr>";
							if($images==true){
								echo '<td class="td-center"><a href="details.php">';
								if(file_exists("images/books/".$isbn.".jpg")){
									echo '<a href="details.php?id='.$book['ISBN'].'"><img src="images/books/'.$isbn.'.jpg" alt="封面" style=" width="80" height="100"></a>';
								}else{
									echo "&nbsp;";
								}
							echo "</a></td>";
							}
						
						echo '<td><h3>'.$book['书名'].'</h3></td>';
						echo '<td class="td-center">'.number_format($book['定价']*0.1*$book['折扣'],2).'</td>';
						echo '<td class="td-center">';
						echo '<input type="button" value="-"><input type="text" name="'.$isbn.'" value="'.$qty.'" size="2"><input type="button" value="+"></td>';
						echo '<td class="td-center">'.number_format($book['定价']*0.1*$book['折扣']*$qty,2).'</td>';
						echo "</tr><br>";
						}
						if($change == true){
							echo "<tr>
								<td colspan=\"".(2+$images)."\">&nbsp;</td>
								<td align=\"center\">
									<input type=\"hidden\" name=\"save\" value=\"true\"/>
									<input type=\"image\" src=\"images/save.png\" border=\"0\" alt=\"保存更改\"/>
								</td>
								<td>&nbsp;</td>
								</tr>";
						}
						echo "</form></table>";
						echo "<div class=\"stand-right\">
							<p id=\"pay-right\">".$_SESSION['items']." 件商品&nbsp;&nbsp;总价（不含运费）：&yen;".number_format($_SESSION['total_price'],2)."<a href=\"#\">去结算</a></p>
						</div>";
					echo "</section>
				</section>
			</article></div>";
}
?>
<?php
function do_html_add_successful($book){
	
	$url = "show_cat.php?catid=".$book['catid'];
	$title = '继续购物';
	echo '<div id="content-wrapper" class="container">
			<article>
			<section class="contacts">
				<h2 id="title15">添加结果：</h2>
				<section>';
				if(!$book){
					echo '<img class="add_error" src="images/warning2.png" style="margin-left:100px;margin-top:20px;">';			
					echo '<div id="sorry" style="font-size:1.9em;margin:10px 50px;"><p>商品添加失败！</p></div><br/>';
				}else{
					echo '<img class="successful" src="images/successful.png" style="margin-left:100px;margin-top:20px;">';			
					echo '<div id="sorry" style="font-size:1.9em;margin:10px 50px;"><p>商品已成功添加至购物车！</p></div><br/>';
					echo '<div id="sorry" style="font-size:1.5em;color:white;margin-top:10px;margin-left:100px;"><p>'.$book['书名'].'</p><br></div>';	
					echo '<div class="continue_shopping">';
					do_html_url($url,$title);
					echo '</div>';
				
				}
				
	echo "	</section>
			</section>
		</article></div>";
}
?>