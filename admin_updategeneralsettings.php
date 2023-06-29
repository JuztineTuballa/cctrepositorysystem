<?php

include_once 'db_conn.php';

//Establish Connection
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,'db_cctrepository');

if(isset($_POST['update_btn'])) {
		

	$editaid = $_POST['update_adminid'];
	$editalastname = str_replace(['"',"'"], "", $_POST['edit_adminlastname']);
	$editafirstname = str_replace(['"',"'"], "", $_POST['edit_adminfirstname']);
	$editamiddlename = str_replace(['"',"'"], "", $_POST['edit_adminmiddlename']);
	$editagender =  $_POST['edit_gridradios'];
	$editabirthdate =  $_POST['edit_adminbirthdate'];
	$editaaddress =  str_replace(['"',"'"], "", $_POST['edit_adminaddress']);
	$editaemail =  $_POST['edit_adminemail'];
	 	
		 	
	$query = "UPDATE tb_adminuser SET 
	admin_lastname = '$editalastname',
	admin_firstname = '$editafirstname', 
	admin_middlename = '$editamiddlename', 
	admin_gender = '$editagender',
	admin_birthday = '$editabirthdate',
	admin_address = '$editaaddress',
	admin_email = '$editaemail'
	WHERE admin_id = '$editaid' ";

	
	$query_run = mysqli_query($connection,$query);

	//Checking if Data is Update or Not
	if($query_run) {
		echo "<script> alert('Your account has been updated successfully!'); window.location='adminsettings.php?update=success' </script>"; 
	} else {
		echo "<script> alert('Account did not update!'); window.location='adminsettings.php?update=error' </script>"; 
	}
	//End Checking
}

?>