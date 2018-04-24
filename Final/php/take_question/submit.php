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
	$connection = mysqli_connect("localhost", "root" ,"pass!","username");   
	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);                   
#==============================================================================
	//$array = array("username"=>"mmd38","questionid" => 1, "question" => "q","caseshit" => $caseshit, "casesmissed" => $casesmissed, "submitted" => $code);


	$arraysize= count($array);
	$finals=json_encode($array,true);
	
	
#========================Exam Select Retrieve exam======================
					
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
	
	$check = mysqli_query($connection,"SELECT * FROM $identification1 WHERE questionid LIKE '$questionid'");
	$row = mysqli_fetch_assoc($check);
	
	$error = mysqli_error($check);
	
	if($row>1){
		$rating = $row['rating'];
		
		}
	else{
		$queue = "INSERT INTO $identification1 (questionid,question,submission,caseshit,casesmissed,rating) VALUES
		('$questionid','','','','','none')";
			
		mysqli_query($connection,$queue);
			
		$rating = "none";
	}
	

	
	mysqli_close($connection);
	
	$final = array("caseshit"=>$caseshit, "casesmissed" =>$casesmissed,"rating" => $rating);
    echo json_encode($final,true);

?>
