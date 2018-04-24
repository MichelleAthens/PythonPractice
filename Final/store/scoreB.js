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
		var data=JSON.parse(res);
		var html="<div class='container row'>";
		html+="<div class='col-mod-12'>";
		html+="<table class='table table-striped'>";
		html+="<thead><tr>";
		html+="<th>Student</th>";
		html+="<th>Question</th>"
		html+="<th>Answer</th>";
		html+="<th>Assess</th>";
		html+="</tr></thead>";
		var len=data.length;
		L=len;
		html+="<tbody>"
		for(var i=0;i<len;i++){
			html+='<tr><td>'+data[i]['stdId']+'</td>';
			html+='<td>'+data[i]['quesId']+'</td>';
			html+='<td>'+data[i]['answer']+'</td>';
			html+='<td>'+data[i]['assess']+'</td>';
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