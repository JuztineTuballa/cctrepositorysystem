<?php

include_once 'db_conn.php';

if(isset($_POST['uploadphoto_btn'])) {
	$pid = $_POST['admin_pid'];
	$filename = $_FILES['admin_pphoto']['name'];
	if(!empty($filename)){
		move_uploaded_file($_FILES['admin_pphoto']['tmp_name'], 'uploads/'.$filename);	
	}
	
	$sql = "UPDATE tb_adminuser SET admin_picture = '$filename' WHERE admin_id = '$pid'";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Admin Photo updated successfully';
	}
	else{
		$_SESSION['error'] = $conn->error;
	}

}
else {
	$_SESSION['error'] = 'Select data to update photo first';
}

header("Location:adminsettings.php?adminphotoupdate=success");

?>



