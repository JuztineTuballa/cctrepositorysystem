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
    header('Location: /cctrepositorysystem/deptheadprofile.php');
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

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Research Coordinator Profile Information <small class="h5 mb-4 text-gray-500">manage research coordinator profile information</small></h1>
    <small><p><i class="fas fa-fw fa-home fa-1x"></i><a href="admindashboard.php" class='text-gray-700'>&nbsp;&nbsp;Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;Research Coordinator Profile</p></small>
  </div>


  <!-- DATA TABLES-->
  <div class="card shadow mb-4" id="deptheadsettings">
  	<div class="card-header py-3">
  		<!--MODAL FORM OF ADD ADMIN-->
  		<br>
  		<button type="button" class="btn btn-primary float-right" class="dropdown-item" href="" data-toggle="modal" data-target="#AddDeptHeadModal">
  		+ Add Research Coordinator</button>

  		<!-- Add Admin Modal-->
  		<div class="modal fade" id="AddDeptHeadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog" role="document">
  				<div class="modal-content bg-light">
  					<div class="modal-header bg-c-blue">
  						<h5 class="modal-title text-light" id="exampleModalLabel">Add Research Coordinator</h5>
  						<button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
  							<span aria-hidden="true">×</span>
  						</button>
  					</div>

  					<!--MODAL BODY-->
  					<div class="modal-body text-dark">
  						<!--FORM ACTION dito nakalagay yung connection ng admin_signup.php tsakaya yung na METHOD="POST"-->
  						<form action="funcadmin_depthead_add.php" method="POST" enctype="multipart/form-data" onsubmit="return validatedepartment()">

  							<div class="form-group">
  								<label for="deptselect">Department</label>
  								<select id="deptselect" name="deptselect" class="container selectpicker d-flex p-2 form-select">
  									<option value="" data-hidden="true">Choose one</option>
  									<option value="School of Computer Studies">School of Computer Studies</option>
  									<option value="School of Education">School of Education</option>
  									<option value="School of Business Management">School of Business Management</option>
  									<option value="School of Hospitality and Tourism Management">School of Hospitality and Tourism Management</option>
  								</select>
  							</div>

  							<div class="form-group">
  								<label for="deptheadlastname">Last Name</label>
  								<input name="deptheadid" type="hidden" value="">
  								<input type="text" name="deptheadlastname" class="form-control" placeholder="Enter Last Name" required>
  							</div>

  							<div class="form-group">
  								<label>First Name</label>
  								<input name="deptheadid" type="hidden" value="">
  								<input type="text" name="deptheadfirstname" class="form-control" placeholder="Enter First Name" required>
  							</div>

  							<div class="form-group">
  								<label>Middle Name</label>
  								<input name="deptheadid" type="hidden" value="">
  								<input type="text" name="deptheadmiddlename" class="form-control" placeholder="Enter Middle Name" required>
  							</div>

  							<div class="form-group">
  								<label>Add Username</label>
  								<input type="text" name="deptheadusername" class="form-control" placeholder="Enter Username" required>
  							</div>

  							<div class="card-text form-group text-primary bg-light">
  								<small><b>Note: Password must meet the following requirements:</b></small><br>
  								<small>&#8226; Minimum of <b>8 characters</b></small><br>
  								<small>&#8226; Must contain at least one <b>digit (0-9)</b></small><br>
  								<small>&#8226; Must contain at least one <b>uppercase letter (A-Z)</b></small><br>
  								<small>&#8226; Must contain at least one <b>lowercase letter (a-z)</b></small>
  							</div>

  							<div class="form-group">
  								<label for="pwd">Add Password</label>
  								<div class="input-group" id="show_hide_password">
  									<input type="password" required class="form-control" id="deptheadpassword" name="deptheadpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Type Password">
  								</div>
  							</div>

  							<div class="form-group">
  								<label for="pwd">Confirm Password</label>
  								<div class="input-group" id="show_hide_password">
  									<input type="password" required class="form-control" id="deptheadconfirmpassword" name="deptheadconfirmpassword" placeholder="Confirm Password">
  								</div>
  								<div class="form-group">
  									<input class="mt-3 ml-1" type="checkbox" onclick="myFunctionDeptHeadPass()"><small> Show Password </small>
  									<div class="float-right mt-3 small" id="CheckPasswordMatchDH1"></div>
  								</div>
  							</div>

  							<label class="form-label" for="customFile">Upload Profile Picture</label>
  							<input type="file" name="deptheadpicture"  id="customFile" accept="image/gif, image/jpeg, image/png" required/>

  						</div>
  						<!--END MODAL BODY-->

  						<div class="modal-footer">
  							<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
  							<button type="submit" name="add_dh_btn" class="btn btn-primary">Add</button>
  						</div>

  					</form>
  				</div>
  			</div>
  		</div>
  		<!-- END ADD RESEARCH COORDINATOR MODAL-->


  		<div class='id="settings"'></div>
  		<h6 class="m-0 font-weight-bold text-primary">Research Coordinator Settings&nbsp;&nbsp;
  		</div> 
  		<!-- END OF MAIN CONTENT IN ADD RESEARCH COORDINATOR MODAL-->

  		<div class="card-body">
  			<div class="table-responsive">
  				<table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
  					<thead>
  						<tr>
  							<!--PRIMARY INFORMATION-->
  							<th style="display:none;">ID</th>
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
  							<th style="display:none;">ID</th>
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
									//preg_replace("|.|","*",$row['dhead_pword'])
  						$sql = "SELECT * FROM tb_depthead WHERE dhead_status = 'Active' ";
  						$query = $conn->query($sql);

  						while($row = $query->fetch_assoc()){
  							$image = (!empty($row['dhead_picture'])) ? 'uploads/'.$row['dhead_picture'] : 'uploads/adminprofile.png';

  							echo "
  							<tr>
  							<td style='display:none;'>".$row['dhead_id']."</td>
  							<td>".$row['dhead_dept']."</td>
  							<td>".$row['dhead_uname']."</td>
  							<td style='display:none;' class='small w-100 text-monospace small' type='password'>".$row['dhead_pword']."</td>
  							<td>
  							<img src='".$image."' width='50px' height='50px'>
  							<a data-target='#EditDeptHeadPhotoModal' class='pull-right text-primary editdhphoto' data-id='".$row['dhead_id']."'><span class='fa fa-edit'></span></a>
  							</td>
  							<td>".$row['dhead_lname']."</td>
  							<td>".$row['dhead_fname']."</td>
  							<td>".$row['dhead_mname']."</td>
  							<td><kbd class='text-capitalize status-posted'>".$row['dhead_status']."</kbd></td>
  							<td>
  							<div class='dropdown'>
  							<button class='btn btn-info dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
  							Manage
  							</button>
  							<div class='dropdown-menu' aria-labelledby='dropdownMenu2' />

  							<a  data-toggle='modal' data-target='#EditDeptHeadModal'></a>
  							<button class='dropdown-item edit01' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>General Settings</button> 

  							<a  data-toggle='modal' data-target='#EditDeptHeadModal2'></a>
  							<button class='dropdown-item edit03' type='button'><i class='fas fa-edit fa-sm fa-fw mr-2 text-gray-400'></i>Edit Username</button> 

  							<a  data-toggle='modal' data-target='#EditDeptHeadModal1'></a>
  							<button class='dropdown-item edit02' type='button'><i class='fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400'></i>Edit Password</button>

  							<form action='deptheadprofile.php' method='POST'>
  							<input type='hidden' name='archiveprofileid' value='".$row['dhead_id']."' />
  							<button class='dropdown-item' type='submit' name='ArchivedProfile' value='Archived'><i class='fas fa-archive fa-sm fa-fw mr-2 text-gray-400'></i>Move to Archive</button>
  							</form>

  							</div>
  							</div>
  							</td> 
  							</tr>
  							";
  						}
  						?> 


  						<!--END PHP CODE HERE--->
  					</tbody>
  				</table>
  			</div>
  		</div>

  		<div class="card-footer py-3">
  			<a href="deptheadprofilearchive.php">
  				<small style="float:right;"><i class="fa fa-archive"></i>&nbsp;Archives</small>
  			</a>
  		</div>

	</div>
