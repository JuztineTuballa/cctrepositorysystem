<?php
include('includes/dh-header.php'); 
include('includes/dh-navbar.php'); 

include_once 'db_conn.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    
    <h1 class="h3 mb-0 text-gray-800">Archived Uploads  <small class="h4 mb-4 text-gray-500">organize student's research papers</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="deptheaddashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Archived Uploads</p></small>

  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">

    <!--START OF CARD HEADER-->
    <div class="card-header py-3">

      <BR/>

      <h6 class="m-0 font-weight-bold text-primary">Manage Archived Research Papers&nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
      <a href="depthead_fileupload.php" class="text-gray-700"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>View Uploaded Research Papers</a></h6>

      </div>
      <!--END OF CARD HEADER-->
      
      <div class="card-body">
        <div class="table-responsive">

          <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;">ID</th>
                <th>Title</th>
                <th>Department</th>
                <th>Author</th>
                <th>Date</th>
                <th>Status</th>
                <th>File</th>

                <th>Settings</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;">ID</th>
                <th>Title</th>
                <th>Department</th>
                <th>Author</th>
                <th>Date</th>
                <th>Status</th>
                <th>File</th>

                <th>Settings</th>
              </tr>
            </tfoot>
            <tbody>
             <?php
             
             $sesid = $_SESSION['dhead_dept'];
             $sesid1 = $_SESSION['dhead_id'];
             
             //SELECT *, tb_depthead.dhead_id AS canid FROM tb_depthead LEFT JOIN tb_fuploads ON tb_depthead.dhead_id=tb_fuploads.priority_id WHERE tb_depthead.dhead_id
             $sql = "SELECT *, tb_depthead.dhead_dept AS canid FROM tb_depthead LEFT JOIN tb_fuploads ON tb_depthead.dhead_dept=tb_fuploads.priority_id WHERE fup_status = 'Archived' AND tb_depthead.dhead_dept = '".$sesid."' AND tb_depthead.dhead_id = '".$sesid1."' ";
             $query = $conn->query($sql);

             while($row = $query->fetch_assoc()) {

               echo "
               <tr>
               <td style='display:none;'>".$row['fup_id']."</td>
               <td>".$row['fup_title']."</td>
               <td>".$row['fup_department']."</td>
               <td>".$row['fup_author']."</td>
               <td>".$row['fup_date']."</td>
               <td><kbd class='text-capitalize status-archive'>".$row['fup_status']."</kbd></td>
               <td>
               <a target='_blank' href='uploads-papers/".$row['fup_document']."'>".$row['fup_document']."</a>
               </td>
               <td>
               <div class='dropdown'>
               <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
               Manage
               </button>
               <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
               
               <form action='depthead_filearchive.php' method='POST'>
               <input type='hidden' name='archivefileid1' value='".$row['fup_id']."' />
               <button class='dropdown-item' type='submit' name='Posted' value='Posted'><i class='fas fa-undo-alt fa-sm fa-fw mr-2 text-gray-400'></i>Restore</button>
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
?>

<?php

include_once 'db_conn.php';

//PHP FUNCTION FOR RESTORING ARCHIVING FILES
if (isset($_POST['Posted'])) {
  $sid = $_POST['archivefileid1'];

  $select = "UPDATE tb_fuploads SET fup_status = 'Posted' WHERE fup_id = '$sid' ";
  $result = mysqli_query($conn,$select);

  echo "<script> alert('File Restored!'); window.location='depthead_filearchive.php?status=Restored' </script>"; 

}
//END PHP FUNCTION FOR RESTORING ARCHIVING FILES
?>

<!--SCRIPT FOR STATUS-->
<script type="text/javascript">
/*
$(document).ready(function() {
    $( ".value-text:contains('Archived')" ).css( "color", "orange"); 
    $( ".value-text:contains('Posted')" ).css( "color", "green" ); 
})
*/
</script>
<!--END SCRIPT FOR STATUS-->