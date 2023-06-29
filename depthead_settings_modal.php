<!-- EDIT MODAL FOR DEPARTMENT HEAD
  
<div class="modal fade" id="EditDeptHeadSettingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Account</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      
      <div class="modal-body">
        
       <form action="depthead_settings_update.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" id="update_deptheadid"  name="update_deptheadid">

         <div class="form-group">
          <label>Last Name</label>
          <input name="editstudentid" type="hidden" value="">
          <input type="text" id="edit_deptheadlastname" name="edit_deptheadlastname" class="form-control" required>
        </div>
        <div class="form-group">
          <label>First Name</label>
          <input name="editdeptheadid" type="hidden" value="">
          <input type="text" id="edit_deptheadfirstname" name="edit_deptheadfirstname" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input name="editdeptheadid" type="hidden" value="">
          <input type="text" id="edit_deptheadmiddlename" name="edit_deptheadmiddlename" class="form-control" required>
        </div>
        
      </div>
   

      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update_deptheadsettings_btn" class="btn btn-success">Update Data</button>
      </div>
    </form>
  </div>
</div>
</div>

END EDIT MODAL FOR DEPARTMENT HEAD-->

<!--UPDATE PHOTO-->
<div class="modal fade" id="EditDeptHeadSettingsPhotoModal">
  <div class="modal-dialog">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Photo</h5>
        <button type="button text-light" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="depthead_settings_update_photo.php" enctype="multipart/form-data">
           <input type="hidden" name="dhs_pid" id="dhs_pid">
           <div class="form-group">
            <div class="col-sm-9">
              <input type="file" id="dhs_pphoto" name="dhs_pphoto" accept="image/gif, image/jpeg, image/png" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-success btn-flat" name="depthead_settings_uploadphoto_btn"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--END UPDATE PHOTO-->

<!--STUDENT MODAL SECURITY AND LOG IN-->
<div class="modal fade" id="EditDeptHeadModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">

      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Department Head Password</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body text-dark"> 
        <form action="depthead_settings_update_password.php" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="dhead_sid" id="dhead_sid">

          <div class="card-text form-group text-dark">
            <small><b>Note: For security, you must first enter your current password.</b></small>
          </div>

          <div class="form-group">
            <label>Current Password</label>
            <input type="password" id="dhs_oldpass" name="dhs_oldpass" placeholder="Type current password" class="form-control" required>
          </div>

          <!-- DIVIDER -->
          <hr class="sidebar-divider">

          <div class="form-group">
           <input type="hidden" id="dhs_fname" name="dhs_fname" class="form-control" readonly>
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
            <input type="password" required class="form-control" id="dhs_newpass" name="dhs_newpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type New Password">
          </div>
        </div>

        <div class="form-group">
          <label for="pwd">Confirm New Password</label>
          <div class="input-group" id="show_hide_password">
            <input type="password" required class="form-control" id="dhs_repass" name="dhs_repass" placeholder="Confirm New Password">&nbsp;&nbsp;
          </div>
          <div class="form-group">
            <input class="mt-3 ml-1" type="checkbox" onclick="myFunction()"><small> Show Password </small>
            <div class="float-right mt-3 small" id="CheckPasswordMatchDH3"></div>
          </div>
        </div>
    </div>
    <!--END MODAL BODY-->
    <div class="modal-footer">
      <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
      <button type="submit" name="btn_dhs_repassword" class="btn btn-success">Update Data</button>
    </div>
  </form>
</div> 
</div>
</div>
<!--END STUDENT MODAL SECURITY AND LOG IN-->

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunction() {
    var x = document.getElementById("dhs_newpass");
    var y = document.getElementById("dhs_repass");
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

