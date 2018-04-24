<?php

#==============================================================================

		$connection = mysqli_connect("localhost","root","password","mmd38");      
    $response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================

			$question    = $array['question'];
			$username = $array['username'];
			$sample		=$array['sample'];
			$cases		   = $array['cases'];
			$level  = $array['level'];
			$category = $array['category'];
			
			$lastname="";
			$id=0;
			
			
			$transarray=array("username"=>$username);
			extract($transarray);
			require 'getusername.php';
			
			
			$stringcase="";
			$length = sizeof($cases);
		
			for($i=0; $i<$length; $i++){
				$piece = $cases[$i];
				$text = "$piece|";
				$stringcase="$stringcase$text";

			}
			
			echo $stringcase;
			$result = mysqli_query($connection,"SELECT max(ID) FROM premade");
			$row= mysqli_fetch_assoc($result);
			
			
			$idmax=$row['max(ID)'];			
			$idmax=$idmax+1;
			
			$sample = str_replace("'","\"",$sample);
			
			$queue = "INSERT INTO premade (ID, author, question, cases,sample,category,diff,rateup,ratedown) VALUES
			('$idmax','$username','$question','$stringcase','$sample','$category','$level',0,0)";
			
			$result = mysqli_query($connection,$queue);
			
			echo $queue;
			echo mysqli_error($connection);
			
			$identification2 ="{$lastname}_qc{$id}";
			
			$queue = "INSERT INTO $identification2 (questionid) VALUES 
			('$idmax')";
			//$result = mysqli_query($connection,$queue);
			
			
			$response = array("response"=>"created");
			echo json_encode($response);
			
			
		
		
	
	
	    
?>
