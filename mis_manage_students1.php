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
    header('Location: /cctrepositorysystem/mis_manage_students1.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'db_conn.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Student Accounts Archive <small class="h4 mb-4 text-gray-500">manage deactivated student accounts</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="adminarchiveprofile.php" class='text-gray-700'>Archive Dashboard</a>&nbsp;&nbsp;>&nbsp;&nbsp;Student Accounts Archive</p></small>
  </div>

  
  <?php 
    if(isset($_SESSION['deactivated_status'])) {
  ?>
    <div class="alert" role="alert">
      <?php echo $_SESSION['deactivated_status']; ?>
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
  <?php
      unset($_SESSION['deactivated_status']);
    }
  ?>


  <form action="mis_manage_students_to_unarchive_code.php" method="POST">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
      <BR/>                 

      <h6 class="m-0 font-weight-bold text-primary">Deactivated Student Accounts</h6>
      </div>
      <!--END OF CARD HEADER-->

      <div class="card-body">
        <div class="table-responsive">

          <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th>ID</th>
                <th>
                  <button type="submit" name="stud_unarchived_multiple_btn"  class="btn mx-1"><i class="fas fa-fw fa-undo-alt"></i></button>
                  <input type="checkbox" onclick="toggle(this);" />&nbsp;Check&nbsp;all<BR/>
                </th>
                <th>Department</th>
                <th>Student Number</th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Status</th>  
                <th>Actions</th>

              </tr>
            </thead>
            <tfoot>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th>ID</th>
                <th>
                  <button type="submit" name="stud_unarchived_multiple_btn"  class="btn mx-1"><i class="fas fa-fw fa-undo-alt"></i></button>
                  <input type="checkbox" onclick="toggle(this);" />&nbsp;Check&nbsp;all<BR/>
                </th>
                <th>Department</th>
                <th>Student Number</th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Status</th>          
                <th>Actions</th>
                
              </tr>
            </tfoot>
            <tbody>
             <?php
             
             $sql = "SELECT *, tb_depthead.dhead_dept AS canid FROM tb_depthead LEFT JOIN tb_student ON tb_depthead.dhead_dept=tb_student.stud_department 
             WHERE tb_student.stud_status = 'Deactivated' ";

             $query = $conn->query($sql);

             while($row = $query->fetch_assoc()) {
              $image = (!empty($row['stud_picture'])) ? 'uploads/'.$row['stud_picture'] : 'uploads/adminprofile.png';
              
              echo "
              <tr>
              <td>".$row['stud_id']."</td>
              <td style='width:10px; text-align: center;'>
              <input type='checkbox' name='stud_unarchived_id[]' value='".$row['stud_id']."' '>
              </td>
              </form>
              <td>".$row['stud_department']."</td>
              <td>".$row['stud_num']."</td>
              <td>
              <img src='".$image."' width='50px' height='50px'>
              </td>
              <td>".$row['stud_lname']."</td>
              <td>".$row['stud_fname']."</td>
              <td><kbd class='text-capitalize status-deactivated'>".$row['stud_status']."</kbd></td>
              <td>

              <div class='dropdown'>
              <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              Manage
              </button>
              <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />

              <form action='mis_manage_students1.php' method='POST'>
              <input type='hidden' name='studreactivaterofileid' value='".$row['stud_id']."' />
              <button class='dropdown-item' type='submit' name='StudReactivateProfile' value='Reactivate'><i class='fas fa-archive fa-sm fa-fw mr-2 text-gray-400'></i>Reactivate Account</button>
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

  <div class="card-footer py-3">
    <a href="mis_manage_students.php">
      <small style="float:right;"><i class="fa fa-sign-out-alt"></i>&nbsp;View Activated Student Accounts</small>
    </a>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php
include('includes/footer.php');
?>


<?php
//PHP FUNCTION FOR REACTIVATING PROFILE
include_once 'db_conn.php';

if (isset($_POST['StudReactivateProfile'])) {
  $sid = $_POST['studreactivaterofileid'];

  $select = "UPDATE tb_student SET stud_status = 'Approved' WHERE stud_id = '$sid' ";
  $result = mysqli_query($conn,$select);

  echo "<script> alert('Reactivate Success!'); window.location='mis_manage_students1.php?status=Reactivated' </script>"; 

}
  //END PHP FUNCTION FOR REACTIVATING PROFILE
?>

<!--SCRIPT FOR SELECTING ALL CHECKBOX-->
<script src="js/select-all-checkbox.js"></script>



