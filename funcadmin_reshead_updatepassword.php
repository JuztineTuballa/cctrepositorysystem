<?php

include_once 'db_conn.php';

if(isset($_POST['btn_reshead_repassword'])) {

	$reshead_id = $_POST['reshead_sid'];
	$reshead_usrname = $_POST['reshead_uname'];

	$new_pass = str_replace(['"',"'"], "", $_POST['reshead_newpass']);
	$re_pass = str_replace(['"',"'"], "", $_POST['reshead_repass']);
	$re_pass_hashed = password_hash($re_pass, PASSWORD_DEFAULT);

	$query = mysqli_query($conn, "SELECT reshead_uname FROM tb_researchhead WHERE reshead_uname = '$reshead_usrname' ");
	$user = mysqli_fetch_array($query);

	if ($user > 0) {
		if ($new_pass !==  $re_pass || $re_pass !== $new_pass) {
			echo "<script> alert('There was an error in your request! Check your syntax and try again!'); window.location='researchheadprofile.php?update=error' </script>"; 

		} else {
			$result = mysqli_query($conn, "UPDATE tb_researchhead SET reshead_pword = '$re_pass_hashed' WHERE reshead_uname = '$reshead_usrname' ");

			if (!$result) {
				echo "<script> alert('Error updating password. Try again later.'); window.location='researchheadprofile.php?update=error' </script>";
			} else {
				echo "<script> alert('Research Head password updated successfully!'); window.location='researchheadprofile.php?update=success' </script>";
			}
		}

	} else {
		echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='researchheadprofile.php?update=error' </script>"; 

	}	 
}

?> 