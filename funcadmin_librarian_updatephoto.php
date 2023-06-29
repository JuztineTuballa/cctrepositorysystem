<?php

include_once 'db_conn.php';

if(isset($_POST['librarian_uploadphoto_btn'])){
	$pid = $_POST['librarian_pid'];
	$filename = $_FILES['librarian_pphoto']['name'];
	if(!empty($filename)){
		move_uploaded_file($_FILES['librarian_pphoto']['tmp_name'], 'uploads/'.$filename);	
	}
	
	$sql = "UPDATE tb_librarian SET librarian_picture = '$filename' WHERE librarian_id = '$pid'";
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

header("Location:librarianprofile.php?libraianphotoupdate=success");

?>



