<?php

include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'Mahalle Sorgu';

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
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Mahalle Sorgu</h4>
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
                            Aşağıdaki belirtilen yere sorgulanacak mahallenin adını yazınız.
                        </div>
                    </div>
                    <div class="block-content tab-content">
                        <form action="mahallesorgu" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input class="form-control" autocomplete="off" type="text" name="mahalle" id="mahalle" placeholder="Mahalle Adı">
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
                                        <th>TC</th>
                                        <th>ADI</th>
                                        <th>SOYADI</th>
                                        <th>ANAADI</th>
                                        <th>BABAADI</th>
                                        <th>DOGUMYERI</th>
                                        <th>DOGUMTARIHI</th>
                                        <th>CINSIYET</th>
                                        <th>NUFUSILI</th>
                                        <th>NUFUSILCESI</th>
                                        <th>ADRESIL</th>
                                        <th>ADRESILCE</th>
                                        <th>MAHALLE</th>
                                        <th>CADDE</th>
                                        <th>KAPINO</th>
                                        <th>DAIRENO</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if ($_POST) {

                                        $mahalle = strtoupper($_POST['mahalle']);

                                        $db = new PDO("mysql:host=localhost;dbname=secmen;charset=utf8", "root", "");

                                        if ($mahalle != "") {
                                            $query = $db->query("SELECT * FROM secmen2015 WHERE MAHALLE = '$mahalle MAH.'");
                                        }

                                        while ($data = $query->fetch()) {

                                    ?>
                                            <tr>
                                                <td> <?php echo $data['TC']; ?> </td>
                                                <td> <?php echo $data['ADI']; ?> </td>
                                                <td> <?php echo $data['SOYADI']; ?> </td>
                                                <td> <?php echo $data['ANAADI']; ?> </td>
                                                <td> <?php echo $data['BABAADI']; ?> </td>
                                                <td> <?php echo $data['DOGUMYERI']; ?> </td>
                                                <td> <?php echo $data['DOGUMTARIHI']; ?> </td>
                                                <td>
                                                    <?php

                                                    if ($data['CINSIYETI'] == "E") {
                                                        echo "Erkek";
                                                    } else if ($data['CINSIYETI'] == "K") {
                                                        echo "Kadın";
                                                    } else {
                                                        echo "Uzaylı";
                                                    }

                                                    ?>
                                                </td>
                                                <td> <?php echo $data['NUFUSILI']; ?> </td>
                                                <td> <?php echo $data['NUFUSILCESI']; ?> </td>
                                                <td> <?php echo $data['ADRESIL']; ?> </td>
                                                <td> <?php echo $data['ADRESILCE']; ?> </td>
                                                <td> <?php echo $data['MAHALLE']; ?> </td>
                                                <td> <?php echo $data['CADDE']; ?> </td>
                                                <td> <?php echo $data['KAPINO']; ?> </td>
                                                <td> <?php echo $data['DAIRENO']; ?> </td>
                                            </tr>
                                    <?php }
                                    } ?>
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