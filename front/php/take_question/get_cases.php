<?php
/*Get cases
===================================================================================

*/
#==============================================================================
	$array = array();
	$sendarray = array();
	
	$connection = mysqli_connect("db718787039.db.1and1.com", "dbo718787039" ,"Hinatachan1!","db718787039");   

	$response = file_get_contents('php://input');
    $array  = json_decode($response,true);                       #Get the response
#==============================================================================

	$questionid = $array['questionid'];	
	
	#$questionid =1;

	
	$queue="SELECT * FROM premade WHERE ID LIKE $questionid";
	
	$result=mysqli_query($connection,$queue);
	
	$row=mysqli_fetch_assoc($result);
	
	$questionid = $row['ID'];
	$case			= $row['cases'];
	$question	= $row['question'];
		
	$case = cleancases($case);
		
		
		
		
	$sendarray[] = array("questionid" => $questionid,"question" => $question, "cases" => $case);
	
	$sendarray = json_encode($sendarray,true);
	echo $sendarray;
	
	mysqli_close($connection);

//======================================================================
//======================================================================
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
