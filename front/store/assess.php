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
	<input type="button" value="Release Exam" class="btn btn-info" onclick="release();"/>
	
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


ajaxRequest.open("POST", "assess_back.php", true);
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

		html+="<th>Exam ID</th>";
		html+="<th>Exam Name</th>";
		
		html+="</tr></thead>";
		html+="<tbody>";
	
		//console.log(len);
		for(var i=0;i<len;i++){
			
			html+="<tr><td>";
			html+='<input type="checkbox" name="examlist" id="'+data[i]['examid'];			
			html+=' " value= " ' +data[i]['examname']+'"'+'></td>';
			//html+='<input type="hidden" name="examnamelist" value="' +data[i]['examname']+'"'+'></td>';

			
			html+='<td><br>'+data[i]['examid']+'</td>';
			html+='<td><br>'+data[i]['examname']+'</td>';
			
			
			
		}
	
	html+="</tbody></table>";
	html+="</div></div>";
	Display.innerHTML=html;
	
	
	}
				
}
			

function release(){
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
								
								var message='The exam' + examname +' has been release to all the students. \nSubmission is now closed';
								alert(message);
								}
				}
			
			var username = "<?php echo $_SESSION['username']; ?>";
			var sendarray=[];
			sendarray.push({username:username});
			var chkbox=document.getElementsByName("examlist");
			
			
			for(var i=0;i<chkbox.length;i++){
					
					
					if(chkbox[i].checked){
								
							var examid=chkbox[i].id;
							var examname=chkbox[i].value;
							sendarray.push({examid:examid,examname:examname});
							
					}
				}
				console.log(sendarray);
				ajaxRequest.open("POST", "assess_backsend.php", true); //php release from midddle
			 //file get contents, decode, function, CURLS
				ajaxRequest.send(JSON.stringify(sendarray));
}
</script>