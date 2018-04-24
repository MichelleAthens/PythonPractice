<?php include "stuHead.php";?>
<?php session_start(); ?>

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

<div id="user"></div>


<div name="examlist" id="examlist" align="middle">

	<center>
	<h3>EVALUATION</h3>
  </center><br>
  
<label>click exam from exam list to show exam data. type to filter</label>	

 
  <div class="button">
  <input type="button" value="Submit" style="position: left;font-size: 20px; background-color: tomato;" onclick= "showGrades();">
  </div>

<input type="text" id="myInput" onkeyup="mySearch()" placeholder="Search..." title="string">
		
<div class="row" id="list">

	<div class="col-md-1"><center></center></div>
			
	<div class="col-md-7" id="view">
	<div class="panel panel-info">
	<div class="panel-heading" style="background-color:#939393;">
	<h4><center><font size="+2">Exam List</font></center></h4>
	</div>
	<div id="exams"></div>
	</div>
	
	</div>
	
	
	
	<div class="col-md-7" id="view">
	<div class="panel panel-info">
	<div class="panel-heading" style="background-color:#939393;">
	<h4><center><font size="+2">Exam List</font></center></h4>
	</div>
	<div id="cases"></div>
	</div>
	
	</div>
	

	

</div>
</div>



<div id="alert"></div>
	
	
</body>
</head>

<script language='javascript'>

var length;
var LEFT=[];//ids of checkboxes
var RIGHT=[];
var hr;  //ajax

try{ajaxRequest = new XMLHttpRequest();} 
catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
catch (e){alert("BROWSWER ERROR");}}}


			ajaxRequest.onreadystatechange = function(){
						if(ajaxRequest.readyState == 4){
							var leftDisplay = document.getElementById('list');
							var rightDisplay = document.getElementById('grades');
							
							var res=ajaxRequest.responseText;
							console.log(res);
							
							var data = JSON.parse(res);
							console.log(res);
							
							var len=data.length;
							legnth=len;
							console.log(len);
							
						var lefthtml="<div class='row'>";
							lefthtml+="<div class='col-md-7'>";
							lefthtml+="<table id='eTable'>";
							lefthtml+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";
							
							lefthtml+='<th>Exam ID</th>';
							lefthtml+="<th>Exam Name</th>";
							lefthtml+="<th>Professor</th>";
							
							lefthtml+="</tr></thead>";
							lefthtml+="<tbody>";
						
						/*var righthtml ='<div>';

							righthtml+='<div>';
							righthtml+="<table class='table table-striped'>";
							righthtml+="<thead style='background-color:#42ABCA;'><tr>";

							righthtml+='<th>Exam ID</th>';
							righthtml+='<th>Grade</th>';
              righthtml+='<th>Question ID</th>';
              righthtml+='<th width="1000">Question</th>';
              righthtml+='<th>Case Hit</th>';
              righthtml+='<th>Case Missed</th>';
							righthtml+='</thread><tbody>';*/
					
					for(var i=0;i<len;i++){
						
						LEFT.push(data[i]['examid']);
						RIGHT.push("grades"+data[i]['examid']);

						var examname = data[i]['examname'];
						var examid = data[i]['examid'];
						var professor=data[i]['professor'];
						var fusion = examid + "|" + examname + "|" + professor;
						
						
						lefthtml+="<tr><td>";			
						lefthtml+='<input type="radio" name="examlist" id="'+data[i]['examid'];			
						lefthtml+='" value="'+fusion+'"'+'></td>';

						lefthtml+='<td><br>'+data[i]['examid']+'</td>';			
						lefthtml+='<td><br>'+data[i]['examname']+'</td>';
						lefthtml+='<td><br>'+data[i]['professor']+'</td>';
						lefthtml+='</tr>';
						

					/*	righthtml+="<tr hidden id='" + "tr" +data[i]['id']+"'><td>";					
						righthtml+='<td><br>'+data[i]['examid']+'</td>';
						righthtml+='<td><br>'+data[i]['grade']+'</td>';
            righthtml+='<td><br>'+data[i]['questionid']+'</td>';
            righthtml+='<td><br>'+data[i]['question']+'</td>';
            righthtml+='<td><br>'+data[i]['casehit']+'</td>';
            righthtml+='<td><br>'+data[i]['casemissed']+'</td>';
					  righthtml+='</tr>';*/
					}

					
		lefthtml+="</tbody></table>";
		lefthtml+="</div></div>";
		
		/*
		righthtml+="</tbody></table>";
		righthtml+='</div></div>';*/
				
		leftDisplay.innerHTML=lefthtml;
		/*rightDisplay.innerHTML=righthtml;*/
}}//statechanges

