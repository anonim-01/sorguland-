<?php

include_once 'database.php';

session_start();

if ($_SESSION['GET_USER_SSID'] == "") {
    exit('Error: ssid not exists');
    die();
}

$GET_SESSION_TOKEN = $_SESSION['GET_USER_SSID'];

$CheckAccount = $db->query("SELECT * FROM users WHERE k_key = '$GET_SESSION_TOKEN'");
$CheckAccountCount = $CheckAccount->rowCount();

while ($CheckData = $CheckAccount->fetch()) {
    $access = $CheckData['k_rol'];
}

if ($CheckAccountCount != "1") {
    exit('Error: no token');
    die();
}

if ($access != 1) {
    exit('Error: no access');
    die();
}

if (isset($_POST['delete'])) {
    $id = $_POST['deleteid'];
    $sql = "DELETE FROM news WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    header('Location: ../notice');
}

if (isset($_POST['account'])) {
    $id = $_POST['accountid'];
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    header('Location: ../users');
}

if (isset($_POST['update'])) {

    $id = $_POST['updateid'];
    $sonuc = $db->exec("UPDATE users SET k_rol = '0' WHERE id = '$id'");
    header('Location: ../users');
}

if (isset($_POST['updatex'])) {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $token = $_POST['token'];
    $expiredate = $_POST['expire_date'];
    $accesslevel = $_POST['access_level'];
    $sonuc = $db->exec("UPDATE users SET 
    k_adi = '$username',
    k_time = '$expiredate',
    k_rol = '$accesslevel'
    WHERE id = '$id'");
    header('Location: ../users?status=true');
}
