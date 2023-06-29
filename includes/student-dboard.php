
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

         <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-harvard  topbar mb-0 static-top shadow px-5">
        <a class="navbar-brand" href="studentprofile.php">
          <div class="d-flex text-white">
            <div>
              <img src="./a-images/cct-logo1.png" style="height: 50px;">
            </div>
            <!--
            <div class="ml-2 mt-0 small">
              <b>City College of Tagaytay</b><br>
              <i class="nav-item navbar-nav text-yellow">Web-Based Repository of Research Outputs</i>
            </div>
            -->
          </div>
        </a>

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
                  <span class="mr-2 d-none d-lg-inline text-white small">
                    
                    <!-- FETCH DEPT HEAD USERNAME -->
                    <!--strtoupper() para maging uppercase yung nafetch na username-->
                    <?php echo strtoupper($_SESSION ['stud_fname']) ?>
                    <?php echo strtoupper($_SESSION ['stud_lname']) ?>

                  </span>
                  
                  <?php
                  include_once 'db_conn.php';  

                  $sesid = $_SESSION['stud_id'];
                  
                  $sql = "SELECT * FROM tb_student WHERE stud_id = '".$sesid."' ";

                  $query = $conn->query($sql);

                  while($row = $query->fetch_assoc()) {
                    $image = (!empty($row['stud_picture'])) ? 'uploads/'.$row['stud_picture'] : 'uploads/adminprofile.png';
                    echo "<img class='img-profile rounded-circle' src='".$image."' class='user-image' alt='User Image'> ";
                  }
                  ?>
                  
                  <!--<img class="img-profile rounded-circle" src="<?php echo (!empty($row['stud_picture'])) ? './a-images/'.$row['stud_picture'] : './a-images/adminz1.png' ?>" class="user-image" alt="User Image"> -->

                </a>

                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="studentsettings.php">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
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

                  <form action="studentlogout.php" method="POST"> 
                    
                    <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

                  </form>

                </div>
              </div>
            </div>
            
            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/datatables-demo.js"></script>

          </div>

