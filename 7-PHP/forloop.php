<?php

for ($i = 0; $i < 10; $i++){
	
	echo $i."<br>";

}

echo "<br><br>";

for ($i = 2; $i <= 30; $i= $i +2){
	
	echo $i."<br>";

}

echo "<br><br>";

for ($i = 10; $i >= 0; $i--){
	
	echo $i."<br>";

}

echo "<br><br>";

$family = array("Vito","Mike","Kat","Clemenza");

for ($i = 0; $i < sizeof($family); $i++){
	
	echo $family[$i]."<br>";
}



echo "<br><br>";
foreach($family as $key => $value){
	
	$family[$key] = $value." Percival";
	echo "Array item".$key." is ".$value."<br>";

}



?>