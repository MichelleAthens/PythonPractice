<?php
/*Take exam
===================================================================================

*/
#==============================================================================
	$array = array();
	
	$questionid=1;
	$question   ="";
	$caseshit		="";
	$casesmissed ="";
	$submitted  ="";
		$connection = mysqli_connect("localhost","root","password","mmd38");      
	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);                   
#==============================================================================
	//$array = array("username"=>"mmd38","questionid" => 1, "question" => "q","caseshit" => $caseshit, "casesmissed" => $casesmissed, "submitted" => $code);


	$arraysize= count($array);
	$finals=json_encode($array,true);
	
	
#========================Exam Select Retrieve exam======================
									#e1_final_ryan
	$username	    	 = $array['username'];
	$questionid		 = $array['questionid'];
	$question			 = $array['question'];
	$code					 = $array['submitted'];
	$caseshit 			 = $array['caseshit'];
	$casesmissed 	 = $array['casesmissed'];

	if (!$casesmissed){
		$casesmissed="";
	}
#=================================================================
#Make Table
	$transarray=array("username"=>$username);
	extract($transarray);
	require 'getcredentials.php';
	
	$identification1 = "{$lastname}_qt{$id}";

	$check = mysqli_query($connection,"SELECT * FROM $identification1 WHERE testid LIKE '$questionid'");
	
	if(mysqli_fetch_assoc($check)){
		$queue = "INSERT INTO $identification1 (questionid,question,submission,caseshit,casesmissed) VALUES
		('$questionid','$question','$code','$caseshit','$casesmissed')";
	
		$result = mysqli_query($connection,"DELETE FROM $identification1 WHERE testid LIKE '$questionid'");
		$result =  mysqli_query($connection,$queue);
	}
	else{
		$result = mysqli_query($connection,$queue);
	}
	#echo mysqli_error($connection);
#===================================================================
	mysqli_close($connection);
	
	$final = array("caseshit"=>$caseshit, "casesmissed" =>$casesmissed);
    echo json_encode($final,true);

?>
