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
    header('Location: /cctrepositorysystem/librarianprofile.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'db_conn.php';
?>

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Librarian Profile Information <small class="h5 mb-4 text-gray-500">manage librarian profile information</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Librarian Profile</p></small>
  </div>

   <!-- DATA TABLES -->
   <div class="card shadow mb-4" id="librariansettings">
    <div class="card-header py-3">
      <!--MODAL FORM OF ADD ADMIN-->
      <br>
      <button type="button" class="btn btn-primary float-right" class="dropdown-item" href="" data-toggle="modal" data-target="#AddLibrarianModal">
      + Add Librarian</button>

      <!-- ADD RESEARCH HEAD -->
      <div class="modal fade" id="AddLibrarianModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content bg-light">
            <div class="modal-header bg-c-blue">
              <h5 class="modal-title text-light" id="exampleModalLabel">Add Librarian</h5>
              <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

            <!--MODAL BODY-->
            <div class="modal-body text-dark">

              <form action="funcadmin_librarian_add.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="librarianlastname">Last Name</label>
                  <input type="text" name="librarianlastname" class="form-control" placeholder="Enter Last Name" required>
                </div>

                <div class="form-group">
                  <label>First Name</label>              
                  <input type="text" name="librarianfirstname" class="form-control" placeholder="Enter First Name" required>
                </div>

                <div class="form-group">
                  <label>Middle Name</label>
                  <input type="text" name="librarianmiddlename" class="form-control" placeholder="Enter Middle Name" required>
                </div>

                <div class="form-group">
                  <label>Add Username</label>
                  <input type="text" name="librarianusername" class="form-control" placeholder="Enter Username" required>
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
                   <input type="password" required class="form-control" id="librarianpassword" name="librarianpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type Password">
                 </div>
               </div>

               <div class="form-group">
                 <label for="pwd">Confirm Password</label>
                 <div class="input-group" id="show_hide_password">
                   <input type="password" required class="form-control" id="librarianconfirmpassword" name="librarianconfirmpassword" placeholder="Confirm Password">
                 </div>
                 <div class="form-group">
                   <input class="mt-3 ml-1" type="checkbox" onclick="myFunctionLibrarianPass()"><small> Show Password </small>
                   <div class="float-right mt-3 small" id="LBCheckPasswordMatch"></div>
                 </div>
               </div>
               
               <label class="form-label" for="customFile">Upload Profile Picture</label>
               <input type="file" name="librarianpicture"  id="customFile" accept="image/gif, image/jpeg, image/png" required/>
               
             </div>
             <!--END MODAL BODY-->

             <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" name="add_librarian_btn" class="btn btn-primary">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END RESEARCH HEAD MODAL -->

    
    <div class='id="settings"'></div>
    <h6 class="m-0 font-weight-bold text-primary">Librarian Settings&nbsp;&nbsp;
    </div> <!-- END OF MAIN CONTENT -->

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
             <!--PRIMARY INFORMATION-->
             <th style="display:none;">ID</th>
             <th>Username</th>
             <th style="display:none;">Password</th>
             <th>Picture</th>
             <th>Lastname</th>
             <th>Firstname</th>
             <th>Middlename</th>   
             <th>Status</th>          
             <th>Settings</th>
             <!--END PRIMARY INFORMATION-->
           </tr>
         </thead>
         <tfoot>
          <tr>
            <!--PRIMARY INFORMATION-->
            <th style="display:none;">ID</th>
            <th>Username</th>
            <th style="display:none;">Password</th>
            <th>Picture</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Status</th>               
            <th>Settings</th>     
            <!--END PRIMARY INFORMATION-->
          </tr>
        </tfoot>
        <tbody>
         <?php
         //preg_replace("|.|","*",$row['reshead_pword'])
         $sql = "SELECT * FROM tb_librarian WHERE librarian_status = 'Active' ";
         $query = $conn->query($sql);

         while($row = $query->fetch_assoc()){
          $image = (!empty($row['librarian_picture'])) ? 'uploads/'.$row['librarian_picture'] : 'uploads/adminprofile.png';

          echo "
          <tr>
          <td style='display:none;'>".$row['librarian_id']."</td>
          <td>".$row['librarian_uname']."</td>
          <td style='display:none;' class='small w-100 text-monospace small'>".$row['librarian_pword']."</td>
          <td>
          <img src='".$image."' width='50px' height='50px'>
          <a data-target='#EditLibrarianPhotoModal' class='pull-right text-primary editlbphoto' data-id='".$row['librarian_id']."'><span class='fa fa-edit'></span></a>
          </td>
          <td>".$row['librarian_lname']."</td>
          <td>".$row['librarian_fname']."</td>
          <td>".$row['librarian_mname']."</td>
          <td><kbd class='text-capitalize status-posted'>".$row['librarian_status']."</kbd></td>
          <td>
          <div class='dropdown'>
          <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
          Manage
          </button>
          <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />

          <a  data-toggle='modal' data-target='#EditLibrarianModal'></a>
          <button class='dropdown-item editLB001' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>General Settings</button>

          <a  data-toggle='modal' data-target='#EditLibrarianModal2'></a>
          <button class='dropdown-item editLB003' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>Edit Username</button>

          <a  data-toggle='modal' data-target='#EditLibrarianModal1'></a>
          <button class='dropdown-item editLB002' type='button'><i class='fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>

          <form action='librarianprofile.php' method='POST'>
          <input type='hidden' name='archiveprofileidLibrarian' value='".$row['librarian_id']."' />
          <button class='dropdown-item' type='submit' name='ArchivedProfileLibrarian' value='Archived'><i class='fas fa-archive fa-sm fa-fw mr-2 text-gray-400'></i>Move to Archive</button>
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
    <a href="librarianprofilearchive.php">
      <small style="float:right;"><i class="fa fa-archive"></i>&nbsp;Archives</small>
    </a>
</div>

</div>
</div>
<!-- /.END CONTAINER FLUID -->

<?php
include('includes/footer.php');
?>

<?php 
//DITO PARA MATAWAG NATIN YUNG MODAL NI EDIT LIBRARIAN
include ('funcadmin_librarian_updatemodal.php');
?>

<?php
//PHP FUNCTION FOR ARCHIVING PROFILE 
if (isset($_POST['ArchivedProfileLibrarian'])) {
  $sid = $_POST['archiveprofileidLibrarian'];

  $select = "UPDATE tb_librarian SET librarian_status = 'Archived' WHERE librarian_id = '$sid' ";
  $result = mysqli_query($conn,$select);

  echo "<script> alert('Succesfully moved to Archive!'); window.location='librarianprofile.php?status=Archived' </script>"; 

}
//END PHP FUNCTION FOR ARCHIVING PROFILE
?>

<script>
//FETCH FOR EDIT LIBRARIAN
$(document).ready(function(){
  $('.editLB001').on('click',function(){
    
   $('#EditLibrarianModal').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);

          $('#update_librarianid').val(data[0]);
          $('#edit_librarianlastname').val(data[4]);
          $('#edit_librarianfirstname').val(data[5]);
          $('#edit_librarianmiddlename').val(data[6]);
          $('#edit_librarianusername').val(data[1]);
          
        });
});
//END -  FOR EDIT LIBRARIAN

//FETCH FOR EDIT LIBRARIAN USERNAME
$(document).ready(function(){
  $('.editLB003').on('click',function(){
    
   $('#EditLibrarianModal2').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);

      $('#update_librarianuid').val(data[0]);
      $('#edit_librarianusername').val(data[1]);
          
  });
});
//END -  FOR EDIT LIBRARIAN USERNAME

