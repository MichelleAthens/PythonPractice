<?php
/*
*/
	$array = array();
    $lastname="";
    $points=1;
$connection = mysqli_connect("localhost", "root" ,"pass!","user");         
    
    $response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response


	//$array[] = array("username"=>"mmd38", "examname" => "test","description"=>"blah blah","difficulty"=>"hard","category"=>"Method");
	//$array[] = array("questionid" => 1,"points"=>20);

	//-----Retrieve JSON-----
	$user			 =$array[0]['username'];
	$description	 = $array[0]['description'];
	$examname		 =$array[0]['examname'];
	$examname		 =strtolower($examname);	
	$difficulty		 =$array[0]['difficulty'];
	$category		 =$array[0]['category'];
	//-----Retrieve JSON close-----	
	
	
	$arraysize= count($array);

	$stringdata=$array['0']['username'];
			
			
	//------Get Username Details-----
	$transarray=array("username"=>$stringdata);
	extract($transarray);
	require 'getusername.php';
	//-----USername Details Close-----
		
		
		
	require 'getexamid.php';	
	
	$identification = "{$idmax}_{$examname}";
	
	//-----Create Exam Table----
	$queue = "CREATE TABLE $identification(
	questionid INT(250),
	question VARCHAR(250),
	points INT(250)	
	)";
	
	$result = mysqli_query($connection,$queue);
	//-----Create Exam Table Close-----
	
	
	//-----Insert Questions Into Table----- 			

	for($i = 1; $i<$arraysize; $i++){ //For every question
	
		$questionid = $array[$i]['questionid'];
		$points     = $array[$i]['points'];
	
		$queue = "INSERT INTO $identification (questionid,points) VALUES 
		('$questionid','$points')";
		
			
		$result = mysqli_query($connection,$queue);
	
	}    
	//-----Insert Questions Close-----
	
	mysqli_close($connection);
	
	
	$connection = mysqli_connect("localhost", "root" ,"pass!","username");   
	$identification1="{$lastname}_tc{$id}";
	
	
	
	//-----Insert Test ID entry in Create exams table-----
	$queue ="INSERT INTO $identification1 (testid) VALUES ('$idmax')";
	$result = mysqli_query($connection,$queue);
	//-----Insert Test ID Close-----
	
	
	
	//-----Create a record------
	$queue = "INSERT INTO exams (testid,name,description,difficulty,category,author,rateup,ratedown) VALUES 
	('$idmax','$examname','$description','$difficulty','$category','$username','0','0')";
	$result = mysqli_query($connection,$queue);
	//-----Record Close-----
	
	
	mysqli_close($connection);
	$res = array("response"=>"done");
	echo json_encode($res,true);
?>
