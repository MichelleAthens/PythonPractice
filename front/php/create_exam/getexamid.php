<?php

		$connection = mysqli_connect("localhost","root","password","mmd38");      

	$result = mysqli_query($con,"SELECT MAX(testid) FROM exams");
	$row = mysqli_fetch_assoc($result);

	$idmax = $row['MAX(testid)'];
	
	
	
	if($idmax==0){
		$idmax=1;
		
	}
	else{
		$idmax++;
	}
	mysqli_close($con);
	
?>