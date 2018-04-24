<?php include "mid.php";?>
<?php include "homehead.php";?>
<?php session_start();?>
<head>

<script src="jquery-3.3.1.min.js"></script>

<script type="text/javascript" src="codemirror/plugin/codemirror/lib/codemirror.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<script src="codemirror/plugin/codemirror/mode/python/python.js"></script>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">  
<link rel="stylesheet" type="text/css" href="codemirror/plugin/codemirror/lib/codemirror.css">



<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



</head>

<style>

.col-md-4{
	 display: inline-block;
	border-style:groove;
	border-width:7px;
	border-radius:8px;
	width:100%;
	overflow: hidden;
	padding:10px,10px,10px,10px;
}

#testtable{
	padding:40px;
}

#exams{
	padding:40px;
	width:100%
	
}
#rateup{
	color:green;
	
    font-weight: bold;
}
#ratedown{
	color:red;
	
    font-weight: bold;
}

#rateupbutton{
	width:150px;
	text-align:center;
}

#ratedownbutton{
	width:150px;
	text-align:center;
}


.results{
	width:100%;
	border-bottom: 6px solid #67B3FF;
	display:inline-block;
	background-color: #fafafa;
	padding:30px;
	
	
}
.scoreleft{
	display: inline-block;
	float:left;
	width:75%
}
.scoreright{
	display: inline-block;
	float:right;
	width:20%
}

#qTest{
	background-color:#67B3FF;
}

</style>



<body>
	
	<div class="container">
	
		<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading">						
					</div>
					<div id="exams"></div><br>
					<div id="score"></div>
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
var ajaxRequest;  
var username = "<?php echo $_SESSION['username']; ?>";
var ANSWERS=[];
var editor = [];

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
			var data=JSON.parse(res);
			var response = data[0]['response'];
			var len=data.length;
			
			if(response=="yes"){
				
				var html="<div class='row' id ='testtable'>";
				html+='<h4><br><br><center><font size="+2">Select an exam to take</font></center></h4>';
				html+="<div class='col-md-4'>";
				html+='<table id="qTest" width="100%">';
				html+="<thead><tr>";
				
				html+="<th></th>";
				html+="<th>ID#</th>";
				html+="<th>Test Name</th>";
				html+="<th>Author</th>";
				html+="<th>Category</th>";
				html+="<th>Level</th>";
				
				html+="<th>(+)</th>";
				html+="<th>(-)</th>";
				html+="<th>Description</th>";
				html+="</tr></thead>";
				html+="<tbody>";
				
				
				for(var i=1;i<len;i++){
					var author= data[i]['author'];
					var examname=data[i]['examname'];
					var examid=data[i]['examid'];
					var description=data[i]['description'];
					var difficulty=data[i]['difficulty'];
					var category=data[i]['category'];
					var author=data[i]['author'];
					var rateup=data[i]['rateup'];
					var ratedown=data[i]['ratedown'];
					var identification = examid+ "_" + examname;
					console.log(identification);
					
					
					html+="<tr>";
					html+="<td></td>";
					html+="<div id='entry"+examid+"'><td>";
					html+='<input type="button" class="w3-button w3-light-blue w3-round-xxlarge" id="button'+examid+'" name="questionlist" id="'+examid+'" onclick="getexam(\''+identification+'\');"';			
					html+='" value="'+examid+'"'+'><p hidden>'+examid+'</p></td>';
					
					
					html+="<td>"+examname+"</td>";
					html+="<td>"+author+"</td>";
					html+="<td>"+difficulty+"</td>";
					html+="<td>"+category+"</td>";
					html+="<td><div id='rateup'>"+rateup+"</div></td>";
					html+="<td><div id='ratedown'>"+ratedown+"</div></td>";
					html+="<td>"+description+"</td>";
					html+="</tr>";
					
				}
				
				
			
				
					html+="</tbody></table>";
					html+="</div></div>";

					Display.innerHTML=html;
									
					$(document).ready(function() {
										$('#qTest').DataTable( {
											responsive: {
												details: {
													type: 'column'
												}
											},
											columnDefs: [ {
												className: 'control',
												orderable: false,
												targets:   0
											} ],
											order: [ 1, 'asc' ]
										} );
									} );

			}
			else{
				alert(response);
			}
			
	
		}
}



