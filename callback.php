<?php

session_start();

if (isset($_SESSION['user_info']) or ! isset($_SESSION['login'])) {
    header("location: instagram_login.php");
    return false;
}

include 'post_get_HTTP.php';
include 'config.php';

$code = $_GET['code'];
$url = "https://api.instagram.com/oauth/access_token";
$header = 0;

$data = array(
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "redirect_uri" => $redirect_uri,
    "grant_type" => "authorization_code",
    "code" => $code
);

$get_access_token = post_get_HTTP(1, $url, $header, $data, 1);
$access_token = $get_access_token['access_token'];
$get = file_get_contents("https://api.instagram.com/v1/users/self/?access_token=$access_token");
$json = json_decode($get, true);
$_SESSION['user_info'] = $json;

header("location: instagram_login.php");
?>