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
    header('Location: /cctrepositorysystem/depthead_semester_archive.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include('includes/dh-header.php'); 
include('includes/dh-navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col-md-12">   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Archived Semester <small class="h4 mb-4 text-gray-500">manage and organize archives</small></h1>
      <small><p><i class="fas fa-fw fa-home fa-1x"></i>
        <a href="deptheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;> 
        <a href="depthead_semester.php" class='text-gray-700'>&nbsp;&nbsp;Semester</a>&nbsp;&nbsp;>&nbsp;&nbsp;Archived Semester</p></small>
    </div>
  </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
<!--START CARD HEADER-->
<div class="card-header py-3">
 
<h6 class="m-0 font-weight-bold text-primary">Manage Archived Semester 
    <!-- <a href="depthead_semester.php">
      <small style="float:right;"><i class="fa fa-sign-out-alt"></i>&nbsp;Go Back</small>
    </a> -->

    </div>
    <!--END OF CARD HEADER-->

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th style="display:none;">ID</th>
              <th>Department</th>
              <th>Semester</th>
              <th>Year Start</th>
              <th>Year End</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th style="display:none;">ID</th>
              <th>Department</th>
              <th>Semester</th>
              <th>Year Start</th>
              <th>Year End</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
           <?php
          
           $sesid = $_SESSION['dhead_dept'];
           $sesid1 = $_SESSION['dhead_id'];

           $sql = "SELECT *, tb_depthead.dhead_dept AS canid 
                   FROM tb_depthead 
                   LEFT JOIN tb_fsemester ON tb_depthead.dhead_dept=tb_fsemester.sem_department 
                   WHERE sem_status = 'Archived' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."'  ";

           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()) {

             echo "
                <tr>
                  <td style='display:none;'>".$row['sem_id']."</td>
                  <td>".$row['sem_department']."</td>
                  <td>".$row['sem_name']."</td>
                  <td>".$row['sem_start']."</td>
                  <td>".$row['sem_end']."</td>
                  <td><kbd class='text-capitalize status-archive'>".$row['sem_status']."</td>
                  <td style='white-space: nowrap;'>

                    <form action='depthead_semester_crud_code.php?sem_id=". $row['sem_id'] ."' method='POST' style='display: inline-block;' onsubmit='return confirm(\"Are you sure you want to restore this semester? please keep in mind that all research outputs from this semester will be restored as well.\");'>
                      <button style='display: inline-block; margin-right: 10px;' class='btn btn-warning' type='submit' name='Restore' value='restore'>
                        <i class='fas fa-undo-alt fa-sm fa-fw mr-2 text-gray-200'></i> Restore
                      </button>
                    </form>

                    <a href='depthead_fileupload_archive.php?sem_priority_id=".$row['sem_priority_id']."'>
                      <button style='display: inline-block; margin-right: 10px;' class='btn btn-info'><i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-200'></i>View Archived Research Papers</button>
                    </a>

                  </td>
                </tr>
                ";
           }
           ?> <!--END PHP CODE HERE--->
         </tbody>
       </table>

     </div>
   </div>
 </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
include('includes/dh-footer.php');
?>


