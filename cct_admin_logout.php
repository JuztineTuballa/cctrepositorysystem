<?php
session_start();
session_unset();
session_destroy();

header("Location: cct_admin_signin.php");
exit;
?>