<?php

include_once 'db_conn.php';

if(isset($_POST['btn_reshead_repassword1'])) {

	$reshead_id = $_POST['reshead_sid1'];
	$reshead_usrname = $_POST['reshead_uname1'];

	$old_pass = str_replace(['"',"'"], "", $_POST['reshead_oldpass1']);
	$new_pass = str_replace(['"',"'"], "", $_POST['reshead_newpass1']);
	$re_pass = str_replace(['"',"'"], "", $_POST['reshead_repass1']);

	$query = mysqli_query($conn, "SELECT reshead_uname, reshead_pword FROM tb_researchhead WHERE reshead_uname = '$reshead_usrname' ");
	$user = mysqli_fetch_array($query);

	if ($user) {

		$stored_hashed_password = $user['reshead_pword'];
		if (password_verify($old_pass, $stored_hashed_password)) {
			if ($new_pass !== $re_pass OR $re_pass !== $new_pass) {

				echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='researchhead_settings.php?update=error' </script>"; 

			} else {

				$hashed_password = password_hash($re_pass, PASSWORD_DEFAULT);
				$result = mysqli_query($conn, "UPDATE tb_researchhead SET reshead_pword = '$hashed_password' WHERE reshead_id = '$reshead_id' ");

				if (!$result) {
					echo "<script> alert('Error updating password. Try again later.'); window.location='researchhead_settings.php?update=error' </script>";
				} else {
					echo "<script> 
							if (confirm('Password updated successfully. Do you want to continue using your account?')) {    
								window.location='researchhead_settings.php?update=success'
							} else {
								window.location='cct_faculty_logout.php?update=success'
							}
						  </script>";   
					}
				}

			} else {
				echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='researchhead_settings.php?update=error' </script>"; 		
			}
	}	else {
			echo "<script> alert('The old password you entered is incorrect!'); window.location='librarian_settings.php?update=error' </script>"; 
		}
}

?> 
