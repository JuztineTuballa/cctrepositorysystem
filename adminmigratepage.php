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
    header('Location: /cctrepositorysystem/adminmigratepage.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include_once 'exports/conn_export.php';
include_once 'includes/header.php'; 
include_once 'includes/navbar.php'; 
?> 

<!-- BEGIN PAGE CONTENT -->
<div class="container-fluid">

  <!-- PAGE HEADING -->
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h4 class="h4 mb-0 text-gray-800">Manage Database <small class="h4 mb-4 text-gray-500"> Backup & Restore Database</small></h4>
    <small><p>
      <i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Manage Database</p></small>
  </div>
    
<BR/><BR/> 

<?php if (isset($_GET['successmessage'])) { ?>
  <div class="alert alert-dismissible fade show py-3" role="alert"  style="background-color: #28a745; color: #fff;">
    <i class="fas fa-bell"></i>
    <?php echo $_GET['successmessage']; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<?php if (isset($_GET['errormessage'])){ ?>
  <p class="alert alert-warning mt-3 pb-3"><i class="fas fa-bell"></i> <?php echo $_GET['errormessage']; ?></p>
<?php } ?>

<BR/>       

<div class="row">

  <div class="col-lg-6">
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-share-square"></i> Export Database</h6>
      </div>
      <div class="card-body text-center">
          <a href="exports/adminExportdatabase.php">
            <button class="btn btn-primary mx-3 my-3 px-4 py-4" type="button"><i class="fas fa-fw fa-database"></i> Export Database</button>
          </a>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-upload"></i> Import Database</h6>
      </div>
      <div class="card-body text-center">
          <!-- <label class="btn btn-danger mx-3 my-3 px-4 py-4">
            <i class="fas fa-fw fa-database"></i> Import Database
            <input type="file" accept=".sql" style="display:none;">
          </label> -->
          <button class="btn btn-danger mx-3 my-3 px-4 py-4" type="button" data-toggle="modal" data-target="#modal1">
            <i class="fas fa-fw fa-database"></i> Import Database
          </button>

      </div>
    </div>
  </div>

</div>
 
<BR/><BR/><BR/><BR/><BR/><BR/><BR/><BR/><BR/><BR/>  

</div>
<!-- END CONTENT ROW -->
 

<!--MODAL -->

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal1Label">Import Database</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="exports/adminImportdatabase.php" method="POST" enctype="multipart/form-data">
        
        <div class="modal-body">
          <div class="alert alert-warning mt-3 pb-3">
            <i class="fas fa-exclamation-triangle"></i> Please note that the import process will overwrite your System including the database. Please ensure that you have a backup of your data before proceeding to the next step.
          </div>
          <div class="custom-file my-3">
            <input type="file" class="custom-file-input" id="fileUpload" name="database" accept=".sql" required>
            <label class="custom-file-label" for="inputDatabase">Choose file</label>
          </div>
        </div>
        
        <div class="modal-footer">
            <button type="submit" id="import" name="import" value="Import" class="btn btn-primary">Import</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </form>

    </div>
  </div>
</div>

<!--END MODAL -->

<?php
include 'includes/footer.php';
?>


<script>
  document.querySelector('#fileUpload').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    document.querySelector('.custom-file-label').innerHTML = fileName;
  });
</script>


