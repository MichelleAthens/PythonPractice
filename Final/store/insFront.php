<?php include "mid.php";?>
<?php include "insHead.php";?>

<link href="instructor.css" rel="stylesheet">
<script src="insFront.js" type="text/JavaScript"></script>
<body>

  <h3>Today is <?php  echo date('<br>Y-m-d');?></h3>

<div id="ajaxDiv"></div>
</body>
<?php include "footer.php"?>

<?php 
session_start();

#echo "Welcome";

#echo $_SESSION['username'];

?>