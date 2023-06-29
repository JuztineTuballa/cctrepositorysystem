<html>
<style type="text/css">
  
    @import url("http://assets.commerce.nikecloud.com/ncss/0.17/dotcom/desktop/css/ncss.en-us.min.css");
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
    /* RESET STYLES */
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
    ul{list-style: outside; margin-left: 20px; padding-left: 0;}
    a { text-decoration: underline; }
    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {
        .body-header {
            padding: 0 0 !important;
        } 
        
        .body-text {
            padding:  30px 0 !important;
        }
        
        .footer-content{
          padding: 17px 40px 19px 28px !important;
        }
        
        /* ALLOWS FOR FLUID TABLES */
        .wrapper {
          width: 100% !important;
          max-width: 100% !important;
        }
        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        .logo{
          padding: 30px 28px !important;
        }
        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        .mobile-hide {
          display: none !important;
        }
        .img-max {
          max-width: 100% !important;
          width: 100% !important;
          height: auto !important;
        }
        /* FULL-WIDTH TABLES */
        .responsive-table {
          width: 100% !important;
        }
        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        .padding {
          padding: 10px 5% 15px 5% !important;
        }
        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }
        .no-padding {
          padding: 0 !important;
        }
        .section-padding {
          padding: 34px 28px 50px 28px !important;
        }
        /* ADJUST BUTTONS ON MOBILE */
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }
        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }
    }
    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</html>


<?php
session_start();
include_once 'db_conn.php';


# LIBRARIES
# FIRST YOU HAVE TO DOWNLOAD COMPOSER
# THEN AFTER THAT COPY AND PASTE THIS LIBRARY FROM https://github.com/PHPMailer/PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
# END LIBRARIES 

//Load Composer's autoloader
require 'vendor/autoload.php';


function send_password_reset($admin_get_name, $admin_get_email, $admin_get_token) {

    $mail = new PHPMailer(true);

    $mail->SMTPDebug = 0;                                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'cctbsit2020@gmail.com';                 
    $mail->Password   = 'eunnweiwmmkbyftg';                        
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = 587;  
  
    $mail->setFrom('cctbsit2020@gmail.com', 'CCT Web-based Repository System');           
    $mail->addAddress($admin_get_email);
    //$mail->addAddress('receiver2@gfg.com', 'Name');
       
    $mail->isHTML(true);                                  
    $mail->Subject = 'Password Reset Notification';
    $email_template = "
    <body style='margin: 0 !important; padding: 0 !important;'> 
    <table border='0' cellpadding='0' cellspacing='0' width='100%'> 
        <tr> 
            <td bgcolor='#ffffff' align='center'> 
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' class='wrapper'> 
                    <tr> 
                        <!-- top-right-bottom-left -->
                        <td align='left' valign='top' 
                            style='height:auto; 
                            border-bottom:3px solid; 
                            border-bottom-color:#000000; 
                            padding: 30px 20px 30px 20px;' 
                        class='logo'> 
                        <img alt='CCTWebBasedRepositorySystem' src='https://64.media.tumblr.com/889e9b9b31d9dd99b98c8a188242879a/cbf6ac5500c13010-55/s2048x3072/f7c152ac502c68bc16b510fe92e6b1000b70943c.pnj' style='max-width:100%;height:auto;border:0'/> 
                        </td> 

                    </tr> 
                </table> 
            </td> 
        </tr> 
        <tr> 
            <!-- top-right-bottom-left -->
            <td bgcolor='#ffffff' align='center' style='padding: 0px 30px 0px 30px;  ' class='section-padding'> 
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' class='responsive-table'> 
                    <tr> 
                        <td style='padding: 30px 20px 30px 20px;' > 
                            <table width='100%' border='0' cellspacing='0' cellpadding='0'> 
                                <tr> 
                                    <td> 
                                        <!-- BODY --> 
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0' > 
                                            <tr> 
                                                <td class='body-header' align='left' style='color:#161616;font-style:normal;font-size:24px;font-weight:normal;font-family:Helvetica;' class='padding'> Web-Based Repository Of Research Outputs for City College of Tagaytay - Password Reset
                                                </td> 
                                            </tr> 
                                            <tr> 
                                            
                                            <!-- top-right-bottom-left -->
                                            <td class='body-text' align='left' 
                                                style='font-size:14px;
                                                color:#161616;
                                                line-height:24px;
                                                letter-spacing:0px;
                                                font-family:Helvetica; 
                                                padding: 20px 0px 20px 0px;'  
                                            class='padding'> 

                                            Please reset your password by clicking&nbsp; 

                                            <a href='http://localhost/cctrepositorysystem/z-admin-reset-password-page.php?token=$admin_get_token&email=$admin_get_email' target='_blank'>here</a>.<br><br> 
                                                If you are unable to click the link above, please copy and paste the link below into your browser:
                                                <br><br> 
                                                <a href='http://localhost/cctrepositorysystem/z-admin-reset-password-page.php?token=$admin_get_token&email=$admin_get_email' target='_blank'> http://localhost/cctrepositorysystem/z-admin-reset-password-page.php?token=$admin_get_token&email=$admin_get_email</a>
                                                <br><br> 
                                                Please do not reply to this email. 
                                            </td> 
                                            </tr> 
                                        </table> 
                                    </td> 
                                </tr> 
                            </table> 
                        </td> 
                    </tr> 
                </table> 
            </td> 
        </tr> 
        <tr>
            <td bgcolor='#ffffff' align='center'>
            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' 
                style='background-color:#ffffff;
                border-top:2px 
                solid;border-top-color:#dddddd;
                max-width: 600px;' class='responsive-table'>
            <tr>
                <!-- top-right-bottom-left -->
                <td class='footer-content' align='left' 
                    style='background-color:#ffffff;
                    border-top:2px solid;
                    border-top-color:#dddddd; 
                    width:241px; 
                    padding: 10px 20px 10px 20px; 
                    font-family:Helvetica; 
                    font-size:10px;
                    line-height:20px;
                    letter-spacing:0;
                color:#5e5c5c'>
                    
                    <strong>Please Contact the System Administrator if you have any questions:</strong>
                    <br>
                    <span>Copyright © <script>document.write( new Date().getFullYear() );</script>  City College of Tagaytay Web-based Repository of Research Outputs</span>
                </td>
            </tr>
            </table>
            </td>
        </tr>
    </table> 
</body>   ";
    $mail->Body  = $email_template;
    $mail->send();
     
 
}


