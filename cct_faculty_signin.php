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
    header('Location: /cctrepositorysystem/cct_faculty_signin.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>

<?php
include "includes/faculty-signin-header.php";
?>

<!--class="bg-gradient-primary"-->
<body>

  <!--LOGIN FORM-->
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 110px;">

      <div class="col-xl-4 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row login-font-color">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <img src="./a-images/cct-faculty.png" style="width: 230px;"> 
                    <h5 class="h6 text-gray-900 mb-4 pt-3">Login to start your session</h5>
                  </div>
                  
                  <!--PHP CODE FOR ERRORS -->
                  <?php if (isset($_GET['error'])){ ?>
                    <p class="modal-error"><?php echo $_GET['error']; ?></p>
                  <?php } ?>

                  <form action="cct_faculty.php" class="user" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Password" name="password" id="jsmyInput">
                    </div>
                    <div class="form-group ml-2">
                      <div class="clearfix">
                        <span class="invalid-feedback"></span>
                          <input type="checkbox" onclick="myFunction()"><small> Show Password </small>
                        </div>
                    </div>
                    <div class="form-group">
                       <button type="submit" name="adminloginbtn" class="btn btn-primary btn-user btn-block blockz" value="Login">Log in</button>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--END LOGIN FORM-->

  <?php
  include 'includes/faculty-signin-footer.php';
  ?>

  <script>
    function myFunction() {
      var x = document.getElementById("jsmyInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>






