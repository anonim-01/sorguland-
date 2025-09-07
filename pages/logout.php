<?php

error_reporting(0);

session_start();

unset($_SESSION['GET_USER_SSID']);

session_destroy();

include '../server/database.php';

$ResetCookie = base64_decode($_COOKIE['cf_rtdsid']);

$update = $db->exec("UPDATE users SET k_cookie = '' WHERE k_cookie = '$ResetCookie'");

setcookie("cf_rtdsid", "", 1);

unset($_COOKIE['USER_SSO_SERVICE']);

header('Location: ../index.php');

?>