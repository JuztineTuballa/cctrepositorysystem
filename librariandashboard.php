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
    header('Location: /cctrepositorysystem/librariandashboard.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include('includes/lb-header.php'); 
include('includes/lb-navbar.php'); 
?> 

<!--ITONG PHP PARA SA DATA ANALYTICS TO / MAY KARUGTONG TO SA BABA-->
<?php  
  $conn = mysqli_connect("localhost", "root", "", "db_cctrepository");  
  $query = "SELECT priority_id, count(*) AS NUMBER FROM tb_fuploads GROUP BY priority_id";
  $result = mysqli_query($conn, $query); 
?> 
<!--ITONG PHP PARA SA DATA ANALYTICS TO / MAY KARUGTONG TO SA BABA-->


<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">
 <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h4 mb-0 text-gray-800">Dashboard <small class="h4 mb-4 text-gray-500"> welcome</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="librariandashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Dashboard</p></small>
  </div>
</div>

<!--START HEADER-->
<header class="bg-headerimage py-5 m-4">
  <div class="container px-5">
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-7">
        <div class="text-center my-5">
          <h3 class="display-6 fw-bolder text-white mb-0">    
            LIBRARIAN DASHBOARD
          </h3>
          <p class='text-white'>CCT Web-Based Repository of Research Outputs</p>
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

   <!--DASHBOARD SCS RESEARCH PAPERS-->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card bg-c-lightgreen1 order-card h-80 py-3">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <h6 class="m-b-20">School of Computer Studies</h6>
              
              <div class="h5 mb-0 font-weight-bold">     
                <div class="h1 mb-2 font-weight-bold">
                 <?php
                 require 'includes/admin-dboardconfig.php';

                 $sesid = 'School of Computer Studies';

                 $query = "SELECT * FROM tb_fuploads WHERE priority_id = '$sesid' AND fup_status = 'Posted' ORDER BY fup_id";
                 $query_run = mysqli_query($link,$query);

                 $row = mysqli_num_rows($query_run);
                 echo '<h1>'.$row.'</h1>';      
                 ?>
               </div>
               <a href="librarian_view_scs.php">
                <div class="text-xs font-weight-bold text-light">View Research Papers</div>
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
  <!--END DASHBOARD SCS RESEARCH PAPERS-->

  <!--DASHBOARD SED RESEARCH PAPERS-->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card bg-c-pink order-card h-80 py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h6 class="m-b-20">School of Education</h6>
            
            <div class="h5 mb-0 font-weight-bold">     
              <div class="h1 mb-2 font-weight-bold">
               <?php
               require 'includes/admin-dboardconfig.php';

               $sesid = 'School of Education';

               $query = "SELECT * FROM tb_fuploads WHERE priority_id = '$sesid' AND fup_status = 'Posted' ORDER BY fup_id";
               $query_run = mysqli_query($link,$query);

               $row = mysqli_num_rows($query_run);
               echo '<h1>'.$row.'</h1>';      
               ?>
             </div>
             <a href="librarian_view_sed.php">
              <div class="text-xs font-weight-bold text-light">View Research Papers</div>
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
<!--END DASHBOARD SED RESEARCH PAPERS-->

<!--DASHBOARD SBM RESEARCH PAPERS-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-purple order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">School of Business Management</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
             <?php
             require 'includes/admin-dboardconfig.php';

             $sesid = 'School of Business Management';

             $query = "SELECT * FROM tb_fuploads WHERE priority_id = '$sesid' AND fup_status = 'Posted' ORDER BY fup_id";
             $query_run = mysqli_query($link,$query);

             $row = mysqli_num_rows($query_run);
             echo '<h1>'.$row.'</h1>';      
             ?>
           </div>
           <a href="librarian_view_sbm.php">
            <div class="text-xs font-weight-bold text-light">View Research Papers</div>
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
<!--END DASHBOARD SBM RESEARCH PAPERS-->


<!--DASHBOARD SHTM RESEARCH PAPERS-->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card bg-c-yellow order-card h-80 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <h6 class="m-b-20">School of Hospitality and Tourism Management</h6>
          
          <div class="h5 mb-0 font-weight-bold">     
            <div class="h1 mb-2 font-weight-bold">
             <?php
             require 'includes/admin-dboardconfig.php';

             $sesid = 'School of Hospitality and Tourism Management';

             $query = "SELECT * FROM tb_fuploads WHERE priority_id = '$sesid' AND fup_status = 'Posted' ORDER BY fup_id";
             $query_run = mysqli_query($link,$query);

             $row = mysqli_num_rows($query_run);
             echo '<h1>'.$row.'</h1>';      
             ?>
           </div>
           <a href="librarian_view_shtm.php">
            <div class="text-xs font-weight-bold text-light">View Research Papers</div>
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
<!--END DASHBOARD SHTM RESEARCH PAPERS--> 


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
      pieHole: 0.4  
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
<!-- END CONTAINER FLUID-->

<?php
include('includes/lb-footer.php');
?>

<!--LOGOUT BUTTON-->
<!--<body>-->
		<!-- <h1>Hello, <?php echo $_SESSION['dhead_uname']; ?> </h1>
		<a href="adminlogout.php">Log Out! </a>
	</body>
  </html>-->




