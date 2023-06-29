<?php
session_start();
include 'db_conn.php';

if(isset($_POST['stud_unarchived_multiple_btn'])) {

    if(isset($_POST['stud_unarchived_id'])) {

        $all_id = $_POST['stud_unarchived_id'];
        $extract_id = implode(',' , $all_id);

        $query = "UPDATE tb_student SET stud_status = 'Approved' WHERE stud_id IN($extract_id) ";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            $_SESSION['deactivated_status'] = "Student account/s has been re-activated successfully!";
            header("Location: mis_manage_students1.php");
        } else {
            $_SESSION['deactivated_status'] = "Student account/s has not been re-activated! Please deactivate some items from the first ten rows only! one at a time! thank you!";
            header("Location: mis_manage_students1.php");
        }
    } else {
        $_SESSION['deactivated_status'] = "Please select at least one student account to reactivate!";
        header("Location: mis_manage_students1.php");
    }
}
?>
