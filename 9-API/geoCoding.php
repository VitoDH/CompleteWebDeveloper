




<html>

	<head>
		<title>Geocoding An Address</title>
	</head>
	
	
	
	<body>
	
	</body>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		var position = {};
		$.ajax({
			url:"https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyBIZCc4z1PLphMKhUzMRwfrMbNEJZyli3U",
			type:"GET",
			success:function(data){
				
				// loop through the array
				$.each(data['results'][0]['address_components'],function(key,value){
					
					if (value["types"][0] == "country"){
						alert(value["short_name"]);
					}
					
					
					
				})
				
				
			}
			
		})
	
	
	
	
	</script>



</html>