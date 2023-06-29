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
    header('Location: /cctrepositorysystem/studentfilearchive.php');
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
    <h1 class="h3 mb-0 text-gray-800">My Archives <small class="h4 mb-4 text-gray-500"> manage your archived requested research outputs</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="studentprofile.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;My Archives</p></small>
  </div>
</div>

<!--START HEADER-->
<header class="bg-headerimage2 py-5 m-3">
  <div class="container px-5">
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-7">
        <div class="text-center my-5">
          <h2 class="display-6 fw-bolder text-white mb-0">    
            <!--<?php echo strtoupper($_SESSION ['stud_department']) ?>-->
            ARCHIVED RESEARCH RECORDS
          </h2>
          <p class='text-white'>Items in your archive are only visible to you.</p>
          <p class="lead text-white mb-4"></p>
        </div>
      </div>
    </div>
  </div>
</header>
<!--END HEADER--> 
<BR/>

<!-- BEGIN PAGE CONTENT -->
<!--<div class="container-fluid">-->
  
  <!-- BEGIN TABLE -->
  <div class="container-fluid">
    <div class="card shadow mb-4">
    
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Archived Research Outputs</h6>
    </div>

      <div class="card-body">
        <div class="table-responsive">

          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;"></th>
                <th>Title</th>
                <th>Department</th>
                <th>Author</th>
                <th>File</th>
                <th>Status</th>
                <th>More</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;"></th>
                <th>Title</th>
                <th>Department</th>
                <th>Author</th>
                <th>File</th>
                <th>Status</th>
                <th>More</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
              
              $sesnum = $_SESSION['studentidno'];
              $sesid = $_SESSION['stud_department'];
              
              $sql = "SELECT *, tb_frequest.req_studdepartment AS canid FROM tb_frequest JOIN tb_student ON tb_frequest.req_studnum = tb_student.stud_num AND tb_frequest.req_studdepartment=tb_student.stud_department JOIN tb_fuploads ON tb_frequest.req_fupdepartment = tb_fuploads.priority_id AND tb_frequest.req_fupauthors = tb_fuploads.fup_author WHERE tb_frequest.req_studnum = '".$sesnum."' AND tb_frequest.req_studdepartment = '".$sesid."' AND tb_frequest.req_fupstatus = 'Approved' AND tb_frequest.req_fuparchive = 'Archived' ";
              $query = $conn->query($sql);

              while($row = $query->fetch_assoc()) {

                echo "
                <tr>
                <td style='display:none;'>".$row['req_id']."</td>
                <td>".$row['req_fuptitle']."</td>
                <td class='value-text'>".$row['req_fupdepartment']."</td>
                <td>".$row['req_fupauthors']."</td> 
                <td>
                  <a target='_blank' href='uploads-papers/".$row['fup_document']."#toolbar=0&navpanes=0'>".$row['fup_document']."</a>
                </td>
                <td><kbd class='text-capitalize value-text'>".$row['req_fuparchive']."</kbd></td>  
                <td>
                <div class='dropdown'>
                <button class='btn btn-dark dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                More
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
                <form action='studentfilearchive.php' method='POST'>
                <input type='hidden' name='unarchivefileST' value='".$row['req_id']."' />
                <button class='dropdown-item' type='submit' name='UnArchiveFileST1' value='Unarchived'><i class='fas fa-undo-alt fa-sm fa-fw mr-2 text-gray-400'></i>
                Restore
                </button>
                </form>
                </div>
                </div>
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
  <!--END TABLE-->
  
</div>
<!-- END CONTENT ROW -->

<?php
include "includes/student-footer.php";
?>

<?php
//PHP FUNCTION FOR BOOKMARKING FILE
if (isset($_POST['UnArchiveFileST1'])) {
  $sid = $_POST['unarchivefileST'];

  $select = "UPDATE tb_frequest SET req_fuparchive = 'Unarchived' WHERE req_id = '$sid' ";
  $result = mysqli_query($conn,$select);

  echo "<script> alert('Succesfully Removed from Archives!'); window.location='studentfilearchive.php?status=Removed' </script>"; 

}
//END PHP FUNCTION FOR BOOKMARKING FILE
?>

<!-- SCRIPT - DISABLE RIGHT CLICK BUTTON-->
<script type="text/javascript">
  $(document).bind("contextmenu",function(e){
    return false;
  });
</script>
<!-- END SCRIPT - DISABLE RIGHT CLICK BUTTON-->

 