<?php

// connection to databses
		$link = mysqli_connect("server name","user-name","password","databse name");
		
		if (mysqli_connect_error()){
			die("Database connection error!");
		}
		
		$error = "";
		
?>