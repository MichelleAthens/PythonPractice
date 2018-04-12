<?php

	$con = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   

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