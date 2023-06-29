<?php

// Establish Connection
include_once 'db_conn.php';
	 
if (isset($_POST['update_librarian_btn'])) {

	$editlbid = $_POST['update_librarianid'];
	$editlblastname = str_replace(['"',"'"], "", $_POST['edit_librarianlastname']);
	$editlbfirstname = str_replace(['"',"'"], "", $_POST['edit_librarianfirstname']);
	$editlbmiddlename = str_replace(['"',"'"], "", $_POST['edit_librarianmiddlename']);
		
	$query = "UPDATE tb_librarian SET 
	librarian_lname = ?, 
	librarian_fname = ?, 
	librarian_mname = ? 
	WHERE librarian_id = ?";

	$stmt = mysqli_prepare($conn, $query);

	mysqli_stmt_bind_param($stmt, "sssi", $editlblastname, $editlbfirstname, $editlbmiddlename, $editlbid);

	if (mysqli_stmt_execute($stmt)) {
		echo "<script> alert('Updated successfully!'); window.location='librarianprofile.php?update=success' </script>"; 
	} else {
		echo "<script> alert('Account did not update!'); window.location='librarianprofile.php?update=error' </script>"; 
	}
	mysqli_stmt_close($stmt);
}


?>

