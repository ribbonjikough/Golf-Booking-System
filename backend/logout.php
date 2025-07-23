<?php
// Destroy session and redirect to login.php
session_start();
session_destroy();
header("Location: ../frontend/login.php");
exit;
?>