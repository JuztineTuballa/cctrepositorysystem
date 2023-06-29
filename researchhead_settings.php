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
    header('Location: /cctrepositorysystem/researchhead_settings.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include 'db_conn.php';
include "includes/rh-header.php";
include "includes/rh-navbar.php";
?>

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">
 <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h4 mb-0 text-gray-800">My Profile <small class="h4 mb-4 text-gray-500"> view your profile information</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="researchheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;My Profile</p></small>
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
               <?php echo mb_strtoupper($_SESSION ['reshead_fname']) ?>
               <?php echo mb_strtoupper($_SESSION ['reshead_mname']) ?>
               <?php echo mb_strtoupper($_SESSION ['reshead_lname']) ?>
             </h4> 
             <!--END h3-->
             <h6 class="text-light">RESEARCH HEAD | CITY COLLEGE OF TAGAYTAY</h6>
             <div class="media">
              <P>See information about your account like your name, you can change your name and password at anytime.</P>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-avatar">
           <?php
           include_once 'db_conn.php';  
           $sesid = $_SESSION['reshead_id'];
           
           $sql = "SELECT * FROM tb_researchhead WHERE reshead_id = '".$sesid."' ";

           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()) {
            $image = (!empty($row['reshead_picture'])) ? 'uploads/'.$row['reshead_picture'] : 'uploads/adminprofile.png';
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
             
             $sessid = $_SESSION['reshead_id'];  
             $sql = "SELECT * FROM tb_researchhead  WHERE reshead_id = '".$sessid."'";

             $query = $conn->query($sql);

             while($row = $query->fetch_assoc()) {
              $image = (!empty($row['reshead_picture'])) ? 'uploads/'.$row['reshead_picture'] : 'uploads/adminprofile.png';
              echo "
              <tr>
              <td style='display:none;'>".$row['reshead_id']."</td>
              <td>".$row['reshead_uname']."</td>
              <td>
              <img src='".$image."' width='50px' height='50px'>
              <a data-target='#EditResHeadPhotoModal1' class='pull-right text-primary editrhsphoto1' data-id='".$row['reshead_id']."'><span class='fa fa-edit'></span></a>
              </td>
              <td>".$row['reshead_lname']."</td>
              <td>".$row['reshead_fname']."</td>
               <td>".$row['reshead_mname']."</td>
              <td>
              <div class='dropdown'>
              <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              Manage
              </button>
              <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
             
              <a  data-toggle='modal' data-target='#EditResearchHeadModal1'></a>
              <button class='dropdown-item editrhs002' type='button'><i class='fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>
              
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
include "includes/dh-footer.php";
?>

<?php
include "researchhead_settings_modal.php";
?>

<!--SCRIPT FOR FETCHING ADMIN PICTURE-->
<script>
  $(document).ready(function(){
    $('.editrhsphoto1').on('click',function(){
      
     $('#EditResHeadPhotoModal1').modal('show');

     $tablerow = $(this).closest('tr');

     var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

     console.log(data);
     
     $('#reshead_pid1').val(data[0]);
     $('#reshead_pphoto1').val(data[2]);

   });
  });
</script>
<!--END SCRIPT FOR FETCHING ADMIN PICTURE-->

<script> 

//JUST COPIED - FETCH FOR STUDENT SECURITY AND LOG IN
$(document).ready(function(){
  $('.editrhs002').on('click',function(){
    
   $('#EditResearchHeadModal1').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);
   
   $('#reshead_sid1').val(data[0]);
   $('#reshead_uname1').val(data[1]);

 });
});
//END - JUST COPIED - FETCH FOR STUDENT SECURITY AND LOG IN
</script>

<!--EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
  function EDITcheckPasswordMatch3() {
    var EDIT_RH3password = $("#reshead_newpass1").val();
    var EDIT_RH3confirmPassword = $("#reshead_repass1").val();
    if (EDIT_RH3password != EDIT_RH3confirmPassword) {
      $("#CheckPasswordMatchRH3").html("Password does not match!").css("color", "red");
    } else {
      $("#CheckPasswordMatchRH3").html("Password match!").css("color", "green");
    }
  }

  $(document).ready(function() {
    $("#reshead_newpass1, #reshead_repass1").on('keyup', function() {
      EDITcheckPasswordMatch3();
    });
  });
</script>
<!--END EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->