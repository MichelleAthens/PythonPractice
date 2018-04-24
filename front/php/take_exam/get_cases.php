<?php
/*Get cases
===================================================================================

*/
#==============================================================================
	$array = array();
	$sendarray = array();
	
		$connection = mysqli_connect("localhost","root","password","mmd38");      
	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================

	
	$identification = $array['identification'];

	
	
	$queue="SELECT * FROM $identification";
	
	$result=mysqli_query($connection,$queue);
	
	while($row=mysqli_fetch_assoc($result)){
		$questionid = $row['questionid'];
		$points 	= $row['points'];
		

		
		$transarray=array("questionid"=>$questionid);
		extract($transarray);
		require 'getquestiondetails.php';
		
		
				
		$cases = cleancases($cases);
		
		
		$sendarray[] = array("questionid" => $questionid, "question" => $question,"cases" => $cases,"points"=>$points);

	
	}
	
	echo json_encode($sendarray);
	
	
	mysqli_close($connection);
	
	
	
	function cleancases($instring){
	$instring = $instring;
	
	
	$outstring = str_replace('\t',' ',$instring);
#	$outstring = preg_replace('/\?\s+/', '|', $instring);
	$outstring = preg_replace('/( )+/', ' ', $instring);
	
	$outstring = str_replace('\n','|',$outstring);
	

	if(endsWith($outstring,'|')){
		$outstring = rtrim($outstring,'|');
	}
	
	if(startsWith($outstring,'|')){
		$outstring = rtrim($outside,'|');
	}
	
	return $outstring;
	}
//======================================================================
	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);

		return $length === 0 || 
		(substr($haystack, -$length) === $needle);
	}
	//======================================================================
	function startsWith($haystack, $needle)
	{
		 $length = strlen($needle);
		 return (substr($haystack, 0, $length) === $needle);
	}
	    
?>
