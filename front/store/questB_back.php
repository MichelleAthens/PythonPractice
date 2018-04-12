<?php

	$response = file_get_contents('php://input');
	$send = json_decode($response,true);


#$send= array("question" => "sample", "cases" => "case", "category" => "default","level"=>"easy");
	$field= json_encode($send,true);

//$url="localhost:8080/php/working/rc/middle/submitquestion/createq_middle.php";
$url="localhost:8080/php/CS490/rc/middle/submitquestions/createquestionsfordb_middle.php";

$curl = curl_init();

  
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_POST => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => $field
  ));
$resp = curl_exec($curl);
$response = json_decode($resp,true);
//========================================================

echo json_encode($response,true);



#$answer = $response['login'];

//echo $response;

?> 