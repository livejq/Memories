<?php
	require_once('book_sc_fns.php');
	
	do_html_header('特刊降价 - 叮叮书店');
	do_html_special('特刊降价');
					$conn = db_connect();
					$query = 'select * from 图书 where 是否降价 = 1';
					$result = $conn->query($query);
					
					if(!$result){
						echo '<p>连接失败！ 请检查各项参数是否正确</p>';	
					}else if($result->num_rows==0){
						echo '<p>本周还未有降价, 或许您可以随处看看</p>';
					}else{
						$num_results = $result->num_rows;
						for($i=0;$i<$num_results;$i++){
							$row[$i] = $result->fetch_assoc();
						}
						display_books($row);
					}
	
	do_html_aside();
	do_html_footer();
?>