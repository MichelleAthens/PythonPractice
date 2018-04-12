<?php

	$con = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   


	$queue  = "SELECT * FROM premade WHERE ID = $questionid";
	
	$result2 = mysqli_query($con,$queue);
	
	$row = mysqli_fetch_assoc($result2);
	$question = $row['question'];
	$cases = $row['cases'];
	$sample = $row['sample'];

	
	mysqli_close($con);
	
?>