ajaxRequest.open("POST","eval_back.php", true);
var username = "<?php echo $_SESSION['username'];?>";
//console.log(username);

var myJSONobject={username:username}
ajaxRequest.send(JSON.stringify(myJSONobject)); 




function mySearch() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
 
  filter = input.value.toUpperCase();
  table = document.getElementById("eTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  
  //console.log(tr);
  //console.log(table);
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
	
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

function showGrades(){
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
			
										
					  var res=ajaxRequest.responseText;
					  console.log(res);

					
						var Display = document.getElementById('list');
						
						var res=ajaxRequest.responseText;
					//	alert(res);
						
						var data=JSON.parse(res);
						   
						var len=data.length;
											
						var examid = data[1]['examid'];
						var examname = data[1]['examname'];
						var professor = data[1]['professor'];
						var grade = data[1]['grade'];
						var html='<div class="containers">';
						
						
						
					html+='<br><br><h4><center><font size="+2">Exam name:'+examname+'<br> Created by: ' + professor+ '</font></center></h4>';
					html+='<h4><center><font size="+2">Grade: '+grade+'</font></center></h4>';
					
								
								for(var i=2;i<len;i++){
										var caseshit ="";
										var casesmissed="";
										var questionid = data[i]['questionid'];
										var question=data[i]['question'];
										var answer = data[i]['submitted'];
										var stringhit="";
										var stringmissed="";
										
										if(data[i]['caseshit']){
										var caseshit = data[i]['caseshit'];}
										
										if(data[i]['casesmissed']){
										var casesmissed=data[i]['casesmissed'];
										}
										
										html+='<div><p><em>Problem '+(i-1)+':</em>';
										html+='<br><p>'+question+'</p>';
										html+='<label>Your answer</label><br>';
										html+='<textarea rows="10" style="width:30%" id="'+data[i]['questionid']+'">'+answer +' </textarea><br><br></div>';
										
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
										
								        html+='<div align="middle" style="border-left:6px solid green;background-color:ccffcc"><label>Cases Hit </label><br><textarea rows="10" style="width:20%; border-radius: 5px;border-left:6px solid green;font-weight:bold;color:green" id="'+data[i]['questionid']+'">'+stringhit +' </textarea><br><br></div>';
								        html+='<div align="middle" style="border-left:6px solid red;background-color:ffcccc"><label>Cases Missed </label><br><textarea rows="10" style="width:20%; border-radius: 5px;border-left:6px solid red;font-weight:bold;color:red" id="'+data[i]['questionid']+'">'+stringmissed +' </textarea><br><br></div>';
										
										
										
										
										
										
										
										html+='</div>';
											
					
							}
html+='</div>';



					Display.innerHTML=html;
					
	
								
								
								
								
								
								}
				}
			
			var username = "<?php echo $_SESSION['username']; ?>";
			
			var chkbox=document.getElementsByName("examlist");
			
			
			for(var i=0;i<chkbox.length;i++){
					
					
					if(chkbox[i].checked){
								
							var examid=chkbox[i].id;
							var examdata=chkbox[i].value;
							
							var string = examdata.split("|");
							var examname = string[1];
							var professor = string[2];
							
							
							var sendarray = {username:username,examid:examid,examname:examname,professor:professor}
							
					}
				}
				console.log(sendarray);
				ajaxRequest.open("POST", "eval_back_show.php", true); //php release from midddle
			 //file get contents, decode, function, CURLS
				ajaxRequest.send(JSON.stringify(sendarray));
}






</script>






