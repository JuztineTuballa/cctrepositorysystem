<?php

include_once 'db_conn.php';

if (isset($_POST['update_depthead_username_btn'])) {

 $editdhid= $_POST['update_deptheaduid'];
 $editdhusername = str_replace(['"',"'"], "", $_POST['edit_deptheadusername']);
  
 $select = mysqli_query($conn, "SELECT * FROM tb_depthead WHERE dhead_uname = '$editdhusername' "); 
 $row = mysqli_fetch_array($select);

  if ($editdhusername == $row['dhead_uname']) {
    echo "<script>alert('The username you entered was already been declared, please type another one.'); window.location='deptheadprofile.php?update=declared' </script>";
    exit();  

  } else {

    $query = "UPDATE tb_depthead SET dhead_uname = '$editdhusername' WHERE dhead_id = '$editdhid' ";
    $query_run = mysqli_query($conn,$query);

      //Checking if Data is Update or Not
      if($query_run) {
        echo "<script> alert('Username Updated Successfully!'); window.location='deptheadprofile.php?update=success' </script>"; 
      } else {
        echo "<script> alert('Username did not update!'); window.location='deptheadprofile.php?update=error' </script>"; 
      }
      //End Checking
    
    }   
 }


?>
 


 


