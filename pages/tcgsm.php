<?php

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = "Telefon Sorgulama";
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Telefon Sorgulama</h4>
                    <p class="mb-1">
                    <p>
                        Telefon numarasını öğrenmek istediğiniz kişinin kimlik numarasını girin.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <form action="tcgsm" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input class="form-control" type="text" name="gsmtc" id="gsmtc" autocomplete="off" minlength="11" maxlength="11" placeholder="Kimlik Numarası"><br>
                            </div>
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
                                        <th>Telefon Numarası</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                        $tc = htmlspecialchars(strip_tags($_POST['gsmtc']));

                                        $db = new PDO("mysql:host=localhost;dbname=120mgsm;charset=utf8", "root", "");

                                        $query = $db->query("SELECT * FROM illegalplatform_hackerdede1_gsm WHERE TC = '$tc' ORDER BY TC DESC");

                                        while ($data = $query->fetch()) {
                                            $getTc = $data['TC'];
                                            $getGsm = $data['GSM'];
                                        }

                                    ?>
                                        <tr>
                                            <th><?= $getTc; ?></th>
                                            <th><?= $getGsm ?></th>
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