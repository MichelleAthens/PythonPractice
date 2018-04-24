<?php include "mid.php";?>
<?php include "homehead.php";?>


<body>

  <center><h3>Today is <?php  echo date('<br>Y-m-d');?></h3></center>
  

<div id="ajaxDiv"></div>
</body>
<?php include "footer.php"?>
<center><br>
<?php 
session_start();

echo "Welcome ";

echo $_SESSION['username'];

?></center>