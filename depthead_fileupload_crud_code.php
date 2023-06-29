<?php
//CODE FOR UPLOADING RESEARCH PAPER WITH MAX OF 200MB PER FILE | FRONT END OF THIS CODE IS IN depthead_fileupload.php

include_once 'db_conn.php';

if(isset($_POST['add_file_btn'])) {
    try {
        // Check if the uploaded file is less than or equal to 300MB
        if ($_FILES["fileuploadfile"]["size"] > 300 * 1024 * 1024) {
            throw new Exception('File size is too large.');
        }

        $dhfiledepartmentID = $_POST['deptselect'];
        $dhfiledepartmentName = $_POST['deptselect'];
        $dhfilesemester = $_POST['semselect'];
        $dhfiletitle = str_replace(['"',"'"], "", $_POST['fileuploadtitle']);
        $dhfileauthor = str_replace(['"',"'"], "", $_POST['fileuploadauthor']);
        $dhfiledate =  date('Y-m-d', strtotime($_POST['fileuploaddate']));
        $dhfileabstract =  str_replace(['"',"'"], "", $_POST['fileuploadabstract']);

        // Only allow PDF files
        $allowedExts = array("pdf");
        $temp = explode(".", $_FILES["fileuploadfile"]["name"]);
        $extension = end($temp);
        if (!in_array($extension, $allowedExts)) {
            throw new Exception('Invalid file type. Only PDF files are allowed.');
        }
        $dhupload_pdf = $_FILES["fileuploadfile"]["name"];
        move_uploaded_file($_FILES["fileuploadfile"]["tmp_name"],"uploads-papers/" . $_FILES["fileuploadfile"]["name"]);

        // Check if the title already exists (case-insensitive)
        $query = "SELECT 1 FROM tb_fuploads WHERE LOWER(fup_title) LIKE CONCAT('%', LOWER(?), '%')";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $dhfiletitle);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num_rows = mysqli_num_rows($result);

        if(mysqli_num_rows($result) > 0) {
            throw new Exception('Oops! This file title already exists.');
        }

        // Check if the abstract already exists (case-insensitive)
        $query = "SELECT 1 FROM tb_fuploads WHERE LOWER(fup_abstract) LIKE CONCAT('%', LOWER(?), '%')";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $dhfileabstract);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            throw new Exception('Oops! This file abstract already exists.');
        }

        $sql = "INSERT INTO `tb_fuploads` (`fup_department`,`fup_title`, `fup_author`,`fup_date`, `fup_abstract`, `fup_document`,`priority_id`, `sem_priority_id`)
                VALUES ('$dhfiledepartmentName','$dhfiletitle',' $dhfileauthor','$dhfiledate','$dhfileabstract','$dhupload_pdf','$dhfiledepartmentID', '$dhfilesemester');";

        if (!mysqli_query($conn,$sql)) {
            throw new Exception('Error: ' . mysqli_error());
        }

        header("Location: depthead_fileupload.php?add=success");
    } catch(Exception $e) {
        // Handle exceptions here
        echo "<script> alert('".$e->getMessage()."'); window.location='depthead_fileupload.php?add=error' </script>";
    } finally {
        mysqli_close($conn);
    }

}
 
//END - CODE FOR UPLOADING RESEARCH PAPER WITH MAX OF 200MB PER FILE | depthead_fileupload.php
?>



<?php
//CODE FOR UPDATING RESEARCH PAPER DETAILS | FRONT END OF THIS CODE IS IN depthead_fileupload_updatemodal.php
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'db_conn.php';

try {
    if (isset($_POST['update_file_btn'])) {
        $fid = $_POST['fileuploadid01'];
        $fdepartment = $_POST['filedepartment'];
        $ftitle = str_replace(['"', "'"], "", $_POST['updatefileuploadtitle']);
        $fauthor = str_replace(['"', "'"], "", $_POST['updatefileuploadauthor']);
        $fdate = $_POST['updatefileuploaddate'];
        $fabstract = str_replace(['"', "'"], "", $_POST['updatefileuploadabstract']);

        // check for duplicates
        $stmt = mysqli_prepare($conn, "SELECT * FROM tb_fuploads WHERE fup_title LIKE CONCAT('%', ?, '%')");
        mysqli_stmt_bind_param($stmt, "s", $ftitle);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num_rows = mysqli_num_rows($result);
        mysqli_stmt_close($stmt);

        if ($num_rows > 0) {
            echo "<script> alert('Hang on! The data you entered already exists! If you don\\'t have anything to change, you can close it!'); window.location='depthead_fileupload.php?update=exists' </script>";
            exit;
        } else {
            $query = "UPDATE tb_fuploads SET fup_department=?, fup_title=?, fup_author=?, fup_date=?, fup_abstract=? WHERE fup_id=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $fdepartment, $ftitle, $fauthor, $fdate, $fabstract, $fid);
            $query_run = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Checking if Data is Update or Not
            if ($query_run) {
                echo "<script> alert('File Updated Successfully!'); window.location='depthead_fileupload.php?update=success' </script>";
            } else {
                echo "<script> alert('File Not Updated!'); window.location='depthead_fileupload.php?update=error' </script>";
            }
        }
    }
} catch (Exception $e) {
    echo "<script> alert('Error: " . $e->getMessage() . "'); window.location='depthead_fileupload.php?update=error' </script>";
}

