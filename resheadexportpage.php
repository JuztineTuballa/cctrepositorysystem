<?php
//CODE TO PREVENT UNNECESSARY TEXT IN URL
$url = explode('/', $_SERVER['REQUEST_URI']);
$page = end($url);
if (strpos($page, '?') !== false) {
    $page = substr($page, 0, strpos($page, '?'));
}
if (strpos($page, '.') !== false) {
    $page = substr($page, 0, strpos($page, '.'));
}
if ($page != basename($_SERVER['SCRIPT_FILENAME'], '.php')) {
    header('Location: /cctrepositorysystem/adminexportpage.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
  include_once 'exports/conn_export.php';
  include_once 'includes/rh-header.php'; 
  include_once 'includes/rh-navbar.php'; 
?> 

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">


  <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Manage Reports<small class="h4 mb-4 text-gray-500"> export your current reports</small></h1>
    <small><p>
      <i class="fas fa-fw fa-home fa-1x"></i><a href="researchheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Reports</p></small>
  </div>
  <p class='mb-4 text-gray-700'>Items here are only visible to you.</p>

  <div class='ml-4'>
  <BR/><BR/><BR/><BR/>


  <a href="exports/ExportReportsPDF.php">
      <i class="fas fa-fw fa-file-export"></i>
      <span>Export List of Uploaded Research Outputs (.PDF)</span>
  </a><BR/>

 
</div>
<BR/><BR/><BR/><BR/><BR/><BR/><BR/><BR/> 

</div>
<!-- END CONTENT ROW -->
 

<?php
  include('includes/rh-footer.php');
?>









