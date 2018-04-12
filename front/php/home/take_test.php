<?php include "mid.php";?>
<?php include "stuHead.php";?>
<?php session_start();?>

<body>
	
	<div class="container">
	

		<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading">						
					</div>
					<center><div id="exams"></div></center><br>
					
				</div>
			</div>
			
		
		
	</div>
	<div id="ajaxDiv"></div>
</body>
</html>




<script language="javascript">
var LN;
var finalarray=[];
var DATA=[];
var ajaxRequest;  // The variable that makes Ajax possible!
try{ajaxRequest = new XMLHttpRequest();} 
catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
catch (e){alert("BROSWER ERROR");}
		}
	}
	

	// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var Display = document.getElementById('exams');
			
			var res=ajaxRequest.responseText;
		//	alert(res);
			var data=JSON.parse(res);
			var response = data[0]['response'];
			var len=data.length;
			
			if(response=="yes"){
				
				var html="<div class='row'>";
				html+='<h4><br><br><center><font size="+2">Select an exam to take</font></center></h4>';
				html+="<div class='col-md-4'>";
				html+="<table class='table table-striped'>";
				html+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";
				
				html+="<th>Exam ID</th>";
				html+="<th>Exam Name</th>";
				html+="<th>Professor</th>";
				html+="</tr></thead>";
				html+="<tbody>";
				
				
				for(var i=1;i<len;i++){
					var professorname = data[i]['professor'];
					var examname=data[i]['examname'];
					var examid=data[i]['examid'];
					var fusion=examid+'|'+examname + '|' + professorname+'|';
			
			
					html+="<tr><td>";
					html+='<input type="checkbox" name="examlist" id="'+fusion;			
					html+=' " value= " ' +fusion+'"'+'></td>';
					//html+='<input type="hidden" name="examnamelist" value="' +data[i]['examname']+'"'+'></td>';

					
					html+='<td><br>'+data[i]['examid']+'</td>';
					html+='<td><br>'+data[i]['examname']+'</td>';
					html+='<td><br>'+data[i]['professor']+'</td>';
				}
			
				
					html+="</tbody></table>";
					html+="</div></div>";
					html+='<br><br><center><input type="button" class="btn btn-primary" value="Select Exam" onclick="getexam();"></input></center>';
					Display.innerHTML=html;
							
				
				
				
			}
			else{
				alert(response);
			}
			
	
		}
}

var username = "<?php echo $_SESSION['username']; ?>";

ajaxRequest.open("POST", "stuExPalist.php", true);
var myobj = {username:username};
ajaxRequest.send(JSON.stringify(myobj));

var ANSWERS=[];

function getexam(){
	var ajaxRequest;
	
	try{ajaxRequest = new XMLHttpRequest();} 
			catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
			catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
			catch (e){alert("BROSWER ERROR");}
						}
					  }

	  ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
			  var ajaxDisplay = document.getElementById('ajaxDiv');
			  var res=ajaxRequest.responseText;
			  console.log(res);

					
					var Display = document.getElementById('exams');
			
			var res=ajaxRequest.responseText;
		//	alert(res);
			
			var data=JSON.parse(res);
			
			var len=data.length;
			

					
					var html="<div class='containers'>";

					var examname=data[1]['examname'];
					var professor=data[1]['professor'];
					
			
					html+='<h4><center><font size="+2">Exam name:'+examname+' Created by: ' + professor+ '</font></center></h4>';

				
				for(var i=2;i<len;i++){
					
					ANSWERS.push(data[i]['questionid']);
					var questionid = data[i]['questionid'];
					var question=data[i]['question'];
				
					html+='<div><p><em>Problem '+(i-1)+':</em>';
					html+='<br><p>'+question+'</p>';
					html+='<label>Your answer</label><br>';
					html+='<textarea rows="10" style="width:80%" id="'+data[i]['questionid']+'"></textarea><br><br>';
					html+='</div>';
				}
			
					html+='<br><br><center><input type="button" class="btn btn-primary" value="Submit Exam" onclick="submitexam();"></input></center>';
					html+='</div>';
					Display.innerHTML=html;
					
					
					}
				
				
				
				
				
				
				
				
}

				/*for(var i=0;i<LN;i++){
					var ans=document.getElementById(DATA[i]).value;
					var ans={"id":DATA[i],"ans":ans};
					answers.push(ans);
				}*/

				
				
			var username = "<?php echo $_SESSION['username']; ?>";
			var sendarray=[];
			sendarray.push({username:username});
			finalarray.push({username:username});
			var chkbox=document.getElementsByName("examlist");
			
			for(var i=0;i<chkbox.length;i++){
					
					
					if(chkbox[i].checked){
								
							var fused=chkbox[i].id;
							var stringarray = fused.split("|");
							var exam_id=stringarray[0];
							var exam_name=stringarray[1];
							var professor_name=stringarray[2];
							
							finalarray.push({examid:exam_id,examname:exam_name,professor:professor_name});
							sendarray.push({examid:exam_id,examname:exam_name,professor:professor_name});
							
					}
				}
				//console.log(sendarray);
 
 
	ajaxRequest.open("POST", "stuExPagetexam.php", true);
	ajaxRequest.send(JSON.stringify(sendarray));
	
	
	
	
}


function submitexam(){
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
			 

			 html+='<h4><center><font size="+2">Exam Successfully Submitted</font></center></h4>';


			  html+='</div>';
			  ajaxDisplay.innerHTML=html;
			  
			  
					}
			}

		var len=ANSWERS.length;

		for(var i=0;i<len;i++){
			
			var answer=document.getElementById(ANSWERS[i]).value;
			
			finalarray.push({questionid:ANSWERS[i],code:answer});
	}
	
	
	console.log(finalarray);

	ajaxRequest.open("POST", "stuExPasendexam.php", true);
	ajaxRequest.send(JSON.stringify(finalarray));

	}


</script>