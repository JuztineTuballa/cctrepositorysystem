<?php 

// Load the database configuration file 
include_once 'conn_export.php'; 

// Fetch records from database 
$query = $conn->query("SELECT * FROM tb_student ORDER BY stud_id ASC"); 

if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "STUDENT_LIST_" . date('Y-m-d') . ".csv"; 
    
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
    
    // Set column headers 
    $fields = array('ID', 'DEPARTMENT', 'STUDENT NUMBER', 'LAST NAME', 'FIRST NAME', 'MIDDLE NAME', 'BIRTHDATE', 'STATUS'); 
    fputcsv($f, $fields, $delimiter); 
    
    // Output each row of the data, format line as csv and write to file pointer 
    // $status = ($row['status'] == 1)?'Active':'Inactive'; 

    while($row = $query->fetch_assoc()){ 
     if ($status = ($row['stud_status'] == 'Approved')) { 
        $lineData = array($row['stud_id'], $row['stud_department'], $row['stud_num'], $row['stud_lname'], $row['stud_fname'], $row['stud_mname'], $row['stud_bdate'], $status); 
        fputcsv($f, $lineData, $delimiter); 
    }
} 

    // Move back to beginning of file 
fseek($f, 0); 

    // Set headers to download file rather than displayed 
header('Content-Type: text/csv'); 
header('Content-Disposition: attachment; filename="' . $filename . '";'); 

    //output all remaining data on a file pointer 
fpassthru($f); 
} 
exit; 

?>

