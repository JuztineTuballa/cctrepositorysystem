<?php

include_once 'db_conn.php';

if(isset($_POST['btn_librarian_repassword'])) {

	$librarian_id = $_POST['librarian_sid'];
	$librarian_usrname = $_POST['librarian_uname'];

	$new_pass = str_replace(['"',"'"], "", $_POST['librarian_newpass']);
	$re_pass = str_replace(['"',"'"], "", $_POST['librarian_repass']);
	$re_pass_hashed = password_hash($re_pass, PASSWORD_DEFAULT);

	$query = mysqli_query($conn, "SELECT librarian_uname FROM tb_librarian WHERE librarian_uname = '$librarian_usrname' ");
	$user = mysqli_fetch_array($query);

	if ($user > 0) {
		if ($new_pass !==  $re_pass || $re_pass !== $new_pass) {
			echo "<script> alert('There was an error in your request! Check your syntax and try again!'); window.location='librarianprofile.php?update=error' </script>"; 

		} else {
			$result = mysqli_query($conn, "UPDATE tb_librarian SET librarian_pword = '$re_pass_hashed' WHERE librarian_uname = '$librarian_usrname' ");

			if (!$result) {
				echo "<script> alert('Error updating password. Try again later.'); window.location='librarianprofile.php?update=error' </script>";
			} else {
				echo "<script> alert('Librarian password updated successfully!'); window.location='librarianprofile.php?update=success' </script>";
			}
		}

	} else {
		echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='librarianprofile.php?update=error' </script>"; 

	}	 
}

?> 