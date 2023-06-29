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
    header('Location: /cctrepositorysystem/studentsettings.php');
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
    <h1 class="h3 mb-0 text-gray-800">My Profile <small class="h4 mb-4 text-gray-500">view your profile information</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="studentprofile.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;My Profile</p></small>
  </div>
</div>

<!--START HEADER-->
<header class="bg-headerimage1 py-5 m-3">
  <div class="container px-5">
    <section class="section about-section" id="about">
      <div class="container">
        <div class="row align-items-center flex-row-reverse">
          <div class="col-lg-6">
            <div class="text-light go-to">
              <!--START h3-->
              <h3 class="text-light">
               <?php echo mb_strtoupper($_SESSION ['stud_fname']) ?>
               <?php echo mb_strtoupper($_SESSION ['stud_lname']) ?>
             </h3> 
             <!--END h3-->
             <h6 class="text-light"><?php echo strtoupper($_SESSION ['studentidno']) ?> | <?php echo strtoupper($_SESSION ['stud_department']) ?></h6>
             <div class="media">
              <P>See information about your account like your student number and name, you can change your name and password at anytime.</P>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-avatar">
           <?php
           include_once 'db_conn.php';  
           $sesid = $_SESSION['stud_id'];
           
           $sql = "SELECT * FROM tb_student WHERE stud_id = '".$sesid."' ";

           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()) {
            $image = (!empty($row['stud_picture'])) ? 'uploads/'.$row['stud_picture'] : 'uploads/adminprofile.png';
            echo "<img class='img-profile rounded-circle' height='130px' src='".$image."' class='user-image' alt='User Image'> ";
          }
          ?>
        </div>
      </div>
    </div>
  </sections>
</header>

<!-- BEGIN TABLE -->
<!--<div class="container-fluid">-->

  <!-- BEGIN PAGE CONTENT -->  
  <!-- CONTENT ROW-->

  <div class="card-body">
    <div class="row"></div>
    <div class="card shadow mb-4">
      
      <div class="card-body">
        <div class="table-responsive">

          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;"></th>
                <th>Department</th>
                <th>Student Number</th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;"></th>
                <th>Department</th>
                <th>Student Number</th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Settings</th>
              </tr>
            </tfoot>
            <tbody>
             <?php
             
             $sessid = $_SESSION['stud_id'];  
             $sql = "SELECT * FROM tb_student  WHERE stud_id = '".$sessid."'";

             $query = $conn->query($sql);

             while($row = $query->fetch_assoc()) {
              $image = (!empty($row['stud_picture'])) ? 'uploads/'.$row['stud_picture'] : 'uploads/adminprofile.png';
              echo "
              <tr>
              <td style='display:none;'>".$row['stud_id']."</td>
              <td>".$row['stud_department']."</td>
              <td>".$row['stud_num']."</td>
              <td>
              <img src='".$image."' width='50px' height='50px'>
              <a data-target='#EditStudentPhotoModal' class='pull-right text-primary editstudphoto' data-id='".$row['stud_id']."'><span class='fa fa-edit'></span></a>
              </td>
              <td>".$row['stud_lname']."</td>
              <td>".$row['stud_fname']."</td>
              <td>
              <div class='dropdown'>
              <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              Manage
              </button>
              <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
              <a  data-toggle='modal' data-target='#EditStudentModal1'></a>
              <button class='dropdown-item edits002' type='button'><i class='fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>
              </div>
              </div>
              </td>
              </tr>
              ";
            }
            ?> <!--END PHP CODE HERE--->

            <!--I REMOVED THIS CODE DAHIL HINDI RELEVANT-->
            <!-- <a  data-toggle='modal' data-target='#EditStudentModal'></a> -->
            <!-- <button class='dropdown-item edits001' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>General Settings</button> -->

          </tbody>
        </table>
      </div>
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
include "studentsettingsmodal.php";
?>

<!--SCRIPT FOR FETCHING ADMIN PICTURE-->
<script>
  $(document).ready(function(){
    $('.editstudphoto').on('click',function(){
      
     $('#EditStudentPhotoModal').modal('show');

     $tablerow = $(this).closest('tr');

     var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

     console.log(data);
     
     $('#student_pid').val(data[0]);
     $('#student_pphoto').val(data[3]);

   });
  });
</script>
<!--END SCRIPT FOR FETCHING ADMIN PICTURE-->

<script>
//FETCH FOR STUDENT GENERAL SETTINGS
$(document).ready(function(){
  $('.edits001').on('click',function(){
    
   $('#EditStudentModal').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);

   $('#update_studentid').val(data[0]);
   $('#edit_studentlastname').val(data[4]);
   $('#edit_studentfirstname').val(data[5]);

 });
});
//END -  FOR EDIT STUDENT GENERAL SETTINGS

//JUST COPIED - FETCH FOR STUDENT SECURITY AND LOG IN
$(document).ready(function(){
  $('.edits002').on('click',function(){
    
   $('#EditStudentModal1').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);
   
   $('#student_sid').val(data[0]);
   $('#student_fname').val(data[5]);

 });
});
//END - JUST COPIED - FETCH FOR STUDENT SECURITY AND LOG IN
</script>

<!--EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
  function EDIT_STUDPasswordMatch() {
    var EDIT_STUDpassword = $("#student_newpass").val();
    var EDIT_STUDconfirmPassword = $("#student_repass").val();
    if (EDIT_STUDpassword != EDIT_STUDconfirmPassword) {
      $("#CheckPasswordMatchSTUD3").html("Password does not match!").css("color", "red");
    } else {
      $("#CheckPasswordMatchSTUD3").html("Password match!").css("color", "green");
    }
  }

  $(document).ready(function() {
    $("#student_newpass, #student_repass").on('keyup', function() {
      EDIT_STUDPasswordMatch();
    });
  });
</script>
<!--END EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->