<?php

$myArray = array("Rob","Kirsten","Tommy");

$myArray[] = "Katie";

print_r($myArray);

echo $myArray[1];

echo "<br><br>";

$anotherArray[0] = "pizza";
$anotherArray[1] = "yoghurt";
$anotherArray["myFavouriteFood"] = "ice cream";

print_r($anotherArray);

echo "<br><br>";

$thirdArray = array(
"France" => "French",
 "USA" => "English",
"Germany" => "German");
print_r($thirdArray);

unset($thirdArray["France"]);


echo "<br><br>";
echo sizeof($thirdArray);

?>