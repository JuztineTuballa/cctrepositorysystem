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
    header('Location: /cctrepositorysystem/librarianprofilearchive.php');
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
    <h1 class="h3 mb-0 text-gray-800">Librarian Archive <small class="h4 mb-4 text-gray-500">manage librarian archive</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="adminarchiveprofile.php" class='text-gray-700'>Archive Dashboard</a>&nbsp;&nbsp;>&nbsp;&nbsp;Librarian Archive</p></small>
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
                 Archived Librarian
                </h3> 
               <!--END h3-->
               <div class="media">
                <P>Items in your archive are only visible to you.</P>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-avatar">
             <img src="a-images/librarian-shield-photo.png" height="150px" title="" alt="">
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

      <h6 class="m-0 font-weight-bold text-primary">Archived Librarian Settings&nbsp;&nbsp; 
      
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
           $sql = "SELECT * FROM tb_librarian WHERE librarian_status = 'Archived' ";
           $query = $conn->query($sql);

           while($row = $query->fetch_assoc()){
            $image = (!empty($row['librarian_picture'])) ? 'uploads/'.$row['librarian_picture'] : 'uploads/adminprofile.png';

            echo "
            <tr>
            <td>".$row['librarian_id']."</td>
            <td>".$row['librarian_uname']."</td>
            <td class='small w-100 text-monospace small' style='display:none;'>".$row['librarian_pword']."</td>
            <td>
            <img src='".$image."' width='50px' height='50px'>
            </td>
            <td>".$row['librarian_lname']."</td>
            <td>".$row['librarian_fname']."</td>
            <td>".$row['librarian_mname']."</td>
            <td><kbd class='text-capitalize status-archive'>".$row['librarian_status']."</kbd></td>
            <td>
            <div class='dropdown'>
            <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Manage
            </button>
            <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
            
            <form action='librarianprofilearchive.php' method='POST'>
            <input type='hidden' name='activeprofileidLB' value='".$row['librarian_id']."' />
            <button class='dropdown-item' type='submit' name='ActiveProfileLB' value='Active'><i class='fas fa-undo-alt fa-sm fa-fw mr-2 text-gray-400'></i>Restore Status</button>
            </form>
            <input type='hidden' class='id' name='id'>
            <a href='funcadmin_librarian_delete.php?deletemonaLB=".$row['librarian_id']."' OnClick=\"return confirm('Are you sure you want to Delete Librarian?');\">
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
    <a href="librarianprofile.php">
      <small style="float:right;"><i class="fa fa-sign-out-alt"></i>&nbsp;View Active Librarians</small>
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
if (isset($_POST['ActiveProfileLB'])) {
  $sid = $_POST['activeprofileidLB'];

  $select = "UPDATE tb_librarian SET librarian_status = 'Active' WHERE librarian_id = '$sid' ";
  $result = mysqli_query($conn,$select);

  echo "<script> alert('Succesfully Removed from Archives!'); window.location='librarianprofilearchive.php?status=Restored' </script>"; 

}
    //END PHP FUNCTION FOR ARCHIVING PROFILE
?>

