<?php

	$response = file_get_contents('php://input');
	$send = json_decode($response,true);



	$field= json_encode($send,true);

	//echo $field;


$curl = curl_init();

//========================================================
$url="michelleathensdizon.com/projects/PythonPractice/front/php/profile/CreatedTests/getcreatedtests.php";

  
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_POST => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => $field
  ));
$resp = curl_exec($curl);
$response = json_decode($resp,true);

echo $resp;
//========================================================

#echo json_encode($response,true);



#$answer = $response['login'];

//echo $response;
//*/
?> 