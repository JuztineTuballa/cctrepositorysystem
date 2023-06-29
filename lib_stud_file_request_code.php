<?php

session_start();
include 'db_conn.php';

if(isset($_POST['stud_approve_all_multiple_btn'])) {

    if(isset($_POST['stud_auto_approve'])) {
        $all_id = $_POST['stud_auto_approve'];
        $extract_id = implode(',' , $all_id);
       
        $query = "UPDATE tb_frequest SET req_fupstatus = 'Approved' WHERE req_id IN (";

        $placeholders = implode(',', array_fill(0, count($all_id), '?'));

        $query .= $placeholders . ")";
        
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, str_repeat('i', count($all_id)), ...$all_id);
        
        $query_run = mysqli_stmt_execute($stmt);

        if($query_run) {
            $_SESSION['approval_status'] = "Request Approved!";
            header("Location: lib_stud_req_approval.php");

        } else {
            $_SESSION['approval_status'] = "Request has not been Approved! Please select some items from the first ten rows only! one at a time! thank you!";
            header("Location: lib_stud_req_approval.php");  
        }
    } else {
        $_SESSION['approval_status'] = "No items selected for approval!";
        header("Location: lib_stud_req_approval.php");
    }
}

?>


