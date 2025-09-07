<?php

include 'database.php';

$rolessid = $_SESSION['GET_USER_SSID'];

$rolequery = $db->query("SELECT * FROM `users` WHERE k_key = '$rolessid'");

$rolecount = $rolequery->rowCount();

if ($rolessid == "" || $rolecount != 1)
{
    exit('Error: ssid not exists');
    die();
}
else
{
    date_default_timezone_set('Europe/Istanbul');
    $updatetimezone = date('d.m.y H:i');
    $updateupdatesync = $db->exec("UPDATE users SET k_updatesync = '$updatetimezone' WHERE k_key = '$rolessid'");
}


