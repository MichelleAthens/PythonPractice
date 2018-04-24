<?php include "homehead.php";?>
<?php session_start();?>
<head>

<link rel="stylesheet" type="text/css" href="codemirror/plugin/codemirror/lib/codemirror.css">
<script type="text/javascript" src="codemirror/plugin/codemirror/lib/codemirror.js"></script>
<script src="codemirror/plugin/codemirror/mode/python/python.js"></script>

<script src="jquery-3.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>



<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



</head>
<style>

.col-md-4{
	background-color:#dddddd;
	border-style:groove;
	border-width:7px;
	border-radius:8px;
	float:right; 
	width:45%;
}



.centerDone{
	display:block;
	left: 47.7%;
	right: 47.7%;
	padding: 10px;
	text-align:center;
}

.centertestArrow{
	position:fixed;
	bottom:40%;
	left:48.3%;
}
.centerquestArrow{
	position:fixed;
	left:48.3%;
	bottom: 20%;
}


.col-md-7{
	float:left; 
	width:45%; 
	border-style:rounded;
	background-color:#00000;
	border-style:groove;
	border-width:7px;
	border-color:67B3FF;
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

#centerpage{
		padding:20;
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


#infor{
	padding:20px;
	
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

	<div id="centerpage">
	<div id="user">
	</div>
	<div name="editExamTable" id="editExamTable">
		<center>
			<h3>Make test</h3>
			
			<div id="infor">
			<label>Enter title of test</label><br>
			<input type="text" name="eName" id="eName" required><br><br>
			
			<label>Description</label><br><textarea rows="2" cols="50"  name="eDes" id="eDes" required></textarea><br><br>
			
			<label>Category
				<select required name="qCategory" id="qCategory">
					<option value="N/A">Not Applicable</option>
					<option value="for">For</option>
					<option value="while">While</option>
					<option value="method">Method</option>
				</select>
			</label><br><br>

			<label>Difficulty level
				<select required name="qLevel" id="qLevel">
					<option value="N/A">Not Applicable</option>
					<option value="easy">Easy</option>
					<option value="medium ">Medium</option>
					<option value="hard">Hard</option>
				</select>
			</label>
			
			</div>
			<input class="centerDone" type="button" value="Done" class="btn btn-lg btn-success" onclick="examAdd();">
		
		
		</center><br>
   

		
		<div id="output"></div>
		
		<div class="row">
			
			
			<div class="col-md-1"><center>
			</center></div>
			
			
			<div class="col-md-7">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4><center><font size="+2">Question Bank</font></center></h4>
					</div>
					<div id="questions"></div>
				</div>
			</div>
		

			<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h4><center><font size="+2">Test</font></center></h4>
					</div>
					<div id="test"></div>
				</div>
			</div>
		</div>
		
		
		
		
					<div class="button">
				<center>

				</center>
			</div>
			
			
			
			
	</div>

	<div id="alert"></div>
	
	
</body>

</div>


<script language="Javascript">

var length;
var LEFT=[];
var RIGHT=[];
var points=[];
var hr; 
var ids=[];

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



hr.onreadystatechange = function(){
	if(hr.readyState == 4){
		var ajaxDisplay = document.getElementById('questions'); //class name instead?
		var rightDisplay = document.getElementById('test');
		
		var res=hr.responseText;
		
		var data=JSON.parse(res);
		
		var len=data.length;
		length=len;
		
		//console.log(data);
		
		var lefthtml="<div class='row'>";
		lefthtml+="<div class='col-md-12'>";
		lefthtml+='<table id="qTable" width="100%">';
		
		lefthtml+="<thead style='background-color:#67B3FF;'><tr>";
		
		lefthtml+="<th></th>";
		lefthtml+="<th>ID#</th>";
		lefthtml+='<th>Question</th>';
		lefthtml+="<th>Category</th>";
		lefthtml+="<th width='250'>Level</th>";
		lefthtml+="<th>Cases</th>";
		
		lefthtml+="</tr></thead>";
		lefthtml+="<tbody>";		
		
		var righthtml ='<div>';
		righthtml+='<div>';
		
		righthtml+="<table class='table table-striped'>";
		righthtml+="<thead style='background-color:#67B3FF;'><tr>";
		righthtml+='<th>ID#</th>';
		righthtml+='<th width="1000">Question</th>';
		righthtml+="<th style='width:25%;'>Points</th></tr>";////
		righthtml+='</thread><tbody>';

		for(var i=0;i<len;i++){
			var Qquestion 	  = data[i]['question'];
			var Qcases		  = data[i]['cases'];
			var Qlevel		  = data[i]['level'];
			var Qcategory	  = data[i]['category'];
			var Qauthor		  = data[i]['author'];
		    var Qrateup		  = data[i]['rateup'];
			var Qratedown	  = data[i]['ratedown'];
			
			
			LEFT.push(data[i]['id']);
			RIGHT.push("test"+data[i]['id']);
			points.push("points"+data[i]['id']);////
			
			
			
			lefthtml+='<tr><td></td>';
			lefthtml+="<div id='entry"+data[i]['id']+"'><td>";
			lefthtml+='<input type="button" class="w3-button w3-light-blue w3-round-xxlarge" id="button'+data[i]['id']+'" name="questionlist" id="'+data[i]['id']+'" onclick="add('+data[i]['id']+');"';			
			lefthtml+='" value="'+data[i]['id']+'"'+'><p hidden>'+data[i]['id']+'</p></td>';
			
			
			lefthtml+='<td width="200px"><br>'+Qquestion+'</td>';
			lefthtml+='<td>'+Qcategory+'</td>';
			lefthtml+='<td>'+Qlevel+'</td>';
			
			
			cases=data[i]['cases'];
			cases.replace('"','\'');
			
			lefthtml+='<td><button class="w3-button w3-light-blue" onclick="onCall(\''+cases+'\')">Cases</button></td>';
			lefthtml+='</tr></div>';

			
			
			
			righthtml+="<tr hidden id='"+"tr"+data[i]['id']+"'><td>";
			
			righthtml+='<input type="button" class="w3-button w3-light-blue w3-round-xxlarge" onclick="remove('+data[i]['id']+');" name="testlist" id="'+"test"+ data[i]['id'];
			righthtml+='"value="'+data[i]['id']+'"'+'></td>';
			
			righthtml+='<td width="200px"><br>'+data[i]['question']+'</td>';
			
			
			righthtml+='<td><input type="text"';////
			righthtml+='id="points'+data[i]['id']+'"';////
			righthtml+='placeholder="Input Points" style="border:none;width:100%;"/></td>';////
			
			righthtml+='</tr>';

			
		}
		
		
		lefthtml+="</tbody></table>";
		lefthtml+="</div></div>";
		righthtml+="</tbody></table>";
		righthtml+='</div></div>';
		
		ajaxDisplay.innerHTML=lefthtml;
		rightDisplay.innerHTML=righthtml;
		
		$(document).ready(function() {
    $('#qTable').DataTable( {
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
}




hr.open("POST","create_test_back.php", true);
hr.send(null);



function onCall(x){
	console.log(x);
	
	var format = x.split("|").join("\n");
	
	alert(format);
}

function add(id){
	var chk=document.getElementById('entry'+id);
	document.getElementById('tr'+id).hidden=false;
	
	var button=document.getElementById('button'+id);
	button.style.display ="none";
	ids.push(id);
	console.log(ids);
}

function remove(id){
	console.log("here");
	var chk=document.getElementById(id);
	
	document.getElementById('tr'+id).hidden=true;
	var button=document.getElementById('button'+id);
	button.style.display="block";
	
	var index = ids.indexOf(id);
	
	if(index> -1){
		ids.splice(index,1);
	}
}



function addquestion(){
	for(var i=0;i<length;i++){
		var chkbox=document.getElementById(LEFT[i]);
		if(chkbox.checked){
			document.getElementById('tr'+LEFT[i]).hidden=false;
		}
	}
}
function removeq(){
	for(var i=0;i<length;i++){
		var chkbox=document.getElementById(RIGHT[i]);
		if(chkbox.checked){
			document.getElementById('tr'+LEFT[i]).hidden=true;
			document.getElementById(LEFT[i]).checked=false;
			chkbox.checked=false;
		}
	}
}


function examAdd(){
//	MID_PATH="/Online_part2/middle/";
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
				
				
					if(ajaxRequest.readyState == 4){
						var ajaxDisplay = document.getElementById('ajaxDiv');
						var res=ajaxRequest.responseText;
						console.log(res);
						}
				
				}
				
				var examname=document.getElementById("eName").value;	
				var level=document.getElementById("qLevel").value;
				var category=document.getElementById("qCategory").value;
				var des=document.getElementById("eDes").value;

				examname = examname.replace(" ","_");
				
				var username = "<?php echo $_SESSION['username']; ?>";
				
				var questions="";
				var out="";
				var sendarray =[];
				
				sendarray.push({username:username,examname:examname,description:des,category:category,difficulty:level});
				ids.sort();
				for(var i=0;i<ids.length;i++){
					console.log("points"+ids[i]);
					var point = document.getElementById("points"+ids[i]).value;
					
					sendarray.push({questionid:ids[i],points:point});
				}
				
				//console.log(sendarray);
				var leng = sendarray.length;
				
				
				
				
				
				
				
				if(examname==""){
					alert("You must input Exam Name");
				}
				else{
					ajaxRequest.onreadystatechange = function() {
						if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
		      
						var res=ajaxRequest.responseText;
						
						//var data=JSON.parse(res);
						var message = 'You have created the exam '+examname+'You may now exit the page';
						alert(message);
						window.location.replace("home.php");
						console.log(res);
			   
						}		
					}
						
					var myJSONObject=sendarray;
					ajaxRequest.open("POST", "create_test_submit.php", true); //file get contents, decode, function, CURLS
					var send = JSON.stringify(myJSONObject);
				
					console.log(JSON.stringify(myJSONObject));
					
					ajaxRequest.send(send); 
				}
}




</script>


