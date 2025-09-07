<?php

session_start();

include '../server/functions.php';

control_user();

date_default_timezone_set('Europe/Istanbul');

$LOGGER_DATE = date('d.m.y H:i:s');

?>

<!DOCTYPE html>
<html lang="<?= get_language(); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Adı Checker</title>
    <link rel="icon" href="../assets/img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="../assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="../assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="../assets/css/main.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
    <link href="../assets/css/dark.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/DataTables/datatables.min.js"></script>
    <script src="../assets/plugins/printer/main.js"></script>
    <script src="../assets/js/pages/datatables.js"></script>
    <script src="../assets/js/script.js" type="module"></script>
    <script src="../assets/js/loading-screen.js"></script>
    <script src="../assets/js/modern-dashboard.js"></script>
    <script src="../assets/js/quick-actions.js"></script>
</head>

<body>