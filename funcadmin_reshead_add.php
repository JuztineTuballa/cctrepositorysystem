<?php

include_once 'db_conn.php';

if(isset($_POST['add_rh_btn'])){
	//Yung name dito sa $_POST[''] kailangan equal siya dun sa <input name="VALUE"> na form na meron sa researchheadprofile.php lam mo yan, pang fetch fetch ng data.
  $varrhlastname = str_replace(['"',"'"], "", $_POST['resheadlastname']);
  $varrhfirstname = str_replace(['"',"'"], "", $_POST['resheadfirstname']);
  $varrhmiddlename = str_replace(['"',"'"], "", $_POST['resheadmiddlename']);
  $varrhusername = str_replace(['"',"'"], "", $_POST['resheadusername']);
  $varrhpassword = str_replace(['"',"'"], "", $_POST['resheadpassword']);
  $varrhconfirmpassword = str_replace(['"',"'"], "", $_POST['resheadconfirmpassword']);
  $varrhpicture = $_FILES['resheadpicture']['name'];

  if(!empty($varrhpicture)){
    move_uploaded_file($_FILES['resheadpicture']['tmp_name'], 'uploads/'.$varrhpicture);	
  }

  // Check password complexity
  if (strlen($varrhpassword) < 8 || !preg_match('/[A-Za-z]/', $varrhpassword) || !preg_match('/\d/', $varrhpassword)) {
    // Password does not meet complexity requirements
    echo "<script> alert('Password does not meet complexity requirements!'); window.location='researchheadprofile.php?password=didnotmeetrequirements' </script>"; 
    exit;
  }

  if ($varrhpassword !== $varrhconfirmpassword) {
    // Password and Confirm Password do not match 
    echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='researchheadprofile.php?password=isnotmatched' </script>"; 
    exit;
  }

  // Hash the password
  $varrhpassword_hash = password_hash($varrhpassword, PASSWORD_DEFAULT);

	$result = mysqli_query($conn,"SELECT * FROM  tb_researchhead WHERE reshead_uname = '$varrhusername'") or exit(mysqli_error()); //check for duplicates
  $num_rows = mysqli_num_rows($result); //number of rows where duplicates exist

  if(($num_rows) > 0){

    echo "<script> alert('Oops! This account already exists on your device.'); window.location='researchheadprofile.php?add=error' </script>"; 
    exit;

  } else {

     $sql = "INSERT INTO `tb_researchhead` (`reshead_lname`, `reshead_fname`, `reshead_mname`, `reshead_uname`, `reshead_pword`, `reshead_picture`)
     VALUES ('$varrhlastname',' $varrhfirstname','$varrhmiddlename','$varrhusername','$varrhpassword_hash','$varrhpicture');";

     if (!mysqli_query($conn,$sql)) {
      die('Error: ' . mysqli_error());
    }
  }

  if($result) {
    header("Location: researchheadprofile.php?add=success");

  } else { echo "Something went wrong"; }

  mysqli_close();

}








