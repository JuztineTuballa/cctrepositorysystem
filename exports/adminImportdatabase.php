<?php
session_start();
require_once 'conn_export.php';

if (empty($_FILES['database']['name'])) {
    header("location: ../adminmigratepage.php?errormessage=Database Required!");
    exit();
} elseif (pathinfo($_FILES['database']['name'], PATHINFO_EXTENSION) != 'sql') {
    header("location: ../adminmigratepage.php?errormessage=Invalid File!");
    exit();
} else {
    $conn = mysqli_connect('localhost', 'root', '', 'db_cctrepository');

    $sql = "DROP TABLE IF EXISTS `tb_adminuser`, `tb_depthead`, `tb_frequest`, `tb_fsemester`, `tb_fuploads`, `tb_librarian`, `tb_researchhead`, `tb_student`, `tb_validatestudent`;";

    if (mysqli_multi_query($conn, $sql)) {
        do {
            // Consume all results before the next query
            if ($res = mysqli_store_result($conn)) {
                mysqli_free_result($res);
            }
        } while (mysqli_next_result($conn));
    } else {
        header("location: ../adminmigratepage.php?errormessage=Oops, something went wrong while deleting the existing tables. Please try again.");
        exit();
    }

    $sql = file_get_contents($_FILES['database']['tmp_name']);

    if (mysqli_multi_query($conn, $sql)) {
        header("location: ../adminmigratepage.php?successmessage=Congratulations your database has been imported successfully!");
        exit(); 
    } else {
        header("location: ../adminmigratepage.php?errormessage=Oops, something didn't quite work while importing the database. Please double-check your file and try again.");
        exit();  
    }
}
?>