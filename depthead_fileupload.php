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
    header('Location: /cctrepositorysystem/depthead_fileupload.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include('includes/dh-header.php'); 
include('includes/dh-navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col-md-12">   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Uploads <small class="h4 mb-4 text-gray-500">manage and organize research papers</small></h1>
      <small><p><i class="fas fa-fw fa-home fa-1x"></i>
        <a href="deptheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp; 
        <a href="depthead_semester.php" class='text-gray-700'>&nbsp;&nbsp;Semester</a>&nbsp;&nbsp;>&nbsp;&nbsp;Uploads</p></small>
    </div>
    <hr>
  </div>
</div>
 
 
<!-- DataTales Example -->
<div class="card shadow mb-4">
<!--START CARD HEADER-->
<div class="card-header py-3">

<BR/>          
    <!--Upload File Modal-->
    <div class="modal fade" id="UploadResearchPaperModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-light">
          <div class="modal-header bg-c-blue">
            <h5 class="modal-title text-light" id="exampleModalLabel">Upload Research Paper</h5>
            <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <!--MODAL BODY-->
          <div class="modal-body text-dark">
            <!--FORM ACTION dito nakalagay yung connection ng admin_signup.php tsakaya yung na METHOD="POST"-->
            <form action="depthead_fileupload_crud_code.php" method="POST" enctype="multipart/form-data" onsubmit="return validatedepartment()">

              <div class="form-group">
                <label for="deptselect">Department</label>
                <select id="deptselect" name="deptselect" class="form-control container selectpicker d-flex p-2 form-select" required>       
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

              <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                <label for="semselect">Semester: </label>
                <select id="semselect" name="semselect" class="form-control container selectpicker d-flex p-2 form-select" required>              
                  <?php
                    
                    if (isset($_GET['sem_priority_id'])) {
                    	$_SESSION['sem_priority_id'] = $_GET['sem_priority_id'];
                    }

                    // Retrieve the sem_priority_id session variable
                    $sesid = $_SESSION['sem_priority_id'];

                    $sql = "SELECT * FROM tb_fsemester WHERE sem_priority_id = '".$sesid."' LIMIT 1 ";
                    $query = $conn->query($sql);

                    while($row = $query->fetch_assoc()){

                        echo "
                        <option value='".$row['sem_priority_id']."'>".$row['sem_priority_id'];"</option>
                        ";
                    }
                  ?>
                </select>     
                <br>
              </div>

              <div class="form-group">
                <label for="fileuploadtitle">Title</label>
                <input name="fileuploadid" type="hidden" value="">
                <input type="text" id="fileuploadtitle" name="fileuploadtitle" class="form-control" placeholder="Enter Research Title" required>
              </div>

              <div class="form-group">
                <label>Author</label>
                <input name="fileuploadid" type="hidden" value="">
                <input type="text" id="fileuploadauthor" name="fileuploadauthor" class="form-control" placeholder="Enter Authors" required>
              </div>

              <!--DATE-->
              <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                <label for="example">Date Published: </label>
                  <?php

          			if (isset($_GET['sem_priority_id'])) {
          				$_SESSION['sem_priority_id'] = $_GET['sem_priority_id'];
          			}

                    // Retrieve the sem_priority_id session variable
                    $sempriorityID = $_SESSION['sem_priority_id'];

                    $sql = "SELECT sem_start, sem_end FROM tb_fsemester WHERE sem_priority_id='".$sempriorityID."' LIMIT 1";
                    $query = $conn->query($sql);
                    $row = $query->fetch_assoc();

                    $min_date = $row['sem_start'] . "-01-01";
                    $max_date = $row['sem_end'] . "-12-31";
                    echo '<input placeholder="Select date" type="date" name="fileuploaddate" class="form-control datepicker" required min="' . $min_date . '" max="' . $max_date . '">';

          		?>
                  <br>
              </div>
              <!--END DATE-->

              <div class="form-group">
                <label>Abstract</label>
                <input name="fileuploadid" type="hidden" value="">
                <textarea type="text" id="fileuploadabstract" name="fileuploadabstract" rows="5" cols="50" class="form-control text-wrap" placeholder="Enter Abstract" required></textarea>
              </div>
              
              <label class="form-label" for="customFile">Research Paper (300MB maximum in PDF form)</label><BR>
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="fileuploadfile" name="fileuploadfile" accept="application/pdf" required>
                  <label class="custom-file-label" for="fileuploadfile">Choose file</label>
                </div>
              </div>

              <div class="form-group">
                <p id="CheckFileSize" class="small"></p>
              </div>

              <!--END MODAL BODY-->
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="add_file_btn" id="add_file_btn" class="btn btn-primary">Add</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END UPLOAD FILE MODAL-->

    <!-- BUTTON TO FETCH THE UPLOAD-->
    <button type="button" class="btn btn-primary float-right addf01" class="dropdown-item" href="" data-toggle="modal" data-target="#UploadResearchPaperModal">
      + Upload Research Paper
    </button>

<h6 class="m-0 font-weight-bold text-primary">Manage Research Papers

    </div>
    <!--END OF CARD HEADER-->

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th style="display:none;">ID</th>
              <th>Department</th>
              <th>Semester</th>
              <th>Title</th> 
              <th>Authors</th>
              <th>Date</th>
              <th style="display:none;">Abstract</th>
              <th>Status</th>
              <th>File</th>
              <th>Manage</th>
            </tr>
          </thead>
           <tfoot>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th style="display:none;">ID</th>
              <th>Department</th>
              <th>Semester</th>
              <th>Title</th> 
              <th>Authors</th>
              <th>Date</th>
              <th style="display:none;">Abstract</th>
              <th>Status</th>
              <th>File</th>
              <th>Manage</th>
            </tr>
          </tfoot>
          <tbody>
            
          <?php
           
           if (isset($_GET['sem_priority_id'])) {
            $_SESSION['sem_priority_id'] = $_GET['sem_priority_id'];
           }

           // Retrieve the sem_priority_id session variable
           $sempriorityID = $_SESSION['sem_priority_id'];

           $sesid = $_SESSION['dhead_dept'];
           $sesid1 = $_SESSION['dhead_id'];
           
           $sql = "SELECT *, tb_depthead.dhead_dept AS canid 
                   FROM tb_depthead 
                   LEFT JOIN tb_fuploads 
                   ON tb_depthead.dhead_dept=tb_fuploads.priority_id 
                   WHERE fup_status = 'Posted' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."' AND sem_priority_id = '".$sempriorityID."' ";

           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()) {

             echo "
             <tr>
             <td style='display:none;'>".$row['fup_id']."</td>
             <td>".$row['fup_department']."</td>
             <td>".$row['sem_priority_id']."</td>
             <td>".$row['fup_title']."</td>
             <td>".$row['fup_author']."</td>
             <td>".$row['fup_date']."</td>
             <td style='display:none;'>".$row['fup_abstract']."</td>
             <td><kbd class='text-capitalize status-posted'>".$row['fup_status']."</kbd></td>
             <td>
             <a target='_blank' href='uploads-papers/".$row['fup_document']."#toolbar=0'>".$row['fup_document']."</a>&nbsp;
             <a class='EditFileModal pull-right text-info editfilepdf' data-id='".$row['fup_id']."'>
             <span class='fa fa-edit'></span></a>
             </td>
             <td>
             <div class='dropdown'>
             <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
             Manage
             </button>
             <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
             <a  data-toggle='modal' data-target='#EditFileModal1'></a>
             <button class='dropdown-item editfile1' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>Edit Description</button>

             <form action='depthead_fileupload_crud_code.php' method='post' onsubmit='return confirm(\"Are you sure you want to archive this research output?\");'>
                <input type='hidden' name='archive_file_id' value='".$row['fup_id']."'>
                <button class='dropdown-item' type='submit' name='archive_file' value='".$row['fup_id']."'>
                  <i class='fas fa-archive fa-sm fa-fw mr-2 text-gray-400'></i> Archive File
                </button>
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
 </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
include('includes/dh-footer.php');
include ('depthead_fileupload_updatemodal.php');
?>

<script>
  //FETCH FOR EDIT FILE DETAILS
  $(function(){
    $(document).on('click', '.editfile1', function(e){
      e.preventDefault();
      
      $('#EditResearchPaperModal').modal('show');
      $tablerow = $(this).closest('tr');
      var data = $tablerow.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#fileuploadid01').val(data[0]);
      $('#filedepartment').val(data[1]);
      $('#updatefileuploadsemester').val(data[2]);
      $('#updatefileuploadtitle').val(data[3]);
      $('#updatefileuploadauthor').val(data[4]);
      $('#updatefileuploaddate').val(data[5]); 
      $('#updatefileuploadabstract').val(data[6]);

    });
  });
//END - FETCH FOR EDIT FILE DETAILS
</script>

<script>
//SCRIPT FOR FETCHING FILE DOCUMENT
$(function(){
  $(document).on('click', '.EditFileModal', function(e){
    e.preventDefault();

    $('#EditFileModal').modal('show');
    $tablerow = $(this).closest('tr');
    var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);
    
    $('#uploads_fileid').val(data[0]);
    $('#uploads_file').val(data[8]);

  });
});
//END SCRIPT FOR FETCHING  FILE DOCUMENT
</script>
 
<script type="text/javascript">
//SCRIPT TO ALLOW SPECIFIC RANGE OF DATE PUBLISHED BASED ON THE DATA WE HAVE IN SEM_START AND SEM_END
// NOTE : THIS ALSO REQUIRES AP PHP WHICH IS WE HAVE ALREADY CODED IN INPUT

$(document).ready(function() {
    $('.datepicker').on('focus', function(e) {
        var minYear = new Date($(this).attr('min')).getFullYear();
        var maxYear = new Date($(this).attr('max')).getFullYear();
        var $thisYear = $(this).val().substr(0,4);
        
        $('select.datepicker-year option').each(function() {
            var year = $(this).val();
            if (year < minYear || year > maxYear) {
                $(this).attr('disabled', 'disabled');
            }
        });
        
        if ($thisYear < minYear || $thisYear > maxYear) {
            $(this).val('');
        }
    });
});

//END - SCRIPT TO ALLOW SPECIFIC RANGE OF DATE PUBLISHED BASED ON THE DATA WE HAVE IN SEM_START AND SEM_END
</script>



<script>
  // Maximum width of the custom file label in pixels
  const MAX_WIDTH = 40;
  
  //SCRIPT FOR CHECKING FILE SIZE
  const input = document.getElementById("fileuploadfile");
  const fileSizeLimit = 300 * 1024 * 1024; // 300 MB in bytes
  const submitButton = document.getElementById("add_file_btn");
  const checkFileSize = document.getElementById("CheckFileSize");

  input.addEventListener("change", () => {
    if (input.files.length > 0) {
      const file = input.files[0];
      if (file.size > fileSizeLimit) {
        checkFileSize.textContent = "File is too large!";
        checkFileSize.style.color = "#FF0000"; // set color to red
        input.value = ""; // clear the input
        submitButton.disabled = true; // disable the submit button
      } else {
        checkFileSize.textContent = ""; // clear any previous error message
        submitButton.disabled = false; // enable the submit button
        const fileName = file.name;
        const label = document.querySelector('.custom-file-label');
        if (label) {
          if (fileName.length > MAX_WIDTH) {
            label.textContent = fileName.substring(0, MAX_WIDTH) + '...';
          } else {
            label.textContent = fileName;
          }
        }
      }
    }
  });
</script>