<?php

include_once 'db_conn.php';

if(isset($_POST['btn_mystudent_repassword'])) {

	$mystudent_id = $_POST['mystudent_ssid'];
	$mystudent_studnum = $_POST['mystudent_studnum'];

	$new_pass = str_replace(['"',"'"], "", $_POST['mystudent_newpass']);
	$re_pass = str_replace(['"',"'"], "", $_POST['mystudent_repass']);
	$re_pass_hashed = password_hash($re_pass, PASSWORD_DEFAULT);

	$stmt = $conn->prepare("SELECT stud_num FROM tb_student WHERE stud_num = ?");
	$stmt->bind_param("s", $mystudent_studnum);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		if ($new_pass !== $re_pass) {
			echo "<script> alert('Passwords do not match!'); window.location='mis_manage_students.php?update=error' </script>"; 

		} else {
			$stmt = $conn->prepare("UPDATE tb_student SET stud_pword = ? WHERE stud_num = ?");
			$stmt->bind_param("ss", $re_pass_hashed, $mystudent_studnum);
			$result = $stmt->execute();

			if (!$result) {
				echo "<script> alert('Error updating password. Try again later.'); window.location='mis_manage_students.php?update=error' </script>";
			} else {
				echo "<script> alert('Student password updated successfully!'); window.location='mis_manage_students.php?update=success' </script>";
			}
		}

	} else {
		echo "<script> alert('Student not found!'); window.location='mis_manage_students.php?update=error' </script>"; 

	}	 
}

?>
