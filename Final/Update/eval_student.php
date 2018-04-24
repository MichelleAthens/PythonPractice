<?php include "mid.php";?>
<?php include "insHead.php";?>
<?php session_start();?>
<style>
	textarea{
  width:500px;
		border:none;
	        }
</style>

<center><h3>Evaluate</h3></center>



</div>
<div align="middle">
	
	<div class="row">
		<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h4><center><font size="+2">Test</font></center></h4>
					</div>
					<div id="exams"></div>
				</div>
			</div>
	</div>
	
</div>

<div id="ajaxDiv"></div>
<br><br>
<?php include "footer.php";?>



<script>

try{ajaxRequest = new XMLHttpRequest();} 
catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
catch (e){alert("BROWSWER ERROR");}
	}
}


var username = "<?php echo $_SESSION['username']; ?>";
var myobj={"username":username};
var length;

		var finalarray =[];

ajaxRequest.open("POST", "eval_student_studentlist.php", true);
ajaxRequest.send(JSON.stringify(myobj));

ajaxRequest.onreadystatechange = function(){
				
	if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
	
	var return_data = ajaxRequest.responseText;
	console.log(return_data);
	
	
	var Display = document.getElementById('exams');
	
	var data = JSON.parse(return_data);
	//console.log(data);
	
	var len=data.length;
	legnth=len;
	
		var html="<div class='row'>";
		html+="<div class='col-md-4'>";
		html+="<table class='table table-striped'>";
		html+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";

		html+="<th>Student ID</th>";
		html+="<th>Student Username</th>";
		html+="<th>Student Firstname</th>";
		html+="<th>Student Lastname</th>";
		
		html+="</tr></thead>";
		html+="<tbody>";
	
		//console.log(len);
		for(var i=0;i<len;i++){
			
			html+="<tr><td>";
			html+='<input type="checkbox" name="studentlist" id="'+data[i]['studentid'];			
			html+=' " value= "' +data[i]['username']+'"'+'></td>';
			//html+='<input type="hidden" name="examnamelist" value="' +data[i]['examname']+'"'+'></td>';

			
			html+='<td><br>'+data[i]['studentid']+'</td>';
			html+='<td><br>'+data[i]['username']+'</td>';
			html+='<td><br>'+data[i]['studentfirstname']+'</td>';
			html+='<td><br>'+data[i]['studentlastname']+'</td>';
			
			
			
		}
	
	html+="</tbody></table>";
	html+='<br><br><input type="button" value="See Student" class="btn btn-info" onclick="view();"/>';
	html+="</div></div>";
	Display.innerHTML=html;
	
	
	}
				
}
			

