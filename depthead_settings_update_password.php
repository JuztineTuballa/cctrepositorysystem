<?php
include_once 'db_conn.php';

if(isset($_POST['btn_dhs_repassword'])) {

	$dhead_ssid = $_POST['dhead_sid'];
	$dhead_ssfname = $_POST['dhs_fname'];

	$old_pass = str_replace(['"',"'"], "", $_POST['dhs_oldpass']);
	$new_pass = str_replace(['"',"'"], "", $_POST['dhs_newpass']);
	$re_pass = str_replace(['"',"'"], "", $_POST['dhs_repass']);
	
	$query = mysqli_query($conn, "SELECT dhead_fname, dhead_pword FROM tb_depthead WHERE dhead_fname = '$dhead_ssfname'");
	$user = mysqli_fetch_array($query);

	if ($user) {

		$stored_hashed_password = $user['dhead_pword'];
		if (password_verify($old_pass, $stored_hashed_password)) {
			if ($new_pass !== $re_pass OR $re_pass !== $new_pass) {

				echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='depthead_settings.php?update=error' </script>"; 

			} else {

				$hashed_password = password_hash($re_pass, PASSWORD_DEFAULT);
				$result = mysqli_query($conn, "UPDATE tb_depthead SET dhead_pword = '$hashed_password' WHERE dhead_fname = '$dhead_ssfname' ");

				if (!$result) {
					echo "<script> alert('Error updating password. Try again later.'); window.location='depthead_settings.php?update=error' </script>";
				} else {
					echo "<script> 
							if (confirm('Password updated successfully. Do you want to continue using your account?')) {    
								window.location='depthead_settings.php?update=success'
							} else {
								window.location='cct_faculty_logout.php?update=success'
							}
						  </script>";   
					}
				}

			} else {
				echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='depthead_settings.php?update=error' </script>"; 
			}	 
		} else {
			echo "<script> alert('The old password you entered is incorrect!'); window.location='depthead_settings.php?update=error' </script>"; 
		}
	}

?>
 
