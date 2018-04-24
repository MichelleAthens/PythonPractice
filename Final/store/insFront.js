function questionLevel(){
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
  var data=JSON.parse(res);
  var html='<table><tr><td width="300px">ProblemName</td><td>Level</td><td></td></tr>';
  var len=data.length;
			for(var i=0;i<len;i++){
				html+='<tr><td width="300px">'+data[i]['name']+'</td>'+'<td>'+data[i]['level']+'</td>';
				html+='<td><input type="checkbox"></td></tr>';
			}
			html+='</table>';
			html+='<input type="button" value="Create Exam">';
			html+='<input type="button" value="View Exam" onclick="viewExam();">';
			ajaxDisplay.innerHTML=html;
		}
	}
	/*
	var level=document.getElementById('level').value;
	var pass="";
	var myJSONObject = {"level": level};
	ajaxRequest.open("POST", MID_PATH+"#", true);
 //file get contents, decode, function, CURLS
	ajaxRequest.send(JSON.stringify(myJSONObject));
	var qb=document.getElementById('question_bank');
*/
}
