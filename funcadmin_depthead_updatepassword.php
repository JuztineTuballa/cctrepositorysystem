<?php

include_once 'db_conn.php';

if(isset($_POST['btn_depthead_repassword'])) {

	$depthead_id = $_POST['depthead_sid'];
	$depthead_usrname = $_POST['depthead_uname'];

	$new_pass = str_replace(['"',"'"], "", $_POST['depthead_newpass']);
	$re_pass = str_replace(['"',"'"], "", $_POST['depthead_repass']);
	$re_pass_hashed = password_hash($re_pass, PASSWORD_DEFAULT);

	$query = mysqli_query($conn, "SELECT dhead_uname FROM tb_depthead WHERE dhead_uname = '$depthead_usrname'");
	$user = mysqli_fetch_array($query);

	if ($user > 0) {
		if ($new_pass !== $re_pass || $re_pass !== $new_pass) {
			echo "<script> alert('There was an error in your request! Check your syntax and try again!'); window.location='deptheadprofile.php?update=error' </script>"; 

		} else {
			$result = mysqli_query($conn, "UPDATE tb_depthead SET dhead_pword = '$re_pass_hashed' WHERE dhead_uname = '$depthead_usrname' ");

			if (!$result) {
				echo "<script> alert('Error updating password. Try again later.'); window.location='deptheadprofile.php?update=error' </script>";
			} else {
				echo "<script> alert('Research Coordinator password updated successfully!'); window.location='deptheadprofile.php?update=success' </script>";
			}
		}

	} else {
		echo "<script> alert('There was an error in your request! Check your syntax and try again!'); window.location='deptheadprofile.php?update=error' </script>"; 

	}	 
}

?> 