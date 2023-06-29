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
    header('Location: /cctrepositorysystem/researchheadprofilearchive.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>


<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'db_conn.php';
?>

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Research Head Archive <small class="h4 mb-4 text-gray-500">manage research head archive</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="adminarchiveprofile.php" class='text-gray-700'>Archive Dashboard</a>&nbsp;&nbsp;>&nbsp;&nbsp;Research Head Archive</p></small>
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
                 Archived Research Head
                </h3> 
               <!--END h3-->
               <div class="media">
                <P>Items in your archive are only visible to you.</P>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-avatar">
             <img src="a-images/research-head-shield-photo.png" height="150px" title="" alt="">
           </div>
         </div>
       </div>
     </sections>
   </header>
   <BR/> 
   <!--END - START HEADER-->

   <!-- DATA TABLES -->
   <div class="card shadow mb-4" id="deptheadsettings">
    <div class="card-header py-3">
    <!--MODAL FORM OF ADD ADMIN-->

    <h6 class="m-0 font-weight-bold text-primary">Archived Research Head Settings&nbsp;&nbsp;
      
    </div> <!-- END OF MAIN CONTENT -->

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
               <!--PRIMARY INFORMATION-->
               <th>ID</th>
               <th>Username</th>
               <th style="display:none;">Password</th>
               <th>Picture</th>
               <th>Lastname</th>
               <th>Firstname</th>
               <th>Middlename</th>   
               <th>Status</th>          
               <th>Settings</th>
               <!--END PRIMARY INFORMATION-->
             </tr>
           </thead>
           <tfoot>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th>ID</th>
              <th>Username</th>
              <th style="display:none;">Password</th>
              <th>Picture</th>
              <th>Lastname</th>
              <th>Firstname</th>
              <th>Middlename</th>
              <th>Status</th>               
              <th>Settings</th>     
              <!--END PRIMARY INFORMATION-->
            </tr>
          </tfoot>
          <tbody>
           <?php
           $sql = "SELECT * FROM tb_researchhead WHERE reshead_status = 'Archived' ";
           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()){
            $image = (!empty($row['reshead_picture'])) ? 'uploads/'.$row['reshead_picture'] : 'uploads/adminprofile.png';

            echo "
            <tr>
            <td>".$row['reshead_id']."</td>
            <td>".$row['reshead_uname']."</td>
            <td class='small w-100 text-monospace small' style='display:none;'>".$row['reshead_pword']."</td>
            <td>
            <img src='".$image."' width='50px' height='50px'>
            </td>
            <td>".$row['reshead_lname']."</td>
            <td>".$row['reshead_fname']."</td>
            <td>".$row['reshead_mname']."</td>
            <td><kbd class='text-capitalize status-archive'>".$row['reshead_status']."</kbd></td>
            <td>
            <div class='dropdown'>
            <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Manage
            </button>
            <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
            
            <form action='researchheadprofilearchive.php' method='POST'>
            <input type='hidden' name='activeprofileidRH' value='".$row['reshead_id']."' />
            <button class='dropdown-item' type='submit' name='ActiveProfileRH' value='Active'><i class='fas fa-undo-alt fa-sm fa-fw mr-2 text-gray-400'></i>Restore Status</button>
            </form>
            <input type='hidden' class='id' name='id'>
            <a href='funcadmin_reshead_delete.php?deletemona1=".$row['reshead_id']."' OnClick=\"return confirm('Are you sure you want to Delete Research Coordinator?');\">
            <button class='dropdown-item' type='button'><i class='fa fa-trash fa-sm fa-fw mr-2 text-gray-400'></i>Delete</button>

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
  <a href="researchheadprofile.php">
    <small style="float:right;"><i class="fa fa-sign-out-alt"></i>&nbsp;View Active Research Heads</small>
  </a>
</div>

</div>
</div>
<!-- /.END CONTAINER FLUID -->

<?php
include('includes/footer.php');
?>

<?php
//PHP FUNCTION FOR ARCHIVING PROFILE 
if (isset($_POST['ActiveProfileRH'])) {
  $sid = $_POST['activeprofileidRH'];

  $select = "UPDATE tb_researchhead SET reshead_status = 'Active' WHERE reshead_id = '$sid' ";
  $result = mysqli_query($conn,$select);

  echo "<script> alert('Succesfully Removed from Archives!'); window.location='researchheadprofilearchive.php?status=Restored' </script>"; 

}
//END PHP FUNCTION FOR ARCHIVING PROFILE
?>

