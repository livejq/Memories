<?php
	$prices = array('Tires'=>100,'Oil'=>10,'Spark Plugs'=>4);
	//初始化关联数组
	foreach($prices as $key => $value)://第一种
		echo $key."-".$value."<br/>";
		endforeach;
	reset($prices);//当两次使用同一数组时调用使之将当前元素重新设置到数组开始处
	while($element = each($prices))://第二种
		echo $element['key'];
		echo "-";
		echo $element['value'];
		echo "<br/>";
		endwhile;
	reset($prices);
	while(list($product,$price)=each($prices))://第三种
		echo "$product-$price<br/>";
		endwhile;
	
	//设置常量
	define('PI',3.1415926);
	echo PI;
	echo '|<br/>';
	//多维数组
	$products = array(	array('TIR','Tires',100),
						array('OIL','Oil',10),
						array('SPK','Spark Plugs',4) );
	for($row=0;$row<3;$row++){
		for($column=0;$column<3;$column++){
			echo '|'.$products[$row][$column];
		}	
		echo '|<br/>';
	}
	$kits = array(	array(	'Code'=>'TIR',
							'Description'=>'Tires',
							'Price'=>100
							),
					array(	'Code'=>'OIL',
							'Description'=>'Oil',
							'Price'=>10
							),
					array(	'Code'=>'SPK',
							'Description'=>'Spark Plugs',
							'Price'=>4
							)
				);
	for($row=0;$row<3;$row++){
		echo '|'.$kits[$row]['Code'].'|'.$kits[$row]['Description'].'|'.$kits[$row]['Price'].'<br/>';
	}
				
?>