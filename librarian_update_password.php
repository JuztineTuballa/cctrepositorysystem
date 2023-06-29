<?php

include_once 'db_conn.php';

if(isset($_POST['btn_librarian_repassword1'])) {

	$librarian_id = $_POST['librarian_sid1'];
	$librarian_usrname = $_POST['librarian_uname1'];

	$old_pass = str_replace(['"',"'"], "", $_POST['librarian_oldpass1']);
	$new_pass = str_replace(['"',"'"], "", $_POST['librarian_newpass1']);
	$re_pass = str_replace(['"',"'"], "", $_POST['librarian_repass1']);

	$query = mysqli_query($conn, "SELECT librarian_uname, librarian_pword FROM tb_librarian WHERE librarian_uname = '$librarian_usrname' ");
	$user = mysqli_fetch_array($query);

	if ($user) {

		$stored_hashed_password = $user['librarian_pword'];
		if (password_verify($old_pass, $stored_hashed_password)) {
			if ($new_pass !== $re_pass OR $re_pass !== $new_pass) {

				echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='librarian_settings.php?update=error' </script>"; 

			} else {

				$hashed_password = password_hash($re_pass, PASSWORD_DEFAULT);
				$result = mysqli_query($conn, "UPDATE tb_librarian SET librarian_pword = '$hashed_password' WHERE librarian_id = '$librarian_id' ");

				if (!$result) {
					echo "<script> alert('Error updating password. Try again later.'); window.location='librarian_settings.php?update=error' </script>";
				} else {
					echo "<script> 
							if (confirm('Password updated successfully. Do you want to continue using your account?')) {    
								window.location='librarian_settings.php?update=success'
							} else {
								window.location='cct_faculty_logout.php?update=success'
							}
						  </script>";   
					}
				}

			} else {
				echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='librarian_settings.php?update=error' </script>"; 		
			}
	} else {
			echo "<script> alert('The old password you entered is incorrect!'); window.location='librarian_settings.php?update=error' </script>"; 
		}
}
	
?> 