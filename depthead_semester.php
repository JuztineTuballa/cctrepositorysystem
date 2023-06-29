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
    header('Location: /cctrepositorysystem/depthead_semester.php');
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
      <h1 class="h3 mb-0 text-gray-800">Semester <small class="h4 mb-4 text-gray-500">manage and organize semester</small></h1>
      <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="deptheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Semester</p></small>
    </div>
    <hr>
  </div>
</div>


<div class="pt-3" style="background-color:#f0f0f0;">

  <div class="col-lg-12">
    <div class="p-2">
      <form action="depthead_semester_crud_code.php" method="POST" enctype="multipart/form-data" class="user" onsubmit="return validateForm()">
        <div class="form-group row">
          <!--THIS CODE IS HIDDEN | FETCH DEPARTMENT-->
          <div style='display:none;' class="col-sm-12 mb-3 mb-sm-3">
            <select  id="semdeptselect" name="semdeptselect" class="form-control container selectpicker d-flex p-2 form-select" required>          
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
          <!--END - THIS CODE IS HIDDEN | FETCH DEPARTMENT-->
          <div class="col-sm-5 mb-3 mb-sm-0">
            <label for="select_semester">Semester:</label>
            <select id="select_semester" name="select_semester" class="container selectpicker d-flex p-2 form-select w-100">
              <option value="" data-hidden="true">Choose Semester</option>
              <option value="1st Semester">1st Semester</option>
              <option value="2nd Semester">2nd Semester</option>
              <option value="3rd Semester">3rd Semester</option>
            </select>          
          </div>
          <div class="col-sm-3">
              <label for="sem_start_year">Year Start:</label>
              <input placeholder="Year Start" id="sem_start_year" name="sem_start_year" class="form-control"/>&nbsp;
          </div>
          <div class="col-sm-2">
              <label for="sem_start_end">Year End:</label>
              <input placeholder="Year End" id="sem_end_year" name="sem_end_year" class="form-control" readonly/>
          </div>
          <div class="col-sm-2">
             <label for="btn_add_semester" style="color:#f0f0f0;">Add Semester:</label>
            <button type="submit" name="btn_add_semester" class="btn btn-success w-100">+ Add Semester</button>
          </div>
        </div>
       </form>
    </div>
  </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
<!--START CARD HEADER-->
<div class="card-header py-3">
 
<h6 class="m-0 font-weight-bold text-primary">Manage Semester 
    <a href="depthead_semester_archive.php">
      <small style="float:right;"><i class="fa fa-archive"></i>&nbsp;Archives</small>
    </a>

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
              <th>Year Start</th>
              <th>Year End</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th style="display:none;">ID</th>
              <th>Department</th>
              <th>Semester</th>
              <th>Year Start</th>
              <th>Year End</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
           <?php
          
           $sesid = $_SESSION['dhead_dept'];
           $sesid1 = $_SESSION['dhead_id'];

           $sql = "SELECT *, tb_depthead.dhead_dept AS canid 
                   FROM tb_depthead 
                   LEFT JOIN tb_fsemester ON tb_depthead.dhead_dept=tb_fsemester.sem_department 
                   WHERE sem_status = 'Created' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."'  ";

           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()) {

             echo "
                <tr>
                  <td style='display:none;'>".$row['sem_id']."</td>
                  <td>".$row['sem_department']."</td>
                  <td>".$row['sem_name']."</td>
                  <td>".$row['sem_start']."</td>
                  <td>".$row['sem_end']."</td>
                  <td><kbd class='text-capitalize status-posted'>".$row['sem_status']."</td>
                  <td style='white-space: nowrap;'>
                    <a href='depthead_fileupload.php?sem_priority_id=".$row['sem_priority_id']."'>
                      <button style='display: inline-block; margin-right: 10px;' class='btn btn-info'><i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-200'></i>Manage</button>
                    </a>

                   <form action='depthead_semester_crud_code.php?sem_id=". $row['sem_id'] ."' method='POST' style='display: inline-block;' onsubmit='return confirm(\"Are you sure you want to archive this semester? Please keep in mind that all research outputs from this semester will be archived as well.\");'>
                     <button style='display: inline-block; margin-right: 10px;' class='btn btn-danger' type='submit' name='Archived' value='Archived'>
                       <i class='fas fa-archive fa-sm fa-fw mr-2 text-gray-200'></i> Archive
                     </button>
                   </form>

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
?>


<script>
//SCRIPT TO REQUIRE SELECTING A SEMESTER
  function validateForm() {
    const selectSemester = document.getElementById('select_semester');
    if (selectSemester.value === '') {
      alert('Please choose a semester');
      return false;
    }
    return true;
  }
//END - SCRIPT TO REQUIRE SELECTING A SEMESTER
</script>


<!--SCRIPT TO SELECT Year Start: AND Year End: -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<script>
  $(document).ready(function(){
      var startDate = new Date(2016, 0, 1); // Start from Jan 1, 2016
      var endDate = new Date(2100, 11, 31); // End at Dec 31, 2100
      var selectedDate = null;

      // Initialize first datepicker
      $("#sem_start_year").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          startDate: startDate,
          endDate: endDate,
          autoclose: true
      }).on('changeDate', function(e){
          // Update selectedDate when first datepicker changes
          selectedDate = new Date(e.date);
          selectedDate.setFullYear(selectedDate.getFullYear() + 1);
          $("#sem_end_year").datepicker('setStartDate', selectedDate);
          $("#sem_end_year").datepicker('setDate', selectedDate);
      });

      // Initialize second datepicker
      $("#sem_end_year").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          startDate: startDate,
          endDate: endDate,
          autoclose: true
      });

      // Initialize selectedDate to current year
      selectedDate = new Date();
      $("#sem_start_year").datepicker('setDate', selectedDate);
      selectedDate.setFullYear(selectedDate.getFullYear() + 1);
      $("#sem_end_year").datepicker('setStartDate', selectedDate);
      $("#sem_end_year").datepicker('setDate', selectedDate);
  });
</script>
<!--END - SCRIPT TO SELECT Year Start: AND Year End: -->




