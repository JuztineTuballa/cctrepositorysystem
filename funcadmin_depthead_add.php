<?php
include_once 'db_conn.php';

if (isset($_POST['add_dh_btn'])) {
  
  $vardhdepartment = $_POST['deptselect'];
  $vardhlastname = str_replace(['"',"'"], "", $_POST['deptheadlastname']);
  $vardhfirstname = str_replace(['"',"'"], "", $_POST['deptheadfirstname']);
  $vardhmiddlename = str_replace(['"',"'"], "", $_POST['deptheadmiddlename']);
  $vardhusername = str_replace(['"',"'"], "", $_POST['deptheadusername']);
  $vardhpassword = str_replace(['"',"'"], "", $_POST['deptheadpassword']);
  $vardhconfirmpassword = str_replace(['"',"'"], "", $_POST['deptheadconfirmpassword']);
  $vardhpicture = $_FILES['deptheadpicture']['name'];

  if (!empty($vardhpicture)) {
    move_uploaded_file($_FILES['deptheadpicture']['tmp_name'], 'uploads/'.$vardhpicture); 
  }

  // Check password complexity
  if (strlen($vardhpassword) < 8 || !preg_match('/[A-Za-z]/', $vardhpassword) || !preg_match('/\d/', $vardhpassword)) {
    // Password does not meet complexity requirements
    echo "<script> alert('Password does not meet complexity requirements!'); window.location='deptheadprofile.php?password=didnotmeetrequirements' </script>"; 
    exit;
  }

  if ($vardhpassword !== $vardhconfirmpassword) {
    // Password and Confirm Password do not match 
    echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='deptheadprofile.php?password=isnotmatched' </script>"; 
    exit;
  }

  // Hash the password
  $vardhpassword_hash = password_hash($vardhpassword, PASSWORD_DEFAULT);

  $result = mysqli_query($conn, "SELECT * FROM tb_depthead WHERE dhead_uname = '$vardhusername'") or exit(mysqli_error()); //check for duplicates
  $num_rows = mysqli_num_rows($result); //number of rows where duplicates exist

  if ($num_rows > 0) {
    
    echo "<script> alert('Oops! This account already exists on your device.'); window.location='deptheadprofile.php?update=error' </script>"; 
    exit;
  
  } else {

    $sql = "INSERT INTO `tb_depthead` (`dhead_dept`, `dhead_lname`, `dhead_fname`, `dhead_mname`, `dhead_uname`, `dhead_pword`, `dhead_picture`) 
            VALUES ('$vardhdepartment', '$vardhlastname', '$vardhfirstname', '$vardhmiddlename', '$vardhusername', '$vardhpassword_hash', '$vardhpicture');";

    if (!mysqli_query($conn, $sql)) {
      die('Error: ' . mysqli_error());
    }
  }

  if ($result) {
    header("Location: deptheadprofile.php?add=success");
  } else {
    echo "Something went wrong";
  }

  mysqli_close();
}


?>