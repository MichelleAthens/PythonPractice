<?php


		$connection = mysqli_connect("localhost","root","password","mmd38");        

	$result = mysqli_query($con,"SELECT * FROM usernames WHERE username like '$username'");
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	$username = $row['username'];
	$lastname = $row['lastname'];
	
	//$lastname = strtolower($lastname);
	$username = strtolower($username);
	mysqli_close($con);

?>