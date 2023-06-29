<?php

include_once 'db_conn.php';

if(isset($_POST['add_librarian_btn'])){
 
  $varlblastname = str_replace(['"',"'"], "", $_POST['librarianlastname']);
  $varlbfirstname = str_replace(['"',"'"], "", $_POST['librarianfirstname']);
  $varlbmiddlename = str_replace(['"',"'"], "", $_POST['librarianmiddlename']);
  $varlbusername = str_replace(['"',"'"], "", $_POST['librarianusername']);
  $varlbpassword = str_replace(['"',"'"], "", $_POST['librarianpassword']);
  $varlbconfirmpassword = str_replace(['"',"'"], "", $_POST['librarianconfirmpassword']);
  $varlbpicture = $_FILES['librarianpicture']['name'];

  if(!empty($varlbpicture)){
    move_uploaded_file($_FILES['librarianpicture']['tmp_name'], 'uploads/'.$varlbpicture);	
  }

  // Check password complexity
  if (strlen($varlbpassword) < 8 || !preg_match('/[A-Za-z]/', $varlbpassword) || !preg_match('/\d/', $varlbpassword)) {
    // Password does not meet complexity requirements
    echo "<script> alert('Password does not meet complexity requirements!'); window.location='librarianprofile.php?password=didnotmeetrequirements' </script>"; 
    exit;
  }

  if ($varlbpassword !== $varlbconfirmpassword) {
    // Password and Confirm Password do not match 
    echo "<script> alert('There was an error in your request! check your syntax and try again!'); window.location='librarianprofile.php?password=isnotmatched' </script>"; 
    exit;
  }

  // Hash the password
  $varlbpassword_hash = password_hash($varlbpassword, PASSWORD_DEFAULT);

	$result = mysqli_query($conn,"SELECT * FROM  tb_librarian WHERE librarian_uname = '$varlbusername'") or exit(mysqli_error()); //check for duplicates
  $num_rows = mysqli_num_rows($result); //number of rows where duplicates exist

  if(($num_rows) > 0){
    echo "<script> alert('Oops! This account already exists on your device.'); window.location='librarianprofile.php?add=error' </script>"; 
    exit;

  } else {

     $sql = "INSERT INTO `tb_librarian` (`librarian_lname`, `librarian_fname`, `librarian_mname`, `librarian_uname`, `librarian_pword`, `librarian_picture`)
     VALUES ('$varlblastname',' $varlbfirstname','$varlbmiddlename','$varlbusername','$varlbpassword_hash','$varlbpicture');";

     if (!mysqli_query($conn,$sql)) {
      die('Error: ' . mysqli_error());
    }
  }
  
  if($result) {
    header("Location: librarianprofile.php?add=success");

  } else { echo "Something went wrong"; }

  mysqli_close();

}








