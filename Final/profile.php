		<?php include "homehead.php";?>
<?php session_start();?>
<head>

<link rel="stylesheet" type="text/css" href="codemirror/plugin/codemirror/lib/codemirror.css">
<script type="text/javascript" src="codemirror/plugin/codemirror/lib/codemirror.js"></script>
<script src="codemirror/plugin/codemirror/mode/python/python.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">  

<script src="jquery-3.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>

.col-md-4{
	background-color:#dddddd;
	border-style:groove;
	border-width:7px;
	border-radius:8px;
}

#credits{
	background-color:#CCE5FF;
	
	
}
#questiontable{
	background-color:#00000;
	border-style:groove;
	border-width:7px;
	border-color:67B3FF;
	border-radius:8px;
}

.row{
	align-content: center;
}

#rateup{
	color:green;
	
    font-weight: bold;
}
#ratedown{
	color:red;
	
    font-weight: bold;
}

#questionspage{
	float:left;
	width:75%;
	background-color:#00000;
	border-style:groove;
	border-width:7px;
	border-color:67B3FF;
	border-radius:8px;
}

#scorepage{
	float:right;
	width:25%;
	background-color:#00000;
	border-style:groove;
	border-width:7px;
	border-color:67B3FF;
	border-radius:8px;
	
}

</style>


<body>

	<div id="user">
	</div>
	<div name="editExamTable" id="editExamTable">
		<br>
   
		
		<div id="output"></div>			
		<div class="row">
			<div class="col-md-1">
				<center>
				</center>
			</div>
				
				<center>
				<div class="col-md-7" style="width:95%; border-style:rounded;">
					<div class="panel panel-info">
						<div id="questions">
							<input type="button" class="w3-button w3-blue" value="View Created Questions" onclick="ViewCQ();" />
							<input type="button" class="w3-button w3-blue" value="View Created Tests" onclick="ViewCT();" />
						
						</div>
					</div>
				</div>
				</center>
				<table id="example" class="display" width="75%"></table>
				
		<div id="answerpage"></div>
		<div id="score"></div>
		</div>		
	</div>
	
	<div class="button">
			<center>

					</center>
	</div>
	<div id="alert"></div>
	
	
</body>
</head>



<script language="Javascript">


