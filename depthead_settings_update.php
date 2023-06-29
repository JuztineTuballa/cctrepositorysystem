<?php

//Establish Connection
include_once 'db_conn.php';

if(isset($_POST['update_deptheadsettings_btn'])) {
	
	$editdeptheadid = $_POST['update_deptheadid'];
	$editdeptheadlastname = str_replace(['"',"'"], "", $_POST['edit_deptheadlastname']);
	$editdeptheadfirstname = str_replace(['"',"'"], "", $_POST['edit_deptheadfirstname']);
	$editdeptheadmiddlename = str_replace(['"',"'"], "", $_POST['edit_deptheadmiddlename']);

	$query = "UPDATE tb_depthead SET 
	dhead_lname = '$editdeptheadlastname',
	dhead_fname = '$editdeptheadmiddlename',
	dhead_mname = '$editdeptheadfirstname'
	WHERE dhead_id = '$editdeptheadid' ";

	$query_run = mysqli_query($conn,$query);

	//Checking if Data is Update or Not
	if($query_run) {
			echo "<script> alert('Your account has been updated successfully!'); window.location='depthead_signin.php?update=success' </script>"; 
	} else {
			echo "<script> alert('Account did not update!'); window.location='depthead_settings.php?update=error' </script>"; 
	}
	//End Checking
}

?>

