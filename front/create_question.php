<?php include "homehead.php";?>
<style>

input[type=text], select {
	width: 15%;
    padding: 4px 20px;
    margin: 8px 0;
    display: inline-block;
    border-radius: 4px;
    box-sizing: border-box;
	border: 1px solid #000;
}
#form{
	width:90%;
	background-color:#00000;
	border-style:groove;
	border-width:7px;
	border-color:67B3FF;
	border-radius:8px;
	padding:40;
	
}
.myCases{
	width: 30%;
    padding: 4px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #000;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border-radius: 4px;
	border: 1px solid #000;
}

.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #0080ff;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 13px;
  padding: 10px;
  width: 120px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

center{
	padding: 10px 50px 10px 50px;
	
}

</style>

<head>

<script src="jquery-3.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="codemirror/plugin/codemirror/lib/codemirror.css">
<script type="text/javascript" src="codemirror/plugin/codemirror/lib/codemirror.js"></script>
<script src="codemirror/plugin/codemirror/mode/python/python.js"></script>
</head>
<center>

	<h2>Make New Questions</h2>
	<div>
	
	<div>
		<h2>
		
		
		</h2>
	</div>
		</select>
	</div>
	
	


	<div>
	<form id="form">
	
				<div>

			<label>Category
				<select required name="qCategory" id="qCategory">
					<option></option>
					<option value="for">For</option>
					<option value="while">While</option>
					<option value="method">Method</option>
				</select>
			</label><br>

			</div>
			<br>
			<div>
			<label>Difficulty level
				<select required name="qLevel" id="qLevel">
					<option></option>
					<option value="easy">Easy</option>
					<option value="medium ">Medium</option>
					<option value="hard">Hard</option>
				</select>
			</label>
			
		</div>
		<br>
	
	
	
	
	
	
	<fieldset style="width:60%;">
	<div>
		<div>
			<input type="hidden" name="qID" id="qID">

			
			<label>Question Description</label><br>
			<textarea rows=7 cols=80 name="qDescript" id="qDescript" placeholder="Question Description" required ></textarea><br><br>
			
			<label>Sample Code</label><p align="left"><textarea rows = 7 cols=80 name="sample" id="sample" placeholder="Sameple Code (optional)"></textarea></p><br>
			<br>
		
		
			
			<div id="cases">
				<input type="button" class="button" value="Add a Test Case" onclick="addCase('cases');" />
				<input type="button" class="button" value="Remove Last" onclick="remove();" />

			</div>
         
		</div><br>

		
	</div>
	
	<input type="button" class="button" value="Submit"; onclick="addQuestion();"/>

	
	
	
	</fieldset>
	</form>
	<br><br>
	</div>


<script language="javascript">



//ALOW TAB IN TEXT AREA================================================
HTMLTextAreaElement.prototype.getCaretPosition = function () { //return the caret position of the textarea
    return this.selectionStart;
};
HTMLTextAreaElement.prototype.setCaretPosition = function (position) { //change the caret position of the textarea
    this.selectionStart = position;
    this.selectionEnd = position;
    this.focus();
};
HTMLTextAreaElement.prototype.hasSelection = function () { //if the textarea has selection then return true
    if (this.selectionStart == this.selectionEnd) {
        return false;
    } else {
        return true;
    }
};
HTMLTextAreaElement.prototype.getSelectedText = function () { //return the selection text
    return this.value.substring(this.selectionStart, this.selectionEnd);
};
HTMLTextAreaElement.prototype.setSelection = function (start, end) { //change the selection area of the textarea
    this.selectionStart = start;
    this.selectionEnd = end;
    this.focus();
};

var textarea = document.getElementsByTagName('textarea')[0]; 

