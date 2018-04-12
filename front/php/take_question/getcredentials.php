<?php

	$con = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   

	$result = mysqli_query($con,"SELECT * FROM usernames WHERE username like '$username'");
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	$username = $row['username'];
	$lastname = $row['lastname'];
	
	//$lastname = strtolower($lastname);
	$username = strtolower($username);
	mysqli_close($con);

?>