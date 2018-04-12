<?php
	$response = file_get_contents('php://input');
	$send = json_decode($response,true);
	
	$curl = curl_init();



	#$url="localhost:8080/php/FINAL/createexam_premade/get_premade.php";
	#$url="localhost:8080/php/rc/middle/create_premade_middle/get_premade_middle.php";
 $url="localhost:8080/php/CS490/rc/middle/create_premade_middle/get_premade_middle.php";
 
	//========================================================
	# $url="https://web.njit.edu/~mmd38/CS490/rc/middle/loginmiddle.php";
	  
	  curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_POST => 1,
		CURLOPT_FOLLOWLOCATION => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_POSTFIELDS => $send
	  ));
	$resp = curl_exec($curl);
	echo $resp
	//========================================================

?>