function view(){
			var ajaxRequest;  //BROWSWERS
			try{ajaxRequest = new XMLHttpRequest();} 
			catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
			catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");}
			catch (e){
			//ERROR
			alert("BROWSER ERROR");
						}
					}
				}
				
				
				
			ajaxRequest.onreadystatechange = function(){
				
					if(ajaxRequest.readyState == 4){
					  //var ajaxDisplay = document.getElementById('ajaxDiv');
				
								
								
								var return_data = ajaxRequest.responseText;
								console.log(return_data);
								
								
								var Display = document.getElementById('exams');
								
								var data = JSON.parse(return_data);
								//console.log(data);
								
								var len=data.length;
								legnth=len;
								
									var html="<div class='row'>";
									html+="<div class='col-md-4'>";
									html+="<table class='table table-striped'>";
									html+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";

									html+="<th>Username of student</th>";
									html+="<th>Exam ID</th>";
									html+="<th>Exam Name</th>";
									html+="<th>Professor</th>";
									html+="<th>Submission Status</th>";
									
									html+="</tr></thead>";
									html+="<tbody>";
								
									//console.log(len);
									for(var i=1;i<len;i++){
										var examid = data[i]['examid'];
										var examname = data[i]['examname'];
										var professor = data[i]['professor'];
										var studentusername = data[0]['studentusername'];
										var submissionstatus = data[i]['submitted'];
										var fusion = studentusername + '|' + examid + '|' + examname + '|' + professor;
										
										html+="<tr><td>";
										html+='<input type="checkbox" name="examlist" id="'+examid;			
										html+='" value="' +fusion+'"'+'></td>';
										//html+='<input type="hidden" name="examnamelist" value="' +data[i]['examname']+'"'+'></td>';

										
										html+='<td><br>'+studentusername+'</td>';
										html+='<td><br>'+examid+'</td>';
										html+='<td><br>'+examname+'</td>';
										html+='<td><br>'+professor+'</td>';
										html+='<td><br>'+submissionstatus+'</td>';
											
					}
						html+="</tbody></table>";
	html+="</div></div>";
	
	
	html+='<br><br><input type="button" value="See Exam" class="btn btn-info" onclick="seeexam();"/>';
	Display.innerHTML=html;
	
	
					}
								
								
								
								
								
								
								
				}
			
			var username = "<?php echo $_SESSION['username']; ?>";
			var sendarray=[];
			sendarray.push({username:username});
			var chkbox=document.getElementsByName("studentlist");
			
			
			for(var i=0;i<chkbox.length;i++){
					
					
					if(chkbox[i].checked){
								
							var studentid=chkbox[i].id;
							var studentusername=chkbox[i].value;
							sendarray.push({studentid:studentid,studentusername:studentusername});
							
					}
				}
				console.log(sendarray);
				
				ajaxRequest.open("POST", "eval_student_examlist.php", true); //php release from midddle
			 //file get contents, decode, function, CURLS
				ajaxRequest.send(JSON.stringify(sendarray));
}

var FEEDBACK=[];

