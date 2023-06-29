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
    header('Location: /cctrepositorysystem/mis_manage_students.php');
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

<div class="d-sm-flex align-items-center justify-content-between mb-1">
  <h1 class="h4 mb-0 text-gray-800">Student Accounts <small class="h5 mb-4 text-gray-500">manage approved student accounts</small></h1>
  <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Student Accounts</p></small>
</div>
<p class='mb-4 text-gray-700'>People who have proven to be CCT students by the system and have successfully registered their accounts are listed below.</p>
<!--Students who successfully registered their accounts are listed below.-->
  
  
<?php 
  if(isset($_SESSION['archived_status'])) {
?>
  <div class="alert" role="alert">
    <?php echo $_SESSION['archived_status']; ?>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  </div>
<?php
    unset($_SESSION['archived_status']);
  }
?>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <BR/>                 

    <h6 class="m-0 font-weight-bold text-primary">Approved Student Accounts</h6>
    </div>
    <!--END OF CARD HEADER-->

    <div class="card-body">
      
      <form action="mis_manage_students_to_archive_code.php" method="POST">

        <div class="table-responsive">
          <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th style="display:none;">ID</th>
                <th>
                  <button type="submit" name="stud_archived_multiple_btn"  class="btn mx-1"><i class="fas fa-fw fa-archive"></i></button>
                  <input type="checkbox" onclick="toggle(this);" />&nbsp;Check&nbsp;all<BR/>
                </th>
                <th>Department</th>
                <th>Student Number</th>
                <th style="display:none;"></th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Status</th>  
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th style="display:none;">ID</th>
                <th>
                  <button type="submit" name="stud_archived_multiple_btn"  class="btn mx-1"><i class="fas fa-fw fa-archive"></i></button>
                  <input type="checkbox" onclick="toggle(this);" />&nbsp;Check&nbsp;all<BR/>
                </th>
                <th>Department</th>
                <th>Student Number</th>
                <th style="display:none;"></th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Status</th>
                <th>Actions</th>          
              </tr>
            </tfoot>
            <tbody>
              <?php
              
              /*
              SELECT *, tb_depthead.dhead_dept AS canid FROM tb_depthead LEFT JOIN tb_student ON tb_depthead.dhead_dept=tb_student.stud_department 
              WHERE tb_student.stud_status = 'Approved'
              */
              $sql = "SELECT * FROM tb_student 
                      WHERE stud_status = 'Approved' ";

              $query = $conn->query($sql);

              while($row = $query->fetch_assoc()) {
                $image = (!empty($row['stud_picture'])) ? 'uploads/'.$row['stud_picture'] : 'uploads/adminprofile.png';
                
                echo "
                <tr>
                <td style='display:none;'>".$row['stud_id']."</td>
                <td style='width:10px; text-align: center;'>
                <input type='checkbox' name='stud_archived_id[]' value='".$row['stud_id']."' />
                </td>
                </form>
                <td>".$row['stud_department']."</td>
                <td>".$row['stud_num']."</td>
                <td style='display:none;'>".$row['stud_pword']."</td>
                <td>
                  <img src='".$image."' width='50px' height='50px'>
                </td>
                <td>".$row['stud_lname']."</td>
                <td>".$row['stud_fname']."</td>
                <td><kbd class='text-capitalize status-posted'>".$row['stud_status']."</kbd></td>
                <td>

                <div class='dropdown'>
                <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Manage
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />

                <a  data-toggle='modal' data-target='#EditStudentSecurityModal'></a>
                <button class='dropdown-item editSTUDSECURITY' type='button'><i class='fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>

                <form action='mis_manage_students.php' method='POST'>
                <input type='hidden' name='studdeactivaterofileid' value='".$row['stud_id']."' />
                <button class='dropdown-item' type='submit' name='StudDeactivateProfile' value='Deactivate'><i class='fas fa-archive fa-sm fa-fw mr-2 text-gray-400'></i>Deactivate Account</button>
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

  <div class="card-footer py-3">
    <a href="mis_manage_students1.php">
      <small style="float:right;"><i class="fa fa-archive"></i>&nbsp;View Deactivated Student Accounts</small>
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
  include 'funcadmin_student_updatemodal.php';
?>


<?php
//PHP FUNCTION FOR ARCHIVING PROFILE
  include_once 'db_conn.php';

  if (isset($_POST['StudDeactivateProfile'])) {
    $sid = $_POST['studdeactivaterofileid'];

    $select = "UPDATE tb_student SET stud_status = 'Deactivated' WHERE stud_id = '$sid' ";
    $result = mysqli_query($conn,$select);

    echo "<script> alert('Deactivated Success!'); window.location='mis_manage_students.php?status=Deactivated' </script>"; 

  }
//END PHP FUNCTION FOR ARCHIVING PROFILE
?>


<script type="text/javascript">
//FETCH FOR STUDENT SECURITY AND LOG IN

  $(document).ready(function(){
    $('.editSTUDSECURITY').on('click',function(){

     $('#EditStudentSecurityModal').modal('show');

     $tablerow = $(this).closest('tr');

     var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

     console.log(data);
     
     $('#mystudent_ssid').val(data[0]);
     $('#mystudent_studnum').val(data[3]);
     $('#mystudent_oldpass').val(data[4]);

   });
  });

//FETCH FOR STUDENT SECURITY AND LOG IN
</script>

<!--EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
 function ADD_STUDPasswordMatch() {
  var ADD_STUDpassword = $("#mystudent_newpass").val();
  var ADD_STUDconfirmPassword = $("#mystudent_repass").val();
  if (ADD_STUDpassword != ADD_STUDconfirmPassword) {
    $("#CheckPasswordMatchSTUD1").html("Password does not match!").css("color", "red");
  } else {
    $("#CheckPasswordMatchSTUD1").html("Password match!").css("color", "green");
  }
}

$(document).ready(function() {
  $("#mystudent_newpass, #mystudent_repass").on('keyup', function() {
    ADD_STUDPasswordMatch();
  });
});
</script>
<!--EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->

<!--SCRIPT FOR SELECTING ALL CHECKBOX-->
<script src="js/select-all-checkbox.js"></script>

