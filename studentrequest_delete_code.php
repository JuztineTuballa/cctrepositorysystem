<!-- PHP TO CANCEL/DELETE REQUEST -->
<?php

 $mysqli = new mysqli('localhost','root','','db_cctrepository') or die(mysqli_error($mysqli));

//CANCEL - DELETE PENDING REQUESTS
  if (isset($_GET['deletemonafile1'])) {
    $fid = $_GET['deletemonafile1'];
    $mysqli->query("DELETE FROM tb_frequest WHERE req_id = $fid") or die($mysqli->error());

    //canceled message
    header("Location: studentrequestprofile1.php?cancelled=success");
    exit;

  } else {
    header("Location: studentrequestprofile1.php?cancelled=success");
    exit;
  }


//CANCEL - DELETE DENIED REQUESTS
  if (isset($_GET['deletemonafile2'])) {
    $fid2 = $_GET['deletemonafile2'];
    $mysqli->query("DELETE FROM tb_frequest WHERE req_id = $fid2") or die($mysqli->error());

    //canceled message
    header("Location: studentrequestprofile2.php?cancelled=success");
    exit;

  } else {
    header("Location: studentrequestprofile2.php?cancelled=success");
    exit;
  }

?>
<!-- END - PHP TO CANCEL/DELETE REQUEST -->

 