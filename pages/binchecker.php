<?php

include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'BIN Checker';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

?>
<style id="Alert">
    .alert-danger {
        background: rgba(234, 84, 85, 0.12) !important;
        color: #ea5455 !important;
    }

    .alert {
        position: relative;
        padding: 0.99rem 1rem;
        margin-bottom: 1rem;
        border: 0 solid transparent;
        border-radius: 0.358rem;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"> BIN Checker</h4>
                    <p class="mb-1">
                    </p>
                    </p>
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-body" style="font-weight: normal;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            Kredi Kartı bilgilerini öğrenmek için kart numarasının ilk 6 hanesini girerek sorgulayabilirsiniz.
                        </div>
                    </div>
                    <div class="block-content tab-content">
                        <form action="binchecker" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input class="form-control" autocomplete="off" maxlength="16" minlength="6" type="text" name="bin" id="bin" placeholder="Örnek ; 415565">
                                <br>
                            </div>
                            <center class="nw">
                                <button onclick="checkNumber()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula </button>
                                <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                                <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="font-weight: 400;font-family: Poppins;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                                <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır</button><br><br>
                            </center>
                        </form>
                        <div class="table-responsive">

                            <table id="01000001" class="table table-hover" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">BIN</th>
                                        <th scope="col">Kart Türü</th>
                                        <th scope="col">Kart Seviyesi</th>
                                        <th scope="col">Credit / Debit</th>
                                        <th scope="col">Ülke</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                        $bin = htmlspecialchars(strip_tags($_POST['bin']));

                                        $filename = file_get_contents("https://lookup.binlist.net/$bin");

                                        $json_decode = json_decode($filename, true);

                                    ?>
                                            <tr>
                                                <td> <?php echo $bin; ?> </td>
                                                <td> <?php echo strtoupper($json_decode['scheme']); ?> </td>
                                                <td> <?php echo strtoupper($json_decode['brand']); ?> </td>
                                                <td> <?php echo strtoupper($json_decode['type']); ?> </td>
                                                <td> <?php echo strtoupper($json_decode['country']['name']); ?> </td>
                                            </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('inc/footer_main.php');
?>