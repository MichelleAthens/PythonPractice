<?php $GLOBALS['BACK_PATH']="https://web.njit.edu/~mmd38/CS490/rc/middle/"; ?>
<?php include "insHead.php";?>
<?php session_start();?>
<head>
<style>

.col-md-4{
	background-color:#dddddd;
		border-style:groove;
	border-width:7px;
	border-radius:8px;
}

.col-md-7{
	background-color:#dddddd;
	border-style:groove;
	border-width:7px;
	border-radius:8px;
}

</style>




<body>

	<div id="user">
	</div>
	<div name="editExamTable" id="editExamTable">
		<center>
			<h3>Make exam</h3>
			<label>Enter title of exam</label>
			<input type="text" name="eName" id="eName"><br>		
		</center><br>
   
 <input type="text" id="myInput" onkeyup="mySearch()" placeholder="Search..." title="string">
		
		<div id="output"></div>
		
		<div class="row">
			
			
			<div class="col-md-1"><center>
			</center></div>
			
			
			<div class="col-md-7" style="float:left; width:50%; border-style:rounded;">
				<div class="panel panel-info">
					<div class="panel-heading" style="background-color:#939393;">
						<h4><center><font size="+2">Question Bank</font></center></h4>
					</div>
					<div id="questions"></div>
				</div>
			</div>
		
		
			

			<div class="col-md-4" style="float:right; width:40%;">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h4><center><font size="+2">Test</font></center></h4>
					</div>
					<div id="test"></div>
				</div>
			</div>
		</div>
		
		
	</div>
	<div class="button">
			<center>
				<input type="button" value="Done" class="btn btn-lg btn-success" onclick="examAdd();">
				<center><input type="button" class="btn btn-lg btn-primary" value=">>" style="position: fixed;bottom:50%;" onclick="addquestion();"></center>
				<center><input type="button" class="btn btn-lg btn-primary" value="<<" style="position: fixed;bottom:30%;" onclick="removeq();"></center>
			</center>
	</div>
	<div id="alert"></div>
	
	
</body>
</head>

<script language="Javascript">

var length;
var LEFT=[];
var RIGHT=[];
var points=[];
var hr; 


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
		lefthtml+="<table id='qTable'>"; //dasda
		lefthtml+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";
		
		lefthtml+='<th width="1000">Question</th>';
		lefthtml+="<th>Category</th>";
		lefthtml+="<th>Difficulty</th>";
		lefthtml+="<th>Cases</th>";
		
		lefthtml+="</tr></thead>";
		lefthtml+="<tbody>";		
		
		var righthtml ='<div>';
		righthtml+='<div>';
		
		righthtml+="<table class='table table-striped'>";
		righthtml+="<thead style='background-color:#42ABCA;'><tr>";
		righthtml+='<th width="200">Check</th>';
		righthtml+='<th width="1000">Question</th>';
		righthtml+="<th style='width:25%;'>Points</th></tr>";////
		righthtml+='</thread><tbody>';

		for(var i=0;i<len;i++){
			LEFT.push(data[i]['id']);
			RIGHT.push("test"+data[i]['id']);
			points.push("points"+data[i]['id']);////
			
			lefthtml+="<tr><td>";
			
			lefthtml+='<input type="checkbox" name="questionlist" id="'+data[i]['id'];			
			lefthtml+='" value="'+data[i]['id']+'"'+'></td>';

			lefthtml+='<td width="200px"><br>'+data[i]['question']+'</td>';
			lefthtml+='<td><br>'+data[i]['category']+'</td>';
			
			
			lefthtml+='<td><br>'+data[i]['level']+'</td>';
			
			
			cases=data[i]['cases'];
			
			cases.replace('"','\'');
			
			lefthtml+='<td><button onclick="onCall(\''+cases+'\')">Cases</button></td>'

						

			lefthtml+='</tr>';

			righthtml+="<tr hidden id='"+"tr"+data[i]['id']+"'><td>";
			
			righthtml+='<input type="checkbox" name="testlist" id="'+"test"+ data[i]['id'];
			righthtml+='"value="'+data[i]['id']+'"'+'></td>';
			
			righthtml+='<td width="200px"><br>'+data[i]['question']+'</td>';
			
			
			righthtml+='<td><input type="text"';////
			righthtml+='id="'+points[i]+'"';////
			righthtml+='placeholder="Input Points" style="border:none;width:100%;"/></td>';////
			
			righthtml+='</tr>';

			
		}
		
		
		lefthtml+="</tbody></table>";
		lefthtml+="</div></div>";
		righthtml+="</tbody></table>";
		righthtml+='</div></div>';
		
		ajaxDisplay.innerHTML=lefthtml;
		rightDisplay.innerHTML=righthtml;
		
	}
}




hr.open("POST","editE_back.php", true);
hr.send(null);



function onCall(x){
	console.log(x);
	
	var format = x.split("|").join("\n");
	
	alert(format);
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

				
				var username = "<?php echo $_SESSION['username']; ?>";
				
				var questions="";
				var out="";
				var sendarray =[];
				
				sendarray.push({username:username,examname:examname});
				
				for(var i=0;i<length;i++){
					var chkbox=document.getElementById(LEFT[i]);
					var point=document.getElementById(points[i]).value;////
					
					if(chkbox.checked){
							out+='<center>' + LEFT[i] + '</center>';
							questions+=LEFT[i];
							
							console.log(point);
							sendarray.push({questionid:LEFT[i],points:point});////
							
					}
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
						
						console.log(res);
			   
						}		
					}
						
					var myJSONObject=sendarray;
					ajaxRequest.open("POST", "editE_backsend.php", true); //file get contents, decode, function, CURLS
					var send = JSON.stringify(myJSONObject);
				
					console.log(JSON.stringify(myJSONObject));
					
					ajaxRequest.send(send); 
				}
}


function mySearch() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
 
  filter = input.value.toUpperCase();
  table = document.getElementById("qTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  
  //console.log(tr);
  //console.log(table);
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    td = tr[i].getElementsByTagName("td")[1];
    td = tr[i].getElementsByTagName("td")[3];
	
	console.log(td);
    if (td) {
		
		console.log(td.innerHTML);
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		  
		
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

</script>



<?php include "footer.php";?>