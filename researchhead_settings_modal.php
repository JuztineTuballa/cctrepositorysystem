<!--UPDATE PHOTO-->
<div class="modal fade" id="EditResHeadPhotoModal1">
  <div class="modal-dialog">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Research Head Photo</h5>
        <button type="button text-light" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="researchhead_update_photo.php" enctype="multipart/form-data">
           <input type="hidden" name="reshead_pid1" id="reshead_pid1">
           <div class="form-group">
            <div class="col-sm-9">
              <input type="file" id="reshead_pphoto1" name="reshead_pphoto1" accept="image/gif, image/jpeg, image/png" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-success btn-flat" name="rh_uploadphoto_btn1"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--END UPDATE PHOTO-->

<!--DEPTHEAD MODAL SECURITY AND LOG IN-->
<div class="modal fade" id="EditResearchHeadModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">

      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Research Head Password</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body text-dark"> 
        <form action="researchhead_update_password.php" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="reshead_sid1" id="reshead_sid1">

          <div class="card-text form-group text-dark">
            <small><b>Note: For security, you must first enter your current password.</b></small>
          </div>

          <div class="form-group">
            <label>Current Password</label>
            <input type="password" required id="reshead_oldpass1" name="reshead_oldpass1" placeholder="Type Current Password" class="form-control">
          </div>

          <!-- DIVIDER -->
          <hr class="sidebar-divider">

          <div class="form-group">
           <input type="hidden" id="reshead_uname1" name="reshead_uname1" class="form-control" readonly>
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
            <input type="password" required class="form-control" id="reshead_newpass1" name="reshead_newpass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type New Password">
          </div>
        </div>

        <div class="form-group">
          <label for="pwd">Confirm New Password</label>
          <div class="input-group" id="show_hide_password">
           <input type="password" required class="form-control" id="reshead_repass1" name="reshead_repass1" placeholder="Confirm New Password">
          </div>
          <div class="form-group">
            <input class="mt-3 ml-1" type="checkbox" onclick="myFunctionResearchHeadUPass()"><small> Show Password </small>
            <div class="float-right mt-3 small" id="CheckPasswordMatchRH3"></div>
          </div>
      </div>
    </div>
    <!--END MODAL BODY-->
    <div class="modal-footer">
      <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
      <button type="submit" name="btn_reshead_repassword1" class="btn btn-success">Update Data</button>
    </div>
  </form>
</div> 
</div>
</div>
<!--END DEPTHEAD MODAL SECURITY AND LOG IN-->


<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunctionResearchHeadUPass() {
    var x = document.getElementById("reshead_newpass1");
    var y = document.getElementById("reshead_repass1");
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