</div>
<!-- /.CONTAINER FLUID -->

<?php
	include('includes/footer.php');
?>

<?php
  	//DITO PARA MATAWAG NATIN YUNG MODAL NI EDIT DEPT HEAD
  	include ('funcadmin_depthead_updatemodal.php');
?>

<?php

	//PHP FUNCTION FOR ARCHIVING PROFILE
	$mysqli = new mysqli('localhost','root','','db_cctrepository') or die(mysqli_error($mysqli));

	if (isset($_POST['ArchivedProfile'])) {
		$sid = $_POST['archiveprofileid'];

		$select = "UPDATE tb_depthead SET dhead_status = 'Archived' WHERE dhead_id = '$sid' ";
		$result = mysqli_query($conn,$select);

		echo "<script> alert('Succesfully moved to Archive!'); window.location='deptheadprofile.php?status=Archived' </script>"; 

	}
	//END PHP FUNCTION FOR ARCHIVING PROFILE
?>

<script>
//FETCH FOR GENERAL SETTINGS
$(function(){
	$(document).on('click', '.edit01', function(e){
		e.preventDefault();

		$('#EditDeptHeadModal').modal('show');
		$tablerow = $(this).closest('tr');

		var data = $tablerow.children("td").map(function(){
			return $(this).text();
		}).get();

		console.log(data);

        $('#update_deptheadid').val(data[0]);
        $('#edit_deptselect').val(data[1]);
        $('#edit_deptheadlastname').val(data[5]);
        $('#edit_deptheadfirstname').val(data[6]);
        $('#edit_deptheadmiddlename').val(data[7]);
        //$('#edit_deptheadusername').val(data[2]);
        //$('#edit_deptheadpassword').val(data[3]);

    });
});
//END -  FETCH FOR GENERAL SETTINGS
</script>

