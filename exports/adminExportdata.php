<?php 
 
// Load the database configuration file 
include_once 'conn_export.php'; 
 
// Fetch records from database 
$rhead_query = $conn->query("SELECT * FROM tb_researchhead ORDER BY reshead_id ASC"); 
 
if($rhead_query->num_rows > 0){ 
    $rhead_delimiter = ","; 
    $rhead_filename = "RESEARCH_HEAD_LIST_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $rhead_f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $rhead_fields = array('ID', 'LAST NAME', 'FIRST NAME', 'MIDDLE NAME', 'USERNAME', 'STATUS'); 
    fputcsv($rhead_f, $rhead_fields, $rhead_delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    // $status = ($row['status'] == 1)?'Active':'Inactive'; 

    while($row = $rhead_query->fetch_assoc()){ 
       if ($rhead_status = ($row['reshead_status'] == 'Active')) { 
        $rhead_lineData = array($row['reshead_id'], $row['reshead_lname'], $row['reshead_fname'], $row['reshead_mname'], $row['reshead_uname'], $rhead_status); 
        fputcsv($rhead_f, $rhead_lineData, $rhead_delimiter); 
     }
    } 
     
    // Move back to beginning of file 
    fseek($rhead_f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $rhead_filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($rhead_f); 
} 

exit; 
 
?>

