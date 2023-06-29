<?php

//include library
require_once 'tcpdf/tcpdf.php';
include_once 'conn_export.php'; 

//make TCPDF object
$pdf = new TCPDF('P', 'mm', 'A4');

//remove default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//add page
$pdf->AddPage();
$pdf->SetFont('Helvetica','',8);

$pdf->Cell(190,10,'',0,1); // empty row

$image_path = '../a-images/cct-logo4.png';
list($width, $height) = getimagesize($image_path);
$image_height = 10; // 10 inches
$image_width = $width * ($image_height / $height);
$image_x = (210 - $image_width) / 2; // center the image horizontally

$pdf->Image($image_path, $image_x, 15, $image_width, $image_height);

$pdf->Cell(190,5,'',0,1); // empty row

$pdf->Cell(190,5,"List of Uploaded Research Outputs",0,1,'C');

$pdf->Ln();

//make the department table
$html1 = "
    <table>
        <tr>
            <th>Department</th>
            <th>Total Uploaded Research Outputs</th>
        </tr>
        ";

//query to fetch data from tb_fuploads table
$query1 = "SELECT fup_department, COUNT(*) AS total FROM tb_fuploads GROUP BY fup_department";
$result1 = $conn->query($query1);

//loop the data
if ($result1->num_rows > 0) {
    while ($row1 = $result1->fetch_assoc()) {
        $html1 .= "
            <tr>
                <td>" . $row1['fup_department'] . "</td>
                <td>" . $row1['total'] . "</td>
            </tr>
        ";
    }
} else {
    $html1 .= "
        <tr>
            <td colspan='2'>No records found.</td>
        </tr>
    ";
}

$html1 .= "
    </table>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #888;
        }
        table tr th {
            background-color: #888;
            color: #fff;
            font-weight: bold;
        }
    </style>
";

// WriteHTMLCell for the department table

$pdf->WriteHTMLCell(192, 0, 9, '', $html1, 0);

// Add a line break
$pdf->Ln(20);


//make the table
$html2 = "
    <table>
        <tr>
            <th>Department</th>
            <th>Semester</th>
            <th>Title</th>
            <th>Authors</th>
        </tr>
        ";

//query to fetch data from tb_fuploads table
$query = "SELECT * FROM tb_fuploads";
$result = $conn->query($query);

//loop the data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html2 .= "
            <tr>
                <td>" . $row['fup_department'] . "</td>
                <td>" . $row['sem_priority_id'] . "</td>
                <td>" . $row['fup_title'] . "</td>
                <td>" . $row['fup_author'] . "</td>
            </tr>
        ";
    }
} else {
    $html2 .= "
        <tr>
            <td colspan='4'>No records found.</td>
        </tr>
    ";
}

$html2 .= "
    </table>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #888;
        }
        table tr th {
            background-color: #888;
            color: #fff;
            font-weight: bold;
        }
    </style>
";

//WriteHTMLCell
$pdf->WriteHTMLCell(192, 0, 9, '', $html2, 0);

// Close and output PDF document
$pdf->Output('List of Uploaded Research Outputs.pdf', 'D');

// Close the database connection
$conn->close();

?>



