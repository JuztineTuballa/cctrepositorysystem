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
    header('Location: /cctrepositorysystem/lib_stud_req_archived.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
  include('includes/lb-header.php'); 
  include('includes/lb-navbar.php'); 
  include_once 'db_conn.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Archived Requests  <small class="h4 mb-4 text-gray-500">manage archived student requests</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="deptheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Archived Requests</p></small>
  </div>

   <!--START HEADER-->
  <header class="bg-headerimage2 py-5 m-0">
    <div class="container px-5">
      <section class="section about-section" id="about">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
              <div class="text-light go-to">
                <!--START h3-->
                <h3 class="text-light">
                 Archived Requests
                </h3> 
               <!--END h3-->
               <div class="media">
                <P>Items in your archive are only visible to you.</P>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-avatar">
              <i style="color:white;" class="fas fa-fw fa-archive fa-6x"></i>
           </div>
         </div>
       </div>
     </sections>
   </header>
   <BR/>

   <!--END START HEADER-->    
 
  <?php 
      if(isset($_SESSION['archive_request_status'])) {
  ?>
    <div class="alert" role="alert">
    <?php echo $_SESSION['archive_request_status']; ?>
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
  <?php
      unset($_SESSION['archive_request_status']);
      }
  ?>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <BR/>                 

      <h6 class="m-0 font-weight-bold text-primary">
      <a>Archived Student Requests</a>
      </h6>

    </div>
    <!--END OF CARD HEADER-->

    <div class="card-body">
      
      <form action="lib_stud_file_request_archive_restore_code.php" method="POST">

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;">ID</th>
                <th>
                  <button type="submit" name="stud_restore_all_multiple_btn"  class="btn mx-1"><i class="fas fa-undo-alt"></i></button>
                  <input type="checkbox" onclick="toggle(this);" />&nbsp;Check&nbsp;all<BR/>
                </th>
                <th>Student Department</th>
                <th>Student Number</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>File Title</th>
                <th>File Authors</th>
                <th>Date Requested</th>
                <th>Request Status</th>
                <th>Archived Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              
              $sql = "SELECT * 
                      FROM tb_frequest 
                      WHERE req_fupdheadarchive = 'Archived' ";

              $query = $conn->query($sql);

              while($row = $query->fetch_assoc()) {
            
                echo "
                <tr>
                <td style='display:none;'>".$row['req_id']."</td>
                <td style='width:10px; text-align: center;'>
                  <input type='checkbox' name='stud_auto_restore[]' value='".$row['req_id']."' />
                </td>
                </form>
                <td>".$row['req_studdepartment']."</td>
                <td>".$row['req_studnum']."</td>
                <td>".$row['req_studlname']."</td>
                <td>".$row['req_studfname']."</td>
                <td>".$row['req_fuptitle']."</td>
                <td>".$row['req_fupauthors']."</td>
                <td>".$row['req_date']."</td> 
                <td><kbd class='text-capitalize value-text'>".$row['req_fupstatus']."</kbd></td>
                <td><kbd class='text-capitalize value-text'>".$row['req_fupdheadarchive']."</kbd></td>
                </tr>
                ";
              }
              ?> <!--END PHP CODE HERE--->

            </tbody>
          </table>

        </div>
      </div>

      <div class="card-footer py-3">
        <a href="lib_stud_req_approval.php">
        <small style="float:right;"><i class="fa fa-sign-out-alt"></i>&nbsp;Back</small>
        </a>
      </div>


    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->


<?php
  include('includes/lb-footer.php');
?>

<!--SCRIPT FOR STATUS AND LEGEND-->
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
   $( ".value-text:contains('Pending')" ).attr('style', 'background-color:#FF8C00', 'color:#FFFFFF'); 
    $( ".value-text:contains('Approved')" ).attr('style', 'background-color:#32CD32', 'color:#FFFFFF'); 
    $( ".value-text:contains('Denied')" ).attr('style', 'background-color:#C41E3A', 'color:#FFFFFF'); 
    $( ".value-text:contains('Archived')" ).attr('style', 'background-color:#FF8C00', 'color:#FFFFFF'); 
    
  });
</script>
<!--END SCRIPT FOR STATUS AND LEGEND-->

<!--SCRIPT FOR SELECTING ALL CHECKBOX-->
<script src="js/select-all-checkbox.js"></script>

