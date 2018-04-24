<?php
/*Take exam
===================================================================================

*/
#==============================================================================
	$array = array();

		$connection = mysqli_connect("localhost","root","password","mmd38");      
		$response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================
	//$array = array("examid" => "1", "examname" => "Final", "professor" => "ryan","username" =>"mmd38","grade" => 83);
 
 
	/*
	$array[] = array("username" => "mmd38");
	$array[] = array("examid" => "1", "examname" => "Final", "professor" => "ryan", "grade" => "90");
	$array[] = array("ID" => "1", 
								"question" => "question",
								"cases" => "cases",
								"answers" => "answers",
								"submitted" => "code",
								"casehit"	=> "x+y",
								"casemissed" => "x*y");
	$array[] = array("ID" => "2", 
								"question" => "question",
								"cases" => "cases",
								"answers" => "answers",
								"submitted" => "code",
								"casehit"	=> "x+y",
								"casemissed" => "x*y");
								*/
								
	$arraysize= count($array);
			
	
#========================Exam Select Retrieve exam======================
									#e1_final_ryan
	$username = $array['username'];
	$examid	   = $array['examid'];
	$examname= $array['examname'];
	$examname = strtolower($examname);
	$professor  = $array['professor'];
	$grade		   = $array['grade'];
#=================================================================
#Make Table
	$transarray=array("username"=>$username);
	extract($transarray);
	require 'getstudentlastname.php';
	
	#===================================================================
#Update data in student's database

	$identification2="s{$studentid}_{$studentlastname}";
	
	$queue="UPDATE $identification2 SET submitted='yes' WHERE ID='$examid'";
	$result = mysqli_query($connection,$queue);
	
	$queue ="UPDATE $identification2 SET grade='$grade' WHERE ID='$examid'";
	$result = mysqli_query($connection,$queue);
	
	$sendarray = array("response"=>"submitted");
	echo json_encode($sendarray);

	
?>
