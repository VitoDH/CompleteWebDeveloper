<?php

	$emailTo = "zhizhuxia1630@163.com";
	$subject = "I hope this works!";
	$body = "I think you're great!";
	$headers = "From: zhizhuxia1630@163.com";

	if (mail($emailTo,$subject,$body,$headers)){
		
		echo "The email was sent successfully.";

	}else{

		echo "The email could not be sent.";

	}
	

?>