mysqli_close($conn);

//END - CODE FOR UPDATING RESEARCH PAPER DETAILS | FRONT END OF THIS CODE IS IN depthead_fileupload_updatemodal.php
?>

<?php
//CODE FOR UPDATING .PDF FILE, THIS ALSO LIMIT TO 200MB MAX ONLY | FRONT END OF THIS CODE IS IN depthead_fileupload_updatemodal.php

$conn = new mysqli('localhost','root','','db_cctrepository') or die(mysqli_error($conn));

if (isset($_POST['depthead_fileupload_updatefile_btn'])) {
    $pid = $_POST['uploads_fileid'];
    $allowedExts = array("pdf");
    $temp = explode(".", $_FILES["fileuploadfile1"]["name"]);
    $extension = end($temp);
    $dhupdate_pdf = $_FILES["fileuploadfile1"]["name"];

    // Check if file extension is not pdf
    if(strtolower($extension) != "pdf"){
        echo "<script> alert('Only PDF files are allowed.'); window.location='depthead_fileupload.php?add=error' </script>";
        exit;
    }

    $file_path = "uploads-papers/" . $_FILES["fileuploadfile1"]["name"];

    // Check if file already exists
    $query = "SELECT * FROM tb_fuploads WHERE fup_document = '$dhupdate_pdf'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script> alert('Oops! This file already exists.'); window.location='depthead_fileupload.php?add=error' </script>";
        exit;
    }

    // Check if file size is less than or equal to 300 MB
    if ($_FILES["fileuploadfile1"]["size"] > 300 * 1024 * 1024) {
        echo "<script> alert('File size should not exceed 300 MB.'); window.location='depthead_fileupload.php?add=error' </script>";
        exit;
    }


    // Upload the file if it does not already exist and file size is within limit
    if (move_uploaded_file($_FILES["fileuploadfile1"]["tmp_name"], $file_path)) {
        $update_query = "UPDATE tb_fuploads SET fup_document = '$dhupdate_pdf' WHERE fup_id = '$pid'";
        if (mysqli_query($conn, $update_query)) {
            // $_SESSION['file_update_success'] = 'File updated successfully';
            // header("Location: depthead_fileupload.php?update=success");
            echo "<script> alert('File updated successfully'); window.location='depthead_fileupload.php?update=success' </script>";
            exit; 
            
        } else {
            $_SESSION['error'] = $conn->error;
            echo "Error: " . $update_query . "<br>" . $conn->error;
        }
    } else {
        echo "<script> alert('Error updating file'); window.location='depthead_fileupload.php?update=error' </script>";
    }

    mysqli_close($conn);
}

//END - CODE FOR UPDATING .PDF FILE, THIS ALSO LIMIT TO 200MB MAX ONLY | FRONT END OF THIS CODE IS IN depthead_fileupload_updatemodal.php
?>


<?php
//CODE FOR ARCHIVING AND RESTORING FILES ONLY | FRONT END OF THIS CODE IS IN depthead_fileupload.php

$mysqli = new mysqli('localhost','root','','db_cctrepository') or die(mysqli_error($mysqli));

if (isset($_POST['archive_file'])) {
  $sid = $_POST['archive_file_id'];

  $select = "UPDATE tb_fuploads SET fup_status = 'Archived' WHERE fup_id = '$sid' ";
  $result = mysqli_query($mysqli, $select);

  if($result){
    echo "<script> alert('File Archived!'); window.location='depthead_fileupload.php?status=Archived' </script>"; 
  }else{
    echo "Error: " . $select . "<br>" . mysqli_error($mysqli);
  }
}

if (isset($_POST['restore_file'])) {
  $restore_sid = $_POST['restore_file_id'];

  $restore_select = "UPDATE tb_fuploads SET fup_status = 'Posted' WHERE fup_id = '$restore_sid' ";
  $restore_result = mysqli_query($mysqli, $restore_select);

  if($restore_result){
    echo "<script> alert('File Restored!'); window.location='depthead_fileupload_archive_toall.php?status=Restored' </script>"; 
  }else{
    echo "Error: " . $restore_select . "<br>" . mysqli_error($mysqli);
  }
}

//END - CODE FOR ARCHIVING AND RESTORING FILES ONLY | FRONT END OF THIS CODE IS IN depthead_fileupload.php
?>




 