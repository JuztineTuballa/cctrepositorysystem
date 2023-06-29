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
    header('Location: /cctrepositorysystem/studentprofile.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include 'db_conn.php';
include "includes/student-header.php";
include "includes/student-navbar.php";
?>


<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">
 <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Dashboard <small class="h4 mb-4 text-gray-500">welcome</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="studentprofile.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Student Dasboard</p></small>
  </div>
</div>

<!--START HEADER-->
<header class="bg-headerimage py-5 m-3">
  <div class="container px-5">
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-7">
        <div class="text-center my-5">
          <h2 class="display-6 fw-bolder text-white mb-0">    
           STUDENT DASHBOARD
          </h2>
          <p class='text-white'>CCT Web-Based Repository of Research Outputs<BR/></p>
          <p class="text-white mb-4"><!--STUDENT OF <?php echo strtoupper($_SESSION ['stud_department']) ?>--></p>
        </div>
      </div>
    </div>
  </div>
</header>
<!--END START HEADER--> 

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">

<!--START DASHBOARD WIDGET-->
<div class="row">

<!--DASHBOARD NUMBER OF UPLOADED RESEARCH PAPER-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-pink order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Number of Uploaded Research Paper</h6>
              
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
                <?php
                require 'includes/admin-dboardconfig.php';

                //$sesid = $_SESSION['dhead_dept'];

                $query = "SELECT * FROM tb_fuploads WHERE fup_status = 'Posted' ORDER BY fup_id";
                $query_run = mysqli_query($link,$query);

                $row = mysqli_num_rows($query_run);
                echo '<h1>'.$row.'</h1>';      
                ?>
              </div>
              <a href="show_all.php">
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
<!--END DASHBOARD NUMBER OF UPLOADED RESEARCH PAPER-->


<!--DASHBOARD NUMBER OF APPROVED REQUESTS -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-lightgreen1 order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Number of Approved Requests</h6>
              
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
                <?php
                require 'includes/admin-dboardconfig.php';

                $sesnum = $_SESSION['studentidno'];
                $sesid = $_SESSION['stud_department'];

                $query = "SELECT *, tb_frequest.req_studdepartment AS canid FROM tb_frequest JOIN tb_student ON tb_frequest.req_studnum = tb_student.stud_num AND tb_frequest.req_studdepartment=tb_student.stud_department JOIN tb_fuploads ON tb_frequest.req_fupdepartment = tb_fuploads.priority_id AND tb_frequest.req_fupauthors = tb_fuploads.fup_author WHERE tb_frequest.req_studnum = '".$sesnum."' AND tb_frequest.req_studdepartment = '".$sesid."' AND tb_frequest.req_fupstatus = 'Approved' ORDER BY req_id";
                $query_run = mysqli_query($link,$query);

                $row = mysqli_num_rows($query_run);
                echo '<h1>'.$row.'</h1>';      
                ?>
              </div>
              <a href="studentrequestprofile.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
              </a>
            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-fw fa-clipboard-check fa-6x"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--END DASHBOARD NUMBER OF APPROVED REQUESTS-->

 <!--DASHBOARD NUMBER OF PENDING  REQUESTS-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-yellow order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Number of Pending Requests</h6>
              
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
                <?php
                require 'includes/admin-dboardconfig.php';

                $sesnum = $_SESSION['studentidno'];
                $sesid = $_SESSION['stud_department'];

                $query = "SELECT *, tb_frequest.req_studdepartment AS canid FROM tb_frequest JOIN tb_student ON tb_frequest.req_studnum = tb_student.stud_num AND tb_frequest.req_studdepartment=tb_student.stud_department JOIN tb_fuploads ON tb_frequest.req_fupdepartment = tb_fuploads.priority_id AND tb_frequest.req_fupauthors = tb_fuploads.fup_author WHERE tb_frequest.req_studnum = '".$sesnum."' AND tb_frequest.req_studdepartment = '".$sesid."' AND tb_frequest.req_fupstatus = 'Pending' ORDER BY req_id";
                $query_run = mysqli_query($link,$query);

                $row = mysqli_num_rows($query_run);
                echo '<h1>'.$row.'</h1>';      
                ?>
              </div>
              <a href="studentrequestprofile1.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
              </a>
            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-fw fa-clipboard fa-6x"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--END DASHBOARD NUMBER OF UPLOADED RESEARCH PAPER-->

  <!--DASHBOARD NUMBER OF DENIED  REQUESTS-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-purple order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Number of Denied Requests</h6>
              
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
                <?php
                require 'includes/admin-dboardconfig.php';

                $sesnum = $_SESSION['studentidno'];
                $sesid = $_SESSION['stud_department'];

                $query = "SELECT *, tb_frequest.req_studdepartment AS canid FROM tb_frequest JOIN tb_student ON tb_frequest.req_studnum = tb_student.stud_num AND tb_frequest.req_studdepartment=tb_student.stud_department JOIN tb_fuploads ON tb_frequest.req_fupdepartment = tb_fuploads.priority_id AND tb_frequest.req_fupauthors = tb_fuploads.fup_author WHERE tb_frequest.req_studnum = '".$sesnum."' AND tb_frequest.req_studdepartment = '".$sesid."' AND tb_frequest.req_fupstatus = 'Denied' ORDER BY req_id";
                $query_run = mysqli_query($link,$query);

                $row = mysqli_num_rows($query_run);
                echo '<h1>'.$row.'</h1>';      
                ?>
              </div>
              <a href="studentrequestprofile2.php">
              <div class="text-xs font-weight-bold text-light">View Details</div>
              </a>
            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-fw fa-calendar-times fa-6x"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--END DASHBOARD NUMBER OF DENIED RESEARCH PAPER-->


</div>
<!--END DASHBOARD WIDGET-->

</div>
<!-- END BEGIN PAGE CONTENT -->

<?php
include "includes/student-footer.php";
?>
