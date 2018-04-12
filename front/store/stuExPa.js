var LN;
var DATA=[];
var ajaxRequest;  // The variable that makes Ajax possible!
try{ajaxRequest = new XMLHttpRequest();} 
catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
catch (e){alert("BROSWER ERROR");}
		}
	}

	// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var ajaxDisplay = document.getElementById('ajaxDiv');
		var res=ajaxRequest.responseText;
	//	alert(res);
		var data=JSON.parse(res);
		var html='<div class="container">';
		var len=data.length;
		LN=len;
		for(var i=0;i<len;i++){
			DATA.push(data[i]['id']);
			html+='<div><p><em>Problem'+(i+1)+':</em>';
			html+=data[i]['name']+'</p>';
			html+='<label>Question Description:</label><br>';
			html+='<p>'+data[i]['description']+'</p>';
			html+='<label>Your answer</label><br>';
			html+='<textarea style="width:80%" id="'+data[i]['id']+'"></textarea><br><br>';
			html+='</div>';
		}
		html+='</div>';
		ajaxDisplay.innerHTML=html;
	}
}
ajaxRequest.open("POST", MID_PATH+"#", true);
ajaxRequest.send(null);
function assest(){
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
  alert(res);

		}
	}
	answers=[];
	for(var i=0;i<LN;i++){
		var ans=document.getElementById(DATA[i]).value;
		var ans={"id":DATA[i],"ans":ans};
		answers.push(ans);
	}
 //file get contents, decode, function, CURLS
	ajaxRequest.open("POST", MID_PATH+"#", true);
	ajaxRequest.send(JSON.stringify(answers));
}