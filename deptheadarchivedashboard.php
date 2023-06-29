<?php
include('includes/dh-header.php'); 
include('includes/dh-navbar.php'); 

?> 

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid" style="margin-bottom: 120px;">


<!-- PAGE HEADING -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
  <h1 class="h3 mb-0 text-gray-800">Archive Dashboard <small class="h4 mb-4 text-gray-500">manage your archives</small></h1>
  <small><p>
    <i class="fas fa-fw fa-home fa-1x"></i><a href="deptheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Archive Dashboard</p></small>
</div>
<p class='mb-4 text-gray-700'>Items in your archive are only visible to you.</p>

<!--START DASHBOARD WIDGET-->
<div class="row">


<!--DASHBOARD NUMBER OF ARCHIVED SEMESTER-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-blue order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Archive Semester</h6>
            
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
               <?php
               require 'includes/admin-dboardconfig.php';
               
               $sesid = $_SESSION['dhead_dept'];
               $sesid1 = $_SESSION['dhead_id'];
           
               $query = "SELECT *, tb_depthead.dhead_dept AS canid 
                         FROM tb_depthead 
                         LEFT JOIN tb_fsemester 
                         ON tb_depthead.dhead_dept=tb_fsemester.sem_department 
                         WHERE sem_status = 'Archived' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."' ORDER BY canid";


               $query_run = mysqli_query($link, $query);

               $row = mysqli_num_rows($query_run);
               echo '<h1>'.$row.'</h1>';
               ?>
             </div>
             <a href="depthead_semester_archive.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
            </a>
          </div>

        </div>
        <div class="col-auto">
          <i class="fas fa-fw fa-archive fa-6x"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END DASHBOARD NUMBER OF ARCHIVED SEMESTER-->

<!--DASHBOARD NUMBER OF ARCHIVED ALL FILES-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-purple1 order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Archive Research Outputs</h6>
            
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
               <?php
               require 'includes/admin-dboardconfig.php';
               
               $sesid = $_SESSION['dhead_dept'];
               $sesid1 = $_SESSION['dhead_id'];
           
               $query = "SELECT *, tb_depthead.dhead_dept AS canid 
                         FROM tb_depthead 
                         LEFT JOIN tb_fuploads 
                         ON tb_depthead.dhead_dept=tb_fuploads.priority_id 
                         WHERE fup_status = 'Archived' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."' ORDER BY canid";

               $query_run = mysqli_query($link, $query);

               $row = mysqli_num_rows($query_run);
               echo '<h1>'.$row.'</h1>';
               ?>
             </div>
             <a href="depthead_fileupload_archive_toall.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
            </a>
          </div>

        </div>
        <div class="col-auto">
          <i class="fas fa-fw fa-file-archive fa-6x"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END DASHBOARD NUMBER OF ARCHIVED ALL FILES-->

</div>
<!--END DASHBOARD WIDGET--> 
</div>
<!-- END CONTENT ROW -->

<?php
include('includes/dh-footer.php');
?>

 







