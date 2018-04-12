<?php
	$array1  = array();
	$finalarray = array();
	$sendarray = array();
	$questionsarray=array();
	$caseshit="";
	$casesmissed="";
	$questionid=0;

	
	$response = file_get_contents('php://input');
    $array1   = json_decode($response,true);       
	//======================================================================

	
	
	$username 	= $array1 [0]['username'];
	$questionid		= $array1 [0]['questionid'];
	$answer	=$array1 [0]['code'];
	
	#echo $answer;
	/*$username = "mmd38";
	$questionid = 1;
	$answer="def addition(x,y):
	sum = x+y
	return (sum)";
	*/
	//======================================================================
	#echo $response;
	
	$sendingarray = array("questionid" => $questionid);
	$sendingarray=json_encode($sendingarray,true);

	

	$ch=curl_init();
	
	 $req = "http://michelleathensdizon.com/projects/PythonPractice/front/php/take_question/get_cases.php";

    curl_setopt_array($ch, array(
    CURLOPT_URL => $req,
    CURLOPT_POST => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => $sendingarray
  ));  
  	$resp = curl_exec($ch);
 //=====================================================================

$sendarray = json_decode($resp,true);
$casearray=$sendarray;

  curl_close($ch);
//=====================================================================

	
$arraysize = count($array1);
$points=0;
$inputpoints=0;
$input="";
$totalsize=0;
$totalscore = 0;
//|0|1|2
//|0|1|2|3|



//|0|1|2|3|4|5
//|0|1|2|3
$totalpoints=0;

	$pointsgot=0;
	global $casesmissed;
	$casesmissed="";
	global $caseshit;
	$caseshit	="";

	global $questionid;
	$questionid		= $sendarray[0]['questionid'];
	$case 					= $sendarray[0]['cases'];
	$amount         = $sendarray[0]['points'];
	$code 					= $array1[0]['answer'];
	$question				= $sendarray[0]['question'];
	
	//**********
	$code = $answer;
	//***********
	
	
	$totalpoints=$totalpoints+$amount;

	$casearray = explode("|",$case);

	$size = sizeof($casearray); 
	
	global $totalsize;

#====================================================Testing
#=========================================================
#
		for ($i=0; $i<=$size;$i++) 					#FOR EVERY IDENTIFING CASE
		{
			$data = $casearray[$i]; 						#Line of a case
			$data = trim($data);
			

			
			$pieces = explode(" ", $data);
			$id = $pieces[0]; 								
			switch($id){
			#=========================================================	
				case "INPUT":
					$input ="";
					$inputpoints=0;
					$input = "$pieces[1]";
					$inputpoints++;
					
					$i++;
					$nextdata = $casearray[$i];
					
					$nextdata = trim($nextdata);
					
					$pieces = explode(" ", $nextdata);
					$datasol = $pieces[1];
				
					solution($code,$input,$datasol);
					break;
				#=========================================================			
				case "COUNT":
					$dataline = $casearray[$i];
					$datarray= explode(" ", $dataline);

			
					$pos=1;
					
					$data=$datarray[$pos];
					
					while(!$data){
						$pos++;
						$data=$datarray[$pos];
					}
					
					$wanted=$data;
					
					$pos++;
					
					$dataid=$datarray[$pos];
					
					if($dataid=="WANT"){
						$pos++;
						
						$data=$datarray[$pos];
						
						while(!$data){
							$pos++;
							$data=$datarray[$pos];
						}
						
						$counting = $datarray[$pos];
						
						counting($wanted,$counting);
					}
					break;
				#=========================================================	
				case "FIND":
					
          
          $search = $pieces[1];
				
				if (strpos($code,$search)!==false){
					$points++;
					
					$score = $amount/$size;
					$score = number_format((float)($score),2,'.','');
					
					$pointsgot = $pointsgot + $score;
				    $caseshit = "$caseshit|FOUND $search";	
				}
        else{
			
					$score = $amount/$size;
					$score = number_format((float)($score),2,'.','');
					
				
					$casesmissed = "$casesmissed|COULD NOT FIND $search";
        }

			break;
          /*	$search = $pieces[1];
						echo "Searching for $search";
						$bodycode = preg_replace('/^.+\n/', '',$code);//Skip the first line 
						
						
						$wordCounts = array_count_values(str_word_count($bodycode,1));
						$codecount = (isset($wordCounts[$search])) ? $wordCounts[$search] : 0;
				
        
            echo "Count is $codecount";
						if($codecount>=1){
							#echo "<br>FOUND <br>";
							$caseshit = "$caseshit|<br>FOUND $search";
							$points++;
						}
						else{
							$casesmissed = "$casesmissed|<br>COULD NOT FIND $search";
							#echo "<br>NOT FOUND";
						}
						/*if (strpos($code,$search)){
							$points++;
							
						}*/

				#=========================================================
				case "FUNCTION-NAME":
					$functionname = $pieces[1];
					
					$lines=explode("\n",$code);
					$firstline = $lines[0];//Get only the first line
					
             
          #$search = $pieces[1];
				
  				if (strpos($firstline,$functionname)!==false){
  					$points++;
					
					$score = $amount/$size;
					$score = number_format((float)($score),2,'.','');
					
					$pointsgot = $pointsgot + $score;
  				    $caseshit = "$caseshit|FOUND $functionname";	
  				}
          else{
          
					$score = $amount/$size;
					$score = number_format((float)($score),2,'.','');
					
  					$casesmissed = "$casesmissed|COULD NOT FIND $functionname";
          }
                     
					/*$wordCounts = array_count_values(str_word_count($firstline,1));
					$codecount = (isset($wordCounts[$functionname])) ? $wordCounts[$functionname] : 0;
					
					if($codecount==1){
						$caseshit = "$caseshit|FOUND DESIRED FUNCTION NAME $functionname";
						$points++;
					}
					else{
						$casesmissed="$casesmissed|MISMATCHED FUNCTION NAME WANTED $functionname";
					}
				break;*/
			    break;
          
          }
	


		}
	$caseshit = trim($caseshit,"|");
	$casesmissed = trim($casesmissed,"|");
	
	$questionsarray = array();
	$questionsarray = array("username"=>$username,"questionid" => $questionid,"question"=>$question,"caseshit" => $caseshit, "casesmissed" => $casesmissed, "submitted" => $code);

	$final=$questionsarray;
	

	//echo "<br>$caseshit<br>";
	//echo "<br>$casesmissed<br>";
	
