<?php
	
	session_start();
	
	
	
	
	if (array_key_exists('email',$_POST) OR array_key_exists('password',$_POST)){
		//connecting to the database
		//argument = (server name,database name,password,username)
		$link  = mysqli_connect("shareddb-n.hosting.stackcp.net","usersdata-3130373b33","jiak34v2jd","usersdata-3130373b33");
	
		if (mysqli_connect_error()){
		
			die("There was an error connecting to the database");
		}
		
		
		
		if ($_POST['email'] == ''){
			echo "<p>Email address is required.</p>"; 
		}else if ($_POST['password'] == ''){
			echo "<p>Password is required.</p>"; 
		}else{
			
			$query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'";
			$result = mysqli_query($link,$query);
				
			if (mysqli_num_rows($result) > 0){
				echo "<p>The email address has already been taken.</p>";
			}else{
				
				$query = "INSERT INTO `users` (`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."',
				'".mysqli_real_escape_string($link,$_POST['password'])."')";
				if (mysqli_query($link,$query)){
					
					$_SESSION['email'] = $_POST['email'];
					
					header("Location: session.php");
					
					
				}else{
					
					echo "<p>There was a problem signing you up. Please try again.</p>";
				}
				
				
			}
			
		}
		
	}
	
	
	
	
	
	//Insert data
	//$query = "INSERT INTO `users` (`email`,`password`) VALUES('vito@uw.edu','iknow')";
	
	//update query
	//$query = "UPDATE `users` SET email = 'comwebdev@gmail.com' WHERE id = 3 LIMIT 1";
	//$query = "UPDATE `users` SET password = 'complexpassword' WHERE email = 'vitodhzzz@gmail.com' LIMIT 1";
	//mysqli_query($link,$query);
	
	//$query = "SELECT * FROM users";
	//$query = "SELECT * FROM users WHERE id = 1";
	//$query = "SELECT * FROM users WHERE email = 'vitodhzzz@gmail.com'";
	//$query = "SELECT * FROM users WHERE email like '%gmail.com'";
	//$query = "SELECT * FROM users WHERE email like '%o%'";
	//$query = "SELECT `email` FROM users WHERE id >= 2 AND email LIKE '%com'";
	
	/*
	$name = "Vito Correlone";
	$query = "SELECT `email` FROM users WHERE name = '".mysqli_real_escape_string($link,$name)."'";
	
	if ($result = mysqli_query($link,$query)){
		
		while ($row = mysqli_fetch_array($result)){
			print_r($row);
		}
		//echo "Your email is ".$row['email']." and your password is ".$row['password'];	
	}
	*/
	
	
?>



<form method = "post">

	<input name="email" placeholder="Email address">
	<input name="password" type="password" placeholder="Password">
	<input type="submit" value="Sign up">


</form>