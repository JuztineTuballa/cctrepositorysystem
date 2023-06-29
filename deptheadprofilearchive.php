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
    header('Location: /cctrepositorysystem/deptheadprofilearchive.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>


<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'db_conn.php';
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!--<h1 class="h4 mb-4 text-gray-800">Research Coordinator Archive Information <small class="h4 mb-4 text-gray-500">manage research coordinator archive information</small></h1>-->

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Research Coordinator Archive <small class="h4 mb-4 text-gray-500">manage research coordinator archive</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="adminarchiveprofile.php" class='text-gray-700'>Archive Dashboard</a>&nbsp;&nbsp;>&nbsp;&nbsp;Research Coordinator Archive</p></small>
  </div>

  <!--START HEADER-->
  <header class="bg-headerimage1 py-5 m-0">
    <div class="container px-5">
      <section class="section about-section" id="about">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
              <div class="text-light go-to">
                <!--START h3-->
                <h3 class="text-light">
                 Archived Research Coordinator
               </h3> 
               <!--END h3-->
               <div class="media">
                <P>Items in your archive are only visible to you.</P>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-avatar">
             <img src="a-images/research-coordinator-shield-photo.png" height="150px" title="" alt="">
           </div>
         </div>
       </div>
     </sections>
   </header>
   <BR/>

   <!--END START HEADER-->      

   <!-- DATA TABLES-->
   <div class="card shadow mb-4" id="deptheadsettings">
    <div class="card-header py-3">
     
      
      <div class='id="settings"'></div>
      <h6 class="m-0 font-weight-bold text-primary">Archive Settings&nbsp;&nbsp; 
      
      </div> <!-- END OF MAIN CONTENT IN ADD RESEARCH COORDINATOR MODAL-->

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
               <!--PRIMARY INFORMATION-->
               <th>ID</th>
               <th>Department</th>
               <th>Username</th>
               <th style="display:none;">Password</th>
               <th>Picture</th>
               <th>Lastname</th>
               <th>Firstname</th>
               <th>Middlename</th> 
               <th>Status</th> 
               <th>Settings</th>
             </tr>
           </thead>
           <tfoot>
            <tr>
             <!--PRIMARY INFORMATION-->
             <th>ID</th>
             <th>Department</th>
             <th>Username</th>
             <th style="display:none;">Password</th>
             <th>Picture</th>
             <th>Lastname</th>
             <th>Firstname</th>
             <th>Middlename</th> 
             <th>Status</th> 
             <th>Settings</th>
           </tr>
         </tfoot>
         <tbody>
          <?php
          $sql = "SELECT * FROM tb_depthead WHERE dhead_status = 'Archived' ";
          $query = $conn->query($sql);

          while($row = $query->fetch_assoc()){
            $image = (!empty($row['dhead_picture'])) ? 'uploads/'.$row['dhead_picture'] : 'uploads/adminprofile.png';

            echo "
            <tr>
            <td>".$row['dhead_id']."</td>
            <td>".$row['dhead_dept']."</td>
            <td>".$row['dhead_uname']."</td>
            <td class='small w-100 text-monospace small' style='display:none;'>".$row['dhead_pword']."</td>
            <td>
            <img src='".$image."' width='50px' height='50px'>
            </td>
            <td>".$row['dhead_lname']."</td>
            <td>".$row['dhead_fname']."</td>
            <td>".$row['dhead_mname']."</td>
            <td><kbd class='text-capitalize status-archive'>".$row['dhead_status']."</kbd></td>
            <td>
            <div class='dropdown'>
            <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Manage
            </button>
            <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
            <form action='deptheadprofilearchive.php' method='POST'>
            <input type='hidden' name='activeprofileid' value='".$row['dhead_id']."' />
            <button class='dropdown-item' type='submit' name='ActiveProfile' value='Active'><i class='fas fa-undo-alt fa-sm fa-fw mr-2 text-gray-400'></i>Restore Status</button>
            </form>
            <input type='hidden' class='id' name='id'>
            <a href='funcadmin_depthead_delete.php?deletemona1=".$row['dhead_id']."' OnClick=\"return confirm('Are you sure you want to Permanently Delete Research Coordinator?');\">
            <button class='dropdown-item' type='button'><i class='fa fa-trash fa-sm fa-fw mr-2 text-gray-400'></i>Delete Permanently</button>
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

  <div class="card-footer py-3">
    <a href="deptheadprofile.php">
      <small style="float:right;"><i class="fa fa-sign-out-alt"></i>&nbsp;View Active Research Heads</small>
    </a>
  </div>

  <!-- <div class="card-footer py-3">
  <div><span><b>Legend:</b></span>&nbsp;&nbsp;
    <span style="padding-right: 15px;"><span class="scsbox" style="border: solid 1px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> School of Computer Studies</span> 
    <span style="padding-right: 15px;"><span class="sedbox" style="border: solid 1px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> School of Education</span> 
    <span style="padding-right: 15px;"><span class="sbmbox" style="border: solid 1px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> School of Business Management</span> 
    <span style="padding-right: 15px;"><span class="shtmbox" style="border: solid 1px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> School of Hospitality and Tourism Management</span> 
  </div>    -->

</div>
</div>
<!-- /.CONTAINER FLUID -->

<?php
include('includes/footer.php');
?>


<?php
    //PHP FUNCTION FOR RESTORING DEPT HEAD ACCOUNT
if (isset($_POST['ActiveProfile'])) {
  $sid = $_POST['activeprofileid'];

  $select = "UPDATE tb_depthead SET dhead_status = 'Active' WHERE dhead_id = '$sid' ";
  $result = mysqli_query($conn,$select);

  echo "<script> alert('Succesfully Removed from Archives!'); window.location='deptheadprofilearchive.php?status=Restored' </script>"; 

}
    //END PHP FUNCTION FOR RESTORING DEPT HEAD ACCOUNT
?>


<!--SCRIPT FOR LEGEND-->
<!-- <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    $( ".value-text:contains('School of Computer Studies')" ).attr('style', 'color:#15753b'); 
    $( ".value-text:contains('School of Education')" ).attr('style', 'color:#2475a3'); 
    $( ".value-text:contains('School of Business Management')" ).attr('style', 'color:#4f258f'); 
    $( ".value-text:contains('School of Hospitality and Tourism Management')" ).attr('style', 'color:#b08821'); 
});
</script> -->
<!--END SCRIPT FOR LEGEND-->