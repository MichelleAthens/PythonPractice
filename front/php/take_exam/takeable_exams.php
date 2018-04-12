<?php
/*Get available exams
===================================================================================


INPUT NEED USERNAME IN ARRAY INDEX 0 0
SELECT EXAMS AFTER 0 0
ARRAY |  0  |  1  |  2  |
|  0  | "username" => "prof1"
|  1  | "question" => "sample", "cases"=>"x+y|var","difficulty"=>"easy","createdby"=>"default"
|  2  | "question" => "sample", "cases"=>"x+y|var","difficulty"=>"easy","createdby"=>"default"
===================================================================================	
*/
#==============================================================================
	$array = array();

	$connection = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   
	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================
	//$array = array("username"=>"mmd38");
	
 
 
	$arraysize= count($array);

	

	
	$queue="SELECT * FROM exams";
	
	$result=mysqli_query($connection,$queue);
	
	$rows = mysqli_num_rows($result);
	
	if($rows!=0){
		$array2[] = array("response" => "yes");
		while($row=mysqli_fetch_assoc($result))
		{
			$examid		=$row['testid'];
			$examname	=$row['name'];
			$description	=$row['description'];
			$difficulty	=$row['difficulty'];
			$category	=$row['category'];
			$author	=$row['author'];
			$rateup	=$row['rateup'];
			$ratedown	=$row['ratedown'];
		
			$array2[]=array("examid" => $examid, "examname" => $examname,"description"=>$description, "difficulty"=>$difficulty,"category"=>$category, "author" =>$author, "rateup"=>$rateup,"ratedown"=>$ratedown);
		
		
		}
	}
	else{
		$array2[] = array("response" => "none");
	}
	
	
	
	echo json_encode($array2);
	
	
	mysqli_close($connection);
	
	    
?>
