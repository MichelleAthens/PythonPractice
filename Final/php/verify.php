<?php
//db718787039 = generic database


	$in = file_get_contents('php://input');
	$username = json_decode($in,true);
	
	
$connection = mysqli_connect("localhost", "root" ,"pass!","user");   
	$result= mysqli_query($connection,"SELECT * FROM usernames WHERE username LIKE $username");
	
	
	 $match = mysqli_num_rows($result);
    
	if($match!=0){
		$response = array("response"=>"taken");
		echo json_encode($response,true);
		
	}
	else{
		$response = array("response"=>"nt");
		echo json_encode($response,true);
		
	}

	mysqli_close;
?>