function seeexam(){
			var ajaxRequest;  //BROWSWERS
			try{ajaxRequest = new XMLHttpRequest();} 
			catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
			catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");}
			catch (e){
			//ERROR
			alert("BROWSER ERROR");
						}
					}
				}
				
				
				
			ajaxRequest.onreadystatechange = function(){
				
					if(ajaxRequest.readyState == 4){
										
											
					  var res=ajaxRequest.responseText;
					  console.log(res);

					
						var Display = document.getElementById('exams');
						
						var res=ajaxRequest.responseText;
					//	alert(res);
						
						var data=JSON.parse(res);
						   
						var len=data.length;
											
						console.log(len);
						var examid = data[1]['examid'];
						var examname = data[1]['examname'];
						var professor = data[1]['professor'];
						var grade = data[1]['grade'];
						var html='<div class="containers">';
						
						
						
					html+='<br><br><h4><center><font size="+2">Exam name:'+examname+'<br> Created by: ' + professor+ '</font></center></h4>';
					html+='<h4><center><font size="+2">Grade: '+grade+'</font></center></h4>';
					html+='<label>New Grade</label><textarea rows="1" style="width:10%;border:solid 2px black;" id="grade"></textarea><br><br></div>';

	html+='<br><br><input type="button" value="Submit Changes" class="btn btn-info" onclick="submit();"/>';
								
								for(var i=2;i<len;i++){
										var caseshit ="";
										var casesmissed="";
										var questionid = data[i]['questionid'];
										var question=data[i]['question'];
										var answer = data[i]['submitted'];
										var stringhit="";
										var stringmissed="";
										var feedback = data[i]['feedback'];
										FEEDBACK.push(questionid);
										
										if(data[i]['caseshit']){
										var caseshit = data[i]['caseshit'];}
										
										if(data[i]['casesmissed']){
										var casesmissed=data[i]['casesmissed'];
										}
										
										html+='<div><p><em>Problem '+(i-1)+':</em>';
										html+='<br><p>'+question+'</p>';
										html+='<label>Your answer</label><br>';
										html+='<textarea rows="10" style="width:30%;border:solid 2px black;" id="'+data[i]['questionid']+'">'+answer +'</textarea><br><br></div>';
										
										var caseshitarray = caseshit.split("|");
										var casesmissedarray=casesmissed.split("|");
										
										
										var hitlength = caseshitarray.length;
										var missedlength = casesmissedarray.length;
										
										
										
										for(var j=0; j<hitlength;j++){
											var cases=caseshitarray[j];
											stringhit+=cases + "\n";
											
											
										}
										
										for(var j=0; j<missedlength;j++){
											var cases=casesmissedarray[j];
											
											stringmissed+=cases + "\n";
											
											
										}
										
										
										
								        html+='<div align="middle" style="border-left:6px solid green;background-color:ccffcc"><label>Cases Hit </label><br><textarea rows="10" style="width:20%;border:solid 2px black; border-radius: 5px;border-left:6px solid green;font-weight:bold;color:green" id="'+data[i]['questionid']+'">'+stringhit +' </textarea><br><br></div>';
								        html+='<div align="middle" style="border-left:6px solid red;background-color:ffcccc"><label>Cases Missed </label><br><textarea rows="10" style="width:20%; border:solid 2px black;border-radius: 5px;border-left:6px solid red;font-weight:bold;color:red" id="'+data[i]['questionid']+'">'+stringmissed +' </textarea><br><br></div>';
								        html+='<div align="middle" style="border-left:6px solid grey;background-color:B8B8B8"><label>Feedback</label><br><textarea rows="10" id="feedback'+questionid+'" style="width:20%; border:solid 2px black;border-radius: 5px;border-left:6px solid gray;font-weight:bold;color:black" id="'+data[i]['questionid']+'">'+feedback +' </textarea><br><br></div>';
										
										
										
										
										
										
										
										html+='</div>';
											
					
					
							}
		
										html+='</div>';
										Display.innerHTML=html;
	
					
								
								
					
			}}
								
								
								
				
			
			var chkbox=document.getElementsByName("examlist");
		
			for(var i=0;i<chkbox.length;i++){
					
					
					if(chkbox[i].checked){
								
							var examid=chkbox[i].id;
							var fusion2=chkbox[i].value;
							var fusionarray = fusion2.split('|');
							var studentusername = fusionarray[0];
							var examname = fusionarray[2];
							var professor = fusionarray[3];
								
							finalarray.push({studentusername:studentusername,examid:examid,examname:examname,professor:professor})
							var sendarray={username:studentusername,examid:examid,examname:examname,professor:professor};
							
					}
				}
				console.log(sendarray);
				
				ajaxRequest.open("POST", "eval_student_getexam.php", true); //php release from midddle
			 //file get contents, decode, function, CURLS
				ajaxRequest.send(JSON.stringify(sendarray));


}
			
			
		
function submit(){
			var ajaxRequest;
			try{ajaxRequest = new XMLHttpRequest();} 
			catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
			catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
			catch (e){alert("BROSWER ERROR");}
						}
					  }

					  
			ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
			  
			  
			  var ajaxDisplay = document.getElementById('exams');
			  var res=ajaxRequest.responseText;
			  console.log(res);
			  
			  
			  
			 var html="<div class='submitted'>";
			 

			 html+='<h4><center><font size="+2">Exam Successfully Updated</font></center></h4>';


			  html+='</div>';
			  ajaxDisplay.innerHTML=html;
			  
			  
					}
			}

		var len=FEEDBACK.length;
		var newgrade = document.getElementById("grade").value;
		finalarray.push({newgrade:newgrade});
		for(var i=0;i<len;i++){
			
			var feedback=document.getElementById("feedback"+FEEDBACK[i]).value;
			
			finalarray.push({questionid:FEEDBACK[i],feedback:feedback});
	}
	
	
	console.log(finalarray);
	
	

	ajaxRequest.open("POST", "eval_student_updateexam.php", true);
	ajaxRequest.send(JSON.stringify(finalarray));

	}	
			
</script>