ajaxRequest.open("POST", "take_test_list.php", true);
var myobj = {username:username};
ajaxRequest.send(JSON.stringify(myobj));



function getexam(id){
	
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
			var data=JSON.parse(res);
			var len=data.length;
			

			
			var html="<div class='containers'>";


				
					for(var i=0;i<len;i++){
						
							ANSWERS.push(data[i]['questionid']);
							var questionid = data[i]['questionid'];
							var question=data[i]['question'];
							var sample = data[i]['sample'];
						
							html+='<div><p><em>Problem '+(i+1)+':</em>';
							html+='<br><p>'+question+'</p>';
							html+='<label>Your answer</label><br>';
							html+='<textarea rows="10" style="width:80%" id="'+data[i]['questionid']+'">'+sample+'</textarea><br><br>';
							html+='</div>';
					}
			
			
			
					html+='<br><br><center><input type="button" class="btn btn-primary" value="Submit Exam" onclick="submitexam(\''+id+'\');"></input></center>';
					html+='</div>';
					Display.innerHTML=html;
					
			



			
					}
					
					for(var i=0;i<len;i++){
						
								editor[i] = CodeMirror.fromTextArea(document.getElementById(data[i]['questionid']), {
								mode: {name: "python",
									    version: 3,
									    singleLineStringErrors: false},
										lineNumbers: true,
										indentUnit: 4,
										matchBrackets: true
								});
						
				
					}			
				
}

			
			var JSONobject = {"identification":id};
			
			console.log(JSONobject);

 
			ajaxRequest.open("POST", "take_test_get.php", true);
			ajaxRequest.send(JSON.stringify(JSONobject));
}


function submitexam(testid){
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
			 
			  showresults(res);
			  /*
			 var html="<div class='submitted'>";
			 

			 html+='<h4><center><font size="+2">Exam Successfully Submitted</font></center></h4>';


			  html+='</div>';
			  ajaxDisplay.innerHTML=html;
			  */
			  
					}
			}

		var len=ANSWERS.length;
				
		finalarray.push({"username":username});
		finalarray.push({"examid":testid});
		
		for(var i=0;i<len;i++){
	
			var answer = editor[i].getValue();
			finalarray.push({questionid:ANSWERS[i],code:answer});
		
		}
	
	
		console.log(finalarray);

		ajaxRequest.open("POST", "take_test_submit.php", true);
		ajaxRequest.send(JSON.stringify(finalarray));

	}

