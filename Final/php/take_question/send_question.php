<?php
/*Take exam
===================================================================================
*/
#==============================================================================
	$array = array();
	$connection = mysqli_connect("localhost", "root" ,"pass!","username");   
	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================
/*
   
	$array[]=array("questionid"=>1);
*/
	$questionid=$array[0]['questionid'];
#========================Retrieve Question information======================	

	$queue = "SELECT * FROM premade WHERE ID LIKE $questionid";
	$result = mysqli_query($connection,$queue);

	
	while($row=mysqli_fetch_assoc($result)){
		$questionid 	= $row['ID'];
		$question  	    = $row['question'];
		$sample		    = $row['sample'];
		$category		= $row['category'];
		$level			= $row['diff'];
		$author			= $row['author'];
		
		$sendarray[] = array("questionid"   => $questionid, 
							 "question"     => $question,
							 "sample"		=> $sample,
							 "category"		=> $category,
							 "level"		=> $level,
							 "author" 		=> $author);
		
		
		}
		
		$finalarray = json_encode($sendarray,true);
		
		echo $finalarray;
	
	
	
	    
?>
