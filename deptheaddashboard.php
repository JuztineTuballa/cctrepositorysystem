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
    header('Location: /cctrepositorysystem/deptheaddashboard.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>


<?php
include('includes/dh-header.php'); 
include('includes/dh-navbar.php'); 
?> 

<?php  
  include_once 'db_conn.php';
  $query = "SELECT priority_id, count(*) AS NUMBER FROM tb_fuploads GROUP BY priority_id";
  $result = mysqli_query($conn, $query); 
?>  

<!--START HEADER-->
<header class="bg-headerimage py-5 m-4">
  <div class="container px-5">
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-7">
        <div class="text-center my-5">
          <h2 class="display-6 fw-bolder text-white mb-0">    
            <?php echo strtoupper($_SESSION ['dhead_dept']) ?>
          </h2>
          <p class='text-white'>Research Coordinator Dashboard</p>
          <p class="lead text-white mb-4"></p>
        </div>
      </div>
    </div>
  </div>
</header>
<!--END HEADER--> 

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">

  <!--START DASHBOARD WIDGET-->
  <div class="row">

  <!--DASHBOARD NUMBER OF CREATED SEMESTER-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-blue order-card h-80 py-3">
      <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <h6 class="m-b-20">Number of Created Semester</h6>
              
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
                             WHERE sem_status = 'Created' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."' ORDER BY canid";

                   $query_run = mysqli_query($link, $query);

                   $row = mysqli_num_rows($query_run);
                   echo '<h1>'.$row.'</h1>';  

                 ?>
               </div>
               <a href="depthead_semester.php">
                <div class="text-xs font-weight-bold text-light">View Details</div>
              </a>
            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-fw fa-calendar-check fa-6x"></i>
          </div>
        </div>
      </div>
    </div>
  </div>  
  <!--END DASHBOARD NUMBER OF CREATED SEMESTER-->

 <!--DASHBOARD NUMBER OF ARCHIVED RESEARCH OUTPUTS-->
 <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-purple1 order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">Number of Uploaded Research Outputs</h6>
            
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
                         WHERE fup_status = 'Posted' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."' ORDER BY canid";

               $query_run = mysqli_query($link, $query);

               $row = mysqli_num_rows($query_run);
               echo '<h1>'.$row.'</h1>';

               ?>
             </div>
             <a href="depthead_fileupload_toall.php">
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
<!--END DASHBOARD NUMBER OF ARCHIVED RESEARCH OUTPUTS-->

<!--DASHBOARD NUMBER OF STUDENT REQUEST-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-cyan order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">Number of Pending Student Requests</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
             <?php 
             require 'includes/admin-dboardconfig.php';

             $sesid = $_SESSION['dhead_dept'];

             $query = "SELECT * FROM tb_frequest WHERE req_fupdepartment = '$sesid' AND req_fupstatus = 'Pending' ORDER BY req_id";
             $query_run = mysqli_query($link,$query);

             $row = mysqli_num_rows($query_run);
             echo '<h1>'.$row.'</h1>';    
             ?>
           </div>
           <a href="depthead_student_file_request_approval.php">
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
<!--END DASHBOARD NUMBER OF STUDENT REQUEST-->

<!--PIE CHART-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">  
google.charts.load('current', {'packages':['corechart']});  
google.charts.setOnLoadCallback(drawChart);  
function drawChart() {
  var data = google.visualization.arrayToDataTable([  
              ['priority_id', 'NUMBER'],  
              <?php  
                while($row = mysqli_fetch_array($result)) {  
                  echo "['".$row["priority_id"]."', ".$row["NUMBER"]."],";  
                }  
              ?>  
  ]);  
  var options = {  
      title: 'Chart of Uploaded Research Papers',  
      //is3D:true,  
      pieHole: 0.2  
      };  
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
  chart.draw(data, options); 
}  
</script>  

<div class="col-lg-4">  
  <div id="piechart" style="width: 800px; height: 400px;"></div>  
</div>
<!--END PIE CHART-->

</div>
<!--END DASHBOARD WIDGET-->

</div>
<!-- END CONTAINER FLUID-->

<?php
include('includes/dh-footer.php');
?>
 