function showresults(data){
	
	  console.log(data);

		var oldDisplay = document.getElementById('exams');
		oldDisplay.parentNode.removeChild(oldDisplay);
		var Display = document.getElementById('score');
						
					
		var data=JSON.parse(data);
					   
		var len=data.length;
									
		var identification = data[1]['identification'];
		var grade = data[1]['grade'];
		var rating = data[0]['rating'];
		
		var html='<div class="containers">';
						
		var senddata = JSON.stringify(data);				
						
		html+='<h4><center><font size="+2">Grade: '+grade+'</font></center></h4>';
		
		if(rating == "none"){
			html+="<h3><center> Rate This</h3><br>";

			html+="<center><input type='button' id='rateupbutton' class='w3-button w3-green' onclick='rateup(\""+identification+"\")' value='Rate Up'>";	
			html+="<input type='button' id='ratedownbutton' class='w3-button w3-red' onclick='ratedown(\""+identification+"\")' value='Rate Down'></center>";	
		}
		else{
			html+="<h2><center>You've already rated this exam</center></h2>";
		}
								
		for(var i=2;i<len;i++){
				var caseshit ="";
				var casesmissed="";
				var questionid = data[i]['questionid'];
				var question=data[i]['question'];
				var answer = data[i]['submitted'];
				var stringhit="";
				var stringmissed="";
				var pointsgot=data[i]['pointsgot'];
				var pointstotal=data[i]['pointstotal'];
				
										
				if(data[i]['caseshit']){
						var caseshit = data[i]['caseshit'];}
				
				if(data[i]['casesmissed']){
						var casesmissed=data[i]['casesmissed'];}
										
				html+='<div class="results">';				
				html+='<div class="scoreleft"><p><em>Problem '+(i-1)+':</em>';
				html+='<br><p>'+question+'</p>';
				html+='<label>Your answer</label><br>';
				html+='<textarea id="score'+data[i]['questionid']+'">'+answer +' </textarea><br><br></div>';
				
				var caseshitarray = caseshit.split("|");
				var casesmissedarray=casesmissed.split("|");
										
										
				var hitlength = caseshitarray.length;
				var missedlength = casesmissedarray.length;
										
				html+='<div class="scoreright">';
				html+="<p><center>Points: "+pointsgot+"/"+pointstotal+"</center></p>";
				html+="<p><center>Cases Hit</center>";						
				for(var j=0; j<hitlength;j++){
						var cases=caseshitarray[j];
						stringhit+=cases + "\n";
					    html+= "<br><font color='green'>      &#x2714;    "+cases+"</font></br>";

									
				}
				
				html+="</p><p><center>Cases Missed</center>";
				for(var j=0; j<missedlength;j++){
						var cases=casesmissedarray[j];
						stringmissed+=cases + "\n";
						html+= "<br><font color='red'>      &#x2716;     "+cases+"</font></br>";
					
											
				}
									
				html+="</p></div></div>";

				/*
def check(n):
  if n == 1:
    return "A"
  elif n == 2:
    return "B"
  elif n == 3:
    return "C"
  else:
    return "none"
*/									
											
			}
			
						html+='</div>';
			Display.innerHTML=html;
					
					for(var i=2;i<len;i++){
								var string = "score"+data[i]['questionid'];
								editor[i] = CodeMirror.fromTextArea(document.getElementById(string), {
								mode: {name: "python",
									    version: 3,
									    singleLineStringErrors: false},
										lineNumbers: true,
										indentUnit: 4,
										matchBrackets: true
								});
						
				
					}			
					
				
					}			

function rateup(input){
	var ajaxRequest;
			try{ajaxRequest = new XMLHttpRequest();} 
			catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
			catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
			catch (e){alert("BROSWER ERROR");}
						}
					  }

					  
			ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
			  
			  
			  var ajaxDisplay = document.getElementById('score');
			  var res=ajaxRequest.responseText;
			  console.log(res);
			 
			  
			 var html="<div class='submitted'>";
			 

			 html+='<h4><center><font size="+2">Thank you for rating</font></center></h4>';


			  html+='</div>';
			  ajaxDisplay.innerHTML=html;
			  
			  
					}
			}

	
		console.log(input);
		
		var idarray = input.split("_");
		
		var idnumber = idarray[0];
		var name = idarray[1];
				
		
		var rateinfo = {"username":username,"examid":idnumber,"examname":name,"rating":"pos"};
		console.log(rateinfo);
		ajaxRequest.open("POST", "take_test_rate.php", true);
		ajaxRequest.send(JSON.stringify(rateinfo));


}
function ratedown(input){
	
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
			 
			 			  
			  var ajaxDisplay = document.getElementById('score');
			  var res=ajaxRequest.responseText;
			  console.log(res);
			 
			  
			 var html="<div class='submitted'>";
			 

			 html+='<h4><center><font size="+2">Thank you for rating</font></center></h4>';


			  html+='</div>';
			  ajaxDisplay.innerHTML=html;
					}
			}

	
		console.log(input);
		
		var idarray = input.split("_");
		
		var idnumber = idarray[0];
		var name = idarray[1];
				
		
		var rateinfo = {"username":username,"examid":idnumber,"examname":name,"rating":"neg"};
		console.log(rateinfo);
		ajaxRequest.open("POST", "take_test_rate.php", true);
		ajaxRequest.send(JSON.stringify(rateinfo));

}



</script>