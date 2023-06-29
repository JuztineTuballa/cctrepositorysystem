<?php

//NEW CODE TO ADD EXCEL WE USE DIFFERENT LIBRARY

// Load Composer's autoloader
require 'vendor/autoload.php'; 
include 'db_conn.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Check if a file was uploaded
if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] === UPLOAD_ERR_OK) {
    $uploadfile = $_FILES['uploadfile']['tmp_name'];

    // Load the uploaded file with PhpSpreadsheet
    $objExcel = IOFactory::load($uploadfile);

    // Iterate through each worksheet in the Excel file
    foreach($objExcel->getWorksheetIterator() as $worksheet) {

        // Get the number of columns in the current worksheet
        $columnCount = $worksheet->getHighestColumn();
        $columnCount = PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($columnCount);

        $highestRow = $worksheet->getHighestRow();

        // Iterate through each row in the current worksheet
        for($row = 1; $row <= $highestRow; $row++) {

            // Iterate through each column A to H
            for ($column = 1; $column <= 8; $column++) {

                // Get the value of the current cell
                $cellValue = $worksheet->getCellByColumnAndRow($column, $row)->getValue();

                // Store the cell value in the appropriate variable based on the current column
                switch ($column) {
                    case 1:
                        $studNum = $cellValue;
                        break;
                    case 2:
                        $studLname = $cellValue;
                        break;
                    case 3:
                        $studFname = $cellValue;
                        break;
                    case 4:
                        $studMname = $cellValue;
                        break;
                    case 5:
                        $studGender = $cellValue;
                        break;
                    case 6:
                        $studCivilStatus = $cellValue;
                        break;
                    case 7:
                        // Format the date value
                        if (PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($worksheet->getCellByColumnAndRow($column, $row))) {
                            $unixDate = PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cellValue);
                            $mysqlDate = date('Y-m-d', $unixDate);
                            $studBirthdate = $mysqlDate;
                        } else {
                            $studBirthdate = $cellValue;
                        }
                        break;
                    case 8:
                        $studCitizenship = $cellValue;
                        break;
                }
            }   
            
            // Check if a duplicate record already exists in the database
            $result = mysqli_query($conn, "SELECT * FROM tb_validatestudent WHERE valstud_num ='$studNum'");
            if (!$result) {
                die("Database query failed: " . mysqli_error($conn));
            }

            $numRows = mysqli_num_rows($result);

            if ($numRows > 0) {
                // Display an error message and redirect to the upload page
                echo "<script> alert('Oops! Some student data already exists on your device.'); window.location='mis_addstudentexcel.php?add=error' </script>"; 
                exit; 
            }

            // Insert the new record into the database
            if ($studLname != '') {
                $insertQry = "INSERT INTO `tb_validatestudent`(`valstud_num`, `valstud_lname`, `valstud_fname`, `valstud_mname`, `valstud_gender`, `valstud_civilstatus`, `valstud_birthdate`, `valstud_citizenship`) VALUES ('$studNum', '$studLname', '$studFname', '$studMname', '$studGender', '$studCivilStatus', '$studBirthdate', '$studCitizenship')";
                
                $insertResult = mysqli_query($conn, $insertQry);
                
                if ($insertResult === false) {
                    // Query failed, get the error message
                    $errorMessage = mysqli_error($conn);

                    // Handle the error message appropriately
                    echo "<script> alert('An error occurred while saving your record. Please try again later. Error: " . $errorMessage . "'); </script>";
                } else {
                    $msg = true;
                }
            }
        }
    }   

    if(isset($msg)) {
        echo "<script> alert('Student data added successfully!'); window.location='mis_addstudentexcel.php?add=success' </script>";
        exit;
    } else {
        echo "<script> alert('Sorry, no file was uploaded. Please try again.'); window.location='mis_addstudentexcel.php?add=error' </script>";
        exit;
    }
}

?>

 