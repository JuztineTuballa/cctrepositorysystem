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
    header('Location: /cctrepositorysystem/show_all.php');
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
    <h1 class="h3 mb-0 text-gray-800">Research Outputs <small class="h4 mb-4 text-gray-500">view uploaded research outputs</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="studentprofile.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Research Outputs</p></small>
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
            RESEARCH OUTPUTS
          </h2>
          <p class='text-white'>All Collections of Submitted Research Outputs<BR/></p>
          <p class="lead text-white mb-4"></p>
        </div>
      </div>
    </div>
  </div>
</header>
<!--END START HEADER--> 

<!-- BEGIN TABLE -->
<div class="container-fluid">
  <div class="card shadow mb-4">

  <div class="card-header py-3">
      <SMALL class="m-0 font-weight-bold text-primary">
      <a href="show_all.php"><i class="fas fa-file-pdf fa-sm fa-fw mr-2"></i>All Collections</a> 
       &nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
      <a href="show_scs.php" class="text-gray-700"><i class="fas fa-file-pdf fa-sm fa-fw mr-2"></i>School of Computer Studies</a> 
       &nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
      <a href="show_sed.php" class="text-gray-700"><i class="fas fa-file-pdf fa-sm fa-fw mr-2"></i>School of Education</a>
       &nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
      <a href="show_sbm.php" class="text-gray-700"><i class="fas fa-file-pdf fa-sm fa-fw mr-2"></i>School of Business Management</a>
       &nbsp;&nbsp;<code class="text-secondary">|</code>&nbsp;&nbsp;
      <a href="show_shtm.php" class="text-gray-700"><i class="fas fa-file-pdf fa-sm fa-fw mr-2"></i>School of Hospitality and Tourism Management</a>
      </SMALL>
  </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-bordered table-striped table-responsive-stack" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th style="display:none;"></th> <!--FILE ID-->
              <th>Title</th>
              <th>Department</th>
              <th>Author</th>
              <th>Date</th>
              <th>Abstract</th>
              <th>More</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <!--PRIMARY INFORMATION-->
              <th style="display:none;"></th> <!--FILE ID-->
              <th>Title</th>
              <th>Department</th>
              <th>Author</th>
              <th>Date</th>
              <th>Abstract</th>
              <th>More</th>

            </tr>
          </tfoot>
          <tbody>
            <?php
                        
            $sql = "SELECT fup_id, fup_title, fup_department, fup_author, fup_date, fup_abstract FROM tb_fuploads 
                    WHERE fup_status = 'Posted'
                    ORDER BY fup_department ASC";

            $result = $conn->query($sql);
 
            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo "
                  <tr>           
                  <td style='display:none;'>".$row['fup_id']."</td>
                  <td>".$row['fup_title']."</td>
                  <td>".$row['fup_department']."</td>
                  <td>".$row['fup_author']."</td>
                  <td>".$row['fup_date']."</td>
                  <div class='truncate-wrapper'>
                    <td class='truncate'>".$row['fup_abstract']."</td>
                  </div>
                  <td style='white-space: nowrap;'>

                    <a  data-toggle='modal' data-target='#StudentRequestModal'></a>
                      <button style='display: inline-block; margin-right: 10px;' class='btn btn-info request1'><i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-200'></i>
                      Request Full Content</button>
                    </a>

                  </td>
                  </tr>
                ";
              }
            }
            ?> <!--END PHP CODE HERE--->
          </tbody>
        </table>
      </div>
    </div>

</div>
<!--END TABLE-->

<?php
  include "includes/student-footer.php";
  include "includes/student-table-scripts.php";
?>

<?php 
  //DITO PARA MATAWAG NATIN YUNG MODAL NI STUDENT REQUEST
  include ('studentrequestmodal.php');
?>

<script>
//FETCH FOR GENERAL SETTINGS
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
//END - FETCH FOR GENERAL SETTINGS
</script>

<!-- SCRIPT - DISABLE RIGHT CLICK BUTTON-->
<script type="text/javascript">
  $(document).bind("contextmenu",function(e){
    return false;
  });
</script>
<!-- END SCRIPT - DISABLE RIGHT CLICK BUTTON-->

 