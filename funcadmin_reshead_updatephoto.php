<?php

include_once 'db_conn.php';

if(isset($_POST['rh_uploadphoto_btn'])){
	$pid = $_POST['reshead_pid'];
	$filename = $_FILES['reshead_pphoto']['name'];
	if(!empty($filename)){
		move_uploaded_file($_FILES['reshead_pphoto']['tmp_name'], 'uploads/'.$filename);	
	}
	
	$sql = "UPDATE tb_researchhead SET reshead_picture = '$filename' WHERE reshead_id = '$pid'";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Photo updated successfully';
	}
	else{
		$_SESSION['error'] = $conn->error;
	}

}
else {
	$_SESSION['error'] = 'Select data to update photo first';
}

header("Location:researchheadprofile.php?dhphotoupdate=success");

?>



