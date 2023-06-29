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
    header('Location: /cctrepositorysystem/depthead_fileupload_archive_toall.php');
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
      <h1 class="h3 mb-0 text-gray-800">Archived Research Outputs <small class="h4 mb-4 text-gray-500">manage and organize research outputs</small></h1>
      <small><p><i class="fas fa-fw fa-home fa-1x"></i>
        <a href="deptheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Archived Dashoard</p></small>
    </div>
  </div>
</div>

 
<!-- DataTales Example -->
<div class="card shadow mb-4">
<!--START CARD HEADER-->
<div class="card-header py-3">
 

<h6 class="m-0 font-weight-bold text-primary">Manage Archived Research Outputs

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
              <th>Action</th>
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
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            
          <?php
           
           $sesid = $_SESSION['dhead_dept'];
           $sesid1 = $_SESSION['dhead_id'];
           
           $sql = "SELECT *, tb_depthead.dhead_dept AS canid 
                   FROM tb_depthead 
                   LEFT JOIN tb_fuploads 
                   ON tb_depthead.dhead_dept=tb_fuploads.priority_id 
                   WHERE fup_status = 'Archived' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."' ";

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
                <a target='_blank' href='uploads-papers/".$row['fup_document']."#toolbar=0&navpanes=0'>".$row['fup_document']." 
                <i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-info'></i></a>
             </td>
             <td style='white-space: nowrap;'>

                <form action='depthead_fileupload_crud_code.php' method='POST' style='display: inline-block;' onsubmit='return confirm(\"Are you sure you want to restore this research output?  please keep in mind that you will only restore this research output, not research outputs and semester.\");'>
                  <input type='hidden' name='restore_file_id' value='".$row['fup_id']."'>
                  <button style='display: inline-block; margin-right: 10px;' class='btn btn-info' type='submit' name='restore_file' value='".$row['fup_id']."'>
                  <i class='fas fa-undo-alt fa-sm fa-fw mr-2 text-gray-200'></i>Restore File
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
include ('depthead_fileupload_updatemodal.php');
?>
 