var editor;
var length;
var LEFT=[];
var ANSWERS=[];
var points=[];
var hr; 
var dataSet = [];
var finalarray=[];
//=======================================================================================================
function ViewCQ(){
			
			try{
			// Opera 8.0+, Firefox, Safari
			hr = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				hr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					hr = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser broke!");
				}
			}
		}
			var username = "<?php session_start(); echo $_SESSION['username']; ?>";
			
			
			var myJSONObject={"username":username};
			console.log(myJSONObject);
			
			hr.open("POST","getcreatedquestions.php", true);
			hr.send(JSON.stringify(myJSONObject));
		//=======================================================================================================
		hr.onreadystatechange = function(){
			if(hr.readyState == 4){
				var ajaxDisplay = document.getElementById('questions'); 
				
				var res=hr.responseText;
				var data=JSON.parse(res);
				
				
				console.log(data);
				var len=data.length;
				length=len;
				
				//=======================================================================================================
				var lefthtml="<div id=questiontable class='row'>";
				lefthtml+="<div class='col-md-12'>";
				lefthtml+="<table id='qTable' width='100%'>"; 
				lefthtml+="<thead style='background-color:#67B3FF;'><tr>";
				
				lefthtml+="<th>ID#</th>";
				lefthtml+='<th width="1000">Question</th>';
				lefthtml+="<th>Category</th>";
				lefthtml+="<th>Difficulty</th>";
				lefthtml+="<th>Author</th>";
				lefthtml+="<th>Cases</th>";
				lefthtml+="<th>Rateup</th>";
				lefthtml+="<th>RateDown</th>";
				
				lefthtml+="</tr></thead>";
				lefthtml+="<tbody>";		
				var newobj={};
				//=======================================================================================================
				for(var i=0;i<len;i++){
					var Qquestion 	  = data[i]['question'];
					var Qcases		  = data[i]['cases'];
					var Qlevel		  = data[i]['level'];
					var Qcategory	  = data[i]['category'];
					var Qauthor		  = data[i]['author'];
					var Qrateup		  = data[i]['rateup'];
					var Qratedown	  = data[i]['ratedown'];
					var QId					=data[i]['id'];
					var qSample  			=data[i]['sample'];
					var Qquestionid		=data[i]['id'];
					setarray = [Qquestion,Qcases,Qlevel,Qcategory,Qauthor,Qrateup,Qratedown];
					dataSet.push(setarray);
					cases=data[i]['cases'];
					cases.replace('"','\'');
					
					LEFT.push(data[i]['id']);

					lefthtml+="<tr>";
					
					
					newobj = {"questionid":QId,"question":Qquestion,"cases":Qcases,"level":Qlevel,"category":Qcategory,"author":Qauthor,"sample":qSample,"rateup":Qrateup,"ratedown":Qratedown};
					var sendobj = JSON.stringify(newobj);
					
					console.log(sendobj);
					lefthtml+="<div id='entry"+data[i]['id']+"'><td>";
					lefthtml+="<input type='button' <p onclick='newSelect("+sendobj+")'";
					lefthtml+='class="w3-button w3-light-blue w3-round-xxlarge" id="button'+data[i]['id']+'" name="questionlist" id="'+data[i]['id']+'" onclick="newSelect('+sendobj+');"';			
					lefthtml+='" value="'+data[i]['id']+'"'+'><p hidden>'+Qquestionid+'</p></td>';
					
					
					lefthtml+="<td width='200px'><p onclick='newSelect("+sendobj+")' style='cursor: pointer;text-decoration:underline;'>"+Qquestion+"</p></td>";
					lefthtml+='<td>'+Qcategory+'</td>';
					lefthtml+='<td>'+Qlevel+'</td>';
					lefthtml+='<td>'+Qauthor+'</td>';
					lefthtml+='<td><button class="w3-button w3-light-blue" onclick="onCall(\''+cases+'\')">Cases</button></td>'
					lefthtml+='<td><div id="rateup">'+Qrateup+'</div></td>';
					lefthtml+='<td><div id="ratedown">'+Qratedown+'</div></td>';
										
					lefthtml+='</tr>';

				}
				
				
				lefthtml+="</tbody></table>";
				lefthtml+="</div></div>";
				ajaxDisplay.innerHTML=lefthtml;
				
				//Paginate the table
				$(document).ready(function() { $('#qTable').DataTable( {responsive:true  } ); } );
				
				
				
				
			}
}
//=======================================================================================================

	
}
//=======================================================================================================
function newSelect(data){
	//var id = JSON.parse(id);
	var qID = data['questionid'];
	var qQuestion = data['question'];
	var qCases = data['cases'];
	var qLevel = data['level'];
	var qCategory = data['category'];
	var qAuthor = data['author'];
	var qSample = data['sample'];
	var qRateup = data['rateup'];
	var qRatedown=data['ratedown'];
	
	sessionStorage.setItem("question",qQuestion);
	sessionStorage.setItem("questionid",qID);
	sessionStorage.setItem("cases",qCases);
	sessionStorage.setItem("level",qLevel);
	sessionStorage.setItem("category",qCategory);
	sessionStorage.setItem("sample",qSample);
	sessionStorage.setItem("author",qAuthor);
	sessionStorage.setItem("rateup",qRateup);
	sessionStorage.setItem("ratedown",qRatedown);
	window.open("Edit_question.php","_blank");

	
}
function onCall(x){
	console.log(x);
	
	var format = x.split("|").join("\n");
	
	alert(format);
}
//=======================================================================================================
function SelectQuestion(id){

	var sendarray=[];
	var ajaxRequest;  
	try{ajaxRequest = new XMLHttpRequest();} 
		catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
		catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
		catch (e){alert("BROWSER ERROR!");
		return false;
			}
		}
	}
				
				
	ajaxRequest.onreadystatechange = function(){
		//Navigate to Answer Question sheet
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv');
			var res=ajaxRequest.responseText;
			AnswerQuestion(res);
		}
	}
				
	sendarray.push({questionid:id});
	console.log(sendarray);
	var send = JSON.stringify(sendarray);
				
	ajaxRequest.open("POST","answer_question_page.php", true);
	ajaxRequest.send(send);
	
}
//=======================================================================================================
//=======================================================================================================
//=======================================================================================================
//=======================================================================================================

function ViewCT(){
	

		try{ajaxRequest = new XMLHttpRequest();} 
		catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
		catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
		catch (e){alert("BROSWER ERROR");}
				}
			}
			

		var username = "<?php echo $_SESSION['username']; ?>";
		ajaxRequest.open("POST", "getcreatedtests.php", true);
		var myobj = {username:username};
		ajaxRequest.send(JSON.stringify(myobj));

			// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4){
					var Display = document.getElementById('questions');
					
					var res=ajaxRequest.responseText;
					var data=JSON.parse(res);
					var response = data[0]['response'];
					var len=data.length;
					
					if(response=="yes"){
						
						var html="<div class='row' id ='testtable'>";
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
							
							var newobjt = {"username":author,"examname":examname,"examid":examid,"description":description,"difficulty":difficulty,
							"category":category,"rateup":rateup,"ratedown":ratedown,"identification":identification};
							
							var sendobjt = JSON.stringify(newobjt);
							
							html+="<tr>";
							html+="<td></td>";
							html+="<div id='entry"+examid+"'><td>";			
							html+="<input type='button' d='button"+examid+"' name='questionlist' id='"+examid+"' class='w3-button w3-grey w3-round-xxlarge' onclick='SelectExam("+sendobjt+")'";			
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

	
}


