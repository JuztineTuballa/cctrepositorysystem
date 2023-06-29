
<!-- Sidebar -->
<ul style="background-color: #1D2327" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./admindashboard.php">
    <div class="ml-0 px-0 sidebar-brand-icon">
      <img src="./a-images/admin-cctlogo.png" style="height: 40px;"> 
    </div> 
    <div class="sidebar-brand-text mr-0">
     
     <img src="./a-images/cct-logo2.png" style="width: 170px;"> 
    </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="admindashboard.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Interface
  </div>

  <li class="nav-item">
    <a class="nav-link" href="adminprofile.php" >
      <i class="fas fa-fw fa-user-lock"></i>
      <span>My Profile</span></a>
  </li>

  <!-- Nav Item - Research Head - For Viewing lang itong purpose ni Research Head -->
  <li class="nav-item">
    <a class="nav-link" href="researchheadprofile.php">
      <i class="fas fa-fw fa-user-alt"></i>
      <span>Research Head</span></a>
  </li>

  <!-- Nav Item - Department Head -->
  <li class="nav-item">
    <a class="nav-link" href="librarianprofile.php">
      <i class="fas fa-fw fa-user-tie"></i>
      <span>Librarian</span></a>
  </li>

  <!-- Nav Item - Department Head -->
  <li class="nav-item">
    <a class="nav-link" href="deptheadprofile.php">
      <i class="fas fa-fw fa-user-graduate"></i>
      <span>Research Coordinator</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Manage Students
  </div>

  <!-- Nav Item - Students -->
  <li class="nav-item">
    <a class="nav-link" href="mis_addstudentexcel.php">
      <i class="fas fa-fw fa-file-import"></i>
      <span>Import Student Records</span></a>
  </li>

  <!-- Nav Item - Students -->
  <li class="nav-item">
    <a class="nav-link" href="mis_manage_students.php">
      <i class="fas fa-users fa-file-import"></i>
      <span>Student Accounts</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    View Records
  </div>

  <!-- Nav Item - Uploads -->
  <li class="nav-item">
    <a class="nav-link" href="funcadmin_fileupload_dashboard.php">
      <i class="fas fa-fw fa-file-pdf"></i>
      <span>View Uploads</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider"> 

  <!-- Heading -->
  <div class="sidebar-heading">
    Site Database
  </div>

  <!-- Nav Item - Database -->
  <li class="nav-item">
    <a class="nav-link" href="adminmigratepage.php">
      <i class="fas fa-fw fa-database"></i>
      <span>Manage Database</span></a>
  </li>

  <BR> 

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>



      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
              
              <!-- FETCH ADMIN USERNAME -->
              <!--strtoupper() para maging uppercase yung nafetch na username-->
              <?php echo mb_strtoupper($_SESSION ['admin_firstname']) ?>
              <?php echo mb_strtoupper($_SESSION ['admin_lastname']) ?>
              
            </span> 

            <?php
            include_once 'db_conn.php';  

            $sesid = $_SESSION['admin_picture'];
            
            $sql = "SELECT * FROM tb_adminuser WHERE admin_picture = '".$sesid."' ";
            $query = $conn->query($sql);

            while($row = $query->fetch_assoc()) {
              $image = (!empty($row['admin_picture'])) ? 'uploads/'.$row['admin_picture'] : 'uploads/adminprofile.png';
              echo "<img class='img-profile rounded-circle' src='".$image."' class='user-image' alt='User Image'> ";
            }
            ?>

            <!--<img class="img-profile rounded-circle" src="<?php echo (!empty($row['admin_picture'])) ? './a-images/'.$row['admin_picture'] : './a-images/adminz1.png'; ?>" class="user-image" alt="User Image">-->

          </a>
          
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="adminprofile.php#adminheader">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="adminprofile.php#adminsettings">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <a class="dropdown-item" href="adminarchiveprofile.php">
              <i class="fas fa-archive fa-sm fa-fw mr-2 text-gray-400"></i>
              Archive
            </a>
             <a class="dropdown-item" href="adminexportpage.php">
              <i class="fas fa-file-export fa-sm fa-fw mr-2 text-gray-400"></i>
              Exports
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- End of Topbar -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Are you sure you want to logout?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            <form action="cct_admin_logout.php" method="POST"> 
              
              <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

            </form>

          </div>
        </div>
      </div>
    </div>
