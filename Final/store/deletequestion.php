<?php include "mid.php";?>
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
			<h3>Delete Question</h3>
		
		</center><br>
		
		<div id="output"></div>
		
		<div class="row">
			
			
			<div class="col-md-1"><center>
			</center></div>
			
			
			<div class="col-md-7" style="border-style:rounded;">
				<div class="panel panel-info">
					<div class="panel-heading" style="background-color:#939393;">
						<h4><center><font size="+2">Question Bank</font></center></h4>
					</div>
					<div id="questions"></div>
				</div>
			</div>
		
		
			

			
		</div>
		
		
	</div>
	<div class="button">
			<center>
				<input type="button" value="Delete" class="btn btn-lg btn-success" onclick="Delete();">
				
			</center>
	</div>
	<div id="alert"></div>
	
	
</body>
</head>

<script language="Javascript">

var length;
var LEFT=[];//ids of checkboxes
var RIGHT=[];
var pt=[];//ids of points 
var hr;  // The variable that makes Ajax possible!


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
		
		console.log(data);
		
		var lefthtml="<div class='row'>";
		lefthtml+="<div class='col-md-12'>";
		lefthtml+="<table class='table table-striped'>";
		lefthtml+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";
		
		lefthtml+='<th width="10000">Question</th>';
		lefthtml+="<th>Category</th>";
		lefthtml+="<th>Difficulty</th>";
		lefthtml+="<th>Cases</th>";
		
		lefthtml+="</tr></thead>";
		lefthtml+="<tbody>";
		
		
		
		
		
		for(var i=0;i<len;i++){
			LEFT.push(data[i]['id']);
			RIGHT.push("test"+data[i]['id']);
			lefthtml+="<tr><td>";
			
			lefthtml+='<input type="checkbox" name="questionlist" id="'+data[i]['id'];			
			lefthtml+='" value="'+data[i]['id']+'"'+'></td>';

			lefthtml+='<td width="200px"><br>'+data[i]['question']+'</td>';
			
			lefthtml+='<td><br>'+data[i]['category']+'</td>';
			lefthtml+='<td><br>'+data[i]['level']+'</td>';
			
			
			cases=data[i]['cases'];
			
			cases.replace('"','\'');
			
			lefthtml+='<td><button onclick="onCall(\''+cases+'\')">Cases</button></td>'
				
				
				  
				
			
						
			//lefthtml+='<td><br>'+data[i]['cases']+'</td>';

			lefthtml+='</tr>';
			
			
			

			
		}
		
		
		lefthtml+="</tbody></table>";
		lefthtml+="</div></div>";
		
		ajaxDisplay.innerHTML=lefthtml;
		
	}
}




hr.open("POST","deletequestion_back.php", true);
hr.send(null);



function onCall(x){
	console.log(x);
	
	var format = x.split("|").join("\n");
	
	alert(format);
}







function Delete(){
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
				
				
				
				var username = "<?php echo $_SESSION['username']; ?>";
				
				var questions="";
				var out="";
				
				
				for(var i=0;i<length;i++){
					var chkbox=document.getElementById(LEFT[i]);
					
					if(chkbox.checked){
							out+='<center>' + LEFT[i] + '</center>';
							questions+=LEFT[i];
							
							var sendarray={questionid:LEFT[i]};
							console.log(sendarray);
							
					}
				}
				
				//console.log(sendarray);
				var leng = sendarray.length;
				
				
				
				
				

					ajaxRequest.onreadystatechange = function() {
						if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
		      
						var res=ajaxRequest.responseText;
						
						alert("Question has been deleted");
						
						console.log(res);
			   
						}		
					}
						
					var myJSONObject=sendarray;
					ajaxRequest.open("POST", "deletequestion_backsend.php", true); //file get contents, decode, function, CURLS
					var send = JSON.stringify(myJSONObject);
				
					console.log(JSON.stringify(myJSONObject));
					
					ajaxRequest.send(send); 
				
				
}


</script>



<?php include "footer.php";?>