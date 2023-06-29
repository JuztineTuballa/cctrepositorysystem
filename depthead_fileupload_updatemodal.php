<!--START EDIT UPDATE FILE MODAL-->
<div class="modal fade" id="EditResearchPaperModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Research Paper</h5>
        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--MODAL BODY-->
      <div class="modal-body text-dark">
        
       <form action="depthead_fileupload_crud_code.php" method="POST" enctype="multipart/form-data" onsubmit="return updatedepartment()">

        <div class="form-group">
          <label for="filedepartment">Department</label>
          <select id="filedepartment" name="filedepartment" class="form-control container selectpicker d-flex p-2 form-select" required>
            <!-- <option value="" selected>--Select--</option> -->
            <?php
            $sesid = $_SESSION['dhead_id'];
                              
            $sql = "SELECT * FROM tb_depthead WHERE dhead_id='".$sesid."' LIMIT 1 ";
            $query = $conn->query($sql);
            while($row = $query->fetch_assoc()){
              echo "
              <option value='".$row['dhead_dept']."'>".$row['dhead_dept']."</option>
              ";
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="updatefileuploadsemester">Semester: </label>
          <select id="updatefileuploadsemester" name="updatefileuploadsemester" class="form-control container selectpicker d-flex p-2 form-select" required>
           <?php
            $sesid = $_SESSION['sem_priority_id'];
                              
            $sql = "SELECT * FROM tb_fsemester WHERE sem_priority_id ='".$sesid."' LIMIT 1 ";
            $query = $conn->query($sql);
            while($row = $query->fetch_assoc()){
              echo "
              <option value='".$row['sem_priority_id']."'>".$row['sem_priority_id']."</option>
              ";
            }
            ?>
          </select>
        </div> 

        <div class="form-group">
          <label for="fileuploadtitle">Title</label>
          <input id="fileuploadid01" name="fileuploadid01" type="hidden">
          <input type="text" id="updatefileuploadtitle" name="updatefileuploadtitle" class="form-control" placeholder="Update Research Title" required>
        </div>

        <div class="form-group">
          <label>Author</label>
          <input type="text" id="updatefileuploadauthor" name="updatefileuploadauthor" class="form-control" placeholder="Update Authors" required>
        </div>

        <!--DATE-->
        <!--PHP CODE PARA SA DATE YUNG KAPARES NETO NASA db_conn.php-->
        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
          <label for="example">Date Published: </label>
          <!-- <input placeholder="Select date" type="date" id="updatefileuploaddate" name="updatefileuploaddate"  class="form-control" required> -->
          <?php
          if (isset($_GET['sem_priority_id'])) {
              $_SESSION['sem_priority_id'] = $_GET['sem_priority_id'];
          }

          // Retrieve the sem_priority_id session variable
          $updatesempriorityID = $_SESSION['sem_priority_id'];

          $sql = "SELECT sem_start, sem_end FROM tb_fsemester WHERE sem_priority_id='".$updatesempriorityID."' LIMIT 1";
          $update_query = $conn->query($sql);

          while($row = $update_query->fetch_assoc()) {
              $update_min_date = $row['sem_start'] . "-01-01";
              $update_max_date = $row['sem_end'] . "-12-31";
              echo '<input placeholder="Select date" type="date" id="updatefileuploaddate" name="updatefileuploaddate" class="form-control datepicker" required min="' . $update_min_date . '" max="' . $update_max_date . '">';
          }
        ?>
          <br>
        </div>
        <!--END DATE-->

        <div class="form-group">
          <label>Abstract</label>
          <textarea type="text" id="updatefileuploadabstract" name="updatefileuploadabstract" rows="5" cols="50" class="form-control text-wrap" placeholder="Update Abstract" required></textarea>
        </div>
        <div class="form-group">
          <p class="disabled-message text-primary" style="display: none;"><small>Note: Button is disabled unless you type something in the input.</small></p>
        </div>
      </div>
      <!--END MODAL BODY-->
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update_file_btn" class="btn btn-primary" id="update-btn">Update</button>

      </div>
    </form>
  </div>
</div>
</div>
<!-- END EDIT UPDATE FILE MODAL-->

<!-- UPDATE FILE -->
<div class="modal fade" id="EditFileModal">
  <div class="modal-dialog">
    <div class="modal-content bg-light">
      <div class="modal-header bg-c-blue">
        <h5 class="modal-title text-light" id="exampleModalLabel">Edit File</h5>
        <button type="button text-light" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="depthead_fileupload_crud_code.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
          <input type="hidden" name="uploads_fileid" id="uploads_fileid">

          <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="fileuploadfile1" name="fileuploadfile1" accept="application/pdf" required>
              <label class="custom-file-label custom-file-label-1" for="fileuploadfile1">Choose file</label>
            </div>
          </div>

          <div class="form-group">
            <p id="CheckFileSize1" class="small"></p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-dark btn-flat pull-left" data-dismiss="modal">
              <i class="fa fa-close"></i> Close </button>
            <button type="submit" class="btn btn-success btn-flat" name="depthead_fileupload_updatefile_btn" id="depthead_fileupload_updatefile_btn">
              <i class="fa fa-check-square-o"></i> Update </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END UPDATE FILE -->


<!--SCRIPT TO REQUIRE SELECTING A DEPARTMENT-->
<script type="text/javascript">
  function updatedepartment(){
    var udept = document.getElementById('filedepartment').value;
    if (udept =="") {
      alert("Please Select Department!");
      return false;
    }
    return true;
  }
</script>
<!--END SCRIPT FOR REQUIRING SELECTING DEPARTMENT-->

<!--SCRIPT TO DISABLE THE BUTTON IN UPDATE IF THE USER DID NOT TYPE ANYTHING IN INPUT TAG-->
<script>
$(document).ready(function() {
  // Disable the "Update" button by default
  $('#update-btn').prop('disabled', true);

  // Enable the "Update" button if any input field is changed
  $('input[type="text"], textarea').on('input', function() {
    $('#update-btn').prop('disabled', false);
  });
});
</script>

<script>
$(document).ready(function() {
  // Disable button on page load
  $('button[name="update_file_btn"]').prop('disabled', true);

  // Display message
  $('p.disabled-message').show();

  // Enable button if any input value changes
  $('form :input').on('input', function() {
    $('button[name="update_file_btn"]').prop('disabled', false);
    $('p.disabled-message').hide();
  });
});
</script>

<!--END - SCRIPT TO DISABLE THE BUTTON IN UPDATE IF THE USER DID NOT TYPE ANYTHING IN INPUT TAG-->


<script type="text/javascript">
//SCRIPT TO ALLOW SPECIFIC RANGE OF DATE PUBLISHED BASED ON THE DATA WE HAVE IN SEM_START AND SEM_END
// NOTE : THIS ALSO REQUIRES AP PHP WHICH IS WE HAVE ALREADY CODED IN INPUT

$(document).ready(function() {
    $('.datepicker').on('focus', function(e) {
        var updateMinYear = new Date($(this).attr('min')).getFullYear();
        var updateMaxYear = new Date($(this).attr('max')).getFullYear();
        var selectedYear = $(this).val().substr(0, 4);
        
        $('select.datepicker-year option').each(function() {
            var year = $(this).val();
            if (year < updateMinYear || year > updateMaxYear) {
                $(this).attr('disabled', 'disabled');
            }
        });
        
        if (selectedYear < updateMinYear || selectedYear > updateMaxYear) {
            $(this).val('');
        }
    });
});

//END - SCRIPT TO ALLOW SPECIFIC RANGE OF DATE PUBLISHED BASED ON THE DATA WE HAVE IN SEM_START AND SEM_END
</script>

<script>
  // SCRIPT FOR CHECKING FILE SIZE
  const inputUpdate = document.getElementById("fileuploadfile1");
  const fileSizeLimitUpdate = 200 * 1024 * 1024; // 200 MB in bytes
  const submitButtonUpdate = document.getElementById("depthead_fileupload_updatefile_btn");
  const checkFileSizeUpdate = document.getElementById("CheckFileSize1");

  inputUpdate.addEventListener("change", () => {
    if (inputUpdate.files.length > 0) {
      const file = inputUpdate.files[0];
      if (file.size > fileSizeLimitUpdate) {
        checkFileSizeUpdate.innerText = "File is too large!";
        checkFileSizeUpdate.style.color = "#FF0000"; // set color to red
        inputUpdate.value = ""; // clear the input
        submitButtonUpdate.disabled = true; // disable the submit button
      } else {
        checkFileSizeUpdate.innerText = ""; // clear any previous error message
        submitButtonUpdate.disabled = false; // enable the submit button
        const fileName = file.name;
        const label = document.querySelector('.custom-file-label-1');
        if (label) {
          const MAX_WIDTH = 40; // Maximum width of label in pixels
          if (fileName.length > MAX_WIDTH) {
            label.innerHTML = fileName.substring(0, MAX_WIDTH - 3) + "...";
          } else {
            label.innerHTML = fileName;
          }
        }
      }
    }
  });
</script>