//JUST COPIED - FETCH FOR LIBRARIAN SECURITY AND LOG IN
$(document).ready(function(){
  $('.editLB002').on('click',function(){
    
   $('#EditLibrarianModal1').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);
   
   $('#librarian_sid').val(data[0]);
   $('#librarian_uname').val(data[1]);
   $('#librarian_oldpass').val(data[2]);

 });
});
//END - JUST COPIED - FETCH FOR LIBRARIAN SECURITY AND LOG IN
</script>

<!--ADD PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script type="text/javascript">
 function ADDLBcheckPasswordMatch() {
  var ADDLBpassword = $("#librarianpassword").val();
  var ADDLBconfirmPassword = $("#librarianconfirmpassword").val();
  if (ADDLBpassword != ADDLBconfirmPassword) {
    $("#LBCheckPasswordMatch").html("Password does not match!").css("color", "red");
  } else {
    $("#LBCheckPasswordMatch").html("Password match!").css("color", "green");
  }
}

$(document).ready(function() {
  $("#librarianpassword, #librarianconfirmpassword").on('keyup', function() {
    ADDLBcheckPasswordMatch();
  });
});
</script>
<!--END ADD PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->

<!--EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script type="text/javascript">
  function EDITLBcheckPasswordMatch() {
    var EDITLBpassword = $("#librarian_newpass").val();
    var EDITLBconfirmPassword = $("#librarian_repass").val();
    if (EDITLBpassword != EDITLBconfirmPassword) {
      $("#CheckPasswordMatch001").html("Password does not match!").css("color", "red");
    } else {
      $("#CheckPasswordMatch001").html("Password match!").css("color", "green");
    }
  }

  $(document).ready(function() {
    $("#librarian_newpass, #librarian_repass").on('keyup', function() {
      EDITLBcheckPasswordMatch();
    });
  });
</script>
<!--END EDIT - SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->

<!--SCRIPT FOR FETCHING DEPT HEAD PICTURE-->
<script type="text/javascript">
  $(document).ready(function(){
    $('.editlbphoto').on('click',function(){
      
     $('#EditLibrarianPhotoModal').modal('show');

     $tablerow = $(this).closest('tr');

     var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

     console.log(data);
     
     $('#librarian_pid').val(data[0]);
     $('#librarian_pphoto').val(data[3]);
     
   });
  });
</script>
<!--END SCRIPT FOR FETCHING DEPT HEAD PICTURE-->

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunctionLibrarianPass() {
    var x = document.getElementById("librarianpassword");
    var y = document.getElementById("librarianconfirmpassword");
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

