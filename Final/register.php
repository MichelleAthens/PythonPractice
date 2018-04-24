<!DOCTYPE html>
<html>
<style>
body {font-family: Arial;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
	
	<fieldset>
    <label><b>Username</b></label>
    <input id="user" type="text" placeholder="Enter Username" name="username" required>

	<label><b>Firstname</b></label>
    <input id="firstname" type="text" placeholder="Enter Firstname" name="first" required>
	
	<label><b>Lastname</b></label>
    <input id="lastname" type="text" placeholder="Enter Lastname" name="last" required>
		
    <label><b>Password</b></label>
    <input id="pass" type="password" placeholder="Enter Password" name="psw" required>

    <label><b>Repeat Password</b></label>
    <input id="pass2" type="password" placeholder="Repeat Password" name="psw-repeat" required>
	
	<label><b>Security Question</b></label>
    <input id="sec" type="text" placeholder="Make a Question" name="sec" required>
	
	<label><b>Answer</b></label>
    <input id="secans" type="text" placeholder="Security Answer" name="ans" required>
    
    <label>
      <input type="checkbox" checked="checked" style="margin-bottom:15px"> Remember me
    </label>
    </fieldset>

	
    <div class="clearfix">
      <button type="submit" onClick="submit(this.fieldset);" class="signupbtn">Sign Up</button>
    </div>
  </div>

</body>
</html>

<script language="javascript">


function submit(){
	var username = document.getElementById("user").value;
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var pass = document.getElementById("pass").value;
	var pass2 = document.getElementById("pass2").value;
	
	
	var security = document.getElementById("sec").value;
	var answer = document.getElementById("secans").value;

	if(pass === pass2){
		console.log("matches");
		
		var ajaxRequest; 
		
		try{ajaxRequest = new XMLHttpRequest();} 
		catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} 
		catch (e){try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} 
		catch (e){alert("BROWSER ERROR!");}}}
				
	var myJSONObject={"username":username};
	console.log(myJSONObject);
		
		ajaxRequest.open("POST", "php/verify.php", true);

		ajaxRequest.send(JSON.stringify(myJSONObject));

		
		ajaxRequest.onreadystatechange = function(){
				
		if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200){
			var return_data = ajaxRequest.responseText;
			console.log(return_data);
			
			if(return_data ==="taken"){
				alert("username taken");
			}
			else{
				var ajax;
					try{ajax = new XMLHttpRequest();} 
					catch (e){try{ajax = new ActiveXObject("Msxml2.XMLHTTP");} 
					catch (e){try{ajax = new ActiveXObject("Microsoft.XMLHTTP");} 
					catch (e){alert("BROWSER ERROR!");}}}
					
		
				var obj = {"username":username,"firstname":firstname,"lastname":lastname,"pass":pass,"security":security,"answer":answer};
				
				ajax.open("POST","php/logincred.php",true);
				ajax.send(JSON.stringify(obj));
				
				
				ajax.onreadystatechange = function(){
						if(ajax.readyState == 4 && ajax.status == 200){
							var return_data = ajax.responseText;
							console.log(return_data);
							var myobj = JSON.parse(return_data);
							var response = myobj['response'];
							
							
							if(response==="success"){
								alert("Creation successful, You can now login");
								
								window.location.replace("index.html"); //home page not made yet
							}
							else{
								alert("Error");
							}
						}
					
			
			
			
			
				}
			}
		}
		
		}

	
	
	
	
	}else{
		alert("Passwords must match");
		
	}
	//Check if both passwords match
	//Send username to database and check
	//if good send data to profile creation
}




</script>
