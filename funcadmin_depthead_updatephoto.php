<?php

include 'db_conn.php';

if(isset($_POST['dh_uploadphoto_btn'])){
	$pid = $_POST['depthead_pid'];
	$filename = $_FILES['depthead_pphoto']['name'];
	if(!empty($filename)){
		move_uploaded_file($_FILES['depthead_pphoto']['tmp_name'], 'uploads/'.$filename);	
	}
	
	$sql = "UPDATE tb_depthead SET dhead_picture = '$filename' WHERE dhead_id = '$pid'";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Photo updated successfully';
	}
	else{
		$_SESSION['error'] = $conn->error;
	}

}
else{
	$_SESSION['error'] = 'Select data to update photo first';
}

header("Location:deptheadprofile.php?dhphotoupdate=success");

?>



