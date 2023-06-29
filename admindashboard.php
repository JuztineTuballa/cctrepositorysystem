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
    header('Location: /cctrepositorysystem/admindashboard.php');
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
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">System Administrator Dashboard <small class="h4 mb-4 text-gray-500">welcome</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;System Administrator Dashboard</p></small>
  </div>

  <!--START DASHBOARD WIDGET-->
  <div class="row">

    <!--DASHBOARD NUMBER OF ADMINISTRATOR-->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card bg-c-lightgreen1 order-card h-80 py-3">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <h6 class="m-b-20">Number of System Administrator</h6>
              
              <div class="h5 mb-0 font-weight-bold">     
                <div class="h1 mb-2 font-weight-bold">
                 <?php
                 require 'includes/admin-dboardconfig.php';

                 $query = "SELECT admin_id FROM tb_adminuser ORDER BY admin_id";
                 $query_run = mysqli_query($link,$query);

                 $row = mysqli_num_rows($query_run);
                 echo '<h1>'.$row.'</h1>';
                 ?>
               </div>
               <a href="adminprofile.php">
                <div class="text-xs font-weight-bold text-light">View Details</div>
              </a>
            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-fw fa-user-lock fa-6x"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--END DASHBOARD NUMBER OF ADMINISTRATOR-->

  <!--DASHBOARD NUMBER OF RESEARCH HEAD-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-blue order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Number of Research Head</h6>
            
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
               <?php
               require 'includes/admin-dboardconfig.php';
               
               $query = "SELECT reshead_id FROM tb_researchhead WHERE reshead_status = 'Active' ORDER BY reshead_id";
               $query_run = mysqli_query($link,$query);

               $row = mysqli_num_rows($query_run);
               echo '<h1>'.$row.'</h1>';
               ?>
             </div>
             <a href="researchheadprofile.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
            </a>
          </div>

        </div>
        <div class="col-auto">
          <i class="fas fa-fw fa-user-alt fa-6x"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END DASHBOARD NUMBER OF RESEARCH HEAD-->

<!--DASHBOARD NUMBER OF LIBRARIAN-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-cyan order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Number of Librarian</h6>
            
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
               <?php
               require 'includes/admin-dboardconfig.php';
               
               $query = "SELECT librarian_id FROM tb_librarian WHERE librarian_status = 'Active' ORDER BY librarian_id";
               $query_run = mysqli_query($link,$query);

               $row = mysqli_num_rows($query_run);
               echo '<h1>'.$row.'</h1>';
               ?>
             </div>
             <a href="librarianprofile.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
            </a>
          </div>

        </div>
        <div class="col-auto">
          <i class="fas fa-fw fa-user-alt fa-6x"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END DASHBOARD NUMBER OF LIBRARIAN-->

<!--DASHBOARD NUMBER OF RESEARCH COORDINATOR-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-purple order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">Number of Research Coordinator</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
              <?php
              require 'includes/admin-dboardconfig.php';

              $query = "SELECT dhead_id FROM tb_depthead WHERE dhead_status = 'Active' ORDER BY dhead_id";
              $query_run = mysqli_query($link,$query);

              $row = mysqli_num_rows($query_run);
              echo '<h1>'.$row.'</h1>';
              ?>
            </div>
            <a href="deptheadprofile.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
            </a>
          </div>

        </div>
        <div class="col-auto">
          <i class="fas fa-fw fa-user-graduate fa-6x"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END DASHBOARD NUMBER OF RESEARCH COORDINATOR-->

<!--DASHBOARD NUMBER OF STUDENTS-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-yellow order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">Number of Students</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
              <?php 
              require 'includes/admin-dboardconfig.php';

              $query = "SELECT * FROM tb_student";
              $query_run = mysqli_query($link,$query);

              $row = mysqli_num_rows($query_run);
              echo '<h1>'.$row.'</h1>';    
              ?>
            </div>
            <a href="mis_manage_students.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
            </a>
          </div>

        </div>
        <div class="col-auto">
          <i class="fas fa-fw fa-users fa-6x"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END DASHBOARD NUMBER OF STUDENTS-->

<!--DASHBOARD NUMBER OF UPLOADS-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-pink order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">View Uploads</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
              <?php 
              require 'includes/admin-dboardconfig.php';

              $query = "SELECT * FROM tb_fuploads";
              $query_run = mysqli_query($link,$query);

              $row = mysqli_num_rows($query_run);
              echo '<h1>'.$row.'</h1>';    
              ?>
            </div>
            <a href="funcadmin_fileupload_dashboard.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
            </a>
          </div>

        </div>
        <div class="col-auto">
          <i class="fas fa-fw fa-file-pdf fa-6x"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END DASHBOARD NUMBER OF UPLOADS-->

</div>
<!--END DASHBOARD WIDGET--> 
</div>
<!-- END CONTENT ROW -->
 

<?php
include('includes/footer.php');
?>

 






