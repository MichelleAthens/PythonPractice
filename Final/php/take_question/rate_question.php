<?php
	$connection = mysqli_connect("localhost", "root" ,"pass!","username");   

	$response = file_get_contents('php://input');

	$array  = json_decode($response,true);     
	
	
	$questionid = $array[0]['questionid'];
	$username = $array[0]['username'];
	$choice = $array[0]['rating'];

	
	$queue = "SELECT * FROM premade WHERE ID LIKE '$questionid'";
	
	$result = mysqli_query($connection,$queue);
	

	$row = mysqli_fetch_assoc($result);
	
	$rateup = $row['rateup'];
	$ratedown = $row['ratedown'];
	
	
	
	
	
	$transarray=array("username"=>$username);
	extract($transarray);
	require 'getusername.php';
	
	$identification = "{$lastname}_qt{$id}";
	
	echo $identification;
	
	
	if($choice == "pos"){
		$rateup++;
	
		$queue = "UPDATE premade SET rateup='$rateup' WHERE ID='$questionid'";
	
		$result = mysqli_query($connection,$queue);
		
		
			
		$queue = "UPDATE $identification SET rating='positive' WHERE questionid='$questionid'";
				
		$result = mysqli_query($connection,$queue);
		
	}
	
	
	
	else{
		$ratedown++;
	
		$queue = "UPDATE premade SET ratedown='$ratedown' WHERE ID='$questionid'";
	
		$result = mysqli_query($connection,$queue);
	
		$queue = "UPDATE $identification SET rating='negative' WHERE questionid='$questionid'";
				
		$result = mysqli_query($connection,$queue);
		
	}
//*/
	
?>