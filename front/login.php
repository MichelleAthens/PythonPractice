<style>
body{
	background-color: red;
	background-image: url(https://upload.wikimedia.org/wikipedia/en/thumb/3/30/NJIT_Highlanders_logo.svg/685px-NJIT_Highlanders_logo.svg.png);
	background-position: center;
	background-size: auto;
	background-color: grey;
	background-repeat: no-repeat;
}
fieldset { 
  display: block;
  margin-left: 2px;
  margin-right: 1100px;
  padding-top: 0.35em;
  padding-bottom: 0.625em;
  padding-left: 0.75em;
  padding-right: 0.75em;
  border: 2px groove (internal value);
}
#status {
  font-size: 20px;
  color:#ffff00;
  text-shadow:2px 2px #a6a886;
}
</style>

<head>
        <meta charset="utf-8">
</head>

<body>
  <h1> Enter Username and Password </h1>
<div class="signIn">

<fieldset>
	Username:<input id="ucid" name="ucid" type="text"/><br /><br/>
	Password:<input id="pass" name="pass" type="password"/><br /><br />
	<input name="btn" type="submit" value="login" onClick="aPost(this.fieldset);">
</fieldset>  
       
<div id="status"></div>
</body>


<script language="javascript">




function aPost(){
    var hr = new XMLHttpRequest();
    var url = "logintest.php";
    var u = document.getElementById("ucid").value;
    var p = document.getElementById("pass").value;
    var vars = "ucid="+u+"&pass="+p;
      hr.open("POST", url , true);
      hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  
      hr.onreadystatechange = function() {
	      if(hr.readyState == 4 && hr.status == 200) {
		      
			  var return_data = hr.responseText;
			  console.log(return_data);
			  
			  var myobj = JSON.parse(return_data);
			  
			  console.log(myobj);
			  
			  if(myobj['login']=="student") window.location.replace("stuFront.php");
			  else if(myobj['login']=="teacher") window.location.replace("insFront.php");
			  else document.getElementById("status").innerHTML = "failed...";

			   
	    }
    }
      hr.send(vars); 

	  }

</script>


