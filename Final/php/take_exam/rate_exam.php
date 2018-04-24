<?php
	$connection = mysqli_connect("localhost", "root" ,"pass!","username");   

	$response = file_get_contents('php://input');
    
	echo json_encode($response,true);
	$array  = json_decode($response,true);     
	
	
	$examid = $array['examid'];
	$username = $array['username'];
	$examname = $array['examname'];
	$choice = $array['rating'];
	
	$queue = "SELECT * FROM exams WHERE testid LIKE '$examid'";
	
	$result = mysqli_query($connection,$queue);
	

	$row = mysqli_fetch_assoc($result);
	
	$rateup = $row['rateup'];
	$ratedown = $row['ratedown'];
	
	$response = array("Response" => "updated");

	
	$transarray=array("username"=>$username);
	extract($transarray);
	require 'getusername.php';
	
	$identification = "{$lastname}_tt{$id}";
	
	$testidentification = "{$examid}_{$examname}";
	
	
	
	if($choice == "pos"){
		$rateup++;
	
		$queue = "UPDATE exams SET rateup='$rateup' WHERE testid='$examid'";
	
		$result = mysqli_query($connection,$queue);
		
		$queue = "UPDATE $identification SET rating='positive' WHERE testid='$testidentification'";
			
		$result = mysqli_query($connection,$queue);
		
	}
	else{
		$ratedown++;
	
		$queue = "UPDATE exams SET ratedown='$ratedown' WHERE testid='$examid'";
	
		$result = mysqli_query($connection,$queue);
		
		$queue = "UPDATE $identification SET rating='negative' WHERE testid='$testidentification'";
		
		$result = mysqli_query($connection,$queue);
		
	}

	
	echo json_encode($response,true);
?>