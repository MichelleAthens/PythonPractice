var L;
var NAME=[];//ids of checkboxes
var NAME1=[];
var pt=[];//ids of points 
var ajaxRequest;  // The variable that makes Ajax possible!
try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
} catch (e){
	// Internet Explorer Browsers
	try{
		ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try{
			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e){
			// Something went wrong
			alert("Your browser broke!");
		}
	}
}

ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var ajaxDisplay = document.getElementById('questions');
		var res=ajaxRequest.responseText;
	//	alert(res);
		var data=JSON.parse(res);
		var html="<div class='row'>";
		html+="<div class='col-md-12'>";
		html+="<table class='table table-striped'>";
		html+="<thead style='background-color:#42ABCA;'><tr><th>Check</th>";
		html+="<th>Points</th>";
		html+="<th>Question</th>";
		html+="<th>Category</th>";
		html+="<th>Difficulty</th>";
		html+="<th>Description</th>";
		html+="<th>Sample Code</th>";
		html+="<th>Sample<br>Output</th>";
		html+="</tr></thead>";
		html+="<tbody>";
		var len=data.length;
		L=len;
		for(var i=0;i<len;i++){
			NAME.push(data[i]['id']);
			pt.push("point"+data[i]['id']);
			html+="<tr><td>";
			html+='<input type="checkbox" id="'+data[i]['id'];
			html+='" value="'+data[i]['id']+'"'+'></td>';
			html+='<td><input type="text"';
			html+='id="'+pt[i]+'"';
			html+='placeholder="Points" style="border:none;width:50px"/></td>';
			html+='<td><label>'+data[i]['name']+'</label></td>';
			html+='<td>'+data[i]['category']+'</td>';
			html+='<td>'+data[i]['level']+'</td>';
			html+='<td>'+data[i]['description']+'</td>';
			html+='<td>'+data[i]['code']+'</td>';
			html+='<td>'+data[i]['output']+'</td>';
			html+='</tr>';
		}
		html+="</tbody></table>";
		html+="</div></div>";
		ajaxDisplay.innerHTML=html;
	}
}
ajaxRequest.open("POST", MID_PATH+"#", true);
//file get contents, decode, function, CURLS
ajaxRequest.send(null);

function cancel(){
	var questions="";
	var started=0;
	for(var i=0;i<L;i++){
		document.getElementById(pt[i]).value='';
		var chkbox=document.getElementById(NAME[i]);
		chkbox.checked=false;
		/*if(chkbox.checked){
			if(started==0) questions+=NAME[i];
			else questions+=" "+NAME[i];
			started=1;
		}*/
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
	//	var question_list=document.getElementById("question_list");
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv');
			var res=ajaxRequest.responseText;
			alert(res);
		}
	}
	var name=document.getElementById("eName").value;
	var questions="";
	var points="";
	var started=0;
	for(var i=0;i<L;i++){
		var chkbox=document.getElementById(NAME[i]);
		var p=document.getElementById(pt[i]).value;
		if(chkbox.checked){
			if(started==0){
				questions+=NAME[i];
				points+=p;
			}
			else{
				questions+=" "+NAME[i];
				points+=" "+p;
			}
			started=1;
		}
	}
	if(name==''){
		alert("You must input Exam Name");
	}
	else{
		var myJSONObject={"name":name,"questions":questions,"points":points};
		ajaxRequest.open("POST", MID_PATH+"#", true); //file get contents, decode, function, CURLS
		ajaxRequest.send(JSON.stringify(myJSONObject));
	}
}