<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Postcode Finder</title>
  </head>
  <body>
  
	<div class="container">
  
		<h1>Poster Finder</h1>
		
		<p>Enter a partial address to get the postal code.</p>
			<div id="message"></div>
		
		<form>
		  <div class="form-group">
			<label for="address">Address</label>
			<input type="text" class="form-control" id="address" placeholder="Enter partial address">
		  </div>
		  
		  <button type="submit" class="btn btn-primary" id="find-postcode">Submit</button>
		</form>
		
	
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
	<script type="text/javascript">
	
		$("#find-postcode").click(function(event) {
			
			//stop the form from being submitted when we press the button
			event.preventDefault();
			
			
			var position = {};
			$.ajax({
				url:"https://maps.googleapis.com/maps/api/geocode/json?address="+ encodeURIComponent($("#address").val())+"&key=AIzaSyBIZCc4z1PLphMKhUzMRwfrMbNEJZyli3U",
				type:"GET",
				success:function(data){
					
					if (data["status"] != "OK"){
						$("#message").html('<div class="alert alert-warning" id="message" role="alert">Postcode could not be found! Please try again.</div>');

					}else{
						$.each(data["results"][0]["address_components"],function(key,value){
						
						if (value["types"][0] == "postal_code"){
							
							$("#message").html('<div class="alert alert-success" id="message" role="alert"><strong>Postcode found!</strong>The postcode is ' + value["long_name"]+'</div>');
							
							
						}
						
					})
						
					}
					
					
					
				}	
			});
			
		});
		
		
	</script>
  
  
  </body>
</html>