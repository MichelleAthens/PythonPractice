<?php
#Get everything in premade table
	$array = array();
#	$connection = mysqli_connect("sql2.njit.edu","mmd38","oXsWKSx7","mmd38");  
$connection = mysqli_connect("localhost","root","password","mmd38");    	
  //$response = file_get_contents('php://input');
  //$array  = json_decode($response,true);                       #Get the response

	$queue="SELECT * FROM premade";
	$result=mysqli_query($connection,$queue);
	$numofrows=mysqli_num_rows($result);
	
	while($row=mysqli_fetch_assoc($result)){
		$questionid = $row['id'];
		$question = $row['question'];
		$category = $row['category'];
		$level = $row['level'];
		$cases = $row['cases'];

	
		
		$array[] = array("id" => $questionid,
								  "question" => $question,
								  "category" => $category,
								  "level" 	=> $level,
								  "cases"	=> $cases);
	}
	   mysqli_close($connection);
	  echo json_encode($array);
	 
?>