textarea.onkeydown = function(event) {
    
    //support tab on textarea
    if (event.keyCode == 9) { //tab was pressed
        var newCaretPosition;
        newCaretPosition = textarea.getCaretPosition() + "    ".length;
        textarea.value = textarea.value.substring(0, textarea.getCaretPosition()) + "    " + textarea.value.substring(textarea.getCaretPosition(), textarea.value.length);
        textarea.setCaretPosition(newCaretPosition);
        return false;
    }
    if(event.keyCode == 8){ //backspace
        if (textarea.value.substring(textarea.getCaretPosition() - 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
            var newCaretPosition;
            newCaretPosition = textarea.getCaretPosition() - 3;
            textarea.value = textarea.value.substring(0, textarea.getCaretPosition() - 3) + textarea.value.substring(textarea.getCaretPosition(), textarea.value.length);
            textarea.setCaretPosition(newCaretPosition);
        }
    }
    if(event.keyCode == 37){ //left arrow
        var newCaretPosition;
        if (textarea.value.substring(textarea.getCaretPosition() - 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
            newCaretPosition = textarea.getCaretPosition() - 3;
            textarea.setCaretPosition(newCaretPosition);
        }    
    }
    if(event.keyCode == 39){ //right arrow
        var newCaretPosition;
        if (textarea.value.substring(textarea.getCaretPosition() + 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
            newCaretPosition = textarea.getCaretPosition() + 3;
            textarea.setCaretPosition(newCaretPosition);
        }
    } 
}
//ALOW TAB IN TEXT AREA================================================
//Credit to: https://css-tricks.com/snippets/javascript/support-tabs-in-textareas/






var choices =['INPUT','FIND','COUNT','FUNCTION-NAME'];

var sel = document.getElementById('cases');
var counter=0;
var casearray=[];

editor = CodeMirror.fromTextArea(document.getElementById("sample"), {
        mode: {name: "python",
               version: 3,
               singleLineStringErrors: false},
        lineNumbers: true,
        indentUnit: 4,
        matchBrackets: true
    });





function remove(){
	counter--;
	var node = document.getElementById('option'+counter);
	
	node.remove();
	
}

function myFunction(count){
	console.log(arguments[0]);
	
	
	var current = arguments[0];
	var x = document.getElementById(current).value;
	
	console.log(x);
	
	
	if (x==="INPUT"){
		
		
		var solDiv = document.createElement('div');
		var solHTML="";
		solHTML += "<textarea id =sol"+current+" rows=1 cols=30 class='casesol' placeholder='Wanted Solution'></textarea>";
		solDiv.innerHTML = solHTML;
		
		document.getElementById('text'+current).placeholder='Wanted Input 	ex) "*",2';
		
		document.getElementById("additional"+current).appendChild(solDiv);


		}
		else if (x==="COUNT"){
				var wantDiv = document.createElement('div');
				var wantHTML="";
				wantHTML += "<textarea id =want"+current+" rows=1 cols=30 class='wantsol' placeholder='How Many'></textarea>";
				wantDiv.innerHTML = wantHTML;
				
				document.getElementById('text'+current).placeholder='Count What';
				
				document.getElementById("additional"+current).appendChild(wantDiv);




		
		}		
		else{
			var place="";
			if(x==="FIND"){
				place = "Search For";
			}
			else if(x==="FUNCTION-NAME"){
				place = "Desired Function Name";
			}
			
			document.getElementById('obj'+current).innerHTML ='';
			var newDiv = document.createElement('div');
			var newSol ="";
		
			var temp1 = current-1;
			newSol += "<div id = 'obj"+current+"'>"
			newSol += "<br><textarea id='text"+current+"'  rows = 1 cols=30 class = 'casetext' placeholder='"+place+"'></textarea>";
			newSol += "<div id = 'additional"+current+"'></div>";	
			newSol +=	"</div>";
			
			
			newDiv.innerHTML = newSol;
			document.getElementById('obj'+current).appendChild(newDiv);
			
		
				
		}
}



function addCase(){
	var newDiv = document.createElement('div');
	var HTML ="";
	var temp = counter+1;
	HTML+="<div id ='option" + counter +"'>";
	HTML+="<br><br><select required class='myCases' id ='"+counter+"' onchange='myFunction("+counter+")'>";

	HTML+="<option></option>";
	
	for(i = 0; i < choices.length; i = i + 1) {
        HTML += "<option value='" + choices[i] + "'>" + choices[i] + "</option>";
    }
	
	
	
    HTML += "</select>";
	HTML += "<div id = obj"+counter+">";
	
	HTML += "<br><textarea id=text"+counter+"  rows = 1 cols=30 class = 'casetext' placeholder='Case "+temp+"'></textarea>";
	HTML += "<div id = 'additional"+counter+"'></div>";	
	HTML +=	"</div>";
	HTML += "</div>"
	counter++;
    newDiv.innerHTML = HTML;
	
    document.getElementById("cases").appendChild(newDiv);
	
}








function addQuestion(){
//===================================================
	var test ="";
	for(i=0; i< counter; i++){

		var sel = "text"+i;
		
		
		var cases = document.getElementById(i).value;
		
		
		switch(cases){
			case "INPUT":
			
				var x = document.getElementById('sol'+i).value;
				var selection = document.getElementById(sel).value;

			
				var inputtext = "INPUT " + selection + "|SOLUTION " +x;
				
				casearray.push(inputtext);
				
				break;
			case "COUNT":
				
				var x = document.getElementById('want'+i).value;
				var selection = document.getElementById(sel).value;
				
				var counttext = "COUNT " + selection + " WANT " +x;
				
				casearray.push(counttext);
			
				break;
			case "FIND":
								
				var selection = document.getElementById(sel).value;
				
				var findtext = "FIND " + selection;
				
				casearray.push(findtext);
				
				
				break;
			case "FUNCTION-NAME":
				
				
				var selection = document.getElementById(sel).value;
				
				var nametext = "FUNCTION-NAME " + selection;
				
				casearray.push(nametext);
				
				
				break;
			
			
			
		}
	}	
	
	
//===================================================
			var ajaxRequest; 
			try{ajaxRequest = new XMLHttpRequest();} 
			catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
			catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
			catch (e){alert("BROWSER ERROR!");
						}
					}
				}
				
	var description=document.getElementById("qDescript").value;
	var sample = editor.getValue();
	var level=document.getElementById("qLevel").value;
	var category=document.getElementById("qCategory").value;

				
	var username = "<?php session_start(); echo $_SESSION['username']; ?>";
	
	
	var myJSONObject={"username":username,"question":description,"sample":sample,"category":category,"level":level,"cases":casearray};
	console.log(myJSONObject);
	
	
		ajaxRequest.open("POST", "create_question_back.php", true);

		ajaxRequest.send(JSON.stringify(myJSONObject));

		ajaxRequest.onreadystatechange = function(){
				
				if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
						var return_data = ajaxRequest.responseText;
						
						console.log(return_data);
						alert("Your question was created!");
						//window.location.replace("create_question.php");
				}
		}


}



</script>


