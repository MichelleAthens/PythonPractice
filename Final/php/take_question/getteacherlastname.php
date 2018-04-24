<?php
#Retrieve Last name of Teacher
#
#+--------------+--------------------------------------------------------------+------------+------------+---------------
#| username  | password                                                              | status     | firstname |  lastname| 
#+--------------+--------------------------------------------------------------+------------+------------+--------------
#| prof1          | 123																		   | teacher|  |Michelle   |  Dizon    |
#+--------------+--------------------------------------------------------------+------------+------------+----------------

	$con = mysqli_connect("localhost","root","password","mmd38");

	$result = mysqli_query($con,"SELECT * FROM teachers WHERE username like '$username'");
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	$lastname = $row['lastname'];
  $lastname = strtolower($lastname);
	#mysqli_close($con);
	
	//echo $id;
	//echo $lastname;
?>