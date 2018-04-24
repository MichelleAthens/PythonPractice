<?php

		$connection = mysqli_connect("localhost","root","password","mmd38");      


	$queue  = "SELECT * FROM premade WHERE ID = $questionid";
	
	$result2 = mysqli_query($con,$queue);
	
	$row = mysqli_fetch_assoc($result2);
	$question = $row['question'];
	$cases = $row['cases'];
	$sample = $row['sample'];

	
	mysqli_close($con);
	
?>