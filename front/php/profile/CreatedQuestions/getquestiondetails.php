<?php
#Get everything in premade table
	$array = array();
	$connection = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   
	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);     

	$questionid = $array['questionid'];
	echo "HERE $questionid";
	$queue="SELECT * FROM premade WHERE ID LIKE '$questionid'";
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

	
		
		$sendarray[] = array("id" => $questionid,
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
	  echo json_encode($sendarray,true);
	 
?>
