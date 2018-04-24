<?php

#==============================================================================

		$connection = mysqli_connect("localhost","root","password","mmd38");      
    $response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================
			$questionid = $array['questionid'];
			$question    = $array['question'];
			$author = $array['username'];
			$sample		=$array['sample'];
			$cases		   = $array['cases'];
			$level  = $array['level'];
			$category = $array['category'];
			
			$stringcase="";
			$length = sizeof($cases);
		
			for($i=0; $i<$length; $i++){
				$piece = $cases[$i];
				$text = "$piece|";
				$stringcase="$stringcase$text";

			}
		
			$sample = str_replace("'","\"",$sample);
			
			
			$check = mysqli_query($connection,"SELECT * FROM premade WHERE ID LIKE '$questionid'");
	
			if (mysqli_fetch_assoc($check)){ //Theres an existing entry
		
				$result = mysqli_query($connection,"DELETE FROM premade WHERE ID LIKE '$questionid'");
				echo mysqli_error($connection);
			}
			
			
			$queue = "INSERT INTO premade (ID, author, question, cases,sample,category,diff,rateup,ratedown) VALUES
			('$questionid','$author','$question','$stringcase','$sample','$category','$level',0,0)";
			
			$result = mysqli_query($connection,$queue);
			
			$response = array("response"=>"created");
			echo json_encode($response);
	    
?>
