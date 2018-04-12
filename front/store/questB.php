<?php include "insHead.php";?>
<style>
.glossary{
	float:right; width:30%;
	background-color:#dddddd;
	border-style:groove;
	border-width:7px;
	border-radius:8px;
}
</style>

<center>

	<h2>Make New Questions</h2>
	<div>
	
	<div>
		<h2>
		
			<input type="button" class="btn btn-lg btn-primary" value="Submit" onclick="addQuestion();"></input>
		
		</h2>
	</div>
		</select>
	</div>
	
	<div class="glossary">
	<label><b>Case Glossary</b></label>
	<body>
	<br><p>Each seperate test case must be seperated by a |</p>
	<p>For example INPUT 2,2|SOLUTION 4|FIND +</p>
	<p>This will send the paramenters 2,2 to the students function and compare the output with 4</p>
	<p>INPUT: Sends in the following data to the function. Must be followed by "SOLUTION". <br>example) INPUT 2|</p>
	<p>SOLUTION: Compares the output of the function to the data after "SOLUTION". <br>example) SOLUTION 4|</p>
	<p>FIND: Searched the code after the first line if data exists. <br>example) FIND +|</p>
	<p>COUNT WANT: Counts how many times a data exists and compares it to the desired number. <br>example) COUNT + WANT 4| </p>
	<p>FUNCTION-NAME: Searches the first line of the code if the function name is the desired. <br>example) FUNCTION-NAME: addition| </p>
	
	
	</body>
	
	
	</div>
	
	<fieldset style="float:left;width:60%;">
	<div>
		<div>
			<input type="hidden" name="qID" id="qID">

			
			<label>Question Description</label><br>
			<textarea rows=7 cols="80 name="qDescript" id="qDescript" placeholder="Question Description"></textarea><br><br>
			<textarea rows = 7 cols="80 name="qCases" id="qCases" placeholder="Cases"></textarea><br>
      
         
		</div><br>
		<div>

			<label>Category
				<select name="qCategory" id="qCategory">
					<option></option>
					<option value="for">For</option>
					<option value="while">While</option>
				//	<option value="method">Method</option>
				</select>
			</label><br>

			
			<label>Difficulty level
				<select name="qLevel" id="qLevel">
					<option></option>
					<option value="easy">Easy</option>
					<option value="medium ">Medium</option>
					<option value="hard">Hard</option>
				</select>
			</label>
			
		</div>
		
	</div>
	
	
	</fieldset>
	





<script language="javascript">

function addQuestion(){
			var ajaxRequest; 
			try{ajaxRequest = new XMLHttpRequest();} 
			catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
			catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
			catch (e){alert("BROWSER ERROR!");
						}
					}
				}
				
	var description=document.getElementById("qDescript").value;
	var cases=document.getElementById("qCases").value;
	var level=document.getElementById("qLevel").value;
	var category=document.getElementById("qCategory").value;
	
	var myJSONObject={"question":description,"category":category,"level":level,"cases":cases};
	//console.log(myJSONObject);
		
		ajaxRequest.open("POST", "questB_back.php", true);

		ajaxRequest.send(JSON.stringify(myJSONObject));

		ajaxRequest.onreadystatechange = function(){
				
if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
var return_data = ajaxRequest.responseText;
console.log(return_data);
alert("Your question was created! You may exit the page or delete your content and make another question");
}
}
}

</script>


