<?php
$response = file_get_contents('php://input');
$send = json_decode($response,true);
$ccc=json_encode($send,true);
$curl = curl_init();

$url="localhost:8080/php/CS490/rc/Back/see_grades/show_grades.php";

curl_setopt_array($curl, array(
CURLOPT_URL => $url,
CURLOPT_POST => 1,
CURLOPT_FOLLOWLOCATION => 1,
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_POSTFIELDS => $ccc
));

$test=curl_exec($curl);


#echo $test;
if ($test === FALSE) {
  echo ' error :'.curl_error($curl).PHP_EOL;
  }
else{
  $in = json_decode($test,true);
  $out=json_encode($in,true);

  echo $out;
  }
?>