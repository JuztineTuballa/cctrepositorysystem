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
    header('Location: /cctrepositorysystem/librarian_view_sbm.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
  include('includes/lb-header.php'); 
  include('includes/lb-navbar.php'); 
  include_once 'db_conn.php';
?>

<style>

  /**Format Table Size**/
  table td:nth-child(4) {
    width: 140px;
  }
  table td:nth-child(5) {
    width: 140px;
  }
  /**Format Table Size**/

</style>

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">

  <!--INSERTED CODE-->  
  <!-- PAGE HEADING -->

  <div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h4 mb-4 text-gray-800">School of Business Management<small class="h4 mb-4 text-gray-500"> view school of business management research papers</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="librariandashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;School of Business Management</p></small>
  </div>

  <!--END INSERTED CODE-->

  <!-- DATA TABLES -->
  <div class="card shadow mb-4">

    <div class="card-header py-3">
      
      <div class='id="settings"'></div>
      <h6 class="m-0 font-weight-bold text-primary">View Research Papers</h6><small class="h4 mb-4 text-gray-500"></small>
    </div> <!-- END OF MAIN CONTENT -->

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
              <th>Abstract</th>
              <th>File</th>
            </tr>
          </thead>
          <tbody>
            <?php
            
            $sql = "SELECT * FROM tb_fuploads WHERE fup_department = 'School of Business Management' AND fup_status = 'Posted' ";
            $query = $conn->query($sql);

            while($row = $query->fetch_assoc()) {

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
                <td>
                  <a target='_blank' href='uploads-papers/".$row['fup_document']."#toolbar=0&navpanes=0'>".$row['fup_document']." 
                  <i class='fas fa-file-pdf fa-sm fa-fw mr-2 text-info'></i></a>
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
</div>
<!-- /.END CONTAINER FLUID -->

<?php
  include('includes/lb-footer.php');
?>


<!-- SCRIPT - DISABLE RIGHT CLICK BUTTON-->
<script type="text/javascript">
  $(document).bind("contextmenu",function(e){
    return false;
  });
</script>
<!-- END SCRIPT - DISABLE RIGHT CLICK BUTTON-->


<!--SCRIPT FOR SHOW MORE SHOWLESS COLUMN NOTE : THESE INCLUDES A CSS IN HEADER-->
<script type="text/javascript">
  
 $(document).ready(function() {
  $('.truncate').each(function() {
    var $this = $(this);
    var $seeMore = $('<a href="librarian_view_sbm.php" class="see-more"> See more</a>');
    var fullText = $this.text();
    $seeMore.on('click', function(event) {
      event.preventDefault();
      $this.text(fullText);
    });
    $this.text(fullText.substr(0, 150) + '...'); /* or any other value */
    $this.append($seeMore);
  });
});
 
</script>
<!--END - SCRIPT FOR SHOW MORE SHOWLESS COLUMN NOTE : THESE INCLUDES A CSS IN HEADER-->



