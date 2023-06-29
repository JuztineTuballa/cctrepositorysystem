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
    header('Location: /cctrepositorysystem/researchheadprofile.php');
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
    <h1 class="h4 mb-0 text-gray-800">Research Head Profile Information <small class="h5 mb-4 text-gray-500">manage research head profile information</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Research Head Profile</p></small>
  </div>
   
   <!-- DATA TABLES -->
   <div class="card shadow mb-4" id="deptheadsettings">
    <div class="card-header py-3">
      <!--MODAL FORM OF ADD ADMIN-->
      <br>
      <button type="button" class="btn btn-primary float-right" class="dropdown-item" href="" data-toggle="modal" data-target="#AddResHeadModal">
      + Add Research Head</button>

      <!-- ADD RESEARCH HEAD -->
      <div class="modal fade" id="AddResHeadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content bg-light">
            <div class="modal-header bg-c-blue">
              <h5 class="modal-title text-light" id="exampleModalLabel">Add Research Head</h5>
              <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

            <!--MODAL BODY-->
            <div class="modal-body text-dark">
              <!--FORM ACTION dito nakalagay yung connection ng admin_signup.php tsakaya yung na METHOD="POST"-->
              <form action="funcadmin_reshead_add.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="resheadlastname">Last Name</label>
                  <input name="resheadid" type="hidden" value="">
                  <input type="text" name="resheadlastname" class="form-control" placeholder="Enter Last Name" required>
                </div>

                <div class="form-group">
                  <label>First Name</label>
                  <input name="resheadid" type="hidden" value="">
                  <input type="text" name="resheadfirstname" class="form-control" placeholder="Enter First Name" required>
                </div>

                <div class="form-group">
                  <label>Middle Name</label>
                  <input name="resheadid" type="hidden" value="">
                  <input type="text" name="resheadmiddlename" class="form-control" placeholder="Enter Middle Name" required>
                </div>

                <div class="form-group">
                  <label>Add Username</label>
                  <input type="text" name="resheadusername" class="form-control" placeholder="Enter Username" required>
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
                   <input type="password" required class="form-control" id="resheadpassword" name="resheadpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type Password">
                 </div>
               </div>

               <div class="form-group">
                 <label for="pwd">Confirm Password</label>
                 <div class="input-group" id="show_hide_password">
                   <input type="password" required class="form-control" id="resheadconfirmpassword" name="resheadconfirmpassword" placeholder="Confirm Password">
                 </div>
                 <div class="form-group">
                   <input class="mt-3 ml-1" type="checkbox" onclick="myFunctionResearchHeadPass()"><small> Show Password </small>
                   <div class="float-right mt-3 small" id="CheckPasswordMatch"></div>
                 </div>
               </div>
               
               <label class="form-label" for="customFile">Upload Profile Picture</label>
               <input type="file" name="resheadpicture"  id="customFile" accept="image/gif, image/jpeg, image/png" required/>
               
             </div>
             <!--END MODAL BODY-->

             <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" name="add_rh_btn" class="btn btn-primary">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END RESEARCH HEAD MODAL -->

    
    <div class='id="settings"'></div>
    <h6 class="m-0 font-weight-bold text-primary">Research Head Settings&nbsp;&nbsp;
      <!--<code class="text-secondary">|</code>&nbsp;&nbsp;
      <a href="researchheadprofilearchive.php" class="text-gray-700"><i class="fas fa-sign-in-alt fa-sm fa-fw mr-2"></i>View Archived Research Heads</a></h6>-->
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
         $sql = "SELECT * FROM tb_researchhead WHERE reshead_status = 'Active' ";
         $query = $conn->query($sql);

         while($row = $query->fetch_assoc()){
          $image = (!empty($row['reshead_picture'])) ? 'uploads/'.$row['reshead_picture'] : 'uploads/adminprofile.png';

          echo "
          <tr>
          <td style='display:none;'>".$row['reshead_id']."</td>
          <td>".$row['reshead_uname']."</td>
          <td style='display:none;' class='small w-100 text-monospace small'>".$row['reshead_pword']."</td>
          <td>
          <img src='".$image."' width='50px' height='50px'>
          <a data-target='#EditResHeadPhotoModal' class='pull-right text-primary editrhphoto' data-id='".$row['reshead_id']."'><span class='fa fa-edit'></span></a>
          </td>
          <td>".$row['reshead_lname']."</td>
          <td>".$row['reshead_fname']."</td>
          <td>".$row['reshead_mname']."</td>
          <td><kbd class='text-capitalize status-posted'>".$row['reshead_status']."</kbd></td>
          <td>
          <div class='dropdown'>
          <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
          Manage
          </button>
          <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />

          <a  data-toggle='modal' data-target='#EditResHeadModal'></a>
          <button class='dropdown-item edit001' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>General Settings</button>

          <a  data-toggle='modal' data-target='#EditResHeadModal2'></a>
          <button class='dropdown-item edit003' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>Edit Username</button>

          <a  data-toggle='modal' data-target='#EditResHeadModal1'></a>
          <button class='dropdown-item edit002' type='button'><i class='fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>

          <form action='researchheadprofile.php' method='POST'>
          <input type='hidden' name='archiveprofileidRH' value='".$row['reshead_id']."' />
          <button class='dropdown-item' type='submit' name='ArchivedProfileRH' value='Archived'><i class='fas fa-archive fa-sm fa-fw mr-2 text-gray-400'></i>Move to Archive</button>
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
  <a href="researchheadprofilearchive.php">
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
//DITO PARA MATAWAG NATIN YUNG MODAL NI EDIT ADMIN
include ('funcadmin_reshead_updatemodal.php');
?>

<?php
//PHP FUNCTION FOR ARCHIVING PROFILE 
if (isset($_POST['ArchivedProfileRH'])) {
  $sid = $_POST['archiveprofileidRH'];

  $select = "UPDATE tb_researchhead SET reshead_status = 'Archived' WHERE reshead_id = '$sid' ";
  $result = mysqli_query($conn,$select);

  echo "<script> alert('Succesfully moved to Archive!'); window.location='researchheadprofile.php?status=Archived' </script>"; 

}
//END PHP FUNCTION FOR ARCHIVING PROFILE
?>

<script>
//FETCH FOR EDIT RESEARCH HEAD
$(document).ready(function(){
  $('.edit001').on('click',function(){
    
   $('#EditResHeadModal').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);

          //yung array galing ito sa table na meron dito sa researchhead.php, yung una kasi nating pinalabas sa table ay yung ID, Username at Password and so on. Kaya ngayon naka array para yung data na ma fefetch sakto parin dun sa inputs nung modal sa funcadmin_reshead_updatemodal.php.

          //yung value naman na may #update_resheadid etc... galing ito sa id nung <input> dalawa yan yung isa name="" para sa php, tapos yung isa naman id="" para sa javascript

          $('#update_resheadid').val(data[0]);
          $('#edit_resheadlastname').val(data[4]);
          $('#edit_resheadfirstname').val(data[5]);
          $('#edit_resheadmiddlename').val(data[6]);
          $('#edit_resheadusername').val(data[1]);
          
        });
});
//END -  FOR EDIT RESEARCH HEAD