/*
function AnswerQuestion(data){
	var data=JSON.parse(data);
	var oldDisplay = document.getElementById('questions');
	oldDisplay.parentNode.removeChild(oldDisplay);
	
	
	
	
	var Display = document.getElementById('answerpage');
	console.log(data);
	var html="<div id='questionspage' class='containers'>";

	var i =0;
					
		ANSWERS.push(data[i]['questionid']);
		var questionid = data[i]['questionid'];
		var question=data[i]['question'];
		var samplecode=data[i]['sample'];
		var author=data[i]['author'];
		var level=data[i]['level'];
		var category=data[i]['category'];
		
		console.log(samplecode);
		
		html+='<div id="credits"><center><p><em>Question ID '+questionid+':</em>';
		html+='<p>';
		html+='<br>Author: '+author;
		html+='<br>Difficulty: '+level;
		html+='<br>Category: '+category;
		html+='</center></div>';
		
		html+='<br><br><center>'+question+'</p>';
		html+='<label>Your answer</label></center><br><br>';
		html+='<textarea class="coder" id="'+data[i]['questionid']+'">'+samplecode+'</textarea><br><br>';

		
		
		
		html+='</div>';

	html+='<br><br><center><input type="button" id="submitbutton" class="btn btn-primary" value="Submit" onclick="submit('+data[i]['questionid']+');"></input></center>';
	html+='</div>';
	Display.innerHTML=html;
	
	
editor = CodeMirror.fromTextArea(document.getElementById(data[i]['questionid']), {
        mode: {name: "python",
               version: 3,
               singleLineStringErrors: false},
        lineNumbers: true,
        indentUnit: 4,
        matchBrackets: true
    });


}
				
	
	
	



function submit(id){
	var ajaxRequest;
	
	try{ajaxRequest = new XMLHttpRequest();} 
		catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
		catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
		catch (e){alert("BROSWER ERROR");}}}

					  
			ajaxRequest.onreadystatechange = function(){

				if(ajaxRequest.readyState == 4){
					
					var ajaxDisplay = document.getElementById('exams');
					var res=ajaxRequest.responseText;
					console.log(res);
			  
					var data=JSON.parse(res);
				
					GradePage(data);
					//var Display = document.getElementById('submitbutton');
					//Display.parentNode.removeChild(Display);
			  
					}
			}
		var test = editor.getValue();
		
		console.log(test);
		var len=ANSWERS.length;

		var answer=document.getElementById(id).value;
		
		answer = test;
		var username = "<?php session_start(); echo $_SESSION['username']; ?>";
		
		var finalarray=[];
		finalarray.push({username:username,questionid:id,code:answer});
		
	
	
		console.log(finalarray);

		ajaxRequest.open("POST", "/projects/PythonPractice/front/php/take_question/grading.php", true);
		ajaxRequest.send(JSON.stringify(finalarray));
	
}


function GradePage(data){
	var caseshit 		 = data['caseshit'];
	var casesmissed = data['casesmissed'];
	var scorehtml = "";
	var scoredisplay = document.getElementById('score');
	
	if(data['caseshit']){
		var caseshit = data['caseshit'];}
										
	if(data['casesmissed']){
		var casesmissed=data['casesmissed'];
	}
	
	
	var caseshitarray = caseshit.split("|");
	var casesmissedarray=casesmissed.split("|");
	console.log(caseshitarray);
	console.log(casesmissedarray);
										
	var hitlength = caseshitarray.length;
	var missedlength = casesmissedarray.length;
										
										
	scorehtml+="<p><center>Cases Hit</center>";
	for(var j=0; j<hitlength;j++){
		var cases=caseshitarray[j];
		scorehtml+= "<br><font color='green'>      &#x2714;    "+cases+"</font></br>";
	}
										
	scorehtml+="</p><p><center>Cases Missed</center>";
	for(var j=0; j<missedlength;j++){
		var cases=casesmissedarray[j];
		scorehtml+= "<br><font color='red'>      &#x2716;     "+cases+"</font></br>";
	}
	
	scorehtml+="</p>";
	
	scoredisplay.innerHTML=scorehtml;
	
}


*/

function SelectExam(data){
	console.log(data);
	
	var tusername 	= data["username"];
	var texamname 	= data["examname"];
	var texamid		 	= data["examid"];
	var tdescription 	= data["description"];
	var tdifficulty	 	= data["difficulty"];
	var tcategory	 	= data["category"];
	var trateup		 	= data["rateup"];
	var tratedown	 	= data["ratedown"];
	var tidentification= data["identification"];
	
	console.log(tidentification);
	
	sessionStorage.setItem("username",tusername);
	sessionStorage.setItem("examname",texamname);
	sessionStorage.setItem("examid",texamid);
	sessionStorage.setItem("description",tdescription);
	sessionStorage.setItem("difficulty",tdifficulty);
	sessionStorage.setItem("category",tcategory);
	sessionStorage.setItem("username",tusername);
	sessionStorage.setItem("rateup",trateup);
	sessionStorage.setItem("ratedown",tratedown);
	sessionStorage.setItem("identification",tidentification);
	window.open("Edit_test.php","_blank");
	
}


</script>



				