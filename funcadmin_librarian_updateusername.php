<?php

//Establish Connection
include_once 'db_conn.php';

if (isset($_POST['update_librarian_username_btn'])) {

 $editlbid = $_POST['update_librarianuid'];
 $editlbusername = str_replace(['"',"'"], "", $_POST['edit_librarianusername']);
  
 $select = mysqli_query($conn, "SELECT * FROM tb_librarian WHERE librarian_uname = '$editlbusername' "); 
 $row = mysqli_fetch_array($select);

  if ($editlbusername == $row['librarian_uname']) {
    echo "<script>alert('The username you entered was already been declared, please type another one.'); window.location='librarianprofile.php?update=declared' </script>";
    exit();  

  } else {

    $query = "UPDATE tb_librarian SET librarian_uname = '$editlbusername' WHERE librarian_id = '$editlbid' ";
    $query_run = mysqli_query($conn,$query);

      //Checking if Data is Update or Not
      if($query_run) {
        echo "<script> alert('Username Updated Successfully!'); window.location='librarianprofile.php?update=success' </script>"; 
      } else {
        echo "<script> alert('Username did not update!'); window.location='librarianprofile.php?update=error' </script>"; 
      }
      //End Checking
    
    }   
 }


?>
 


