<?php

include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'Ad Soyad Sorgu';

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
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Ad Soyad Sorgu</h4>
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
                            Aşağıda belirtilen yerlere tüm hepsini doldurmak zorunda değilsiniz hangi bilgisi elinizde bulunuyorsa onu girmeniz yeterlidir.
                        </div>
                    </div>
                    <div class="block-content tab-content">
                        <form action="adsoyadsorgu" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <div style="display: flex; flex-direction: row;">
                                    <input style="margin-right: 50px;" autocomplete="off" name="txtad" class="form-control" type="text" id="ad" placeholder="Ad" required>
                                    <br>
                                    <input class="form-control" autocomplete="off" type="text" name="txtsoyad" id="soyad" placeholder="Soyad" required>
                                    <br>
                                </div>
                                <br>
                                <input class="form-control" autocomplete="off" type="text" name="txtadresil" id="adresil" placeholder="Adres İl">
                                <br>
                                <input class="form-control" autocomplete="off" type="text" name="txtadresilce" id="adresilce" placeholder="Adres İlçe">
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
                                        <th>Kimlik Numarası</th>
                                        <th>Adı</th>
                                        <th>Soyadı</th>
                                        <th>Doğum Tarihi</th>
                                        <th>İl</th>
                                        <th>İlçe</th>
                                        <th>Anne Adı</th>
                                        <th>Anne TC</th>
                                        <th>Baba Adı</th>
                                        <th>Baba TC</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {
                                        echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";
                                        $ad = htmlspecialchars(strip_tags($_POST['txtad']));
                                        $soyad = htmlspecialchars(strip_tags($_POST['txtsoyad']));
                                        $il = htmlspecialchars(strip_tags($_POST['txtadresil']));
                                        $ilce = htmlspecialchars(strip_tags($_POST['txtadresilce']));

                                        $db = new PDO("mysql:host=localhost;dbname=101m;charset=utf8", "root", "");

                                        if ($ad != "" && $soyad != "" && $il == "" && $ilce == "") {
                                            $query = $db->query("SELECT * FROM 101m WHERE ADI = '$ad' AND SOYADI = '$soyad'");
                                        } else if ($ad != "" && $soyad != "" && $il != "" && $ilce == "") {
                                            $query = $db->query("SELECT * FROM 101m WHERE ADI = '$ad' AND SOYADI = '$soyad' AND NUFUSIL = '$il'");
                                        } else if ($ad != "" && $soyad != "" && $il != "" && $ilce != "") {
                                            $query = $db->query("SELECT * FROM 101m WHERE ADI = '$ad' AND SOYADI = '$soyad' AND NUFUSIL = '$il' AND NUFUSILCE = '$ilce'");
                                        } else {
                                            $query = $db->query("SELECT * FROM 101m WHERE ADI = '$ad' AND SOYADI = '$soyad'");
                                        }

                                        while ($data = $query->fetch()) {

                                    ?>
                                            <tr>
                                                <td> <?php echo $data['TC']; ?> </td>
                                                <td> <?php echo $data['ADI']; ?> </td>
                                                <td> <?php echo $data['SOYADI']; ?> </td>
                                                <td> <?php echo $data['DOGUMTARIHI']; ?> </td>
                                                <td> <?php echo $data['NUFUSIL']; ?> </td>
                                                <td> <?php echo $data['NUFUSILCE']; ?> </td>
                                                <td> <?php echo $data['ANNEADI']; ?> </td>
                                                <td> <?php echo $data['ANNETC']; ?> </td>
                                                <td> <?php echo $data['BABAADI']; ?> </td>
                                                <td> <?php echo $data['BABATC']; ?> </td>
                                            </tr>
                                    <?php
                                        }
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