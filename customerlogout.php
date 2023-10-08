<?php
// Destroy the session
session_start();
session_destroy();

// Redirect to the customerlogin.php page
header("Location: customerlogin.php");
exit();
?>

