function newQuestion(){
	document.getElementById("qDescript").value='';
	document.getElementById("qName").value='';
	document.getElementById("qCategory").value='';
	document.getElementById("qLevel").value='';
}

function addQuestion(){
			var ajaxRequest; 
			try{ajaxRequest = new XMLHttpRequest();} 
			catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
			catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
			catch (e){alert("BROWSER ERROR!");
						}
					}
				}
				
				
			ajaxRequest.onreadystatechange = function(){
				
				
				var return_data = ajaxRequest.responseText;
			  console.log(return_data);

				}
			}
	
	
//	var id=document.getElementById("qID").value;
	var description=document.getElementById("qDescript").value;
	var cases=document.getElementById("qCases").value;
	var level=document.getElementById("qLevel").value;
	var category=document.getElementById("qCategory").value;

	if(name=='' || level==''){
	//	alert("qName and dLevels");
	}
	
	else{
		var myJSONObject={"question":description,"category":category,"level":level,"cases":cases};
		
		
		
		ajaxRequest.open("POST", "questB_back.php", true);
		
   //file get contents, decode, function, CURLS
		ajaxRequest.send(JSON.stringify(myJSONObject));
}


