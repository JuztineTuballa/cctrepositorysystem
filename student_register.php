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
    header('Location: /cctrepositorysystem/student_register.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include "includes/student-register-header.php";
?>

<body>
  
  <!-- LOGIN FORM --> 

  <BR/>
  <body>
    <div class="container">
      <BR/><BR/>
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          
          <!--NESTED ROW WITHIN CARD BODY-->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-reg-image"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form action="student_register.php" method="POST" class="user" enctype="multipart/form-data" onsubmit="return validatedepartment()">
                  <div class="form-group">
                    <label for="deptselect">Department</label>
                    <select id="deptselect" name="deptselect" class="container selectpicker d-flex p-2 form-select" required>
                      <option value="" data-hidden="true">Choose one</option>
                      <option value="School of Computer Studies">School of Computer Studies</option>
                      <option value="School of Education">School of Education</option>
                      <option value="School of Business Management">School of Business Management</option>
                      <option value="School of Hospitality and Tourism Management">School of Hospitality and Tourism Management</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <input type="text" id="student_lname" name="student_lname" class="form-control" placeholder="Last Name" required>
                  </div>
                  <div class="form-group">
                    <input type="text" id="student_fname" name="student_fname" class="form-control" placeholder="First Name" required>
                  </div>
                  <div class="form-group"> <!--BAGO LANG TONG MNAME NA NILAGAY KO 11/14/22-->
                    <input type="text" id="student_mname" name="student_mname" class="form-control" placeholder="Middle Name" required>
                  </div>
                  <div class="form-group">
                    <input type="text" id="student_idnumber" name="student_idnumber" class="form-control" placeholder="Student Number" required>
                  </div>

                  <!--DATE-->
                  <!--PHP CODE PARA SA DATE YUNG KAPARES NETO NASA db_conn.php-->
                  <?php
                   if(isset($_SESSION['status'])){
                    echo "<h5>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                  }
                  ?>

                  <div class="form-group" id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                    <label for="example">Date of birth</label>
                    <input placeholder="Select date" type="date" id="student_birthdate" name="student_birthdate" id="example" class="form-control" required>
                  </div>
                  <!--END DATE-->

                   <label for="example">Password</label>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0" id="show_hide_password">
                      <input type="password" class="form-control" id="student_pword" name="student_pword"  placeholder="Type Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                      <input class="mt-3 ml-2" type="checkbox" onclick="myFunction()"><small> Show Password </small>
                    </div>
                    <div class="col-sm-6" id="show_hide_password">
                      <input type="password" class="form-control" id="student_cpword" name="student_cpword" placeholder="Repeat Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"required>
                      <div class="float-right mt-3 small" id="CheckPasswordMatch"></div>       
                    </div>
                    <div class="col-sm-9"><BR/>
                     <label class="form-label" for="customFile">Upload Picture</label>
                     <!-- <small>(2x2 inches, colored with white background)</small> -->
                     <input type="file" name="studentpicture"  id="customFile" accept="image/gif, image/jpeg, image/png, image/jfif" required/>
                     <!-- onchange="checkImageDimensions();" -->
                   </div>
                 </div>

                 <button type="submit" id="register" name="register" value="register" class="btn btn-primary btn-user btn-block">Register Account</button>
                 
               </form>
               <hr>
               <div class="text-center">
                <a class="small" href="index.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
        <!--END - NESTED ROW WITHIN CARD BODY-->
      </div>
    </div>
  </div>

</body>



<!--PHP TO REGISTER STUDENT-->
<?php 
include 'db_conn.php';

if (isset($_POST['register'])) {

  $varsDepartment = $_POST['deptselect'];
  $varsLName = str_replace(['"', "'"], "", $_POST['student_lname']);
  $varsFName = str_replace(['"', "'"], "", $_POST['student_fname']);
  $varsMName = str_replace(['"', "'"], "", $_POST['student_mname']);
  $varsIdNo = $_POST['student_idnumber'];
  $varsBDate = $_POST['student_birthdate'];
  $varsPword = str_replace(['"', "'"], "", $_POST['student_pword']);
  $varsCPword = str_replace(['"', "'"], "", $_POST['student_cpword']);
  $varsPicture = $_FILES['studentpicture']['name'];

  // Hash password before inserting
  $hashed_password = password_hash($varsPword, PASSWORD_DEFAULT);

  // Check if passwords match
  if ($varsPword !== $varsCPword) {
    echo "<script> alert('Passwords do not match!'); window.location='student_register.php?status=error' </script>";
    return;
  }

  if (!empty($varsPicture)) {
    move_uploaded_file($_FILES['studentpicture']['tmp_name'], 'uploads/'.$varsPicture); 
  }

  $selectTb2 = "SELECT DISTINCT valstud_num, valstud_lname, valstud_birthdate FROM tb_validatestudent WHERE valstud_num = '$varsIdNo' AND valstud_birthdate = '$varsBDate' ";
  $resultTb2 = mysqli_query($conn, $selectTb2);

  $selectTb1 = "SELECT * FROM tb_student WHERE stud_num = '$varsIdNo' ";
  $resultTb1 = mysqli_query($conn, $selectTb1);

  if (mysqli_num_rows($resultTb2) > 0) {
    if (mysqli_num_rows($resultTb1) == 0) {

      $register = "INSERT INTO tb_student (stud_department, stud_lname, stud_fname, stud_mname, stud_num, stud_bdate, stud_pword, stud_picture, stud_status) 
                   VALUES('$varsDepartment', '$varsLName', '$varsFName', '$varsMName', '$varsIdNo', '$varsBDate', '$hashed_password', '$varsPicture', 'Approved')";
      mysqli_query($conn, $register);

      echo "<script> alert('Thanks for signing up!'); window.location='student_register.php?status=approved' </script>"; 
    } else {
      echo "<script> alert('This student account is already taken!'); window.location='student_register.php?status=error' </script>"; 
    }
  } else {
    echo "<script> alert('Sorry, this system is exclusive for City College of Tagaytay students only!'); window.location='student_register.php?status=error' </script>"; 
  }
  return;
}

?>
<!--END - PHP TO REGISTER STUDENT-->


<?php
  include 'includes/student-signin-footer.php';
?>


<!--SCRIPT TO ONLY 2x2 SIZE ID-->
<script src="js/image-size.js"></script>
<!--END SCRIPT TO ONLY 2x2 SIZE ID-->

<!--SCRIPT TO ONLY ALLOW NUMERIC CHARACTERS IN STUDENT ID-->
<script type="text/javascript">
  $(document).ready(function() {
  // Restrict input to only accept numeric values
  $('#student_idnumber').on('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
  });
});

</script>
<!--END - SCRIPT TO ONLY ALLOW NUMERIC CHARACTERS IN STUDENT ID-->

<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunction() {
    var x = document.getElementById("student_cpword");
    var y = document.getElementById("student_pword");
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

<!--SCRIPT TO REQUIRE SELECTING A DEPARTMENT-->
<script type="text/javascript">
  function validatedepartment(){
    var department = document.getElementById('deptselect').value;
    if (department=="") {
      alert("Please Select Department!");
      return false;
    }
    return true;
  }
</script>
<!--END SCRIPT FOR REQUIRING SELECTING DEPARTMENT-->

<!--SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script type="text/javascript">
  $(function () {
    $("#register").click(function () {
      var password = $("#txtPassword").val();
      var confirmPassword = $("#txtConfirmPassword").val();
      if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }
      return true;
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#student_cpword").on('keyup', function() {
      var password = $("#student_pword").val();
      var confirmPassword = $("#student_cpword").val();
      if (password != confirmPassword)
        $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
      else
        $("#CheckPasswordMatch").html("Password match !").css("color", "green");
    });
  });
</script>
<!--END SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
