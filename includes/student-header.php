<?php session_start();
if (isset($_SESSION['stud_id']) && isset($_SESSION['stud_department'])) {

  ?>

  <?php
} else {
  header("Location:./index.php;");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Student">
  <meta name="author" content="Juztine Tuballa">

  <title>CCT Web-Based Repository of Research Outputs</title>

  <link rel="icon" type="image/png" href="a-images\cct-favicon.png" sizes="16x16">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/inputborder.css" rel="stylesheet">
  <link href="css/dashboard-widgets.css" rel="stylesheet">
  <link href="css/design-department.css" rel="stylesheet">
  <link href="css/displaycard.css"  rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/trajan-pro" rel="stylesheet">
  <link href="css/legend-box.css"  rel="stylesheet">


  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


  <style>

    .bg-headerimage {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url(./img/t18.png);
      border-radius: 20px;
    }

    @media only screen and (min-width: 768px) {
      .bg-headerimage {
        background-size: 1513px 288px;
      }
    }

    .bg-headerimage1 {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url(./img/t19.png);
      border-radius: 20px;
    }

    @media only screen and (min-width: 768px) {
      .bg-headerimage1 {
        background-size: 1513px 288px;
      }
    }

    .bg-c-grey {
      background: linear-gradient(45deg,#c9cbcc,#717273);
    } 

    .bg-headerimage2 {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url(./img/t16.png);
      border-radius: 20px;
    }

    @media only screen and (min-width: 768px) {
      .bg-headerimage2 {
        background-size: 1513px 288px;
      }
    }

    .bg-c-grey {
      background: linear-gradient(45deg,#c9cbcc,#717273);
    } 

        
    body {
      color: #36454F;
    } tr:nth-child(even) {
        background-color: #ebeced;
        color: #36454F;
    } tr:nth-child(odd) {
        background-color: #f3f6f4;
        color: #36454F;
    } tr:hover td {
        background: #dce9f4 !important;
    } .trajanfont {
       font-family: 'Trajan Pro', sans-serif;
    }
    
    /* TRUNCATE THE COLUMN TO PREVENT LONG TEXT NOTE: THESE INCLUDE A JS */

    .truncate-wrapper {
      cursor: pointer;
      }
    .truncate-wrapper:hover .see-more {
      text-decoration: underline;
    }
    
    /*END TRUNCATE THE COLUMN TO PREVENT LONG TEXT NOTE: THESE INCLUDE A JS*/

  </style>

 
</head>

    <body id="page-top">

      <!--PAGE WRAPPER-->
      <div id="wrapper">

