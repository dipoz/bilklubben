<?php
// Initialize the session
session_start();

$_SESSION = array();

// ødelegge session:
session_destroy();

// Route til home.php:
header("location: home.php");
exit;
?>
