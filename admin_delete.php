<?php

include_once 'db_conn.php';

// DELETE
if (isset($_GET['deletemona'])) {
	$id = $_GET['deletemona'];
	$stmt = $conn->prepare("DELETE FROM tb_adminuser WHERE admin_id=?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	
	// check if the query was successful
	if ($stmt->affected_rows == 1) {
		// header refresh every 0 second
		header("refresh: 0; cct_admin_logout.php?delete=success");
     	exit;
	} else {
		echo '<script>alert("Admin Not Deleted!")</script>';
	}
	
} else {
	echo '<script>alert("Admin Not Deleted!")</script>';
}

?>

