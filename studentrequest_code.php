<!--PHP TO REQUEST FILE-->

<?php 

include 'db_conn.php';

if(isset($_POST['request_btn'])) {
  
  $reqstud_department = $_POST['rstud_department'];
  $reqstud_num = $_POST['rstud_num'];
  $reqstud_lname = $_POST['rstud_lname'];
  $reqstud_fname = $_POST['rstud_fname'];

  $reqfile_title = $_POST['rfile_title'];
  $reqfile_department = $_POST['rfile_department'];
  $reqrfile_authors = $_POST['rfile_authors'];
  $reqrfile_date = $_POST['rfile_date'];
  $reqrfile_abstract = $_POST['rfile_abstract'];

  $select = mysqli_query($conn, "SELECT * FROM tb_frequest WHERE req_studnum = '$reqstud_num' AND req_fuptitle = '$reqfile_title' AND req_fupauthors = '$reqrfile_authors'"); 
  $row = mysqli_fetch_array($select);

  if ($row) {
    $rstatus = $row['req_fupstatus'];
    switch ($rstatus) {
      case "Approved":
        echo "<script> alert('Oops! Your request has already been approved and the copy of research is already in your account.'); window.location='show_all.php?status=alreadyapproved' </script>";
        break;
      case "Pending":
        echo "<script> alert('Your request is still pending for approval'); window.location='show_all.php?status=pending' </script>";
        break;
      case "Denied":
        $register = "INSERT INTO tb_frequest (req_studdepartment, req_studnum, req_studlname, req_studfname, req_fuptitle, req_fupdepartment, req_fupauthors, req_fupdate, req_fupabstract, req_fupstatus) VALUES('$reqstud_department', '$reqstud_num', '$reqstud_lname', '$reqstud_fname', '$reqfile_title', '$reqfile_department','$reqrfile_authors', '$reqrfile_date', '$reqrfile_abstract', 'Pending')";
        if($conn->query($register)) {
          echo "<script> alert('Your previous request has been denied. A new request has been submitted.'); window.location='show_all.php?status=pending' </script>"; 
        } else { 
          $_SESSION['error'] = $conn->error;
        }
        break;
      default:
        header("location: show_all.php?error=Something Went Wrong!");
        exit(); 
    }
  } else {
    $register = "INSERT INTO tb_frequest (req_studdepartment, req_studnum, req_studlname, req_studfname, req_fuptitle, req_fupdepartment, req_fupauthors, req_fupdate, req_fupabstract, req_fupstatus) VALUES('$reqstud_department', '$reqstud_num', '$reqstud_lname', '$reqstud_fname', '$reqfile_title', '$reqfile_department','$reqrfile_authors', '$reqrfile_date', '$reqrfile_abstract', 'Pending')";
    if($conn->query($register)) {
      echo "<script> alert('Your Request is now Pending for Approval!'); window.location='show_all.php?status=pending' </script>"; 
    } else { 
      $_SESSION['error'] = $conn->error;
    }
  }
}


?>
