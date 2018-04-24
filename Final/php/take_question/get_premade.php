<?php
#Get everything in premade table
	$array = array();
	$connection = mysqli_connect("localhost", "root" ,"pass!","username");   

	$queue="SELECT * FROM premade";
	$result=mysqli_query($connection,$queue);
	$numofrows=mysqli_num_rows($result);
	
	while($row=mysqli_fetch_assoc($result)){
		$questionid = $row['ID'];
		$question = $row['question'];
		$category = $row['category'];
		$level = $row['diff'];
		$cases = $row['cases'];
		$author = $row['author'];
		$rateup = $row['rateup'];
		$ratedown = $row['ratedown'];

	
		
		$array[] = array("id" => $questionid,
								  "question" => $question,
								  "category" => $category,
								  "level" 	=> $level,
								  "cases"	=> $cases,
								  "author"  => $author,
								  "rateup"  => $rateup,
								  "ratedown" => $ratedown
								  );
	}
	   mysqli_close($connection);
	  echo json_encode($array);
	 
?>
