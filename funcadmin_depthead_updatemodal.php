 <!--EDIT MODAL FOR DEPARTMENT HEAD-->
 <div class="modal fade" id="EditDeptHeadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Research Coordinator</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">
        <!--FORM ACTION dito nakalagay yung connection ng admin_signup.php tsakaya yung na METHOD="POST"-->
        <form action="funcadmin_depthead_update.php" method="POST" enctype="multipart/form-data">

         <input type="hidden" id="update_deptheadid"  name="update_deptheadid">

         <div class="form-group">
          <label for="edit_deptselect">Department</label>
          <select id="edit_deptselect" name="edit_deptselect" class="container selectpicker d-flex p-2 form-select">
            <option value="School of Computer Studies">School of Computer Studies</option>
            <option value="School of Education">School of Education</option>
            <option value="School of Business Management">School of Business Management</option>
            <option value="School of Hospitality and Tourism Management">School of Hospitality and Tourism Management</option>
            <option value="School of Arts and Science">School of Arts and Science</option>
          </select>
        </div>

        <div class="form-group">
          <label for="adminlastname">Last Name</label>
          <input name="editdeptheadid" type="hidden" value="">
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
      <!--END MODAL BODY-->

      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update_depthead_btn" class="btn btn-success">Update Data</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- END EDIT MODAL FOR DEPARTMENT HEAD-->

<!-- EDIT DEPARTMENT HEAD USERNAME -->
 <div class="modal fade" id="EditDeptHeadModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Department Head Username</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">

        <form action="funcadmin_depthead_update_username.php" method="POST" enctype="multipart/form-data">

         <input type="hidden" name="update_deptheaduid" id="update_deptheaduid">

        <div class="form-group">
          <label>Username</label>
          <input type="text" name="edit_deptheadusername" id="edit_deptheadusername" class="form-control" required>
        </div>
        
      </div>
      <!--END MODAL BODY-->
      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" id="update_depthead_username_btn" name="update_depthead_username_btn" class="btn btn-success">Update Data</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- END EDIT DEPARTMENT HEAD'S USERNAME -->

<!--UPDATE PHOTO-->
<div class="modal fade" id="EditDeptHeadPhotoModal">
  <div class="modal-dialog">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Research Coordinator Photo</h5>
        <button type="button text-light" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="funcadmin_depthead_updatephoto.php" enctype="multipart/form-data">
           <input type="hidden" name="depthead_pid" id="depthead_pid">
           <div class="form-group">
            <div class="col-sm-9">
              <input type="file" id="depthead_pphoto" name="depthead_pphoto" accept="image/gif, image/jpeg, image/png" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-success btn-flat" name="dh_uploadphoto_btn"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--END UPDATE PHOTO-->

<!--DEPTHEAD MODAL SECURITY AND LOG IN-->
<div class="modal fade" id="EditDeptHeadModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">

      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Research Coordinators Settings and Privacy</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body text-dark"> 
        <form action="funcadmin_depthead_updatepassword.php" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="depthead_sid" id="depthead_sid">

          <div class="form-group">
            <input type="hidden" id="depthead_uname" name="depthead_uname" class="form-control" readonly>
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
            <input type="password" required class="form-control" id="depthead_newpass" name="depthead_newpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type New Password">
          </div>
        </div>

        <div class="form-group">
          <label for="pwd">Confirm New Password</label>
          <div class="input-group" id="show_hide_password">
           <input type="password" required class="form-control" id="depthead_repass" name="depthead_repass" placeholder="Confirm New Password">
          </div>
          <div class="form-group">
            <input class="mt-3 ml-1" type="checkbox" onclick="myFunctionDeptHeadUPass()"><small> Show Password </small>
            <div class="float-right mt-3 small" id="CheckPasswordMatchDH2"></div>
          </div>
      </div>
    </div>
    <!--END MODAL BODY-->
    <div class="modal-footer">
      <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
      <button type="submit" name="btn_depthead_repassword" class="btn btn-success">Update Data</button>
    </div>
  </form>
</div> 
</div>
</div>
<!--END DEPTHEAD MODAL SECURITY AND LOG IN-->

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunctionDeptHeadUPass() {
    var x = document.getElementById("depthead_newpass");
    var y = document.getElementById("depthead_repass");
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

