<?php
	// second, expire in 24 hours in this example
	//setcookie("customerId","1234",time() + 60 * 60 * 24);
	
	//unset the cookie, change the time it expire, it will require two times of refreshing page to see the effect
	//setcookie("customerId","",time() - 60 * 60);
	
	setcookie("customerId","",time() + 60 * 60);
	$_COOKIE["customerId"] = "test";
	
	echo $_COOKIE['customerId'];
	
	

	
	
?>


