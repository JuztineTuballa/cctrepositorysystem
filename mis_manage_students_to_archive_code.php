<?php
session_start();
include 'db_conn.php';

if(isset($_POST['stud_archived_multiple_btn'])) {

    if(isset($_POST['stud_archived_id'])) {
        
        $all_id = $_POST['stud_archived_id'];
        $extract_id = implode(',' , $all_id);

        $query = "UPDATE tb_student SET stud_status = 'Deactivated' WHERE stud_id IN($extract_id) ";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            $_SESSION['archived_status'] = "Student account/s has been deactivated successfully!";
            header("Location: mis_manage_students.php");

        } else {
            $_SESSION['archived_status'] = "Student account/s has not been deactivated! Please deactivate some items from the first ten rows only! one at a time! thank you!";
            header("Location: mis_manage_students.php");
        }
    } else {
        $_SESSION['archived_status'] = "Please select at least one student account to deactivate!";
        header("Location: mis_manage_students.php");
    }
}
?>
