<?php
//INSERT SEMESTER CODE
include 'db_conn.php';

// check if form is submitted
if(isset($_POST['btn_add_semester'])) {
    
    // retrieve input values
    $department = mysqli_real_escape_string($conn, $_POST['semdeptselect']);
    $semester = mysqli_real_escape_string($conn, $_POST['select_semester']);
    $startyear = mysqli_real_escape_string($conn, $_POST['sem_start_year']);
    $endyear = mysqli_real_escape_string($conn, $_POST['sem_end_year']);

    
    $sem_concatenation = $semester ." ". $startyear . "-" . $endyear;

    // Check if the combination of values already exists in the table
    $sql_check = "SELECT COUNT(*) FROM tb_fsemester WHERE sem_department = '$department' AND sem_name = '$semester' AND sem_start = '$startyear' AND sem_end = '$endyear'";
    $result_check = mysqli_query($conn, $sql_check);
    $row = mysqli_fetch_array($result_check);
    $count = $row[0];

    // If the combination of values doesn't exist, insert the data into the table
    if($count == 0) {
      $sql_insert = "INSERT INTO tb_fsemester (sem_department, sem_name, sem_start, sem_end, sem_priority_id, sem_status) 
                       VALUES ('$department', '$semester', '$startyear', '$endyear', '$sem_concatenation', 'Created')";
      if(mysqli_query($conn, $sql_insert)) {
        // Data successfully inserted
        echo "<script> alert('Semester Added Successfully!'); window.location='depthead_semester.php?status=addsuccess' </script>"; 
      } else {
        // Insert failed
        echo "<script> alert('Error Adding Semester!'); window.location='depthead_semester.php?status=error' </script>" . mysqli_error($conn);
      }
    } else {
      // Combination of values already exists in the table 
      echo "<script> alert('Error: Duplicate entry for semester!'); window.location='depthead_semester.php?status=addsuccess' </script>"; 
    }
}
//END INSERT SEMESTER CODE
?> 


<?php
//PHP FUNCTION FOR ARCHIVING SEMESTER AND FILES
// NOTE : IF SEMESTER HAS DATA AND FILES DOES NOT, THEREFORE SEMESTER WILL ALSO BE ARCHIVE

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_conn.php';

if (isset($_POST['Archived'])) {
  $semester_id = $_GET['sem_id'];

  // Check if the sem_priority_id values in tb_fsemester and tb_fuploads match
  $select_query = "SELECT fsem.sem_priority_id, fup.sem_priority_id AS upload_sem_priority_id 
                   FROM tb_fsemester fsem 
                   LEFT JOIN tb_fuploads fup ON fsem.sem_department = fup.fup_department 
                   WHERE fsem.sem_id = ? AND fup.fup_status != 'Archived'";
  
  $stmt = mysqli_prepare($conn, $select_query);
  mysqli_stmt_bind_param($stmt, "i", $semester_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $match_found = false;
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['sem_priority_id'] == $row['upload_sem_priority_id']) {
      $match_found = true;
      break;
    }
  }

  // Update the semester and uploads status
  if (!$match_found) {
    $select = "UPDATE tb_fsemester
               SET sem_status = 'Archived'
               WHERE sem_id = ?";
  } else {
    $select = "UPDATE tb_fsemester
               INNER JOIN tb_fuploads
               ON tb_fsemester.sem_priority_id = tb_fuploads.sem_priority_id
               AND tb_fsemester.sem_department = tb_fuploads.fup_department
               SET tb_fsemester.sem_status = 'Archived',
               tb_fuploads.fup_status = 'Archived'
               WHERE tb_fsemester.sem_id = ?";
  }

  $stmt = mysqli_prepare($conn, $select);
  mysqli_stmt_bind_param($stmt, "i", $semester_id);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    echo "<script> alert('Semester successfully archived!'); window.location='depthead_semester.php?status=Archived' </script>";
  } else {
    echo "<script> alert('Error: " . mysqli_error($conn) . "'); </script>";
  }
}

//END - PHP FUNCTION FOR ARCHIVING SEMESTER AND FILES
?>

 
<?php
//PHP FUNCTION FOR RESTORING SEMESTER AND FILES
// NOTE : IF SEMESTER HAS DATA AND FILES DOES NOT, THEREFORE SEMESTER WILL ALSO BE RESTORED

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_conn.php';

if (isset($_POST['Restore'])) {
  $semester_id = $_GET['sem_id'];

  // Check if the sem_priority_id values in tb_fsemester and tb_fuploads match
  $select_query = "SELECT fsem.sem_priority_id, fup.sem_priority_id AS upload_sem_priority_id 
                   FROM tb_fsemester fsem 
                   LEFT JOIN tb_fuploads fup ON fsem.sem_department = fup.fup_department 
                   WHERE fsem.sem_id = ? AND fup.fup_status != 'Posted'";
  
  $stmt = mysqli_prepare($conn, $select_query);
  mysqli_stmt_bind_param($stmt, "i", $semester_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $match_found = false;
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['sem_priority_id'] == $row['upload_sem_priority_id']) {
      $match_found = true;
      break;
    }
  }

  // Update the semester and uploads status
  if (!$match_found) {
    $select = "UPDATE tb_fsemester
               SET sem_status = 'Created'
               WHERE sem_id = ?";
  } else {
    $select = "UPDATE tb_fsemester
               INNER JOIN tb_fuploads
               ON tb_fsemester.sem_priority_id = tb_fuploads.sem_priority_id
               AND tb_fsemester.sem_department = tb_fuploads.fup_department
               SET tb_fsemester.sem_status = 'Created',
               tb_fuploads.fup_status = 'Posted'
               WHERE tb_fsemester.sem_id = ?";
  }

  $stmt = mysqli_prepare($conn, $select);
  mysqli_stmt_bind_param($stmt, "i", $semester_id);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    echo "<script> alert('Semester successfully restored!'); window.location='depthead_semester_archive.php?status=Restored' </script>";
  } else {
    echo "<script> alert('Error: " . mysqli_error($conn) . "'); </script>";
  }
}
//END PHP FUNCTION FOR RESTORING SEMESTER AND FILES
?>

