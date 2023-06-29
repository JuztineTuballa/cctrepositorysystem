<?php

//Establish Connection
include_once 'db_conn.php';
	
	if(isset($_POST['update_reshead_btn'])) {

		$editrhid = $_POST['update_resheadid'];
		$editrhlastname = str_replace(['"',"'"], "", $_POST['edit_resheadlastname']);
		$editrhfirstname = str_replace(['"',"'"], "", $_POST['edit_resheadfirstname']);
		$editrhmiddlename = str_replace(['"',"'"], "", $_POST['edit_resheadmiddlename']);
		

		$query = "UPDATE tb_researchhead SET 
		reshead_lname = '$editrhlastname', 
		reshead_fname = '$editrhfirstname', 
		reshead_mname = '$editrhmiddlename' 
		WHERE reshead_id = '$editrhid' ";

		$query_run = mysqli_query($conn,$query);

		//Checking if Data is Update or Not
		if($query_run) {
			echo "<script> alert('Updated successfully!'); window.location='researchheadprofile.php?update=success' </script>"; 
		} else {
			echo "<script> alert('Account did not update!'); window.location='researchheadprofile.php?update=error' </script>"; 
		}
		//End Checking

	}

?>

