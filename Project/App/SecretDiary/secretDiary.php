<?php
	
	session_start();
	$error = "";
	
	// Log out session
	if (array_key_exists("logout",$_GET)){
		
		unset($_SESSION);
		setcookie("id","",time()-60*60);
		$_COOKIE["id"] = "";	
		// !!!!!
		session_destroy();
		
	}else if ((array_key_exists("id",$_SESSION) AND $_SESSION['id']) OR (array_key_exists("id",$_COOKIE) AND $_COOKIE['id'])) {
		
		header("Location:loggedInPage.php");
		
	}
	
	
	if (array_key_exists("submit",$_POST)){
		
		include("connection.php");
		
		# email entry validation
		if (!$_POST['email']){
			$error .= "An email address is required<br>";
		}
		
		if (!$_POST['password']){
			$error .= "An password address is required<br>";
		}
		
		if ($error != ""){
			$error = "<p>There were error(s) in your form:</p>".$error;
			
		}else{
			
			# if signUp == 1, then we are in sign up process
			if ($_POST['signUp'] == '1'){
				$query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
				$result = mysqli_query($link,$query);
				
				if (mysqli_num_rows($result) > 0){
					
					$error =  "That email address is taken.";
					
				}else{
					
					$query = "INSERT INTO `users` (`email`,`password`) VALUES('".mysqli_real_escape_string($link,$_POST['email'])."',
					'".mysqli_real_escape_string($link,$_POST['password'])."')";
					
					if (!mysqli_query($link,$query)){
						$error = "<p>Could not sign you up - please try again later.</p>";
						
					}else{
						
						# store password with hash function
						
						$query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = 
						".mysqli_insert_id($link)." LIMIT 1";\
						
						mysqli_query($link,$query);
						
						# store session and cookie
						$_SESSION['id'] = mysqli_insert_id($link);
						
						if ($_POST['stayLoggedIn'] == '1'){
							
							setcookie("id",mysqli_insert_id($link),time()+60*60*24*365);
							
						}
						
						header("Location: loggedInPage.php");
						
					}
					
				}
			}else{
				# if signUp == 0, then we are in log in process
				
				$query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'";
				$result = mysqli_query($link,$query);
				$row = mysqli_fetch_array($result);
				
				# check whether password is correct or not
				if (isset($row)){
					
					$hashedPassedword = md5(md5($row['id']).$_POST['password']);
					
					if ($hashedPassedword == $row['password']){
						
						$_SESSION['id'] = $row['id'];
						
						if ($_POST['stayLoggedIn'] == '1'){
							
							setcookie("id",$row['id'],time()+60*60*24*365);
							
						}
						
						header("Location: loggedInPage.php");
						
						
					}else{
						
						$error = "The password is incorrect";
						
					}
				}else{
					
					$error = "That email/password combination could not be found.";
					
				}
				
			}
	
		}
		
	}

?>


<?php include("header.php"); ?>
  	
	<div class="container" id="homePageContainer">
		
		
		
		<h1>Secret Diary</h1>
		<p><strong>Store your thoughts permanently and securely.</strong></p>
		
	
		<div id="error"><?php if($error!=""){
		echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
		}?></div>



		<form method="post" id="signUpForm">
			
			<p>Interested? Sign up now!</p>
			
			<div class="form-group">
				<input type="email" class="form-control"  name="email" placeholder="Your Email">
			</div>
			
			<div class="form-group">
				<input type="password" class="form-control"  name="password" placeholder="Password">
			</div>
			
			<div class="form-group  form-check">
				<input type="checkbox" class="form-check-input" name="stayLoggedin" value=1>
				<label class="form-check-label" for="stayLoggedIn">Stay Logged In</label>
				<input type="hidden" name="signUp" value="1">
			</div>
			
			
				
			<button type="submit" class="btn btn-primary" name="submit">Sign Up!</button>
			<br>
			<p><a class="toggleForms">Log in</a></p>
			
		</form>
		


		<form method="post" id="logInForm">
			
			<p>Log in using your username and password</p>
			
			<div class="form-group">
				<input type="email" class="form-control"  name="email" placeholder="Your Email">
			</div>
			
			<div class="form-group">
				<input type="password" class="form-control"  name="password" placeholder="Password">
			</div>
			
			<div class="form-group  form-check">
				<input type="checkbox" class="form-check-input" name="stayLoggedin" value=1>
				<label class="form-check-label" for="stayLoggedIn">Stay Logged In</label>
				<input type="hidden" name="signUp" value="0">
			</div>
			
			
				
			<button type="submit" class="btn btn-primary" name="submit">Log In!</button>
			
			<p><a class="toggleForms">Sign up</a></p>
		</form>
	</div>
 
 <?php include("footer.php"); ?>












