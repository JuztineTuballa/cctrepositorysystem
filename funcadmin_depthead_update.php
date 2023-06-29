<?php

// Establish Connection
include_once 'db_conn.php';

if(isset($_POST['update_depthead_btn'])) {

	$editdhid = $_POST['update_deptheadid'];
	$editdhdepartment = $_POST['edit_deptselect'];
	$editdhlastname = str_replace(['"',"'"], "", $_POST['edit_deptheadlastname']);
	$editdhfirstname = str_replace(['"',"'"], "", $_POST['edit_deptheadfirstname']);
	$editdhmiddlename = str_replace(['"',"'"], "", $_POST['edit_deptheadmiddlename']);

	// Prepare the UPDATE query
	$stmt = $conn->prepare("UPDATE tb_depthead SET dhead_dept=?, dhead_lname=?, dhead_fname=?, dhead_mname=? WHERE dhead_id=?");
	$stmt->bind_param("ssssi", $editdhdepartment, $editdhlastname, $editdhfirstname, $editdhmiddlename, $editdhid);
	$stmt->execute();

	// Check if the query was successful
	if ($stmt->affected_rows == 1) {
		echo "<script> alert('Updated successfully!'); window.location='deptheadprofile.php?update=success' </script>";
	} else {
		echo "<script> alert('Account did not update!'); window.location='deptheadprofile.php?update=error' </script>";
	}

	// End Checking
}

?>