//FETCH FOR EDIT RESEARCH HEAD USERNAME
$(document).ready(function(){
  $('.edit003').on('click',function(){
    
   $('#EditResHeadModal2').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);

      $('#update_resheaduid').val(data[0]);
      $('#edit_resheadusername').val(data[1]);
          
  });
});
//END -  FOR EDIT RESEARCH HEAD USERNAME


//JUST COPIED - FETCH FOR RESEARCH HEAD SECURITY AND LOG IN
$(document).ready(function(){
  $('.edit002').on('click',function(){
    
   $('#EditResHeadModal1').modal('show');

   $tablerow = $(this).closest('tr');

   var data = $tablerow.children("td").map(function(){
    return $(this).text();
  }).get();

   console.log(data);
   
   $('#reshead_sid').val(data[0]);
   $('#reshead_uname').val(data[1]);
   $('#reshead_oldpass').val(data[2]);

 });
});
//END - JUST COPIED - FETCH FOR RESEARCH HEAD SECURITY AND LOG IN
</script>

 
<!--ADD - PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script type="text/javascript">
  function ADDcheckPasswordMatch() {
    var ADDpassword = $("#resheadpassword").val();
    var ADDconfirmPassword = $("#resheadconfirmpassword").val();
    if (ADDpassword !== ADDconfirmPassword) {
      $("#CheckPasswordMatch").html("Password does not match!").css("color", "red");
    } else {
      $("#CheckPasswordMatch").html("Password match!").css("color", "green");
    }
  }

  $(document).ready(function() {
    $("#resheadpassword, #resheadconfirmpassword").on('keyup', function() {
      ADDcheckPasswordMatch();
    });
  });

</script>
<!--END - ADD PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->


<!--EDIT - PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
  function EDITcheckPasswordMatch() {
    var password = $("#reshead_newpass").val();
    var confirmPassword = $("#reshead_repass").val();
    if (password != confirmPassword) {
      $("#CheckPasswordMatch001").html("Password does not match!").css("color", "red");
    } else {
      $("#CheckPasswordMatch001").html("Password match!").css("color", "green");
    }
  }

  $(document).ready(function() {
    $("#reshead_newpass, #reshead_repass").on('keyup', function() {
      EDITcheckPasswordMatch();
    });
  });

</script>
<!--END - EDIT PASSWORD - SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->


<!--SCRIPT FOR FETCHING DEPT HEAD PICTURE-->
<script type="text/javascript">
  $(document).ready(function(){
    $('.editrhphoto').on('click',function(){
      
     $('#EditResHeadPhotoModal').modal('show');

     $tablerow = $(this).closest('tr');

     var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

     console.log(data);
     
     $('#reshead_pid').val(data[0]);
     $('#reshead_pphoto').val(data[3]);
     
   });
  });
</script>
<!--END SCRIPT FOR FETCHING DEPT HEAD PICTURE-->

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunctionResearchHeadPass() {
    var x = document.getElementById("resheadpassword");
    var y = document.getElementById("resheadconfirmpassword");
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

