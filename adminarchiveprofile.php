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
    header('Location: /cctrepositorysystem/adminarchiveprofile.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?> 

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">


  <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Archive Dashboard <small class="h4 mb-4 text-gray-500">manage your archives</small></h1>
    <small><p>
      <i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Archive Dashboard</p></small>
  </div>
  <p class='mb-4 text-gray-700'>Items in your archive are only visible to you.</p>

  <!--START DASHBOARD WIDGET-->
  <div class="row">


  <!--DASHBOARD NUMBER OF ARCHIVED RESEARCH HEAD-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-blue order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Research Head Archive</h6>
            
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
               <?php
               require 'includes/admin-dboardconfig.php';
               
               $query = "SELECT reshead_id FROM tb_researchhead WHERE reshead_status = 'Archived' ORDER BY reshead_id";
               $query_run = mysqli_query($link,$query);

               $row = mysqli_num_rows($query_run);
               echo '<h1>'.$row.'</h1>';
               ?>
             </div>
             <a href="researchheadprofilearchive.php">
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
<!--END DASHBOARD NUMBER OF ARCHIVED RESEARCH HEAD-->


<!--DASHBOARD NUMBER OF ARCHIVED LIBRARIAN-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-cyan order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Librarian Archive</h6>
            
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
               <?php
               require 'includes/admin-dboardconfig.php';
               
               $query = "SELECT librarian_id FROM tb_librarian WHERE librarian_status = 'Archived' ORDER BY librarian_id";
               $query_run = mysqli_query($link,$query);

               $row = mysqli_num_rows($query_run);
               echo '<h1>'.$row.'</h1>';
               ?>
             </div>
             <a href="librarianprofilearchive.php">
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
<!--END DASHBOARD NUMBER OF LIBRARIAN-->

<!--DASHBOARD NUMBER OF ARCHIVED RESEARCH COORDINATOR-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-purple order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">Research Coordinator Archive</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
              <?php
              require 'includes/admin-dboardconfig.php';

              $query = "SELECT dhead_id FROM tb_depthead WHERE dhead_status = 'Archived' ORDER BY dhead_id";
              $query_run = mysqli_query($link,$query);

              $row = mysqli_num_rows($query_run);
              echo '<h1>'.$row.'</h1>';
              ?>
            </div>
            <a href="deptheadprofilearchive.php">
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
<!--END DASHBOARD NUMBER OF ARCHIVED RESEARCH COORDINATOR-->

<!--DASHBOARD NUMBER OF STUDENTS-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-yellow order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">Student Records Archive</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
              <?php 
              require 'includes/admin-dboardconfig.php';

              $query = "SELECT * FROM tb_validatestudent WHERE valstud_status = 'Archived' ";
              $query_run = mysqli_query($link,$query);

              $row = mysqli_num_rows($query_run);
              echo '<h1>'.$row.'</h1>';    
              ?>
            </div>
            <a href="mis_addstudentexcel1.php">
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
<!--END DASHBOARD NUMBER OF STUDENTS-->

<!--DASHBOARD NUMBER OF STUDENT ACCOUNTS-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-pink order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">Student Accounts Archive</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
              <?php 
              require 'includes/admin-dboardconfig.php';

              $query = "SELECT *, tb_depthead.dhead_dept AS canid FROM tb_depthead LEFT JOIN tb_student ON tb_depthead.dhead_dept=tb_student.stud_department 
                   WHERE tb_student.stud_status = 'Deactivated'";
              $query_run = mysqli_query($link,$query);

              $row = mysqli_num_rows($query_run);
              echo '<h1>'.$row.'</h1>';    
              ?>
            </div>
            <a href="mis_manage_students1.php">
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
<!--END DASHBOARD NUMBER OF STUDENT ACCOUNTS-->

</div>
<!--END DASHBOARD WIDGET--> 
</div>
<!-- END CONTENT ROW -->

<?php
include('includes/footer.php');
?>

 





