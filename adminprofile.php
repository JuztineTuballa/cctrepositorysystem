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
    header('Location: /cctrepositorysystem/adminprofile.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>


<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'db_conn.php';
?>

<style>
    hr {
        display: block;
        height: 1px;
        border: 0;
        border-top: 2px solid #e7e6ed;
        margin: 1em 0;
        padding: 0;
        max-width: 250px;
      }
</style>

<div class="container-fluid">

  <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile <small class="h4 mb-4 text-gray-500">view your profile information</small></h1>
    <small><p>
      <i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;My Profile</p></small>
  </div>

  <!--START HEADER-->
  <header class="bg-headerimage py-5 m-0">
    <div class="container px-5">
      <section class="section about-section" id="about">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
              <div class="text-light go-to">
                <!--START h3-->
                <h3 class="text-light">
                 <?php echo mb_strtoupper($_SESSION ['admin_firstname'])  ?>
                 <?php echo mb_strtoupper($_SESSION ['admin_lastname'])  ?>
               </h3> 
               <!--END h3-->
               <hr>
               <h6 class="theme-color lead">System Administrator</h6>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-avatar">
             <?php
             include_once 'db_conn.php';  
             $sesid = $_SESSION['admin_id'];
             
             $sql = "SELECT * FROM tb_adminuser WHERE admin_id = '".$sesid."' ";

             $query = $conn->query($sql);

             while($row = $query->fetch_assoc()) {
              $image = (!empty($row['admin_picture'])) ? 'uploads/'.$row['admin_picture'] : 'uploads/adminprofile.png';
              echo "<img class='img-profile rounded-circle' height='130px' src='".$image."' class='user-image' alt='User Image'> ";
            }
            ?>
          </div>
        </div>
      </div>
    </sections>
  </header>
  <BR/>
  
  <!-- DATA TABLES -->
  <div class="card shadow mb-4" id="adminsettings">
    <div class="card-header py-3">

      <!--MODAL FORM OF ADD ADMIN-->
      
      <br>
      <button type='button' class='btn btn-primary float-right' class='dropdown-item'  data-toggle='modal' data-target='#AddAdminModal'>
        + Add Administrator
      </button> 

        <!--ADD ADMIN MODAL-->
       <div class="modal fade" id="AddAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content bg-light">
          <div class="modal-header bg-c-blue">
          <h5 class="modal-title text-light" id="exampleModalLabel">Add Administrator</h5>
          <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
          </div>
           
            <!--MODAL BODY-->
            <div class="modal-body text-dark">
      
              <form action="admin_add.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="adminlastname">Last Name</label>
                  <input name="adminid" type="hidden" value="">
                  <input type="text" name="adminlastname" class="form-control" placeholder="Enter Last Name" required>
                </div>
                <div class="form-group">
                  <label>First Name</label>
                  <input name="adminid" type="hidden" value="">
                  <input type="text" name="adminfirstname" class="form-control" placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                  <label>Middle Name</label>
                  <input name="adminid" type="hidden" value="">
                  <input type="text" name="adminmiddlename" class="form-control" placeholder="Enter Middle Name" required>
                </div>

                <!--RADIO BUTTON-->
                <fieldset class="form-group">
                  <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Male">
                        <label class="form-check-label" for="gridRadios1">
                         Male
                       </label>
                     </div>
                     <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Female">
                      <label class="form-check-label" for="gridRadios2">
                        Female
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="Others">
                      <label class="form-check-label" for="gridRadios3">
                       Others
                     </label>
                   </div>
                 </div>
               </div>
             </fieldset>
             <!--END RADIO BUTTON-->

             <!--DATE-->
             <!--PHP CODE FOR DATE db_conn.php-->
             <?php
             if(isset($_SESSION['status'])){
              echo "<h5>".$_SESSION['status']."</h5>";
              unset($_SESSION['status']);
            }
            ?>

            <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
              <label for="example">Birthdate</label>
              <input placeholder="Select date" type="date" name="adminbirthdate" id="example" class="form-control" required>
              <br>
            </div>
            <!--END DATE-->

            <div class="form-group">
              <label>Address</label>
              <input type="text" name="adminaddress" class="form-control" placeholder="Enter Address" required>
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="email" id="adminemail" name="adminemail" class="form-control" placeholder="Enter Email" required>
            </div>

            <div class="form-group">
              <label>Add Username</label>
              <input type="text" id="adminusername" name="adminusername" class="form-control" placeholder="Enter Username" required> 
            </div>
            
            <div class="card-text form-group text-primary bg-light">
              <small><b>Note: Password must meet the following requirements:</b></small><br>
              <small>&#8226; Minimum of <b>8 characters</b></small><br>
              <small>&#8226; Must contain at least one <b>digit (0-9)</b></small><br>
              <small>&#8226; Must contain at least one <b>uppercase letter (A-Z)</b></small><br>
              <small>&#8226; Must contain at least one <b>lowercase letter (a-z)</b></small>
            </div>

            <div class="form-group">
              <label for="pwd">Add Password</label>
              <div class="input-group" id="show_hide_password">
                <input type="password" required class="form-control" id="adminpassword" name="adminpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type Password">
              </div>
            </div>

            <div class="form-group">
              <label for="pwd">Confirm Password</label>
              <div class="input-group" id="show_hide_password">
                <input type="password" required class="form-control" id="adminconfirmpassword" name="adminconfirmpassword" placeholder="Confirm Password">
              </div>
              <div class="form-group">
                <input class="mt-3 ml-1" type="checkbox" onclick="myFunction()"><small> Show Password </small>
                <div class="float-right mt-3 small" id="CheckPasswordMatch"></div>
              </div>
            </div>
            <label class="form-label" for="customFile">Upload Profile Picture</label>
            <input type="file" name="adminpicture"  id="customFile" accept="image/gif, image/jpeg, image/png"  required/>
            
          </div>
          <!--END MODAL BODY-->

          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" name="add_btn" id="add_btn" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div></div>
    <!-- END ADD ADMIN MODAL-->

    <div class='id="settings"'></div>
    <h6 class="m-0 font-weight-bold text-primary">List of System Administrators</h6>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
           <!--PRIMARY INFORMATION-->
           <th style="display:none;">ID</th>
           <th>Username</th>
           <th style="display:none;">Password</th>
           <th>Photo</th>
           <th>Lastname</th>
           <th>Firstname</th>
           <th>Middlename</th>
           <th>Gender</th>
           <th>Birthday</th>
           <th>Address</th>
           <th>Email</th>
           <th>Status</th>
           <th>Actions</th>
         </tr>
       </thead>
     <tbody>
       <?php
       $sql = "SELECT * FROM tb_adminuser";
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
        </td>

        <td>".$row['admin_lastname']."</td>
        <td>".$row['admin_firstname']."</td>
        <td>".$row['admin_middlename']."</td>
        <td>".$row['admin_gender']."</td>
        <td>".$row['admin_birthday']."</td>
        <td>".$row['admin_address']."</td>
        <td>".$row['admin_email']."</td>
        <td><small><kbd class='text-capitalize value-status'>".$row['admin_status']."</kbd></small></td>
        <td>
        <div class='dropdown'>
        <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Manage
        </button>
        <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />

        <a  data-toggle='modal' data-target='#EditAdminModal0'></a>
        <button class='dropdown-item edit0' type='button'><i class='fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400'></i>Settings and privacy</button>

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

<?php
include('includes/footer.php');
?>

<?php 
//CALL EDIT ADMIN MODAL
include ('admin_updatemodal.php');
?>

<script type="text/javascript"> 
//FETCH FOR SETTINGS AND PRIVACY
$(function(){
  $(document).on('click', '.edit0', function(e){
    e.preventDefault();
    
    $('#EditAdminModal0').modal('show');
    $tablerow = $(this).closest('tr');

    var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);
    
    $('#admin_SPid').val(data[0]);
    $('#admin_SPusername').val(data[1]);
        
    });
});
//END - FETCH FOR SETTINGS AND PRIVACY
</script>

<!--SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
  function checkPasswordMatch() {
  	var password = $("#adminpassword").val();
  	var confirmPassword = $("#adminconfirmpassword").val();
  	if (password != confirmPassword)
    	$("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
  	else
    	$("#CheckPasswordMatch").html("Password match !").css("color", "green");
	}

	$(document).ready(function() {
  	$("#adminpassword, #adminconfirmpassword").on('keyup', function() {
    	checkPasswordMatch();
  		});
	});

</script>
<!--END SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunction() {
    var x = document.getElementById("adminpassword");
    var y = document.getElementById("adminconfirmpassword");
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

<!--SCRIPT FOR SYSTEM ADMINISTRATOR STATUS-->
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    $( ".value-status:contains('Active')" ).attr('style', 'background-color:#32CD32', 'color:#FFFFFF'); 
    $( ".value-status:contains('Deactivated')" ).attr('style', 'background-color:#C41E3A', 'color:#FFFFFF'); 
});
</script>
<!--END SCRIPT FOR SYSTEM ADMINISTRATOR STATUS-->

