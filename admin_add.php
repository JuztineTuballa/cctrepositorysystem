<?php

include_once 'db_conn.php';

if(isset($_POST['add_btn'])) {

  //Sanitize and escape user inputs
  $varalastname = mysqli_real_escape_string($conn, trim($_POST['adminlastname']));
  $varafirstname = mysqli_real_escape_string($conn, trim($_POST['adminfirstname']));
  $varamiddlname = mysqli_real_escape_string($conn, trim($_POST['adminmiddlename']));
  $varagender = $_POST['gridRadios'];
  $varabirthdate = $_POST['adminbirthdate'];
  $varaaddress = mysqli_real_escape_string($conn, trim($_POST['adminaddress']));
  $varaemail = mysqli_real_escape_string($conn, trim($_POST['adminemail']));
  $varausername = mysqli_real_escape_string($conn, trim($_POST['adminusername']));
  $varapassword = mysqli_real_escape_string($conn, trim($_POST['adminpassword']));
  $varaconfirmpassword = mysqli_real_escape_string($conn, trim($_POST['adminconfirmpassword']));
  $varapicture = $_FILES['adminpicture']['name'];


  //Hash password before inserting
  $hashed_password = password_hash($varapassword, PASSWORD_DEFAULT);

  if(!empty($varapicture)){
    move_uploaded_file($_FILES['adminpicture']['tmp_name'], 'uploads/'.$varapicture);  
  }
  

  //Check for duplicates in the database
  $result = mysqli_query($conn,"SELECT * FROM  tb_adminuser WHERE admin_email = '$varaemail' OR  admin_username ='$varausername'") or exit(mysqli_error());
  $num_rows = mysqli_num_rows($result);

  //Validate password entry
  if ($varapassword == $varaconfirmpassword) {

    if(($num_rows) > 0) {
      echo "<script> alert('Oops! This account already exists!'); window.location='adminprofile.php?add=error' </script>";
      exit;

    } else {

      //Insert user data into the database
      $sql = "INSERT INTO `tb_adminuser`(`admin_lastname`, `admin_firstname`, `admin_middlename`, `admin_gender`, `admin_birthday`, `admin_address`, `admin_email`, `admin_username`, `admin_password`, `admin_picture`) VALUES ('$varalastname','$varafirstname','$varamiddlname','$varagender','$varabirthdate','$varaaddress','$varaemail','$varausername','$hashed_password','$varapicture');";

      if (!mysqli_query($conn,$sql)) {
        die('Error: ' . mysqli_error());
      }
    }

  } else {
     echo "<script> alert('Oops! Error adding account, please double check your query!'); window.location='adminprofile.php?add=error' </script>";
     exit;
  }

  if($result) {
    header("Location: adminprofile.php?add=success");

  } else { 
    echo "Something went wrong"; 
  }
  
  mysqli_close($conn);

}

?>