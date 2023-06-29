<?php

session_start();
include_once 'db_conn.php';

if (isset($_POST['btn_setting_privacy'])) {
  
  $admin_sp_id = $_POST["admin_SPid"];  
  $admin_sp_username = $_POST["admin_SPusername"]; 
  $admin_sp_pass = $_POST["admin_SPpass"];

  // Retrieve the hashed password from the database
  $select = mysqli_query($conn, "SELECT * FROM tb_adminuser WHERE admin_id = '$admin_sp_id'");
  $row = mysqli_fetch_array($select);
  $hashed_password = $row['admin_password'];

  if (empty($admin_sp_pass)) { 
    echo "<script> alert('Password Required!'); window.location='adminprofile.php?confirm=error' </script>";
    exit();  
    
  } else if (!password_verify($admin_sp_pass, $hashed_password)) {
    echo "<script> alert('The password you entered was incorrect.'); window.location='adminprofile.php?confirm=error' </script>";
    exit();  

  } else {

    $select2 = mysqli_query($conn, "SELECT * FROM tb_adminuser WHERE  admin_id = '$admin_sp_id'"); 
    $check_user = mysqli_num_rows($select2);

    if ($check_user == 1) {
      
      $_SESSION['SPadmin_id'] = $row['admin_id'];
      $_SESSION['SPadmin_username'] = $row['admin_username'];
      $_SESSION['SPadmin_firstname'] = $row['admin_firstname'];
      $_SESSION['SPadmin_lastname'] = $row['admin_lastname'];
      $_SESSION['SPadmin_gender'] = $row['admin_gender'];

      header("location: adminsettings.php?confirm=success");
    
    }  else {
      header("location: adminprofile.php?confirm=error");
      exit();  
    }
  }
}

?>
