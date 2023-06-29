
<!--LIBRARIAN MODAL SECURITY AND LOG IN-->
<div class="modal fade" id="EditStudentSecurityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-light">

      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Student Password</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body text-dark"> 
        <form action="funcadmin_student_updatepassword.php" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="mystudent_ssid" id="mystudent_ssid">

         <div class="form-group">
           <input type="hidden" id="mystudent_studnum" name="mystudent_studnum" class="form-control" readonly>
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
            <input type="password" required class="form-control" id="mystudent_newpass" name="mystudent_newpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type New Password">
          </div>
        </div>

        <div class="form-group">
          <label for="pwd">Confirm New Password</label>
          <div class="input-group" id="show_hide_password">
           <input type="password" required class="form-control" id="mystudent_repass" name="mystudent_repass" placeholder="Confirm New Password">
          </div>
          <div class="form-group">
            <input class="mt-3 ml-1" type="checkbox" onclick="myFunctionMyStudentUPass()"><small> Show Password </small>
            <div class="float-right mt-3 small" id="CheckPasswordMatchSTUD1"></div>
          </div>
      </div>
    </div>
    <!--END MODAL BODY-->
    <div class="modal-footer">
      <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
      <button type="submit" name="btn_mystudent_repassword" class="btn btn-success">Update Data</button>
    </div>
  </form>
</div> 
</div>
</div>
<!--END DEPTHEAD MODAL SECURITY AND LOG IN-->

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunctionMyStudentUPass() {
    var x = document.getElementById("mystudent_newpass");
    var y = document.getElementById("mystudent_repass");
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

