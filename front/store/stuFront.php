<?php include "mid.php";?>
<?php include "stuHead.php";?>
<body>
	<h3><center>Please Click Exam Tab and Start Exam<center></h3>
	<div id="ajaxDiv"></div>
</body>
<?php include "footer.php"?>

<?php 
session_start();

#echo "Welcome";

echo $_SESSION['username'];

?>