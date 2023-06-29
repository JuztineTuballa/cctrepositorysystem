<?php
$sname = "localhost";
$unmae = "root";
$password = "";

$db_name = "db_cctrepository";
$conn = mysqli_connect($sname,$unmae,$password,$db_name);

if (!$conn) {
	echo "connection failed!";
}

//CODE PARA SA CALENDAR
if(isset($_POST['save_date'])) {

    //$name = $_POST['name'];
	$dob = date('Y-m-d', strtotime($_POST['dateofbirth']));
	
	$mydatequery = "INSERT INTO tb_adminuser (dob) VALUES ('$dob')";
	$mydatequery_run = mysqli_query($conn,$mydatequery);

	if ($mydatequery_run) {

		$_SESSION['status'] = "Date Inserted";
		header("Location:adminprofile.php");

	} else {

		$_SESSION['status'] = "Date Failed";
		header("Location:adminprofile.php");

	}
}
//END CODE PARA SA CALENDAR
?>