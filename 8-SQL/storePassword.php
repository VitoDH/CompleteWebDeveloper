<?php
	
	//level 3 encryption with salt
	//$salt = "werwfsdsdrfwefv";
	//echo md5($salt."password");
	
	$row['id'] = 73;
	echo md5(md5($row['id'])."password");

	
	
?>