if (isset($_POST['admin_password_reset_button'])) {
   $var_email = mysqli_real_escape_string($conn, $_POST['admin_email_reset']);
   
   #CREATE TOKEN MD5
   $admin_get_token = md5(rand());

   $check_email = "SELECT * FROM tb_adminuser WHERE admin_email = '$var_email' LIMIT 1 ";
   $check_email_run = mysqli_query($conn, $check_email);

   #CHECK CONDITION
   if (mysqli_num_rows($check_email_run) > 0) {
     $row = mysqli_fetch_array($check_email_run);
     $admin_get_name = $row['admin_firstname'];
     $admin_get_email = $row['admin_email'];

     $update_token= "UPDATE tb_adminuser SET admin_token = '$admin_get_token' WHERE admin_email='$admin_get_email' LIMIT 1 ";

     #UPDATING THE TOKEN
     $update_token_run = mysqli_query($conn, $update_token);

     #CONDITION TO CHECK IF THE TOKEN IS UPDATED OR NOT
     if($update_token_run) {
      #SEND A MAIL IF CONDITION IS TRUE
      send_password_reset($admin_get_name, $admin_get_email, $admin_get_token);

      echo "<script> alert('We e-mailed you a password reset link!'); window.location='z-admin-forgot-password-page.php?sent=linksendsuccessfully' </script>"; 
      exit;

     } else {
       header("location: z-admin-forgot-password-page.php?error=No Email Found!");
       exit(); 
     }
     #END-CONDITION TO CHECK IF THE TOKEN IS UPDATED OR NOT

   } else {
      header("location: z-admin-forgot-password-page.php?error=No Email Found!");
       exit(); 
   }



} //END OUTER IF

?>


<?php
 
include_once 'db_conn.php';

if (isset($_POST['admin_password_update_button'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['admin_email_reset_check']);
    $user_new_password = mysqli_real_escape_string($conn, $_POST['admin_enter_new_password']);
    $user_confirm_new_password = mysqli_real_escape_string($conn, $_POST['admin_confirm_new_password']);
    $user_token = mysqli_real_escape_string($conn, $_POST['admin_reset_token']);

    $user_new_password_hashed = password_hash($user_new_password, PASSWORD_DEFAULT);
    $user_confirm_new_password_hashed = password_hash($user_confirm_new_password, PASSWORD_DEFAULT);

    if (empty($user_email) || empty($user_new_password_hashed) || empty($user_confirm_new_password_hashed)) {
        echo "<script> alert('All fields are mandatory'); window.location='z-admin-reset-password-page.php?token=$user_token&email=$user_email' </script>"; 
        exit;
    }

    if (empty($user_token)) {
        echo "<script> alert('No Token Available'); window.location='z-admin-reset-password-page.php?token=$user_token&email=$user_email' </script>"; 
        exit;
    }

    $check_token_query = "SELECT admin_token FROM tb_adminuser WHERE admin_token = '$user_token' LIMIT 1";
    $check_token_run = mysqli_query($conn, $check_token_query);

    if (mysqli_num_rows($check_token_run) == 0) {
        echo "<script> alert('Invalid Token'); window.location='z-admin-reset-password-page.php?token=$user_token&email=$user_email' </script>"; 
        exit;
    }

    if ($user_new_password != $user_confirm_new_password) {
        echo "<script> alert('Incorrect New Password and Confirm Password did not Match!'); window.location='z-admin-reset-password-page.php?token=$user_token&email=$user_email' </script>"; 
        exit;
    }

    $update_user_password_query = "UPDATE tb_adminuser SET admin_password = '$user_new_password_hashed' WHERE admin_token = '$user_token' LIMIT 1";
    $update_user_password_run = mysqli_query($conn, $update_user_password_query);

    if ($update_user_password_run) {
      $get_admin_info_query = "SELECT admin_firstname, admin_lastname FROM tb_adminuser WHERE admin_token = '$user_token' LIMIT 1";
      $get_admin_info_run = mysqli_query($conn, $get_admin_info_query);
      $admin_info = mysqli_fetch_assoc($get_admin_info_run);

      $admin_name = $admin_info['admin_firstname'] . ' ' . $admin_info['admin_lastname'];
      echo "<script> alert('Password Updated Successfully for $admin_name!'); window.location='z-admin-reset-password-page.php' </script>"; 
      exit;

    } else {
        echo "<script> alert('Something Went Wrong! Password did not Update'); window.location='z-admin-reset-password-page.php?token=$user_token&email=$user_email' </script>"; 
        exit;
    }

}

?>

 