<?php

include_once 'db_conn.php';

if(isset($_POST['btn_repassword'])) {

	$admin_id = $_POST['admin_sid'];
	$admin_usrname = str_replace(['"',"'"], "", $_POST['admin_uname']);

	$old_pass = str_replace(['"',"'"], "", $_POST['admin_oldpass']);
	$new_pass = str_replace(['"',"'"], "", $_POST['admin_newpass']);
	$re_pass = str_replace(['"',"'"], "", $_POST['admin_repass']);

	$query = mysqli_query($conn, "SELECT admin_username, admin_password FROM tb_adminuser WHERE admin_username = '$admin_usrname'");
	$user = mysqli_fetch_array($query);

	if (password_verify($old_pass, $user['admin_password'])) {
		if ($new_pass !== $re_pass) {
			echo "<script> alert('The new passwords you entered do not match!'); window.location='adminsettings.php?update=error' </script>"; 

		} else {
			$new_pass_hashed = password_hash($new_pass, PASSWORD_DEFAULT);
			$result = mysqli_query($conn, "UPDATE tb_adminuser SET admin_password = '$new_pass_hashed' WHERE admin_username = '$admin_usrname' ");

			if (!$result) {
				echo "<script> alert('Error updating password. Try again later.'); window.location='adminsettings.php?update=error' </script>";
			} else {
				echo "<script> 
				if (confirm('Password updated successfully. Do you want to continue using your account?')) {    
					window.location='adminsettings.php?update=success'
					} else {
						window.location='adminlogout.php?update=success'
					}
					</script>";   
				}
			}

		} else {
			echo "<script> alert('The old password you entered is incorrect!'); window.location='adminsettings.php?update=error' </script>"; 

		}	 

	}

?> 
