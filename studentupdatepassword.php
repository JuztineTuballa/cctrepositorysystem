<?php

include_once 'db_conn.php';

if(isset($_POST['btn_student_repassword'])) {

	$student_ssid = $_POST['student_sid'];
	$student_ssfname = $_POST['student_fname'];

	$old_pass = $_POST['student_oldpass'];
	$new_pass = $_POST['student_newpass'];
	$re_pass = $_POST['student_repass'];

	if ($new_pass !== $re_pass) {
		echo "<script> alert('Passwords do not match!'); window.location='studentsettings.php?update=error' </script>";
		exit();
	}

	$query = mysqli_query($conn, "SELECT stud_fname, stud_pword FROM tb_student WHERE stud_fname = '$student_ssfname'");
	$user = mysqli_fetch_assoc($query);

	if (password_verify($old_pass, $user['stud_pword'])) {
		$hashed_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
		$result = mysqli_query($conn, "UPDATE tb_student SET stud_pword = '$hashed_new_pass' WHERE stud_fname = '$student_ssfname' ");

		if (!$result) {
			echo "<script> alert('Error updating password. Try again later.'); window.location='studentsettings.php?update=error' </script>";
		} else {
			echo "<script> 
			if (confirm('Password updated successfully. Do you want to continue using your account?')) {    
				window.location='studentsettings.php?update=success'
			} else {
				window.location='studentlogout.php?update=success'
			}
			</script>";   
		}
	} else {
		echo "<script> alert('Invalid old password!'); window.location='studentsettings.php?update=error' </script>";
	}
}

?>