<?php
include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'

);

$page_title = 'Okul Numarası Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

error_reporting(0);

?>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Okul Numarası Sorgu</h4>
                    <p class="mb-1">
                    <p>
                        Okul Numarasını Öğrenmek İstediğiniz Kişinin Kimlik Numarasını Giriniz.</br>
                    </p>
                    </p>
                    <form action="okulnosorgu" method="POST">
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="tc" role="tabpanel">

                                <input required maxlength="11" autocomplete="off" class="form-control" type="text" name="tcno" id="tcno" placeholder="Kimlik Numarası"><br>

                                <center class="nw">
                                    <button onclick="checkNumber()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula </button>
                                    <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                                    <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="font-weight: 400;font-family: Poppins;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                                    <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır</button><br><br>
                                </center>
                    </form>
                    <div class="table-responsive">
                        <table id="01000001" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kimlik Numarası</th>
                                    <th>Adı</th>
                                    <th>Soyadı</th>
                                    <th>Okul Numarası</th>
                                </tr>
                            </thead>
                            <tbody id="00001010">
                                <?php

                                if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                    $posttc = $_POST['tcno'];

                                    $filename = file_get_contents("https://illegale.dev/platform/okul?tc=$posttc&hash=1943wqrtrt");
                                    $json_decode = json_decode($filename, true);

                                ?>
                                    <tr>
                                        <th><?= $json_decode['TC']; ?></th>
                                        <th><?= $json_decode['ADI']; ?></th>
                                        <th><?= $json_decode['SOYADI']; ?></th>
                                        <th><?= $json_decode['okulno']; ?></th>
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