<?php


	$error = "";
	$successMessage = "";
	if($_POST){
		
		
		if (!$_POST["email"]){
			$error .="An email address is required.<br>";
		}
		
		if (!$_POST["subject"]){
			$error .="A subject is required.<br>";
		}
		
		if (!$_POST["content"]){
			$error .="A content address is required.<br>";
		}
		
		if ($_POST["email"] && filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) === false){
			$error .="The email address is invalid.<br>";
		}
		
		if ($error != ""){
			$error = '<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong><p>' . $error . '</div>';
		}else{
			
			$emailTo = "vitodhzzz@gmail.com";
			$subject = $_POST['subject'];
			$content = $_POST['content'];
			$headers = "From: ".$_POST['email'];
			
			if (mail($emailTo,$subject,$content,$headers)){
					$successMessage = '<div class="alert alert-success" role="alert">You message was sent, we\'ll get back to you ASAP!</div>';
				
			}else{
				
				$error = '<div class="alert alert-danger" role="alert"><p>You message couldn\'t be sent. Please try again later.<p>' . $error . '</div>';

			}
			
		}
		
	}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Get in touch</title>
  </head>
  <body>
		<div class="container">
			<h1>Get in touch！</h1>
			
			<div id="error"><? echo $error.$successMessage;?></div>
			
		<form method="post">
		  <div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
			<label for="subject">Subject</label>
			<input type="text" id="subject" name="subject" class="form-control">
		  </div>
		  

		  <div class="form-group">
			<label for="content">What would you like to ask as?</label>
			<textarea class="form-control" name="content" id="content" rows="3"></textarea>
		  </div>
		  

		  <button type="submit" id="submit" class="btn btn-primary">Submit</button>
		  
		</form>
			
		</div>
	
		
		
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
	<script type="text/javascript">
	
		$("form").submit(function(e){
			
			
			var error = "";
			
			if ($("#email").val() == ""){
				error += "The Email filed is required.<br>";
			}
			
			
			if ($("#subject").val() == ""){
				error += "The subject filed is required.<br>";
			}
			
			if ($("#content").val() == ""){
				error += "The content filed is required.";
			}
			
			if (error != ""){
				
				$("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in you form:</strong></p>'+error+'</div>');
				return false;
			}else{
				
				
				return true;
			}
		});
	
	
	</script>
  
  
  
  
  
  
  </body>
</html>