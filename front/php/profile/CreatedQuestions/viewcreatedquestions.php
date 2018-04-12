<?php
#Get everything in premade table
	$array = array();
	$connection = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   
	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);     
	
	$username = $array['username'];

	$queue="SELECT * FROM premade WHERE author LIKE '$username'";
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
		$sample = $row['sample'];

	
		
		$sendarray[] = array("id" => $questionid,
								  "question" => $question,
								  "category" => $category,
								  "level" 	=> $level,
								  "cases"	=> $cases,
								  "author"  => $author,
								  "sample" => $sample,
								  "rateup"  => $rateup,
								  "ratedown" => $ratedown
								  );
	}
	   mysqli_close($connection);
	  echo json_encode($sendarray,true);
	 
?>
