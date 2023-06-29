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
    header('Location: /cctrepositorysystem/lib_stud_req_approval.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
  include('includes/lb-header.php'); 
  include('includes/lb-navbar.php'); 
  include_once 'db_conn.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    
    <h1 class="h3 mb-0 text-gray-800">Requests  <small class="h4 mb-4 text-gray-500">manage student requests</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="librariandashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Requests</p></small>

  </div>
 
  <?php 
    if(isset($_SESSION['approval_status'])) {
  ?>
    
  <div class="alert" role="alert">
    <?php echo $_SESSION['approval_status']; ?>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  </div>
  
  <?php
    unset($_SESSION['approval_status']);
    }
  ?>
  
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <BR/>                 

    <h6 class="m-0 font-weight-bold text-gray-700 float-right">
    <a href="lib_stud_req_approval.php" class="text-primary">Pending Student Requests</a>
    &nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
    <a href="lib_stud_req_approval1.php" class="text-gray-700"></i>Approved Student Requests</a> 
    &nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
    <a href="lib_stud_req_approval2.php" class="text-gray-700">Denied Student Requests</a>   
    </h6>

  </div>
  <!--END OF CARD HEADER-->

  <div class="card-body">
      
    <form action="lib_stud_file_request_code.php" method="POST">

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th style="display:none;">ID</th>
              <th>
                <button type="submit" name="stud_approve_all_multiple_btn"  class="btn mx-1"><i class="fas fa-clipboard-check"></i></button>
                <input type="checkbox" onclick="toggle(this);" />&nbsp;Check&nbsp;all<BR/>
              </th>
              <th>Student Department</th>
              <th>Student Number</th>
              <th>Lastname</th>
              <th>Firstname</th>
              <th>File Title</th>
              <th>File Authors</th>
              <th>Date Requested</th>
              <th>Request Status</th>
              <th>Actions</th>
            </tr>
          </thead>
      
          <tbody>
            <?php
              
            $sesid = $_SESSION['librarian_id'];
           
            $sql = "SELECT *, tb_librarian.librarian_id 
                    FROM tb_librarian 
                    LEFT JOIN tb_frequest 
                    ON tb_frequest.req_fupstatus = 'Pending'
                    WHERE tb_librarian.librarian_id = '".$sesid."' ";
                    
            $query = $conn->query($sql);

            while($row = $query->fetch_assoc()) {
            
              echo "
              <tr>
                <td style='display:none;'>".$row['req_id']."</td>
                <td style='width:10px; text-align: center;'>
                <input type='checkbox' name='stud_auto_approve[]' value='".$row['req_id']."' />
                </td>
                </form>
                <td>".$row['req_studdepartment']."</td>
                <td>".$row['req_studnum']."</td>
                <td>".$row['req_studlname']."</td>
                <td>".$row['req_studfname']."</td>
                <td>".$row['req_fuptitle']."</td>
                <td>".$row['req_fupauthors']."</td>
                <td>".$row['req_date']."</td> 
                <td><kbd class='text-capitalize value-text'>".$row['req_fupstatus']."</kbd></td>
                <td>

                <div class='dropdown'>
             
                <form action='lib_stud_req_approval.php' method='POST'>
                <input type='hidden' name='approvestudid' value='".$row['req_id']."' />
                <button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Actions 
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenu2' />
                <a data-toggle='modal'></a>
                <button class='dropdown-item' type='submit' name='approve' value='Approve' /><i class='fas fa-check-square fa-sm fa-fw mr-2 text-gray-400'></i>Approve Request</button>
                <button class='dropdown-item' type='submit' name='deny' value='Deny' /><i class='fas fa-times-circle fa-sm fa-fw mr-2 text-gray-400'></i>Deny Request</button>
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

  <div class="card-footer py-3">
    <a href="lib_stud_req_archived.php">
      <small style="float:right;"><i class="fa fa-archive"></i>&nbsp;Archives</small>
    </a>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
  include('includes/lb-footer.php');
?>


<?php
  
  //PHP FUNCTION FOR APPROVE AND DECLINE REQUEST
  
  if (isset($_POST['approve'])) {
    $sid = $_POST['approvestudid'];

    $select = "UPDATE tb_frequest SET req_fupstatus = 'Approved' WHERE req_id = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $sid);
    $stmt->execute();

    echo "<script> alert('Request Approved!'); window.location='lib_stud_req_approval.php?status=approved' </script>"; 

  }

  if (isset($_POST['deny'])) {
    $sid = $_POST['approvestudid'];

    $select = "UPDATE tb_frequest SET req_fupstatus = 'Denied' WHERE req_id = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $sid);
    $stmt->execute();

    echo "<script> alert('Request Denied!'); window.location='lib_stud_req_approval.php?status=denied' </script>"; 

  }

?>

<!--SCRIPT FOR STATUS AND LEGEND-->
<script type="text/javascript">

  document.addEventListener('DOMContentLoaded', function() {
    $( ".value-text:contains('Pending')" ).attr('style', 'background-color:#FF8C00', 'color:#FFFFFF'); 
    $( ".value-text:contains('Approved')" ).attr('style', 'background-color:#32CD32', 'color:#FFFFFF'); 
    $( ".value-text:contains('Denied')" ).attr('style', 'background-color:#C41E3A', 'color:#FFFFFF'); 
  });

</script>
<!--END SCRIPT FOR STATUS AND LEGEND-->


<!--SCRIPT FOR SELECTING ALL CHECKBOX-->
<script src="js/select-all-checkbox.js"></script>

