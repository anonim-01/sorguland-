<?php

$customCSS = array(
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = 'IBAN Sorgu';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>

<div class="content">
    <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

        <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="butto" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
        <a class="navbar-brand me-1 me-sm-3" href="index.php">
            <div class="d-flex align-items-center"><img class="me-2" /><span class="font-sans-serif"></span>
            </div>
        </a>
    </nav>
    <div class="row">

        <div class="col-xl-12 col-md-6">


            <style>
                #disarisi {

                    height: 500px;

                    overflow: hidden;

                    position: relative;

                    width: 635px;

                }

                #icerisi {

                    height: 2000px;

                    left: -10px;

                    position: absolute;

                    top: -600px;

                    width: 700px;

                }
            </style>



            <div id="disarisi"><iframe height="200%" width="200%" src="https://hesapno.com/mod_iban_coz" name="hesapno.com iban çözümleme modülü" scrolling="auto" frameborder="0"></iframe></div>
            <script src="../vendors/popper/popper.min.js"></script>
            <script src="../vendors/bootstrap/bootstrap.min.js"></script>
            <script src="../vendors/anchorjs/anchor.min.js"></script>
            <script src="../vendors/is/is.min.js"></script>
            <script src="../vendors/echarts/echarts.min.js"></script>
            <script src="../vendors/fontawesome/all.min.js"></script>
            <script src="../vendors/lodash/lodash.min.js"></script>
            <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
            <script src="../vendors/list.js/list.min.js"></script>
            <script src="../assets/js/theme.js"></script>
            </body>

            </html>
            <?php
            include('inc/footer_main.php');
            ?>