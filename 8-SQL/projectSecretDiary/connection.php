<?php

// connection to databses
		$link = mysqli_connect("shareddb-p.hosting.stackcp.net","secretdi-31313517af","12345678!","secretdi-31313517af");
		
		if (mysqli_connect_error()){
			die("Database connection error!");
		}
		
		$error = "";
		
?>