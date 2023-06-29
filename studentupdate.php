<?php

//Establish Connection
include_once 'db_conn.php';

if(isset($_POST['update_student_btn'])) {
	
	$editstudid = $_POST['update_studentid'];
	$editstudlastname = $_POST['edit_studentlastname'];
	$editstudfirstname = $_POST['edit_studentfirstname'];

	$query = "UPDATE tb_student SET 
	stud_lname = '$editstudlastname',
	stud_fname = '$editstudfirstname'
	WHERE stud_id = '$editstudid' ";

	$query_run = mysqli_query($conn,$query);

	//Checking if Data is Update or Not
	if($query_run) {
			echo "<script> alert('Your account has been updated successfully!\\n\\Please login again'); window.location='index.php?update=success' </script>"; 
	} else {
			echo "<script> alert('Account did not update!'); window.location='studentsettings.php?update=error' </script>"; 
	}
	//End Checking
}

?>

