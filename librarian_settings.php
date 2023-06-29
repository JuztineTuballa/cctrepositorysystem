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
    header('Location: /cctrepositorysystem/librarian_settings.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include 'db_conn.php';
include "includes/lb-header.php";
include "includes/lb-navbar.php";
?>

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">
 <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h4 mb-0 text-gray-800">My Profile <small class="h4 mb-4 text-gray-500"> view your profile information</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="librariandashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;My Profile</p></small>
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
              <h4 class="text-light">
               <?php echo mb_strtoupper($_SESSION ['librarian_fname']) ?>
               <?php echo mb_strtoupper($_SESSION ['librarian_mname']) ?>
               <?php echo mb_strtoupper($_SESSION ['librarian_lname']) ?>
             </h4> 
             <!--END h3-->
             <h6 class="text-light">LIBRARIAN | CITY COLLEGE OF TAGAYTAY</h6>
             <div class="media">
              <P>See information about your account like your name, you can change your name and password at anytime.</P>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-avatar">
           <?php
           include_once 'db_conn.php';  
           $sesid = $_SESSION['librarian_id'];
           
           $sql = "SELECT * FROM tb_librarian WHERE librarian_id = '".$sesid."' ";

           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()) {
            $image = (!empty($row['librarian_picture'])) ? 'uploads/'.$row['librarian_picture'] : 'uploads/adminprofile.png';
            echo "<img class='img-profile rounded-circle' height='127px' width='127px' src='".$image."' class='user-image' alt='User Image'> ";
          }
          ?>
        </div>
      </div>
    </div>
  </sections>
</header>

<!-- BEGIN TABLE -->
<!-- <div class="container-fluid"> -->

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
                <th>Username</th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;"></th>
                <th>Username</th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Settings</th>
              </tr>
            </tfoot>
            <tbody>
             <?php
             
             $sessid = $_SESSION['librarian_id'];  
             $sql = "SELECT * FROM tb_librarian  WHERE librarian_id = '".$sessid."'";

             $query = $conn->query($sql);

             while($row = $query->fetch_assoc()) {
              $image = (!empty($row['librarian_picture'])) ? 'uploads/'.$row['librarian_picture'] : 'uploads/adminprofile.png';
              echo "
              <tr>
              <td style='display:none;'>".$row['librarian_id']."</td>
              <td>".$row['librarian_uname']."</td>
              <td>
              <img src='".$image."' width='50px' height='50px'>
              <a data-target='#EditLibrarianPhotoModal1' class='pull-right text-primary editlibrarianphoto1' data-id='".$row['librarian_id']."'><span class='fa fa-edit'></span></a>
              </td>
              <td>".$row['librarian_lname']."</td>
              <td>".$row['librarian_fname']."</td>
               <td>".$row['librarian_mname']."</td>
              <td>
              <div class='dropdown'>
              <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              Manage
              </button>
              <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
             
              <a  data-toggle='modal' data-target='#EditLibrarianModal1'></a>
              <button class='dropdown-item editLB002' type='button'><i class='fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>
              
              </div>
              </div>
              </td>
              </tr>
              ";
            }
            ?> 
             
            <!--END PHP CODE HERE--->
          
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
<!--END TABLE-->

<!-- </div> -->
<!-- END CONTENT ROW -->


<?php
include "includes/lb-footer.php";
?>

<?php
include "librarian_settings_modal.php";
?>

<!--SCRIPT FOR FETCHING ADMIN PICTURE-->
<script>
  $(document).ready(function(){
    $('.editlibrarianphoto1').on('click',function(){
      
     $('#EditLibrarianhotoModal1').modal('show');

     $tablerow = $(this).closest('tr');

     var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

     console.log(data);
     
     $('#librarian_pid1').val(data[0]);
     $('#librarian_pphoto1').val(data[2]);

   });
  });
</script>
<!--END SCRIPT FOR FETCHING ADMIN PICTURE-->

<script> 

//JUST COPIED - FETCH FOR STUDENT SECURITY AND LOG IN
$(document).ready(function(){
  $('.editLB002').on('click',function(){
    
   $('#EditLibrarianModal1').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);
   
   $('#librarian_sid1').val(data[0]);
   $('#librarian_uname1').val(data[1]);

 });
});
//END - JUST COPIED - FETCH FOR STUDENT SECURITY AND LOG IN
</script>

<!--EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
  function EDITLBcheckPasswordMatch3() {
    var EDIT_LB3password = $("#librarian_newpass1").val();
    var EDIT_LB3confirmPassword = $("#librarian_repass1").val();
    if (EDIT_LB3password != EDIT_LB3confirmPassword) {
      $("#CheckPasswordMatchLB3").html("Password does not match!").css("color", "red");
    } else {
      $("#CheckPasswordMatchLB3").html("Password match!").css("color", "green");
    }
  }

  $(document).ready(function() {
    $("#librarian_newpass1, #librarian_repass1").on('keyup', function() {
      EDITLBcheckPasswordMatch3();
    });
  });
</script>
<!--END EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->