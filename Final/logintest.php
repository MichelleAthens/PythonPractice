<?php

session_start();
$Username=$_POST['ucid'];
$Password=$_POST['pass'];




$field = array('Username' => $Username , 'Password' => $Password);
$send= json_encode($field);
$curl = curl_init();
$url="michelleathensdizon.com/projects/PythonPractice/front/php/login/login.php";
  

 
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_POST => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => $send
  ));
$resp = curl_exec($curl);



$answer = $response['Response'];

if(strcmp($answer,"NO MATCH") == 0){
	echo $resp;
}
else{
	$_SESSION['username'] = $Username;
	
	
echo $resp;
}
?> 