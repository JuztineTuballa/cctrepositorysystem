<?php

//Establish Connection
include_once 'db_conn.php';

if (isset($_POST['update_reshead_username_btn'])) {

 $editrhid = $_POST['update_resheaduid'];
 $editdrhsername = str_replace(['"',"'"], "", $_POST['edit_resheadusername']);
  
 $select = mysqli_query($conn, "SELECT * FROM tb_researchhead WHERE reshead_uname = '$editdrhsername' "); 
 $row = mysqli_fetch_array($select);

  if ($editdrhsername == $row['reshead_uname']) {
    echo "<script>alert('The username you entered was already been declared, please type another one.'); window.location='researchheadprofile.php?update=declared' </script>";
    exit();  

  } else {

    $query = "UPDATE tb_researchhead SET reshead_uname = '$editdrhsername' WHERE reshead_id = '$editrhid' ";
    $query_run = mysqli_query($conn,$query);

      //Checking if Data is Update or Not
      if($query_run) {
        echo "<script> alert('Username Updated Successfully!'); window.location='researchheadprofile.php?update=success' </script>"; 
      } else {
        echo "<script> alert('Username did not update!'); window.location='researchheadprofile.php?update=error' </script>"; 
      }
      //End Checking
    
    }   
 }


?>
 


