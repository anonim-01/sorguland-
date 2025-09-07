<?php

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = 'Fatura Sorgulama';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Telefon Numarası Fatura Sorgulama</h4>
                    <p class="mb-1">
                    <p>
                       Sorgulamak istediğiniz kişinin telefon numarasını giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <form action="gsmfatura" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input class="form-control" type="text" name="gsmno" id="gsmno" minlength="10" maxlength="10" placeholder="5327151653"><br>
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
                                        <th>Telefon Numarası</th>
                                        <th>Mesaj</th>
                                        <th>Kurum</th>
                                        <th>Son Ödeme Tarihi</th>
                                        <th>Fatura Tutarı</th>
                                        <th>Abone İsim</th>
                                        <th>Fatura No</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                        $gsm = htmlspecialchars(strip_tags($_POST['gsmno']));

                                        // $filename = file_get_contents("http://79.137.206.5:3000/davincihash/apis/v1/gsmfatura/ttmobil?apikey=versenOlurMu&gsm=");

                                    ?>
                                        <tr>
                                            <th><?= $gsm; ?></th>
                                            <th>Bu Numaraya Ait Borç Bulunamadı.</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
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