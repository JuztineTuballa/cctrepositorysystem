<?php 

// Load the database configuration file 
include_once 'conn_export.php'; 

// Fetch records from database 
$query = $conn->query("SELECT * FROM tb_librarian ORDER BY librarian_id ASC"); 

if($query->num_rows > 0){ 
    $LibrarianDelimiter = ","; 
    $LibrarianFilename = "LIBRARIAN_LIST_" . date('Y-m-d') . ".csv"; 
    
    // Create a file pointer 
    $LibrarianF = fopen('php://memory', 'w'); 
    
    // Set column headers 
    $LibrarianFields = array('ID', 'LAST NAME', 'FIRST NAME', 'MIDDLE NAME', 'USERNAME', 'STATUS'); 
    fputcsv($LibrarianF, $LibrarianFields, $LibrarianDelimiter); 
    
    // Output each row of the data, format line as csv and write to file pointer 
    // $status = ($row['status'] == 1)?'Active':'Inactive'; 

    while($row = $query->fetch_assoc()){ 
     if ($status = ($row['librarian_status'] == 'Active')) { 
        $lineData = array($row['librarian_id'], $row['librarian_lname'], $row['librarian_fname'], $row['librarian_mname'], $row['librarian_uname'], $status); 
        fputcsv($LibrarianF, $lineData, $LibrarianDelimiter); 
    }
} 

// Move back to beginning of file 
fseek($LibrarianF, 0); 

// Set headers to download file rather than displayed 
header('Content-Type: text/csv'); 
header('Content-Disposition: attachment; filename="' . $LibrarianFilename . '";'); 

//output all remaining data on a file pointer 
fpassthru($LibrarianF); 
} 
exit; 

?>

