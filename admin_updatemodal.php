
<!--MODAL SETTINGS AND PRIVACY-->
<div class="modal fade" id="EditAdminModal0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">

      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Account Information</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body text-dark"> 
        <form action="admin_upd_spconfirm.php" method="POST" enctype="multipart/form-data">
         <h5><b>Confirm your password</b></h5>
         <div class="card-text form-group text-dark">
           <small><b>Note: Please enter your password in order to get this.</b></small>
         </div>
         
         <input type="hidden" name="admin_SPid" id="admin_SPid">
         <input type="hidden" name="admin_SPusername" id="admin_SPusername">

         <div class="form-group">
           <label>Password :</label>
           <input type="password" id="admin_SPpass" name="admin_SPpass" placeholder="Type Current Password" class="form-control" >
         </div>

      </div>
      <!--END MODAL BODY-->

      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" name="btn_setting_privacy" class="btn btn-success">Confirm</button>
      </div>

  </form>
</div> 
</div>
</div>
<!--END MODAL SETTINGS AND PRIVACY-->

 <!-- EDIT MODAL ADMINISTRATOR SETTINGS-->
 <div class="modal fade" id="EditAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Administrator Settings</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">
        <!--FORM ACTION dito nakalagay yung connection ng admin_signup.php tsakaya yung na METHOD="POST"-->
        <form action="admin_updategeneralsettings.php" method="POST" enctype="multipart/form-data">

         <input type="hidden" name="update_adminid" id="update_adminid">

         <div class="form-group">
          <label for="adminlastname">Last Name</label>
          <input name="edit_adminid" type="hidden" value="">
          <input type="text" id="edit_adminlastname" name="edit_adminlastname" class="form-control" required>
        </div>
        <div class="form-group">
          <label>First Name</label>
          <input name="adminid" type="hidden" value="">
          <input type="text" id="edit_adminfirstname" name="edit_adminfirstname" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input name="adminid" type="hidden" value="">
          <input type="text" id="edit_adminmiddlename" name="edit_adminmiddlename" class="form-control" required>
        </div>

        <!--RADIO BUTTON-->
        <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="edit_gridradios" id="edit_gridradios1" value="Male">
                <label class="form-check-label" for="gridRadios">
                  Male
                </label>
                
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="edit_gridradios" id="edit_gridradios2" value="Female">
                <label class="form-check-label" for="gridRadios">
                  Female
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="edit_gridradios" id="edit_gridradios3" value="Others">
                <label class="form-check-label" for="gridRadios">
                  Others
                </label>
              </div>
            </div>
          </div>
        </fieldset>
        <!--END RADIO BUTTON-->

        <!--DATE-->
        <!--PHP CODE PARA SA DATE YUNG KAPARES NETO NASA db_conn.php-->
        <?php
        if(isset($_SESSION['status'])){
          echo "<h5>".$_SESSION['status']."</h5>";
          unset($_SESSION['status']);
        }

        ?>

        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
          <label for="example">Birthdate</label>
          <input placeholder="Select date" type="date" name="edit_adminbirthdate" id="edit_adminbirthdate" class="form-control" required>
          <br>
        </div>

        <!--END DATE-->

        <div class="form-group">
          <label>Address</label>
          <input type="text" name="edit_adminaddress" id="edit_adminaddress" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="edit_adminemail" id="edit_adminemail" class="form-control" required>
        </div>

      </div>
      <!--END MODAL BODY-->
      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update_btn" class="btn btn-success">Update Data</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- END EDIT MODAL ADMINISTRATOR'S SETTINGS -->


<!-- EDIT ADMINISTRATOR USERNAME -->
 <div class="modal fade" id="EditAdminModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Account Username</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">

        <form action="admin_updateusername.php" method="POST" enctype="multipart/form-data">

         <input type="hidden" name="update_adminuid" id="update_adminuid">

        <div class="form-group">
          <label>Username</label>
          <input type="text" name="edit_adminusername" id="edit_adminusername" class="form-control" required>
        </div>
        
      </div>
      <!--END MODAL BODY-->
      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" id="update_username_btn" name="update_username_btn" class="btn btn-success">Update Data</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- END EDIT ADMINISTRATOR'S USERNAME -->


<!-- UPDATE PHOTO -->
<div class="modal fade" id="EditAdminPhotoModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Administrator's Photo</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="admin_updatephoto.php" enctype="multipart/form-data">
           <input type="hidden" name="admin_pid" id="admin_pid">
           <div class="form-group">
            <div class="col-sm-9">
              <input type="file" id="admin_pphoto" name="admin_pphoto" accept="image/gif, image/jpeg, image/png" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-success btn-flat" name="uploadphoto_btn"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--END UPDATE PHOTO-->

<!--MODAL SECURITY AND LOG IN-->
<div class="modal fade" id="EditAdminModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">

      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Administrator's Password</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body text-dark"> 
        <form action="admin_updatepassword.php" method="POST" enctype="multipart/form-data">

         <input type="hidden" name="admin_sid" id="admin_sid">

         <div class="card-text form-group text-dark">
           <small><b>Note: To ensure security, you must first enter the current password of this administrator.</b></small>
         </div>

         <div class="form-group">
           <label>Current Password</label>
           <input type="password" id="admin_oldpass" name="admin_oldpass" placeholder="Type Current Password" class="form-control" required>
         </div>

         <!-- Divider -->
         <hr class="sidebar-divider">

         <div class="form-group">
           <input type="hidden" id="admin_uname" name="admin_uname" class="form-control" readonly>
         </div>

         <div class="card-text form-group text-primary bg-light">
          <small><b>Note: New Password must meet the following requirements:</b></small><br>
          <small>&#8226; Minimum of <b>8 characters</b></small><br>
          <small>&#8226; Must contain at least one <b>digit (0-9)</b></small><br>
          <small>&#8226; Must contain at least one <b>uppercase letter (A-Z)</b></small><br>
          <small>&#8226; Must contain at least one <b>lowercase letter (a-z)</b></small>
        </div>

        <div class="form-group">
          <label for="pwd">New Password</label>
          <div class="input-group" id="show_hide_password">
            <input type="password" required class="form-control" id="admin_newpass" name="admin_newpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type New Password">
          </div>
        </div>

        <div class="form-group">
          <label for="pwd">Confirm New Password</label>
          <div class="input-group" id="show_hide_password">
           <input type="password" required class="form-control" id="admin_repass" name="admin_repass" placeholder="Confirm New Password">
          </div>
          <div class="form-group">
            <input class="mt-3 ml-1" type="checkbox" onclick="myFunctionPass()"><small> Show Password </small>
            <div class="float-right small mt-3" id="CheckPasswordMatch1"></div>
          </div>
      </div>
    </div>
    <!--END MODAL BODY-->
    <div class="modal-footer">
      <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
      <button type="submit" name="btn_repassword" class="btn btn-success">Update Data</button>
    </div>
  </form>
</div> 
</div>
</div>
<!--END MODAL SECURITY AND LOG IN-->
  
<!--SCRIPT FOR PASSWORD VALIDATION (8 CHARACTERS, UPPERCASES, LOWERCASES, NUMBERS)-->                
<script>
// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
<!--END SCRIPT FOR PASSWORD VALIDATION (8 CHARACTERS, UPPERCASES, LOWERCASES, NUMBERS)-->    


