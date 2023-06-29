 <!--REQUEST FULL CONTENT OF DOCUMENT-->
 <div class="modal fade" id="StudentRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Request Full Content</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">
        
        <!--FORM ACTION-->
        <form action="studentrequest_code.php" method="POST" enctype="multipart/form-data">
        <div class="text-center">
          <label class="h5 text-gray-900 mb-0">STUDENT INFORMATION</label>
        </div>

        <!-- DIVIDER -->
        <hr class="sidebar-divider">

        <div class="form-group">
          <label>Department:</label>
           <?php
              $sesid = $_SESSION['stud_id'];
              $sql = "SELECT * FROM tb_student WHERE stud_id='".$sesid."' LIMIT 1 ";
              $query = $conn->query($sql);
              while($row = $query->fetch_assoc()){
                echo "
                <input id='rstud_department' name='rstud_department' value='".$row['stud_department']."' class='form-control' readonly>
                ";
              }
            ?>
        </div>

        <div class="form-group">
          <label>Student Number:</label>
           <?php
              $sesid = $_SESSION['stud_id'];
              $sql = "SELECT * FROM tb_student WHERE stud_id='".$sesid."' LIMIT 1 ";
              $query = $conn->query($sql);
              while($row = $query->fetch_assoc()){
                echo "
                <input id='rstud_num' name='rstud_num' value='".$row['stud_num']."' class='form-control' readonly>
                ";
              }
            ?>
        </div>
      
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label>Lastname:</label>
             <?php
              $sesid = $_SESSION['stud_id'];
              $sql = "SELECT * FROM tb_student WHERE stud_id='".$sesid."' LIMIT 1 ";
              $query = $conn->query($sql);
              while($row = $query->fetch_assoc()){
                echo "
                <input id='rstud_lname' name='rstud_lname' value='".$row['stud_lname']."' class='form-control' readonly>
                ";
              }
            ?>
          </div>

          <div class="col-sm-6">
            <label>Firstname:</label>
             <?php
                $sesid = $_SESSION['stud_id'];
                $sql = "SELECT * FROM tb_student WHERE stud_id='".$sesid."' LIMIT 1 ";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc()){
                  echo "
                  <input id='rstud_fname' name='rstud_fname' value='".$row['stud_fname']."' class='form-control' readonly>
                  ";
                }
              ?>
          </div>
        </div>

        <BR/>
   
        <div class="text-center">
          <label class="h5 text-gray-900 mb-0">REQUESTED RESEARCH OUTPUT</label>
        </div>

        <!-- DIVIDER -->
        <hr class="sidebar-divider">

        <input type="hidden" name="rfile_id" id="rfile_id">

        <div class="form-group">
          <input type="hidden" id="rdate" name="rdate" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Title:</label>
          <input name="rfile_title" id="rfile_title" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Department:</label>
          <input  name="rfile_department" id="rfile_department" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Authors:</label>
          <input name="rfile_authors" id="rfile_authors" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Date Published:</label>
          <input name="rfile_date" id="rfile_date" class="form-control" readonly>
        </div>
      
        <div class="form-group"  style="display:none;">
          <label>Abstract:</label>
          <textarea name="rfile_abstract" id="rfile_abstract" class="form-control"  rows="8" cols="50" class="form-control text-wrap" readonly></textarea>
        </div>
      
      </div>
      <!--END MODAL BODY-->
      <div class="modal-footer">
        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" name="request_btn" class="btn btn-success">Submit Request</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- END REQUEST FULL CONTENT OF DOCUMENT-->


<style type="text/css">

/*STYLING MODAL*/

/*input[type="text"][readonly],
textarea[readonly] {
  color:#1c1c1c !important;
  background-color: #F8F9FC !important; 
  
}*/

input {
  color:#1c1c1c;
  background-color: #F8F9FC !important; 
  
}
/*END - STYLING MODAL*/

</style>

<!--SCRIPT FOR GETTING THE CURRENT DATE AND TIME-->
<script type="text/javascript">
  document.getElementById('rdate').value = Date();
</script>
<!--END - SCRIPT FOR GETTING THE CURRENT DATE AND TIME-->