<?php

include_once 'db_conn.php';

if (isset($_POST['update_username_btn'])) {

 $editaid= $_POST['update_adminuid'];
 $editausername = str_replace(['"',"'"], "", $_POST['edit_adminusername']);
  
 $select = mysqli_query($conn, "SELECT * FROM tb_adminuser WHERE admin_username = '$editausername' "); 
 $row = mysqli_fetch_array($select);

  if ($editausername == $row['admin_username']) {
    echo "<script>alert('The username you entered was already been declared, please type another one.'); window.location='adminsettings.php?update=declared' </script>";
    exit();  

  } else {

    $query = "UPDATE tb_adminuser SET admin_username = '$editausername' WHERE admin_id = '$editaid' ";
    $query_run = mysqli_query($conn,$query);

      //Checking if Data is Update or Not
      if($query_run) {
        echo "<script> alert('Username Updated Successfully!'); window.location='adminsettings.php?update=success' </script>"; 
      } else {
        echo "<script> alert('Username did not update!'); window.location='adminsettings.php?update=error' </script>"; 
      }
      //End Checking
    
    }   
 }


?>
 


