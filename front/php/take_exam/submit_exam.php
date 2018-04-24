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
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================
	//$array[] = array("examid" => "1", "examname" => "Final", "professor" => "ryan");
 
 
	/*
	
	
	def check(n):
  if n == 1:
    return "A"
  elif n == 2:
    return "B"
  elif n == 3:
    return "C"
  else:
    return "none"
	
	
									*/
	$arraysize= count($array);
	$finals=json_encode($array,true);
	
	
#========================Exam Select Retrieve exam======================
									#e1_final_ryan
	$username = $array[0]['username'];
	$identification = $array[1]['identification'];	
	$grade		   = $array[1]['grade'];
	
	
#=================================================================
#Make Table
	$transarray=array("username"=>$username);
	extract($transarray);
	require 'getusername.php';
	
	$identification2 = "sub{$username}_{$identification}";
	
	
	$queue = "CREATE TABLE $identification2 (
	ID INTEGER(50),
	question VARCHAR(250),
	caseshit	 VARCHAR(250),
	casesmissed	 VARCHAR(250),
	pointsgot	INT(50),
	pointstotal INT(50),
	submitted VARCHAR(500))
	";
	
	$check = mysqli_query($connection, "SELECT 1 FROM $identification2 LIMIT 1");

	if($check !==FALSE){ //It exists
			$result = mysqli_query($connection,"DROP TABLE $identification2");
			$result = mysqli_query($connection,$queue);
	}
	else{
			$result = mysqli_query($connection,$queue);
		
	}
#===================================================================
#Insert Questions

	for($i=2;$i<=$arraysize-1;$i++){
		
		$test=json_encode($array,true);
		#echo "<br><br>In For $test";
		
		$questionid=$array[$i]['questionid'];
		$question   =$array[$i]['question'];
		$caseshit		= $array[$i]['caseshit'];
		$casesmissed = $array[$i]['casesmissed'];
		$submitted  =$array[$i]['submitted'];
		$pointsgot  =$array[$i]['pointsgot'];
		$pointstotal  =$array[$i]['pointstotal'];

		
		$caseshit=str_replace("'"," ",$caseshit);
		$casesmissed=str_replace("'"," ",$casesmissed);
		$submitted=str_replace("'","\"",$submitted);

		
		$queue="INSERT INTO $identification2(ID,question,caseshit,casesmissed,pointsgot,pointstotal,submitted) VALUES
		('$questionid','$question','$caseshit','$casesmissed','$pointsgot','$pointstotal','$submitted')";
			

		$result = mysqli_query($connection,$queue);		
		

		}
		mysqli_close($connection);
#===================================================================
//Make data entry into user profile lastname_ttID#


		
	$connection = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   
   
   
	$idtest = "{$lastname}_tt{$id}";
	

	
	
	$check = mysqli_query($connection,"SELECT * FROM $idtest WHERE testid LIKE '$identification'");
	
	
	if (mysqli_fetch_assoc($check)){ //Theres an existing entry
		$row = mysqli_fetch_assoc($check);
			
		$rating = $row['rating'];
		if (!$rating){
			$rating = "none";
		}
		
		$queue = "INSERT INTO $idtest(testid,submissionid,rating,score) VALUES 
		('$identification','$identification2','$rating','$grade')";
		
		$array[0] = array("username" => $username,"rating" => $rating);
		
		$result = mysqli_query($connection,"DELETE FROM $idtest WHERE testid LIKE '$identification'");
		$result = mysqli_query($connection,$queue);
	}
	else{
		$queue = "INSERT INTO $idtest(testid,submissionid,rating,score) VALUES 
		('$identification','$identification2','none','$grade')";
		
		$array[0] = array("username" => $username, "rating" => "none");
		$result = mysqli_query($connection,$queue);
	}

	
	$sendarray = array("response"=>"submitted");
	echo json_encode($array);

	
?>
