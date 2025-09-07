<?php

include 'database.php';

$adminssid = $_SESSION['GET_USER_SSID'];

$adminquery = $db->query("SELECT * FROM `users` WHERE k_key = '$adminssid'");

while ($admindata = $adminquery->fetch()) {
    $adminrole = $admindata['k_rol'];

    if ($adminrole != "1") {
        exit('Error: no admin access');
        die();
    }
}
