<?php

include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'Plaka Sorgu';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

?>
<style>
    iframe{
        width: 100%;
        height: 750px !important;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Parsel Sorgu</h4>
                    <p class="mb-1">
                    </p>
                    </p>
                    <iframe src="https://parselsorgu.tkgm.gov.tr/" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('inc/footer_main.php');
?>