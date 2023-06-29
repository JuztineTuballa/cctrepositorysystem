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
    header('Location: /cctrepositorysystem/adminsettings.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'db_conn.php';
?>

<div class="container-fluid">

  <!-- PAGE HEADING -->

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">System Administrator Settings<small class="h4 mb-4 text-gray-500"> manage your profile information</small></h1>
    <small><p>
      <i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="adminprofile.php" class='text-gray-700'>My Profile</a>&nbsp;&nbsp;>&nbsp;&nbsp;System Administrator Settings</p></small>
  </div>
 
  <!-- DATA TABLES -->
  <div class="card shadow mb-4" id="adminsettings">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">System Administrator Settings</h6>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
           <!--PRIMARY INFORMATION-->
           <th style="display:none;">ID</th>
           <th >Username</th>
           <th style="display:none;">Password</th>
           <th>Photo</th>
           <th>Lastname</th>
           <th>Firstname</th>
           <th>Middlename</th>
           <!-- END PRIMARY INFORMATION-->
           <!--SECONDARY INFORMATION-->
           <th>Gender</th>
           <th>Birthday</th>
           <th>Address</th>
           <th>Email</th>
           <!--END SECONDARY INFORMATION-->
           <th>Settings</th>
         </tr>
       </thead>
       <tfoot>
        <tr>
         <!--PRIMARY INFORMATION-->
         <th style="display:none;">ID</th>
         <th>Username</th>
         <th style="display:none;">Password</th>
         <th>Photo</th>
         <th>Lastname</th>
         <th>Firstname</th>
         <th>Middlename</th>
         <!-- END PRIMARY INFORMATION-->
         <!--SECONDARY INFORMATION-->
         <th>Gender</th>
         <th>Birthday</th>
         <th>Address</th>
         <th>Email</th>
         <!--END SECONDARY INFORMATION-->
         <th>Settings</th>
       </tr>
     </tfoot>
     <tbody>
       <?php

       $sesid = $_SESSION['SPadmin_id'];
       $sql = "SELECT * FROM tb_adminuser WHERE admin_id = '$sesid' ";
       $query = $conn->query($sql);

       while($row = $query->fetch_assoc()){
        $image = (!empty($row['admin_picture'])) ? 'uploads/'.$row['admin_picture'] : 'uploads/adminprofile.png';

        echo "
        <tr>
        <td style='display:none;'>".$row['admin_id']."</td>
        <td>".$row['admin_username']."</td>
        <td style='display:none;' class='small w-100 text-monospace small'>".strtolower(strrev(password_hash($row['admin_password'], PASSWORD_BCRYPT)))."</td>
        <td>
        <img src='".$image."' width='50px' height='50px'>
        <a data-target='#EditAdminPhotoModal' class='pull-right text-primary editphoto' data-id='".$row['admin_id']."'><span class='fa fa-edit'></span></a>
        </td>

        <td>".$row['admin_lastname']."</td>
        <td>".$row['admin_firstname']."</td>
        <td>".$row['admin_middlename']."</td>
        <td>".$row['admin_gender']."</td>
        <td>".$row['admin_birthday']."</td>
        <td>".$row['admin_address']."</td>
        <td>".$row['admin_email']."</td>
        <td>
        <div class='dropdown'>
        <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Manage
        </button>
        <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />

        <a  data-toggle='modal' data-target='#EditAdminModal'></a>
        <button class='dropdown-item edit1' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>General Settings</button>

        <a  data-toggle='modal' data-target='#EditAdminModal2'></a>
        <button class='dropdown-item edit2' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>Account Username</button>

        <a  data-toggle='modal' data-target='#EditAdminModal3'></a>
        <button class='dropdown-item edit3' type='button'><i class='fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>

        <form action='adminsettings.php' method='POST'>
        <input type='hidden' name='myprofileidADMIN' value='".$row['admin_id']."' />
        <button class='dropdown-item' type='submit' name='MyProfileADMIN' value='Deactivate'><i class='fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400'></i>Deactivate Account</button>
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
</div>
<!-- /.CONTAINER FLUID-->

<!-- CODE TO DELETE ACCOUNT - Connected to  admin_delete.php -->
<!-- <input type='hidden' class='id' name='id'>
<a href='admin_delete.php?deletemona=".$row['admin_id']."' OnClick=\"return confirm('Are you sure you want to Delete this Administrator?');\">
<button class='dropdown-item' type='button'><i class='fa fa-trash fa-sm fa-fw mr-2 text-gray-400'></i>Delete</button> -->
<!-- END - CODE TO DELETE ACCOUNT - Connected to  admin_delete.php -->

<?php
include('includes/footer.php');
?>

 
<?php
// PHP FUNCTION FOR DEACTIVATING PROFILE
if (isset($_POST['MyProfileADMIN'])) {
    $deactivateid = $_POST['myprofileidADMIN'];

    $sql = "UPDATE tb_adminuser SET admin_status = 'Deactivated', admin_deac_timestamp = NOW() WHERE admin_id = $deactivateid";
    $result = mysqli_query($conn, $sql);

     echo "<script> alert('Account Successfully Deactivated!'); window.location='cct_admin_logout.php?status=Deactivated' </script>"; 
}
?>


<!--CSS PARA SA SIZE NUNG ENCRYPTED ROW NUNG TABLE-->
<style>
  .wrapword2 {
    white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
    white-space: -webkit-pre-wrap;          /* Chrome & Safari */ 
    white-space: -pre-wrap;                 /* Opera 4-6 */
    white-space: -o-pre-wrap;               /* Opera 7 */
    white-space: pre-wrap;                  /* CSS3 */
    word-wrap: break-word;                  /* Internet Explorer 5.5+ */
    word-break: break-all;
    white-space: normal;
    font-size: 15px;
  }

  
</style>

<!--END CSS PARA SA SIZE NUNG TABLE-->

<?php 
//DITO PARA MATAWAG NATIN YUNG MODAL NI EDIT ADMIN
include ('admin_updatemodal.php');
?>

<script>
//FETCH FOR GENERAL SETTINGS
$(function(){
  $(document).on('click', '.edit1', function(e){
    e.preventDefault();
    
    $('#EditAdminModal').modal('show');
    $tablerow = $(this).closest('tr');

    var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

        $('#update_adminid').val(data[0]);
        $('#edit_adminlastname').val(data[4]);
        $('#edit_adminfirstname').val(data[5]);
        $('#edit_adminmiddlename').val(data[6]); 
        $('#edit_adminbirthdate').val(data[8]);
        $('#edit_adminaddress').val(data[9]);
        $('#edit_adminaddress').val(data[9]);
        $('#edit_adminemail').val(data[10]);

        if (data[7]=='Male') {
          $('#edit_gridradios1').val(data[7]).prop('checked', true);
        } else if (data[7]=='Female') {
          $('#edit_gridradios2').val(data[7]).prop('checked', true);
        } else {
          $('#edit_gridradios3').val(data[7]).prop('checked', true);
        }
        
      });
});
//END - FETCH FOR GENERAL SETTINGS
</script>

<script>
//FETCH FOR EDIT USERNAME
$(function(){
  $(document).on('click', '.edit2', function(e){
    e.preventDefault();
    
    $('#EditAdminModal2').modal('show');
    $tablerow = $(this).closest('tr');

    var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

        $('#update_adminuid').val(data[0]);
        $('#edit_adminusername').val(data[1]);
        
      });
});
//END - FETCH FOR EDIT USERNAME
</script>

<script type="text/javascript"> 
//FETCH FOR SECURITY AND LOG IN
$(function(){
  $(document).on('click', '.edit3', function(e){
    e.preventDefault();
    
    $('#EditAdminModal3').modal('show');
    $tablerow = $(this).closest('tr');

    var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);
    
    $('#admin_sid').val(data[0]);
    $('#admin_uname').val(data[1]);
    //$('#admin_oldpass').val(data[2]);
        
      });
});
//END - FETCH FOR SECURITY AND LOG IN
</script>

<script>
//SCRIPT FOR FETCHING ADMIN PICTURE
$(function(){
  $(document).on('click', '.editphoto', function(e){
    e.preventDefault();
    
    $('#EditAdminPhotoModal').modal('show');
    $tablerow = $(this).closest('tr');

    var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);
    
    $('#admin_pid').val(data[0]);
    $('#admin_pphoto').val(data[3]);
    
  });
});
//END - SCRIPT FOR FETCHING ADMIN PICTURE
</script>

<!--SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
  function checkPasswordMatch() {
    var password = $("#admin_newpass").val();
    var confirmPassword = $("#admin_repass").val();
    if (password != confirmPassword)
      $("#CheckPasswordMatch1").html("Password does not match!").css("color", "red");
    else
      $("#CheckPasswordMatch1").html("Password match!").css("color", "green");
  }

  $(document).ready(function() {
    $("#admin_newpass, #admin_repass").on('keyup', function() {
      checkPasswordMatch();
      });
  });
</script>
<!--END SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunctionPass() {
    var x = document.getElementById("admin_newpass");
    var y = document.getElementById("admin_repass");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    if (y.type === "password") {
      y.type = "text";
    } else {
     y.type = "password";
   }
 }
</script>
<!--END SCRIPT TO SHOW OR HIDE PASSWORD-->


