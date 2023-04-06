<?php
ob_start();
if (!isset($_SESSION))
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    header("location:trangchu.php");
?>