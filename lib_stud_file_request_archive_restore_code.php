<?php
//ARCHIVE APPROVED REQUEST

session_start();
include 'db_conn.php';
 
if(isset($_POST['stud_archive_all_multiple_btn'])) {

    if(isset($_POST['stud_auto_archive'])) {
        $all_id = $_POST['stud_auto_archive'];
        $extract_id = implode(',' , $all_id);

        // Prepare the statement
        $stmt = $conn->prepare("UPDATE tb_frequest SET req_fupdheadarchive = 'Archived' WHERE req_id IN ($extract_id)");

        // Bind parameters (not required in this case)

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['archive_request_status'] = "Requests have been archived successfully!";
            header("Location: lib_stud_req_approval1.php");
        } else {
            $_SESSION['archive_request_status'] = "Requests have not been archived! Please select some items from the first ten rows only! one at a time! thank you!";
            header("Location: lib_stud_req_approval1.php");
        }
    } else {
        $_SESSION['archive_request_status'] = "No items selected to archive!";
        header("Location: lib_stud_req_approval1.php");
    }
}


//END - ARCHIVE APPROVED REQUEST
?>



<?php
//ARCHIVE DENIED REQUEST

session_start();
include 'db_conn.php';

if(isset($_POST['stud_archive_all_multiple_btn1'])) {

    if(isset($_POST['stud_auto_archive1'])) {
        $all_id = $_POST['stud_auto_archive1'];
        $extract_id = implode(',' , $all_id);

        $query = "UPDATE tb_frequest SET req_fupdheadarchive = 'Archived' WHERE req_id IN (";

        $placeholders = implode(',', array_fill(0, count($all_id), '?'));

        $query .= $placeholders . ")";

        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, str_repeat('i', count($all_id)), ...$all_id);

        $query_run = mysqli_stmt_execute($stmt);

        if($query_run) {
            $_SESSION['archive_request_status'] = "Requests has been archived successfully!";
            header("Location: lib_stud_req_approval2.php");
        } else {
            $_SESSION['archive_request_status'] = "Requests has not been archived! Please select some items from the first ten rows only! one at a time! thank you!";
            header("Location: lib_stud_req_approval2.php");
        }
    } else {
        $_SESSION['archive_request_status'] = "No items selected for archiving!";
        header("Location: lib_stud_req_approval2.php");
    }
}

//ARCHIVE DENIED REQUEST
?>



<?php
//RESTORE APPROVED AND DENIED REQUEST

session_start();
include 'db_conn.php';

if(isset($_POST['stud_restore_all_multiple_btn'])) {

    if(isset($_POST['stud_auto_restore'])) {
        $all_id = $_POST['stud_auto_restore'];
        $extract_id = implode(',' , $all_id);
       
        $query = "UPDATE tb_frequest SET req_fupdheadarchive = 'Unarchived' WHERE req_id IN (";

        $placeholders = implode(',', array_fill(0, count($all_id), '?'));

        $query .= $placeholders . ")";
        
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, str_repeat('i', count($all_id)), ...$all_id);
        
        $query_run = mysqli_stmt_execute($stmt);

        if($query_run) {
            $_SESSION['archive_request_status'] = "Requests has been restored to its original status!";
            header("Location: lib_stud_req_archived.php");

        } else {
            $_SESSION['archive_request_status'] = "Requests has not been restored! Please select some items from the first ten rows only! one at a time! thank you!";
            header("Location: lib_stud_req_archived.php");  
        }
    } else {
        $_SESSION['archive_request_status'] = "No items selected for restoration!";
        header("Location: lib_stud_req_archived.php");
    }
}

//END - RESTORE APPROVED AND DENIED REQUEST
?>