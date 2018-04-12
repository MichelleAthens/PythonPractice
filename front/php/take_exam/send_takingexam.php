<?php

#==============================================================================
	$array = array();

	$connection = mysqli_connect("db719674949.db.1and1.com","dbo719674949","Hinatachan1!","db719674949");      
	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================
/*
   $array=array("identification" => "ID#_testname")
	*/
	
#========================Exam Select Retrieve exam======================
	$identification	= $array["identification"];

	$queue = "SELECT * FROM $identification";
	$result = mysqli_query($connection,$queue);

	
	
	while($row=mysqli_fetch_assoc($result)){
			$questionid = $row['questionid'];
			$question    = $row['question'];
			$points		  = $row['points'];
		
				//------Get Question Details-----
					$transarray=array("questionid"=>$questionid);
					extract($transarray);
					require 'getquestiondetails.php';
				//-----Question Details Close-----
			
			
			
				$sendarray[] = array("questionid" => $questionid, 
											   "question"    => $question,
											   "sample"		=> $sample,
											   "points"=>$points);
			
		
		}
		
		$finalarray = json_encode($sendarray);
		
		echo $finalarray;
	
	
	
	    
?>
