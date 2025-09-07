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

$page_title = 'Aile Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

?>
<style>
    td {
        text-transform: capitalize;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                    <img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Aile Sorgu
                    </h4>
                    <p style="color: #fff">Sorgulanacak kişinin kimlik numarasını giriniz.</p><br>
                    <form action="ailesorgu" method="POST">
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input require maxlength="30" class="form-control" autocomplete="off" type="text" name="number" id="tcx" placeholder="Kimlik Numarası"><br>
                                <center class="nw">
                                <button onclick="checkNumber()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula </button>
                                <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                                <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="font-weight: 400;font-family: Poppins;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                                <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır</button><br><br>
                            </center>
                    </form>
                    <div class="table-responsive" id="scroll">
                        <table id="01000001" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>

                                    <th style="color: white; font-weight: bold;">YAKINLIK</th>
                                    <th style="color: white; font-weight: bold;">TC</th>
                                    <th style="color: white; font-weight: bold;">AD</th>
                                    <th style="color: white; font-weight: bold;">SOYAD</th>
                                    <th style="color: white; font-weight: bold;">DOĞUM TARİHİ</th>
                                    <th style="color: white; font-weight: bold;">ADRES IL</th>
                                    <th style="color: white; font-weight: bold;">ADRES ILCE</th>
                                    <th style="color: white; font-weight: bold;">ANNE ADI</th>
                                    <th style="color: white; font-weight: bold;">ANNE TC</th>
                                    <th style="color: white; font-weight: bold;">BABA ADI</th>
                                    <th style="color: white; font-weight: bold;">BABA TC</th>
                                </tr>
                            </thead>

                            <tbody id="01000001" style="color: white;">
                                <?php

                                if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                    $str = htmlspecialchars(strip_tags($_POST['number']));

                                    $baglanti = new mysqli('localhost', 'root', '', '101m');

                                    $sth = $baglanti->prepare("SELECT * FROM `101m`");

                                    $sql = "SELECT * FROM `101m` WHERE `TC` = '$str'";
                                    $result = $baglanti->query($sql);

                                    while ($row = $result->fetch_assoc()) {

                                        echo "<tr>
                    <td> Kendisi </td>
                    <td>" . $row["TC"] . "</td>
                    <td>" . $row["ADI"] . "</td>
                    <td>" . $row["SOYADI"] . "</td>
                    <td>" . $row["DOGUMTARIHI"] . "</td>
                    <td>" . $row["ANNEADI"] . "</td>
                    <td>" . $row["ANNETC"] . "</td>
                    <td>" . $row["BABAADI"] . "</td>
                    <td>" . $row["BABATC"] . "</td>
                    <td>" . $row["NUFUSIL"] . "</td>
                    <td>" . $row["NUFUSILCE"] . "</td>

                </tr>";
                                        $sqlcocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                        $resultcocugu = $baglanti->query($sqlcocugu);

                                        $sqlkardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                        $resultkardesi = $baglanti->query($sqlkardesi);
                                        $sqlbabasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                        $resultbabasi = $baglanti->query($sqlbabasi);
                                        $sqlanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                        $resultanasi = $baglanti->query($sqlanasi);

                                        $sqlkendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                        $resultkendicocugu = $baglanti->query($sqlkendicocugu);
                                    }

                                    while ($row = $resultkendicocugu->fetch_assoc()) {

                                        echo "<tr>
                        <td> Çocuğu </td>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
    
                    </tr>";
                                    }
                                    while ($row = $resultkardesi->fetch_assoc()) {


                                        echo "<tr>
                        <td> Kardeşi </td>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
    
                    </tr>";
                                    }

                                    while ($row = $resultbabasi->fetch_assoc()) {

                                        $tcrow5 = $row['TC'];

                                        echo "<tr>
                        <td> Babası </td>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
    
                       </tr>";
                                    }

                                    while ($row = $resultanasi->fetch_assoc()) {

                                        echo "<tr>
                        <td> Annesi </td>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
                        </tr>";
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
</div>
<style>
    #scroll {
        direction: ltr;
        overflow: auto;
        height: 700px;
        width: 100%;

    }

    #scroll div {
        direction: ltr;
    }
</style>
<?php

include('inc/footer_main.php');
?>