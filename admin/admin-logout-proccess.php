<?php
session_start();

// Clear session
session_destroy();

// Clear cookie
setcookie("admin_logged_in", "", time() - 3600, "/", "", true, true);

// Redirect to sign-in page
header("Location: admin-login.php");
exit();
?>