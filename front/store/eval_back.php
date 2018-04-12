<?php
$response = file_get_contents('php://input');
$send = json_decode($response,true);
$ccc=json_encode($send,true);
$curl = curl_init();
#echo $ccc;

$url="localhost:8080/php/CS490/rc/Back/see_grades/seeable_exams.php";
#$url="localhost:8080/php/FINAL/see_grades/seeable_exams.php";

curl_setopt_array($curl, array(
CURLOPT_URL => $url,
CURLOPT_POST => 1,
CURLOPT_FOLLOWLOCATION => 1,
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_POSTFIELDS => $ccc
));
//$resp = curl_exec($curl);
	
//$in=json_encode($resp,true);
//$resp=json_decode($in,true);

//echo $resp
//testing
$test=curl_exec($curl);

#echo json_encode($test,true);
if ($test === FALSE) {
  echo ' error :'.curl_error($curl).PHP_EOL;
  }
else{
  $in = json_decode($test,true);
  $out=json_encode($in,true);

  echo $out;
  }


?>