#======================================================	
#======================================================	

   	$ch=curl_init();
	
		 $req = "michelleathensdizon.com/projects/PythonPractice/front/php/take_question/submit.php";

    curl_setopt_array($ch, array(
    CURLOPT_URL => $req,
    CURLOPT_POST => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => json_encode($final,true)
  ));  
  	$resp = curl_exec($ch);
#======================================================	
#======================================================	  
	  echo $resp;
//*/
#======================================================	
#======================================================
#======================================================	
#======================================================
#======================================================	
#======================================================
#======================================================	
#======================================================
function makepyfile($code,$params){ //Write the code to file
	global $casesmissed;
	global $input;
	$funccall="";

	$tok = strtok($code," \n\t"); //Get the first token should be def

		if($tok=="def"){
		$tok=strtok(" \n\t");
		
		$line = $tok;
		$func=explode("(",$line);
		
		//Pull out the function in order to make a call
		$funccall = $func[0];
	}
  
 
  $infile="grade.py";
  file_put_contents("grade.py", "");
  $file = fopen($infile,"w");		#Make a file
	
 
	$header = ""; 
	$need = "print(\"content-type: text/html\\n\\n\")";
	$output = "\nprint (solution)";
	fwrite($file,$code."\n");

	if(!fwrite($file,"\n\nsolution = {$funccall}({$input})\n",200)){
   echo"Unable to write";
	}
	
	#fwrite($file,$need);
	
	fwrite($file,$output);
	fclose($file);
	$input="";
	
	$result = exec("python grade.py 2>&1",$output,$return) ;
	
	if (!$return){
	}
	else{
		
		
	}
	return $result;
}

#======================================================
function solution($code,$input,$datasol){
	global $points;
	global $inputpoints;
	global $caseshit;
	global $casesmissed;
	global $amount;
	global $pointsgot;
	global $size;
	
	$studentresult = makepyfile($code,$input);
	
	$studentresult=(string)$studentresult;
	$datasol = (string)$datasol;
	if ($studentresult===$datasol){
		

		$points = $points + $inputpoints +1;
		
		
		$score = $amount/$size;
		$score = number_format((float)($score),2,'.','');
		$score = $score*2;
		
		$pointsgot = $pointsgot + $score;
		$caseshit="$caseshit|INPUTTING $input MATCHED SOLUTION $datasol";
		
		$inputpoints=0;	
	
	}
	else{
		
		
		
		$score = $amount/$size;
		$score = number_format((float)($score),2,'.','');
		$score = $score*2;
		
		
		$casesmissed = "$casesmissed|INPUTTING $input GOT $studentresult NEEDED $datasol";
		$inputpoints=0;
	}
}

#======================================================


#======================================================

function counting($want,$need) {
	global $points;
	global $code;
	global $casesmissed;
	global $caseshit;
	global $pointsgot;
	global $size;
	global $amount;
	
	$wantsize = strlen($want);
	$wordCounts = array_count_values(str_word_count($code,1));
	$codecount = (isset($wordCounts[$want])) ? $wordCounts[$want] : 0;
	
	
	if($wantsize==1){ //If looking for a char
		if(substr_count($code,$want)==$need){
			$points++;
		
		
		
		$score = $amount/$size;
		
		$score = number_format((float)($score),2,'.','');
		$pointsgot = $pointsgot + $score;
		$caseshit = "$caseshit|COUNTING $want NEEDED $need";
		}
		else{
			
			$codecount = substr_count($code,$want);
			$score = $amount/$size;
			$score = number_format((float)($score),2,'.','');
		
		$casesmissed = "$casesmissed|COUNTING $want FOUND $codecount NEED $need";
		}
	
	}
	else if($codecount==$need){
		$points++;
		
		
		
		
		
		$score = $amount/$size;
		$score = number_format((float)($score),2,'.','');
		$pointsgot = $pointsgot + $score;
		$caseshit = "$caseshit|COUNTING $want NEEDED $need";

	}
	else{
		
		
		$score = $amount/$size;
		$score = number_format((float)($score),2,'.','');
		
		$casesmissed = "$casesmissed|COUNTING $want FOUND $codecount NEED $need";
	}
}
#======================================================

#======================================================
#*/
?>