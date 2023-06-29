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
include_once 'includes/header.php'; 
include_once 'includes/navbar.php'; 
?> 

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">


  <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Export Data <small class="h4 mb-4 text-gray-500"> export your current data's</small></h1>
    <small><p>
      <i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Export Data</p></small>
  </div>
  <p class='mb-4 text-gray-700'>Items here are only visible to you.</p>

  <div class='ml-4'>
    <BR/><BR/><BR/><BR/>



  <a href="exports/adminExportdata.php">
      <i class="fas fa-fw fa-file-export"></i>
      <span>Export Active List of Research Head (.CSV)</span>
  </a><BR/>

  <a href="exports/adminExportdata3.php">
      <i class="fas fa-fw fa-file-export"></i>
      <span>Export Active List of Librarian (.CSV)</span>
  </a><BR/>

  <a href="exports/adminExportdata1.php">
      <i class="fas fa-fw fa-file-export"></i>
      <span>Export Active List of Research Coordinator (.CSV)</span>
  </a><BR/>

  <a href="exports/adminExportdata2.php">
      <i class="fas fa-fw fa-file-export"></i>
      <span>Export List of Students (.CSV)</span>
  </a><BR/>

<!--   <a href="exports/adminExportdatabase.php">
      <i class="fas fa-fw fa-file-export"></i>
      <span>Export Database (.SQL <p class="fas fa-fw fa-database"></p>)</span>
  </a><BR/> -->


</div>
<BR/><BR/><BR/><BR/><BR/><BR/><BR/><BR/> 

</div>
<!-- END CONTENT ROW -->

<!-- RESEARCH HEAD TABLE --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th style='display:none;'>ID</th>
            <th style='display:none;'>Lastname</th>
            <th style='display:none;'>Firstname</th>
            <th style='display:none;'>Middlename</th>
            <th style='display:none;'>Username</th>
            <th style='display:none;'>Password</th>
        </tr>
    </thead>
    <tbody>
     <?php 
    // Fetch records from database 
     $rhead_result = $conn->query("SELECT * FROM tb_researchhead ORDER BY reshead_id ASC"); 
     if($rhead_result->num_rows > 0){ 
        while($row = $rhead_result->fetch_assoc()){ 
            ?>
            <tr>
                <td style='display:none;'><?php echo $row['reshead_id']; ?></td>
                <td style='display:none;'><?php echo $row['reshead_lname'].' '.$rhead_row['reshead_fname'].' '.$row ['reshead_mname']; ?></td>
                <td style='display:none;'><?php echo $row['reshead_uname']; ?></td>
                <td style='display:none;'><?php echo $row['reshead_pword']; ?></td>

            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
    </tbody>
</table>
<!--END - RESEARCH HEAD TABLE -->

<!-- LIBRARIAN TABLE --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th style='display:none;'>ID</th>
            <th style='display:none;'>Lastname</th>
            <th style='display:none;'>Firstname</th>
            <th style='display:none;'>Middlename</th>
            <th style='display:none;'>Username</th>
            <th style='display:none;'>Password</th>
        </tr>
    </thead>
    <tbody>
     <?php 
    // Fetch records from database 
     $rhead_result = $conn->query("SELECT * FROM tb_librarian ORDER BY librarian_id ASC"); 
     if($rhead_result->num_rows > 0){ 
        while($row = $rhead_result->fetch_assoc()){ 
            ?>
            <tr>
                <td style='display:none;'><?php echo $row['librarian_id']; ?></td>
                <td style='display:none;'><?php echo $row['librarian_lname'].' '.$rhead_row['librarian_fname'].' '.$row ['librarian_mname']; ?></td>
                <td style='display:none;'><?php echo $row['librarian_uname']; ?></td>
                <td style='display:none;'><?php echo $row['librarian_pword']; ?></td>

            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
    </tbody>
</table>
<!--END - LIBRARIAN TABLE -->

<!-- RESEARCH COORDINATOR TABLE --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th style='display:none;'>ID</th>
            <th style='display:none;'>Department</th>
            <th style='display:none;'>Lastname</th>
            <th style='display:none;'>Firstname</th>
            <th style='display:none;'>Middlename</th>
            <th style='display:none;'>Username</th>
            <th style='display:none;'>Password</th>
        </tr>
    </thead>
    <tbody>
     <?php 
    // Fetch records from database 
     $result = $conn->query("SELECT * FROM tb_depthead ORDER BY dhead_id ASC"); 
     if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
            ?>
            <tr>
                <td style='display:none;'><?php echo $row['dhead_id']; ?></td>
                <td style='display:none;'><?php echo $row['dhead_dept']; ?></td>
                <td style='display:none;'><?php echo $row['dhead_lname'].' '.$row['dhead_fname'].' '.$row['dhead_mname']; ?></td>
                <td style='display:none;'><?php echo $row['dhead_uname']; ?></td>
                <td style='display:none;'><?php echo $row['dhead_pword']; ?></td>

            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
    </tbody>
</table>
<!--END - RESEARCH COORDINATOR TABLE -->



<!-- STUDENT TABLE --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th style='display:none;'>ID</th>
            <th style='display:none;'>Department</th>
            <th style='display:none;'>Student Number</th>
            <th style='display:none;'>Lastname</th>
            <th style='display:none;'>Firstname</th>
            <th style='display:none;'>Middlename</th>
            <th style='display:none;'>Birthdate</th>
            <th style='display:none;'>Status</th>
            
        </tr>
    </thead>
    <tbody>
     <?php 
    // Fetch records from database 
     $result = $conn->query("SELECT * FROM tb_student ORDER BY stud_id ASC"); 
     if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
            ?>
            <tr>
                <td style='display:none;'><?php echo $row['stud_id']; ?></td>
                <td style='display:none;'><?php echo $row['stud_department']; ?></td>
                <td style='display:none;'><?php echo $row['stud_num']; ?></td>
                <td style='display:none;'><?php echo $row['stud_lname'].' '.$row['stud_fname'].' '.$row['stud_mname']; ?></td>
                <td style='display:none;'><?php echo $row['stud_bdate']; ?></td>
                <td style='display:none;'><?php echo $row['stud_status']; ?></td>

            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
    </tbody>
</table>
<!--END - STUDENT COORDINATOR TABLE -->



<?php
include('includes/footer.php');
?>









