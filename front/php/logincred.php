<?php

	$in = file_get_contents('php://input');
	
	$array = json_decode($in,true);
	
	$username=$array['username'];
	$firstname=$array['firstname'];
	$lastname=$array['lastname'];
	$password=$array['pass'];
	$security=$array['security'];
	$answer=$array['answer'];
	
	
	$connection = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   
   
   
	$result = mysqli_query($connection,"SELECT max(ID) FROM usernames");
	$row= mysqli_fetch_assoc($result);
	$idmax=$row['max(ID)'];
	
	if(!$idmax){
		$id=1;
	}
	else{
		$id=$idmax+1;
	}
   
   $lastname = strtolower($lastname);
   $firstname = strtolower($firstname);
   
   //Questions taken
	$identification1 = "{$lastname}_qt{$id}";
	

	$queue1 = "CREATE TABLE $identification1(
	questionid INT(250),
	question VARCHAR(500),
	submission VARCHAR(500),
	rating VARCHAR(100),
	caseshit VARCHAR(500),
	casesmissed VARCHAR(500)
	)";
	
	
	//Questions Created
	$identification2 ="{$lastname}_qc{$id}";

	
	$queue2 = "CREATE TABLE $identification2(
	questionid INT(250)
	)";
	
	//Tests Taken
	$identification3 = "{$lastname}_tt{$id}";

	
	$queue3 = "CREATE TABLE $identification3(
	testid VARCHAR(250),
	submissionid VARCHAR(250),
	rating VARCHAR(100),
	score INT(250)
	)";
	
	
	//Tests Created
	$identification4 = "{$lastname}_tc{$id}";

	
	$queue4 = "CREATE TABLE $identification4(
	testid INT(250)
	)";
	
	
	$result1 = mysqli_query($connection,$queue1);
	$result2 = mysqli_query($connection,$queue2);
	$result3 = mysqli_query($connection,$queue3);
	$result4 = mysqli_query($connection,$queue4);
	
	
   
   
   
   
   
   
   
   
	$passhash = password_hash($password,PASSWORD_DEFAULT);
   
   
	$queue = "INSERT INTO usernames(id,username,pass,firstname,lastname,sec,ans) VALUES
	 ('$id','$username','$passhash','$firstname','$lastname','$security','$answer')";

	$result5 = mysqli_query($connection,$queue);
	
	if($result5){
	$response = array("response"=>"success");
	
		
	}
	else{
		$response = array("response" =>"error");
	}
	
	echo json_encode($response,true);
?>