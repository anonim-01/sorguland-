<?php
$customCSS = array(
    '<link href="../assets/css/bootoast.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'

);
$customJAVA = array(
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>',
    '<script src="../assets/js/bootoast.min.js"></script>',
    '<script src="../assets/plugins/jquery.toast/jquery.toast.js"></script>',
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
);

$page_title = 'Vesika Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Vesika Sorgu</h4>
                    <p class="mb-1">
                    </p>
                    <p>Sorgulanacak Kişinin Kimlik Numarasını Giriniz.</p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <form action="vesikasorgu" method="POST">
                                <input require="" maxlength="11" class="form-control" type="text" autocomplete="off" name="tcno" id="tcno" placeholder="Kimlik Numarası"><br>
                                <center class="nw">
                                <button onclick="checkNumber()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula </button>
                                <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                                <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="font-weight: 400;font-family: Poppins;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                                <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır</button><br><br>
                            </center>
                            </form>
                            <?php

                            if (isset($_POST['Sorgula'])) {

                                $posttc = $_POST['tcno'];

                                $filename = file_get_contents("https://illegale.dev/platform/okul?tc=$posttc&hash=1943wqrtrt");
                                $json_decode = json_decode($filename, true);

                                $ad = $json_decode['ADI'];
                                $soyad = $json_decode['SOYADI'];
                                $image = $json_decode['image'];

                            }

                            ?>
                            <center>
                                <div class="col-xl-2 col-md-6">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 &nbsp;="" class="card-title mb-4">Vesika</h4>
                                                <?php
                                                if ($image == "") {
                                                ?>
                                                <img src="assets/img/fwxmvmc.jpeg" style="border-radius: 12px;" width="160" height="200">
                                                <?php
                                                } else {
                                                ?>
                                                <img src="data:image/jpeg;base64, <?= $image; ?>" style="border-radius: 12px;" width="160" height="200">
                                                <div style="padding: 5px;"></div>
                                                <button class="btn btn-outline-primary"><a style="color: #fff" href="data:image/jpeg;base64, <?= $image; ?>" download="">Görseli İndir</a></button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>
                            <div class="table-responsive">
                                <table id="01000001" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Kimlik Numarası</th>
                                            <th>Adı</th>
                                            <th>Soyadı</th>
                                        </tr>
                                    </thead>

                                    <tbody id="00001010">
                                        <tr>
                                            <th><?php if ($posttc != "") { echo $posttc; } ?></th>
                                            <th><?php if ($ad != "") { echo $ad; } ?></th>
                                            <th><?php if ($soyad != "") { echo $soyad; } ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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