<script>
//FETCH FOR USERNAME
$(function(){
	$(document).on('click', '.edit03', function(e){
		e.preventDefault();

		$('#EditDeptHeadModal2').modal('show');
		$tablerow = $(this).closest('tr');

		var data = $tablerow.children("td").map(function(){
			return $(this).text();
		}).get();

		console.log(data);

		$('#update_deptheaduid').val(data[0]);
        $('#edit_deptheadusername').val(data[2]);
       
    });
});
//END -  FETCH FOR USERNAME
</script>

<script type="text/javascript">
//FETCH FOR SECURITY AND LOG IN
$(function(){
	$(document).on('click', '.edit02', function(e){
		e.preventDefault();

		$('#EditDeptHeadModal1').modal('show');
		$tablerow = $(this).closest('tr');

		var data = $tablerow.children("td").map(function(){
			return $(this).text();
		}).get();

		console.log(data);

		$('#depthead_sid').val(data[0]);
		$('#depthead_uname').val(data[2]);
		$('#depthead_oldpass').val(data[3]);
	});
});
//END - FETCH FOR SECURITY AND LOG IN
</script>

<script type="text/javascript">
//SCRIPT TO REQUIRE SELECTING A DEPARTMENT
function validatedepartment(){
	var department = document.getElementById('deptselect').value;
	if (department=="") {
		alert("Please Select Department!");
		return false;
	}
	return true;
}
//END - SCRIPT TO REQUIRE SELECTING A DEPARTMENT
</script>

<!--ADD PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
 function ADD_DHPasswordMatch() {
  var ADD_DHpassword = $("#deptheadpassword").val();
  var ADD_DHconfirmPassword = $("#deptheadconfirmpassword").val();
  if (ADD_DHpassword != ADD_DHconfirmPassword) {
    $("#CheckPasswordMatchDH1").html("Password does not match!").css("color", "red");
  } else {
    $("#CheckPasswordMatchDH1").html("Password match!").css("color", "green");
  }
}

$(document).ready(function() {
  $("#deptheadpassword, #deptheadconfirmpassword").on('keyup', function() {
    ADD_DHPasswordMatch();
  });
});
</script>
<!--END PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->

<!--EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script>
 function EDIT_DHPasswordMatch() {
  var EDIT_DHpassword = $("#depthead_newpass").val();
  var EDIT_DHconfirmPassword = $("#depthead_repass").val();
  if (EDIT_DHpassword != EDIT_DHconfirmPassword) {
    $("#CheckPasswordMatchDH2").html("Password does not match!").css("color", "red");
  } else {
    $("#CheckPasswordMatchDH2").html("Password match!").css("color", "green");
  }
}

$(document).ready(function() {
  $("#depthead_newpass, #depthead_repass").on('keyup', function() {
    EDIT_DHPasswordMatch();
  });
});
</script>
<!--END EDIT PASSWORD SCRIPT - FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->

<script>
//SCRIPT FOR FETCHING DEPT HEAD PICTURE
$(function(){
	$(document).on('click', '.editdhphoto', function(e){
		e.preventDefault();

		$('#EditDeptHeadPhotoModal').modal('show');
		$tablerow = $(this).closest('tr');

		var data = $tablerow.children("td").map(function(){
			return $(this).text();
		}).get();

		console.log(data);

		$('#depthead_pid').val(data[0]);
		$('#depthead_pphoto').val(data[4]);    

	});
});
//END SCRIPT FOR FETCHING DEPT HEAD PICTURE
</script>

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunctionDeptHeadPass() {
    var x = document.getElementById("deptheadpassword");
    var y = document.getElementById("deptheadconfirmpassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    if (y.type === "password") {
      y.type = "text";
    } else {
     y.type = "password";
   }
 }
</script>
<!--END SCRIPT TO SHOW OR HIDE PASSWORD-->

 