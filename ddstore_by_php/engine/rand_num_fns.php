<?php
	function randomkeys($length){
		$pattern = '1234567890abcdefghijklmnobqrstuvwxyzABCDEFGHIJKLMNOBQRSTUVWXYZ';
		$keys ='';
		for($i=0;$i<$length;$i++){
			$keys .= $pattern{mt_rand(0,35)};	
		}
		return $keys;
	}
?>