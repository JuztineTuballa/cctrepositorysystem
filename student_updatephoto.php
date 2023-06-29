<?php

include_once 'db_conn.php';

if(isset($_POST['student_uploadphoto_btn'])) {
	$pid = $_POST['student_pid'];
	$filename = $_FILES['student_pphoto']['name'];
	if(!empty($filename)) {
		move_uploaded_file($_FILES['student_pphoto']['tmp_name'], 'uploads/'.$filename);	
	}
	
	$sql = "UPDATE tb_student SET stud_picture = '$filename' WHERE stud_id = '$pid'";
	if($conn->query($sql)) {
		$_SESSION['success'] = 'Photo updated successfully';
	}
	else {
		$_SESSION['error'] = $conn->error;
	}

}
else {
	$_SESSION['error'] = 'Select data to update photo first';
}

header("Location:studentsettings.php?photoupdate=success");

?>




