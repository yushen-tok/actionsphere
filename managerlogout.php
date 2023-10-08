<?php
// Destroy the session
session_start();
session_destroy();

// Redirect to the managerstafflogin.php page
header("Location: managerstafflogin.php");
exit();
?>

