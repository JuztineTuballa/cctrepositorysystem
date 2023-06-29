<?php

session_start();
include 'db_conn.php';

if (isset($_POST['student_idnumber']) && isset($_POST['student_pword'])) {

  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $studentidno = validate($_POST['student_idnumber']);
  $studpword = validate($_POST['student_pword']);

  $select = mysqli_query($conn, "SELECT * FROM tb_student WHERE stud_num = '$studentidno'"); 
  $row = mysqli_fetch_array($select);

  if (empty($studentidno)) {
    header("location: index.php?error=Student Number Required");
    exit();  

  } else if (empty($studpword)){
    header("location: index.php?error=Password Required");
    exit();

  } else {

    $hashed_password = $row['stud_pword'];

    if (password_verify($studpword, $hashed_password)) {
      $_SESSION["status"]=$row['stud_status'];
      $_SESSION["studentidno"]=$row['stud_num'];
      $_SESSION["studpword"]=$hashed_password;

      $_SESSION["stud_id"]=$row['stud_id'];
      $_SESSION["stud_department"]=$row['stud_department'];
      $_SESSION["stud_lname"]=$row['stud_lname'];
      $_SESSION["stud_fname"]=$row['stud_fname'];
      $_SESSION["stud_picture"]=$row['stud_picture'];

      if ($_SESSION["status"] == "Approved") {
        $myMessage1 = addslashes($_SESSION["stud_fname"]);
        $myMessage2 = addslashes($_SESSION["stud_lname"]);
        echo "<script> alert('Login Success! Welcome'+' '+'$myMessage1'+' '+'$myMessage2'+'!'); window.location='studentprofile.php?status=approved' </script>"; 

      } else if ($_SESSION["status"] == "Deactivated") {
        header("location: index.php?error=Your account has been deactivated in preparation for the coming semester, please contact your system administrator for assistance.");
        exit(); 

      } else {
        header("location: index.php?error=Incorrect Student Number or Password!");
        exit(); 

      } //inner else

    } else {
      header("Location: index.php?error=Incorrect Student Number or Password!");
      exit();
    } //semi inner else
  }

} else {
  header("Location: index.php");
  exit();

} //outer else


?>