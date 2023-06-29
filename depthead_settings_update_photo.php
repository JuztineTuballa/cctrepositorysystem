<?php

//Establish Connection
include_once 'db_conn.php';

if (isset($_POST['depthead_settings_uploadphoto_btn'])) {
	$pid = $_POST['dhs_pid'];
	$filename = $_FILES['dhs_pphoto']['name'];
	if (!empty($filename)) {
		move_uploaded_file($_FILES['dhs_pphoto']['tmp_name'], 'uploads/'.$filename);	
	}
	
	$sql = "UPDATE tb_depthead SET dhead_picture = '$filename' WHERE dhead_id = '$pid'";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Photo updated successfully';
	}
	else {
		$_SESSION['error'] = $conn->error;
	}

}
else {
	$_SESSION['error'] = 'Select data to update photo first';
}

header("Location:depthead_settings.php?dhphotoupdate=success");

?>



