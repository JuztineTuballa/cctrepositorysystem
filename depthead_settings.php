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
    header('Location: /cctrepositorysystem/depthead_settings.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>


<?php
include 'db_conn.php';
include "includes/dh-header.php";
include "includes/dh-navbar.php";
?>


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
               <?php echo mb_strtoupper($_SESSION ['dhead_fname']) ?>
               <?php echo mb_strtoupper($_SESSION ['dhead_mname']) ?>
               <?php echo mb_strtoupper($_SESSION ['dhead_lname']) ?>
             </h4> 
             <!--END h3-->
             <h6 class="text-light">RESEARCH COORDINATOR | <?php echo strtoupper($_SESSION ['dhead_dept']) ?></h6>
             <div class="media">
              <P>See information about your account like your name, you can change your name and password at anytime.</P>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-avatar">
           <?php
           include_once 'db_conn.php';  
           $sesid = $_SESSION['dhead_id'];
           
           $sql = "SELECT * FROM tb_depthead WHERE dhead_id = '".$sesid."' ";

           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()) {
            $image = (!empty($row['dhead_picture'])) ? 'uploads/'.$row['dhead_picture'] : 'uploads/adminprofile.png';
            echo "<img class='img-profile rounded-circle' height='127px' width='127px' src='".$image."' class='user-image' alt='User Image'> ";
          }
          ?>
        </div>
      </div>
    </div>
  </sections>
</header>

<!-- BEGIN TABLE -->
<!-- <div class="container-fluid">
 -->
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
                <th>Department</th>
                <th>Picture</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Settings</th>
              </tr>
            </tfoot>
            <tbody>
             <?php
             
             $sessid = $_SESSION['dhead_id'];  
             $sql = "SELECT * FROM tb_depthead  WHERE dhead_id = '".$sessid."'";

             $query = $conn->query($sql);

             while($row = $query->fetch_assoc()) {
              $image = (!empty($row['dhead_picture'])) ? 'uploads/'.$row['dhead_picture'] : 'uploads/adminprofile.png';
              echo "
              <tr>
              <td style='display:none;'>".$row['dhead_id']."</td>
              <td>".$row['dhead_dept']."</td>
              <td>
              <img src='".$image."' width='50px' height='50px'>
              <a data-target='#EditDeptHeadSettingsPhotoModal' class='pull-right text-primary editdhsphoto' data-id='".$row['dhead_id']."'><span class='fa fa-edit'></span></a>
              </td>
              <td>".$row['dhead_lname']."</td>
              <td>".$row['dhead_fname']."</td>
               <td>".$row['dhead_mname']."</td>
              <td>
              <div class='dropdown'>
              <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              Manage
              </button>
              <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
             
              <a  data-toggle='modal' data-target='#EditDeptHeadModal1'></a>
              <button class='dropdown-item editdhs002' type='button'><i class='fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>
              
              </div>
              </div>

              </td>
              </tr>
              ";
            }
            ?> 
            <!--
              <a  data-toggle='modal' data-target='#EditDeptHeadModal'></a>
              <button class='dropdown-item editdhs001' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>General Settings</button>

            -->

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
include "depthead_settings_modal.php";
?>

<!--SCRIPT FOR FETCHING ADMIN PICTURE-->
<script>
  $(document).ready(function(){
    $('.editdhsphoto').on('click',function(){
      
     $('#EditDeptHeadSettingsPhotoModal').modal('show');

     $tablerow = $(this).closest('tr');

     var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

     console.log(data);
     
     $('#dhs_pid').val(data[0]);
     $('#dhs_pphoto').val(data[2]);

   });
  });
</script>
<!--END SCRIPT FOR FETCHING ADMIN PICTURE-->

<script>
/* FETCH FOR STUDENT GENERAL SETTINGS
    I COMMENTED SO WE CAN DISABLED THIS FUNCTION 
    HINDI NA KAILANGAN NETO 

$(document).ready(function(){
  $('.editdhs001').on('click',function(){
    
   $('#EditDeptHeadSettingsModal').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);

   $('#update_deptheadid').val(data[0]);
   $('#edit_deptheadlastname').val(data[3]);
   $('#edit_deptheadfirstname').val(data[4]);
   $('#edit_deptheadmiddlename').val(data[5]);

 });
});

*/ 

//JUST COPIED - FETCH FOR STUDENT SECURITY AND LOG IN
$(document).ready(function(){
  $('.editdhs002').on('click',function(){
    
   $('#EditDeptHeadModal1').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);
   
   $('#dhead_sid').val(data[0]);
   $('#dhs_fname').val(data[4]);

 });
});
//END - JUST COPIED - FETCH FOR STUDENT SECURITY AND LOG IN
</script>

<!--EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
  function EDIT_DH3PasswordMatch() {
    var EDIT_DH3password = $("#dhs_newpass").val();
    var EDIT_DH3confirmPassword = $("#dhs_repass").val();
    if (EDIT_DH3password != EDIT_DH3confirmPassword) {
      $("#CheckPasswordMatchDH3").html("Password does not match!").css("color", "red");
    } else {
      $("#CheckPasswordMatchDH3").html("Password match!").css("color", "green");
    }
  }

  $(document).ready(function() {
    $("#dhs_newpass, #dhs_repass").on('keyup', function() {
      EDIT_DH3PasswordMatch();
    });
  });
</script>
<!--END EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->