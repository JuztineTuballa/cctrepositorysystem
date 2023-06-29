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

    // Get user details from depthead table
    $query_depthead = "SELECT * FROM tb_depthead WHERE dhead_uname = BINARY '$username'";
    $result_depthead = mysqli_query($conn, $query_depthead);

    // Get user details from librarian table
    $query_librarian = "SELECT * FROM tb_librarian WHERE librarian_uname = BINARY '$username'";
    $result_librarian = mysqli_query($conn, $query_librarian);

    // Get user details from researchhead table
    $query_researchhead = "SELECT * FROM tb_researchhead WHERE reshead_uname = BINARY '$username'";
    $result_researchhead = mysqli_query($conn, $query_researchhead);


    if (empty($username)) {
        header("location: cct_faculty_signin.php?error=Username Required.");
        exit();  

    } else if (empty($password)) {
        header("location: cct_faculty_signin.php?error=Password Required.");
        exit();  

    } else {

        if (mysqli_num_rows($result_depthead) > 0) { 

            // User is an Depthead
            $row = mysqli_fetch_assoc($result_depthead);

            if (password_verify($password, $row['dhead_pword'])) {
                if ($row['dhead_status'] == 'Active') {

                    $_SESSION['dhead_uname'] = $row['dhead_uname'];
                    $_SESSION['dhead_fname'] = $row['dhead_fname'];
                    $_SESSION['dhead_mname'] = $row['dhead_mname'];
                    $_SESSION['dhead_lname'] = $row['dhead_lname'];
                    $_SESSION['dhead_id'] = $row['dhead_id'];
                    $_SESSION['dhead_dept'] = $row['dhead_dept'];
                    $_SESSION['dhead_picture'] = $row['dhead_picture'];  
                    $deptheadMessage1 = addslashes($_SESSION["dhead_fname"]);
                    $deptheadMessage2 = addslashes($_SESSION["dhead_lname"]);
                    echo "<script> alert('Login Success! Welcome'+' '+'$deptheadMessage1'+' '+'$deptheadMessage2'+'!'); window.location='deptheaddashboard.php?login=success' </script>"; 
                    exit();

                } else {
                    // Account is archived
                    header("location: cct_faculty_signin.php?error=Your account has been Archived. Please contact your System Administrator for assistance.");
                    exit();  
                }
            } else {
                // Invalid Password Casing
                header("location: cct_faculty_signin.php?error=Incorrect Username or Password.");
                exit();  
            }

        } //DEPTHEAD CLOSING

        else if (mysqli_num_rows($result_librarian) > 0) { 

            // User is an Librarian
            $row = mysqli_fetch_assoc($result_librarian);

            if (password_verify($password, $row['librarian_pword'])) {
                if ($row['librarian_status'] == 'Active') {

                    // Set session variables for librarian user
                    $_SESSION['librarian_status']=$row['librarian_status'];
                    $_SESSION['librarian_uname']=$row['librarian_uname'];
                    $_SESSION['librarian_pword']=$row['librarian_pword'];
                    $_SESSION['librarian_id']=$row['librarian_id'];
                    $_SESSION['librarian_lname']=$row['librarian_lname'];
                    $_SESSION['librarian_fname']=$row['librarian_fname'];
                    $_SESSION['librarian_mname']=$row['librarian_mname'];
                    $_SESSION['librarian_picture']=$row['librarian_picture']; 
                    $librarianMessage1 = addslashes($_SESSION["librarian_fname"]);
                    $librarianMessage2 = addslashes($_SESSION["librarian_lname"]);
                    echo "<script> alert('Login Success! Welcome'+' '+'$librarianMessage1'+' '+'$librarianMessage2'+'!'); window.location='librariandashboard.php?login=success' </script>"; 
                    exit();

                } else {
                    // Account is archived
                    header("location: cct_faculty_signin.php?error=Your account has been Archived. Please contact your System Administrator for assistance.");
                    exit();  
                }
            } else {
                // Invalid Password Casing
                header("location: cct_faculty_signin.php?error=Incorrect Username or Password.");
                exit();  
            }

        } //LIBRARIAN CLOSING

        else if (mysqli_num_rows($result_researchhead) > 0) { 

            // User is an Research Head
            $row = mysqli_fetch_assoc($result_researchhead);

            if (password_verify($password, $row['reshead_pword'])) {
                if ($row['reshead_status'] == 'Active') {

                    // Set session variables for Research Head user
                    $_SESSION['reshead_status']=$row['reshead_status'];
                    $_SESSION['reshead_uname']=$row['reshead_uname'];
                    $_SESSION['reshead_pword']=$row['reshead_pword'];
                    $_SESSION['reshead_id']=$row['reshead_id'];
                    $_SESSION['reshead_lname']=$row['reshead_lname'];
                    $_SESSION['reshead_fname']=$row['reshead_fname'];
                    $_SESSION['reshead_mname']=$row['reshead_mname'];
                    $_SESSION['reshead_picture']=$row['reshead_picture'];
                    $resheadMessage1 = addslashes($_SESSION["reshead_fname"]);
                    $resheadMessage2 = addslashes($_SESSION["reshead_lname"]);
                    echo "<script> alert('Login Success! Welcome'+' '+'$resheadMessage1'+' '+'$resheadMessage2'+'!'); window.location='researchheaddashboard.php?login=success' </script>"; 
                    exit();

                } else {
                    // Account is archived
                    header("location: cct_faculty_signin.php?error=Your account has been Archived. Please contact your System Administrator for assistance.");
                    exit();  
                }
            } else {
                // Invalid Password Casing
                header("location: cct_faculty_signin.php?error=Incorrect Username or Password.");
                exit();  
            }

        } //RESEARCH HEAD CLOSING

        else { 
            // If Result is not Equal to All Users
            header("location: cct_faculty_signin.php?error=Incorrect Username or Password.");
            exit(); 

        } // CLOSING TO ALL USER



    } // ELSE CLOSING

} //POST CLOSING


?>


 






