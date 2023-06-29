<?php
include('includes/dh-header.php'); 
include('includes/dh-navbar.php'); 
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<div class="row">
  <div class="col-md-12">   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Archived Research Outputs <small class="h4 mb-4 text-gray-500">manage and organize research outputs</small></h1>
      <small><p><i class="fas fa-fw fa-home fa-1x"></i>
        <a href="deptheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;> 
        <a href="depthead_semester.php" class='text-gray-700'>&nbsp;&nbsp;Semester</a>&nbsp;&nbsp;>
        <a href="depthead_semester_archive.php" class='text-gray-700'>&nbsp;&nbsp;Archived Semester</a>&nbsp;&nbsp;>&nbsp;&nbsp;Archived Research Outputs</p></small>
    </div>
    <hr>
  </div>
</div>
 
 
<!-- DataTales Example -->
<div class="card shadow mb-4">
<!--START CARD HEADER-->
<div class="card-header py-3">
 

<h6 class="m-0 font-weight-bold text-primary">Manage Archived Research Papers

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
                   WHERE fup_status = 'Archived' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."' AND sem_priority_id = '".$sempriorityID."' ";

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
             <td><kbd class='text-capitalize status-archive'>".$row['fup_status']."</kbd></td>
             <td>
             <a target='_blank' href='uploads-papers/".$row['fup_document']."'>".$row['fup_document']."</a>&nbsp;
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