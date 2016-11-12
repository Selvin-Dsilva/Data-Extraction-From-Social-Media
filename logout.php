<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
#ob_start();
if (isset($_SESSION['user_info']) or isset($_SESSION['login'])) {
    unset($_SESSION['user_info']);
    unset($_SESSION['login']);
    header("location: instagram_login.php");
} else {
    header("location: instagram_login.php");
}
?>