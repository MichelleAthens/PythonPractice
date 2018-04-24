<?php
/*
*/
	$array = array();
    $lastname="";
    $points=1;
		$connection = mysqli_connect("localhost","root","password","mmd38");       
    
    $response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response


	//$array[] = array("username"=>"mmd38", "examname" => "test","description"=>"blah blah","difficulty"=>"hard","category"=>"Method");
	//$array[] = array("questionid" => 1,"points"=>20);

	//-----Retrieve JSON-----
	$user			 =$array[0]['username'];
	$oldid			 =$array[0]['oldid'];
	$examid		 =$array[0]['examid'];
	$rateup		 =$array[0]['rateup'];
	$ratedown    =$array[0]['ratedown'];
	$description	 = $array[0]['description'];
	$examname		 =$array[0]['examname'];
	$examname		 =strtolower($examname);	
	$difficulty		 =$array[0]['difficulty'];
	$category		 =$array[0]['category'];
	//-----Retrieve JSON close-----	
	
	//Test=======================
	//==========================
	
	$arraysize= count($array);

	$stringdata=$array['0']['username'];
			
			
	//------Get Username Details-----
	$transarray=array("username"=>$stringdata);
	extract($transarray);
	require 'getusername.php';
	//-----USername Details Close-----
		
	
	//Delete old
	$result = mysqli_query($connection,"DROP TABLE $oldid");

	echo mysqli_error($connection);
			
			
			
			
	//new id
	$identification = "{$examid}_{$examname}";
	
	//-----Create Exam Table----
	$queue = "CREATE TABLE $identification(
	questionid INT(250),
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
	
	
	$connection = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   
	$identification1="{$lastname}_tc{$id}";
	
	
	
	//-----Delete old entry-----
	$result = mysqli_query($connection,"DELETE FROM $identification1 WHERE testid LIKE '$examid'");
	$result = mysqli_query($connection,"DELETE FROM exams WHERE testid LIKE '$examid'");
	
	//-----Delete old close-----
	
	
	//-----Insert Test ID entry in Create exams table-----
	$queue ="INSERT INTO $identification1 (testid) VALUES ('$examid')";
	$result = mysqli_query($connection,$queue);
	//-----Insert Test ID Close-----
	
	
	
	//-----Create a record------
	$queue = "INSERT INTO exams (testid,name,description,difficulty,category,author,rateup,ratedown) VALUES 
	('$examid','$examname','$description','$difficulty','$category','$username','$rateup','$ratedown')";
	$result = mysqli_query($connection,$queue);
	//-----Record Close-----
	
	
	mysqli_close($connection);
	$res = array("response"=>"done");
	echo json_encode($res,true);
?>
