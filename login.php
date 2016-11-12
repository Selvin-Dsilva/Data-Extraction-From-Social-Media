<?php

session_start();

if (isset($_SESSION['user_info'])) {
    header("location: instagram_login.php");
    return false;
}

include 'config.php';

$_SESSION['login'] = 1;

header("location: https://api.instagram.com/oauth/authorize/?client_id=$client_id&redirect_uri=$redirect_uri&response_type=code&scope=basic"); // redirect user to oauth page
?>