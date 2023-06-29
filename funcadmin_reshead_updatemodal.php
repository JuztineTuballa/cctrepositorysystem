<!--EDIT MODAL FOR RESEARCH HEAD-->
<div class="modal fade" id="EditResHeadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Research Head Information</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">
        <!--FORM ACTION dito nakalagay yung connection ng admin_signup.php tsakaya yung na METHOD="POST"-->
        <form action="funcadmin_reshead_update.php" method="POST" enctype="multipart/form-data">

         <input type="hidden" id="update_resheadid"  name="update_resheadid">

         <div class="form-group">
          <label for="resheadlastname">Last Name</label>
          <input name="editdeptheadid" type="hidden" value="">
          <input type="text" id="edit_resheadlastname" name="edit_resheadlastname" class="form-control" required>
        </div>
        <div class="form-group">
          <label>First Name</label>
          <input name="editdeptheadid" type="hidden" value="">
          <input type="text" id="edit_resheadfirstname" name="edit_resheadfirstname" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input name="editdeptheadid" type="hidden" value="">
          <input type="text" id="edit_resheadmiddlename" name="edit_resheadmiddlename" class="form-control" required>
        </div>
        
      </div>
      <!--END MODAL BODY-->

      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update_reshead_btn" class="btn btn-success">Update Data</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- END EDIT MODAL FOR RESEARCH HEAD-->

<!-- EDIT RESEARCH HEAD USERNAME -->
 <div class="modal fade" id="EditResHeadModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Research Head Username</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">

        <form action="funcadmin_reshead_updateusername.php" method="POST" enctype="multipart/form-data">

         <input type="hidden" name="update_resheaduid" id="update_resheaduid">

        <div class="form-group">
          <label>Username</label>
          <input type="text" name="edit_resheadusername" id="edit_resheadusername" class="form-control" required>
        </div>
        
      </div>
      <!--END MODAL BODY-->
      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" id="update_reshead_username_btn" name="update_reshead_username_btn" class="btn btn-success">Update Data</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- END EDIT RESEARCH HEAD'S USERNAME -->

<!--UPDATE PHOTO-->
<div class="modal fade" id="EditResHeadPhotoModal">
  <div class="modal-dialog">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Research Head Photo</h5>
        <button type="button text-light" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="funcadmin_reshead_updatephoto.php" enctype="multipart/form-data">
           <input type="hidden" name="reshead_pid" id="reshead_pid">
           <div class="form-group">
            <div class="col-sm-9">
              <input type="file" id="reshead_pphoto" name="reshead_pphoto" accept="image/gif, image/jpeg, image/png" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-success btn-flat" name="rh_uploadphoto_btn"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--END UPDATE PHOTO-->

<!--DEPTHEAD MODAL SECURITY AND LOG IN-->
<div class="modal fade" id="EditResHeadModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <form action="funcadmin_reshead_updatepassword.php" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="reshead_sid" id="reshead_sid">

          <!-- <div class="form-group">
            <label>Current Password</label>
            <input type="password" id="reshead_oldpass" name="reshead_oldpass" placeholder="Type Current Password" class="form-control" readonly>
          </div> -->

          <!-- DIVIDER -->
          <!-- <hr class="sidebar-divider"> -->

          <div class="form-group">
           <input type="hidden" id="reshead_uname" name="reshead_uname" class="form-control" readonly>
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
            <input type="password" required class="form-control" id="reshead_newpass" name="reshead_newpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type New Password">
          </div>
        </div>

        <div class="form-group">
          <label for="pwd">Confirm New Password</label>
          <div class="input-group" id="show_hide_password">
           <input type="password" required class="form-control" id="reshead_repass" name="reshead_repass" placeholder="Confirm New Password">
          </div>
          <div class="form-group">
            <input class="mt-3 ml-1" type="checkbox" onclick="myFunctionResearchHeadUPass()"><small> Show Password </small>
            <div class="float-right mt-3 small" id="CheckPasswordMatch001"></div>
          </div>
      </div>
    </div>
    <!--END MODAL BODY-->
    <div class="modal-footer">
      <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
      <button type="submit" name="btn_reshead_repassword" class="btn btn-success">Update Data</button>
    </div>
  </form>
</div> 
</div>
</div>
<!--END DEPTHEAD MODAL SECURITY AND LOG IN-->

<!--SCRIPT FOR SHOWING HIDDEN PASSWORD-->    
<script>
  $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
      event.preventDefault();
      if($('#show_hide_password input').attr("type") == "text"){
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass( "fa-eye-slash" );
        $('#show_hide_password i').removeClass( "fa-eye" );
      } else if ($('#show_hide_password input').attr("type") == "password"){
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass( "fa-eye-slash" );
        $('#show_hide_password i').addClass( "fa-eye" );
      }
    });
  });
</script>
<!--END SCRIPT FOR SHOWING HIDDEN PASSWORD-->    
 
<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunctionResearchHeadUPass() {
    var x = document.getElementById("reshead_newpass");
    var y = document.getElementById("reshead_repass");
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

