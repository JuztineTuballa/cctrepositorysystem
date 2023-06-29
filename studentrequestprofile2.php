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
    header('Location: /cctrepositorysystem/studentrequestprofile2.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
  include 'db_conn.php';
  include "includes/student-header.php";
  include "includes/student-navbar.php";
?>


<link href="css/seemore-table-alignment.css"  rel="stylesheet">

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">
 <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">My Requests <small class="h4 mb-4 text-gray-500"> manage your requested research outputs</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="studentprofile.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;My Requests</p></small>
  </div>
</div>

<!--START HEADER-->
<header class="bg-headerimage2 py-5 m-3">
  <div class="container px-5">
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-7">
        <div class="text-center my-5">
          <h2 class="display-6 fw-bolder text-white mb-0">    
            <!--<?php echo strtoupper($_SESSION ['stud_department']) ?>-->
            REQUESTED RESEARCH RECORDS
          </h2>
          <p class='text-white'>Denied Requested Research Outputs</p>
          <p class="lead text-white mb-4"></p>
        </div>
      </div>
    </div>
  </div>
</header>
<!--END HEADER-->

 
<BR/>

<!-- BEGIN TABLE -->
<div class="container-fluid">
  <div class="card shadow mb-4">

    <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary">
         <a href="studentrequestprofile.php" class="text-gray-700">
          <i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-700'></i>
          Approved Requested Research Outputs</a>&nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
         <a href="studentrequestprofile1.php" class="text-gray-700">
          <i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-700'></i>
          Pending Requested Research Outputs</a>&nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
         <a href="studentrequestprofile2.php">
          <i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-700'></i>
          Denied Requested Research Outputs</a>&nbsp;&nbsp; 
       </h6>
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;"></th>
                <th>Title</th>
                <th>Department</th>
                <th>Author</th>
                <th>File</th>
                <th>Abstract</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!--PRIMARY INFORMATION-->
                <th style="display:none;"></th>
                <th>Title</th>
                <th>Department</th>
                <th>Author</th>
                <th>File</th>
                <th>Abstract</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
          <tbody>
            <?php

            $sesnum = $_SESSION['studentidno'];
            $sesid = $_SESSION['stud_department'];

            $sql = "SELECT *, tb_frequest.req_studdepartment AS canid FROM tb_frequest JOIN tb_student ON tb_frequest.req_studnum = tb_student.stud_num AND tb_frequest.req_studdepartment=tb_student.stud_department JOIN tb_fuploads ON tb_frequest.req_fupdepartment = tb_fuploads.priority_id AND tb_frequest.req_fupauthors = tb_fuploads.fup_author WHERE tb_frequest.req_studnum = '".$sesnum."' AND tb_frequest.req_studdepartment = '".$sesid."' AND tb_frequest.req_fupstatus = 'Denied' ";
            $query = $conn->query($sql);

            while($row = $query->fetch_assoc()) {

              echo "
              <tr>
                <td style='display:none;'>".$row['req_id']."</td>
                <td>".$row['req_fuptitle']."</td>
                <td>".$row['req_fupdepartment']."</td>
                <td>".$row['req_fupauthors']."</td>
                <td>".$row['req_date']."</td>
                <div class='truncate-wrapper'>
                  <td class='truncate'>".$row['fup_abstract']."</td>
                </div>
                <td><kbd class='value-text'>".$row['req_fupstatus']."</kbd></td>
                <td style='white-space: nowrap;'>
                  <a  data-toggle='modal' data-target='#StudentRequestModal'></a>
                    <button style='display: inline-block; margin-right: 10px; background-color:#9e2662; color:white;' class='btn request1'><i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-200'></i>
                      Request Again
                    </button>
                  </a>
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
<!--END TABLE-->
 

<?php
  include "includes/student-footer.php";
?>

<?php 
  //DITO PARA MATAWAG NATIN YUNG MODAL NI STUDENT REQUEST
  include ('studentrequestmodal.php');
?>


<script>
//FETCH MODAL
$(function(){
  $(document).on('click', '.request1', function(e){
    e.preventDefault();
    
    $('#StudentRequestModal').modal('show');
    $tablerow = $(this).closest('tr');

    var data = $tablerow.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

        $('#rfile_id').val(data[0]);
        $('#rfile_title').val(data[1]);
        $('#rfile_department').val(data[2]);
        $('#rfile_authors').val(data[3]);
        $('#rfile_date').val(data[4]);
        $('#rfile_abstract').val(data[5]);
        $('#rfileuploadfile').val(data[6]);
        
      });
});
//END - MODAL
</script>

<script type="text/javascript">
//SCRIPT - DISABLE RIGHT CLICK BUTTON
  $(document).bind("contextmenu",function(e){
    return false;
  });
//END SCRIPT - DISABLE RIGHT CLICK BUTTON
</script>


<script type="text/javascript">
//SCRIPT FOR STATUS AND LEGEND 
  document.addEventListener('DOMContentLoaded', function() {
    $( ".value-text:contains('Pending')" ).attr('style', 'background-color:#FF8C00', 'color:#FFFFFF'); 
    $( ".value-text:contains('Approved')" ).attr('style', 'background-color:#32CD32', 'color:#FFFFFF'); 
    $( ".value-text:contains('Denied')" ).attr('style', 'background-color:#C41E3A', 'color:#FFFFFF'); 
});
//END SCRIPT FOR STATUS AND LEGEND
</script>


<script type="text/javascript">
// SEE MORE ONLY
 $(document).ready(function() {
  $('.truncate').each(function() {
    var $this = $(this);
    var $seeMore = $('<a href="studentrequestprofile2.php" class="see-more"> See more</a>');
    var fullText = $this.text();
    $seeMore.on('click', function(event) {
      event.preventDefault();
      $this.text(fullText);
    });
    $this.text(fullText.substr(0, 150) + '...'); /* or any other value */
    $this.append($seeMore);
  });
});
// END SEE MORE ONLY
</script>