<?php
 session_start();
 include 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CCT Web-Based Repository of Research Outputs</title>

    <link rel="icon" type="image/png" href="a-images\cct-icon.png" sizes="16x16">


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/darkmode-signin.css" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>

    body {
      background-color:#f5f5f5; 
    }

    </style>

</head>

<body>
<BR><BR><BR>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="./a-images/cct-logo3.png" style="width: 270px;">
                                        <h5 class="h5 text-gray-900 mb-3 pt-3">Reset Password</h5>
                                    </div>
                                    <form action="z-admin-password-reset-code.php" method="POST" class="user">
                                        
                                        <!--PHP CODE FOR ERRORS -->
                                        <?php if (isset($_GET['error'])){ ?>
                                        <p class="modal-error"><?php echo $_GET['error']; ?></p>
                                        <?php } ?>

                                        <div class="form-group">
                                        	<!--NOTE LALABAS LANG YUNG VALUE NI TOKEN AT EMAIL KAPAG CLINICK MO YUNG LINK SA EMAIL NA SINEND 
                                        	SI VARIABLE NA TOKEN SA VALUE="" SYSTEM GENERATED NA YAN HINDI NA YAN SAKOP NG CODES NATEN -->
                                        	<input type="hidden" class="form-control form-control-user text-gray-900" value="<?php if(isset($_GET['token'])) { echo $_GET['token']; } ?>" name="admin_reset_token">
                                        </div>

                                         <div class="form-group">
                                        	<!--NOTE LALABAS LANG YUNG VALUE NI TOKEN AT EMAIL KAPAG CLINICK MO YUNG LINK SA EMAIL NA SINEND 
                                        	SI VARIABLE NA EMAIL SA VALUE="" SYSTEM GENERATED NA YAN HINDI NA YAN SAKOP NG CODES NATEN -->
                                        	<input  class="form-control text-gray-900" value="<?php if(isset($_GET['email'])) { echo $_GET['email']; } ?>"
                                        	 name="admin_email_reset_check" readonly>
                                        </div>

                                        <div class="card-text form-group text-primary bg-light">
                                          <small><b>Note: New Password must meet the following requirements:</b></small><br>
                                          <small>&#8226; Minimum of <b>8 characters</b></small><br>
                                          <small>&#8226; Must contain at least one <b>digit (0-9)</b></small><br>
                                          <small>&#8226; Must contain at least one <b>uppercase letter (A-Z)</b></small><br>
                                          <small>&#8226; Must contain at least one <b>lowercase letter (a-z)</b></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="admin_enter_new_password" id="admin_enter_new_password" class="form-control text-gray-900" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter New Password">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="admin_confirm_new_password" id="admin_confirm_new_password" class="form-control text-gray-900" placeholder="Enter New Password">
                                        </div>

                                        <div class="form-group">
                                            <input class="mt-3 mb-1 ml-1" type="checkbox" onclick="myFunction()"><small> Show Password </small>
                                            <div class="float-right mt-3 small" id="CheckResetPasswordMatch"></div>
                                        </div>
                                         
                                        <button type="submit" name="admin_password_update_button" class="btn btn-primary btn-user btn-block blockz">Reset Password</button>
                                    </form>
                                    <hr>
                                    
                                    <div class="text-center">
                                      <div class="form-group">
                                        Back to <a href="cct_signin.php">&nbsp;Sign in</a></p>
                                      </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<?php
include 'includes/z-forgot-password-footer.php';
?>


<!--SCRIPT TO SHOW OR HIDE PASSWORD-->
<script>
  function myFunction() {
    var x = document.getElementById("admin_enter_new_password");
    var y = document.getElementById("admin_confirm_new_password");
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
 

<!--SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
<script type="text/javascript">
  $(function () {
    $("#admin_password_update_button").click(function () {
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
    $("#admin_confirm_new_password").on('keyup', function() {
      var password = $("#admin_enter_new_password").val();
      var confirmPassword = $("#admin_confirm_new_password").val();
      if (password != confirmPassword) {
        $("#CheckResetPasswordMatch").html("Password does not match !").css("color", "red");
      }
      else {
        $("#CheckResetPasswordMatch").html("Password match !").css("color", "green");
      }
    });
  });
</script>
<!--END SCRIPT FOR CONFIRMING IF BOTH DATA IN THE PASSWORD IS CORRECT-->
