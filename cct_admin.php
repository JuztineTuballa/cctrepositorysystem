
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

<?php

session_start();

// Connect to database
include_once 'db_conn.php';

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Function to sanitize user input
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Get form Input
    $username = validate($_POST["username"]);
    $password = validate($_POST["password"]);

    // Get user details from admin table
    $query_admin = "SELECT * FROM tb_adminuser WHERE admin_username = BINARY '$username'";
    $result_admin = mysqli_query($conn, $query_admin);

    if (empty($username)) {
        header("location: cct_admin_signin.php?error=Username Required.");
        exit();  

    } else if (empty($password)) {
        header("location: cct_admin_signin.php?error=Password Required.");
        exit();  

    } else {

        if (mysqli_num_rows($result_admin) > 0) { 

            // User is an Admin
            $row = mysqli_fetch_assoc($result_admin);

            if (password_verify($password, $row['admin_password'])) {
                if ($row['admin_status'] == 'Active') {

                    $_SESSION['admin_username'] = $row['admin_username'];
                    $_SESSION['admin_firstname'] = $row['admin_firstname'];
                    $_SESSION['admin_lastname'] = $row['admin_lastname'];
                    $_SESSION['admin_gender'] = $row['admin_gender'];
                    $_SESSION['admin_id'] = $row['admin_id'];
                    $_SESSION['admin_picture'] = $row['admin_picture'];
                    $adminMessage1 = addslashes($_SESSION["admin_firstname"]);
                    $adminMessage2 = addslashes($_SESSION["admin_lastname"]);
                    echo "<script> alert('Login Success! Welcome'+' '+'$adminMessage1'+' '+'$adminMessage2'+'!'); window.location='admindashboard.php?login=success' </script>"; 
                    exit();

                } else if ($row['admin_status'] == 'Deactivated') {

                    if (isset($_POST['birthday'])) {
                        $entered_birthday = validate($_POST['birthday']);

                        // Get user's birthday from database
                        $user_birthday_query = "SELECT admin_birthday FROM tb_adminuser WHERE admin_username = BINARY '$username'";
                        $result_birthday = mysqli_query($conn, $user_birthday_query);
                        $row_birthday = mysqli_fetch_assoc($result_birthday);

                        if ($entered_birthday == $row_birthday['admin_birthday']) {

                            // Activate user's account
                            $activate_query = "UPDATE tb_adminuser SET admin_status = 'Active', admin_reac_timestamp = NOW() WHERE admin_username = BINARY '$username'";
                            mysqli_query($conn, $activate_query);

                            $_SESSION['admin_username'] = $row['admin_username'];
                            $_SESSION['admin_firstname'] = $row['admin_firstname'];
                            $_SESSION['admin_lastname'] = $row['admin_lastname'];
                            $_SESSION['admin_gender'] = $row['admin_gender'];
                            $_SESSION['admin_id'] = $row['admin_id'];
                            $_SESSION['admin_picture'] = $row['admin_picture'];

                            $adminMessage1 = addslashes($_SESSION["admin_firstname"]);
                            $adminMessage2 = addslashes($_SESSION["admin_lastname"]);

                            echo "<script> alert('Your account has been reactivated. Welcome'+' '+'$adminMessage1'+' '+'$adminMessage2'+'!'); window.location='admindashboard.php?login=success' </script>"; 
                            exit();

                        } else {
 
                            echo "<script> alert('Incorrect Birthday!'); window.location='cct_admin_signin.php?login=error' </script>"; 
                            exit();
                        }
                    }

                    // User is deactivated and needs to enter their birthday
                    else {

                        echo '
                            <div class="container">
                            <div class="row justify-content-center">
                            <div class="col-xl-7 col-lg-12 col-md-9">
                            <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                            <div class="row">
                            <div class="col-lg-12">
                            <div class="p-5">
                            <div class="text-center">
                            <div class="text-center">
                            <img src="./a-images/cct-logo3.png" style="width: 270px;">
                            <h5 class="h5 text-gray-900 mb-3 pt-3">Account Reactivation</h5>
                            </div>
                            <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
                            <div class="form-group">
                            <label for="birthday">Please enter your birthday to reactivate your account:</label>
                            <input type="date" id="birthday" name="birthday" class="form-control form-control-user" required min="1930-01-01">
                            <?php if (isset($_GET[\'error\'])){ ?>
                            <p class="modal-error"><?php echo $_GET[\'error\']; ?></p>
                            <?php } ?>
                            </div>
                            <input type="hidden" id="username" name="username" value="' . $username . '">
                            <input type="hidden" id="password" name="password" value="' . $password . '">
                            <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            ';


                    }
                }

            } else {
                // Invalid Password Casing
                header("location: cct_admin_signin.php?error=Incorrect Username or Password.");
                exit();  
            }

        } //ADMIN CLOSING

        else { 
            // If Result is not Equal to All Users
            header("location: cct_admin_signin.php?error=Incorrect Username or Password.");
            exit(); 

        } // CLOSING TO ADMIN USER


    } // ELSE CLOSING

} //POST CLOSING


?>


 






