
<!--ITONG PHP DITO. PARA ITO SA USERNAME, PANG FETCH NG NAME NI ADMIN AT MAILAGAY SA PROFILE (navbar.php)-->
<?php 
  session_start();
  if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_firstname'])) {
?>

<?php
  } else {
    header("Location:./cct_signin.php;");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="System Administrator">
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
  <link href="css/all_alerts.css" rel="stylesheet">
  <link href="css/legend-box.css"  rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    
    .bg-headerimage {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url(./img/t16.png);
      border-radius: 20px;
    }

    @media only screen and (min-width: 768px) {
      .bg-headerimage {
        background-size: 1513px 288px;
      }
    }

    .bg-headerimage1 {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url(./img/t20.png);
      border-radius: 20px;
    }

    @media only screen and (min-width: 768px) {
      .bg-headerimage1 {
        background-size: 1513px 288px;
      }
    }
 
    .transparent-input { background-color:rgba(0,0,0,0) !important; border:none !important; }

    body {
      color: #36454F;
    } mark {
      background-color: #911212;
      color:white;
    }.bg-c-grey {
        background: linear-gradient(45deg,#c9cbcc,#717273);
    } tr:nth-child(even) {
        background-color: #ebeced;
        color: #36454F;
    } tr:nth-child(odd) {
        background-color: #f3f6f4;
        color: #36454F;
    } tr:hover td {
        background: #dce9f4 !important;
    } .status-posted {
        background-color: #32CD32;   
        color:#FFFFFF;
    } .status-archive {
        background-color: #FF8C00;   
        color:#FFFFFF;
    } .status-deactivated {
        background-color: #C41E3A;   
        color:#FFFFFF;
    } 

    /* TRUNCATE THE COLUMN TO PREVENT LONG TEXT NOTE: THESE INCLUDE A JS */
    
    table td:nth-child(2) {
      width: 250px;
    }
    table td:nth-child(3) {
      width: 180px;
    }
    table td:nth-child(4) {
      width: 180px;
    }
    table td:nth-child(5) {
      width: 180px;
    }
    table td:nth-child(6) {
      width: 480px;
    }
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

    <!-- Page Wrapper -->
    <div id="wrapper">