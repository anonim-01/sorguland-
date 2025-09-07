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

$page_title = 'Soyağacı Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

?>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Soyağacı Sorgu
                    </h4>
                    <p style="color: #fff">Sorgulanacak kişinin kimlik numarasını giriniz.</p><br>
                    <form action="soyagacisorgu" method="POST">
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

                                    $number = htmlspecialchars(strip_tags($_POST['number']));

                                    $baglanti = new mysqli('localhost', 'root', '', '101m');

                                    $str = $number;
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
                                        $sqlBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                        $resultBabası = $baglanti->query($sqlBabası);
                                        $sqlAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                        $resultAnnesi = $baglanti->query($sqlAnnesi);

                                        $sqlkendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                        $resultkendicocugu = $baglanti->query($sqlkendicocugu);
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
                                            $sqlkendikendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                            $resultkendikendicocugu = $baglanti->query($sqlkendikendicocugu);
                                            while ($row = $resultkendikendicocugu->fetch_assoc()) {
                                                echo "<tr>
                            <td> Torunu </td>
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
                                                $sqlkendikendikendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultkendikendikendicocugu = $baglanti->query($sqlkendikendikendicocugu);
                                                while ($row = $resultkendikendikendicocugu->fetch_assoc()) {
                                                    echo "<tr>
                                <td> Torununun Çocuğu </td>
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
                                            $sqlkardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                            $resultkardescocugu = $baglanti->query($sqlkardescocugu);
                                            while ($row = $resultkardescocugu->fetch_assoc()) {
                                                echo "<tr>
                            <td> Kardeşinin Çocuğu </td>
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

                                                $sqlkardeskardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultkardeskardescocugu = $baglanti->query($sqlkardeskardescocugu);
                                                while ($row = $resultkardeskardescocugu->fetch_assoc()) {
                                                    echo "<tr>
                                <td> Kardeşinin Torunu </td>
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
                                                    $sqlkardeskardeskardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultkardeskardeskardescocugu = $baglanti->query($sqlkardeskardeskardescocugu);
                                                    while ($row = $resultkardeskardeskardescocugu->fetch_assoc()) {
                                                        echo "<tr>
                                    <td> Kardeşinin Torununun Çocuğu </td>
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
                                            }
                                        }

                                        while ($row = $resultBabası->fetch_assoc()) {
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
                                            $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                            $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                                            $sqlbabaBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                            $resultbabaBabası = $baglanti->query($sqlbabaBabası);
                                            $sqlbabaAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                            $resultbabaAnnesi = $baglanti->query($sqlbabaAnnesi);

                                            while ($row = $resultbabakardesi->fetch_assoc()) {
                                                echo "<tr>
                            <td> Babasının Kardeşi </td>
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
                                                $sqlbabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultbabakardescocugu = $baglanti->query($sqlbabakardescocugu);
                                                while ($row = $resultbabakardescocugu->fetch_assoc()) {
                                                    echo "<tr>
                                <td> Babasının Kardeşinin Çocuğu </td>
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
                                                    $sqlbabakardesbabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultbabakardesbabakardescocugu = $baglanti->query($sqlbabakardesbabakardescocugu);
                                                    while ($row = $resultbabakardesbabakardescocugu->fetch_assoc()) {
                                                        echo "<tr>
                                    <td> Babasının Kardeşinin Torunu </td>
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
                                                        $sqlbabakardesbabakardesbabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultbabakardesbabakardesbabakardescocugu = $baglanti->query($sqlbabakardesbabakardesbabakardescocugu);
                                                        while ($row = $resultbabakardesbabakardesbabakardescocugu->fetch_assoc()) {
                                                            echo "<tr>
                                        <td> Babasının Kardeşinin Torununun Çocuğu </td>
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
                                                }
                                            }

                                            while ($row = $resultbabaBabası->fetch_assoc()) {
                                                echo "<tr>
                                <td> Babasının Babası </td>
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
                                                $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                                $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                                                $sqlbabaBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                                $resultbabaBabası = $baglanti->query($sqlbabaBabası);
                                                $sqlbabaAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                                $resultbabaAnnesi = $baglanti->query($sqlbabaAnnesi);

                                                while ($row = $resultbabakardesi->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Babasının Babasının Kardeşi </td>
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
                                                    $sqlbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultbabababakardescocugu = $baglanti->query($sqlbabababakardescocugu);
                                                    while ($row = $resultbabababakardescocugu->fetch_assoc()) {
                                                        echo "<tr>
                                        <td> Babasının Babasının Kardeşinin Çocuğu </td>
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
                                                        $sqlbabababakardesbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultbabababakardesbabababakardescocugu = $baglanti->query($sqlbabababakardesbabababakardescocugu);
                                                        while ($row = $resultbabababakardesbabababakardescocugu->fetch_assoc()) {
                                                            echo "<tr>
                                            <td> Babasının Babasının Kardeşinin Torunu </td>
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
                                                            $sqlbabababakardesbabababakardesbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                            $resultbabababakardesbabababakardesbabababakardescocugu = $baglanti->query($sqlbabababakardesbabababakardesbabababakardescocugu);
                                                            while ($row = $resultbabababakardesbabababakardesbabababakardescocugu->fetch_assoc()) {
                                                                echo "<tr>
                                                <td> Babasının Babasının Kardeşinin Torununun Çocuğu </td>
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
                                                    }
                                                }

                                                while ($row = $resultbabaBabası->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Babasının Babasının Babası </td>
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
                                                while ($row = $resultbabaAnnesi->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Babasının Babasının Annesi </td>
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
                                            while ($row = $resultbabaAnnesi->fetch_assoc()) {
                                                echo "<tr>
                                <td> Babasının Annesi </td>
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
                                                $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                                $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                                                $sqlbabaBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                                $resultbabaBabası = $baglanti->query($sqlbabaBabası);
                                                $sqlbabaAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                                $resultbabaAnnesi = $baglanti->query($sqlbabaAnnesi);

                                                while ($row = $resultbabakardesi->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Babasının Annesinin Kardeşi </td>
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
                                                    $sqlbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultbabaannekardescocugu = $baglanti->query($sqlbabaannekardescocugu);
                                                    while ($row = $resultbabaannekardescocugu->fetch_assoc()) {
                                                        echo "<tr>
                                        <td> Babasının Annesinin Kardeşinin Çocuğu </td>
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
                                                        $sqlbabaannekardesbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultbabaannekardesbabaannekardescocugu = $baglanti->query($sqlbabaannekardesbabaannekardescocugu);
                                                        while ($row = $resultbabaannekardesbabaannekardescocugu->fetch_assoc()) {
                                                            echo "<tr>
                                            <td> Babasının Annesinin Kardeşinin Torunu </td>
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
                                                            $sqlbabaannekardesbabaannekardesbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                            $resultbabaannekardesbabaannekardesbabaannekardescocugu = $baglanti->query($sqlbabaannekardesbabaannekardesbabaannekardescocugu);
                                                            while ($row = $resultbabaannekardesbabaannekardesbabaannekardescocugu->fetch_assoc()) {
                                                                echo "<tr>
                                                <td> Babasının Annesinin Kardeşinin TorunuNUN Çocuğu </td>
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
                                                    }
                                                }

                                                while ($row = $resultbabaBabası->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Babasının Annesinin Babası </td>
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
                                                while ($row = $resultbabaAnnesi->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Babasının Annesinin Annesi </td>
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
                                        }
                                    }
                                    while ($row = $resultAnnesi->fetch_assoc()) {
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
                                        $sqlannekardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                        $resultannekardesi = $baglanti->query($sqlannekardesi);
                                        $sqlanneBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                        $resultanneBabası = $baglanti->query($sqlanneBabası);
                                        $sqlanneAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                        $resultanneAnnesi = $baglanti->query($sqlanneAnnesi);

                                        while ($row = $resultannekardesi->fetch_assoc()) {
                                            echo "<tr>
                            <td> Annesinin Kardeşi </td>
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
                                            $sqlannekardescocugu = "SELECT * FROM `101m` WHERE `BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ";
                                            $resultannekardescocugu = $baglanti->query($sqlannekardescocugu);
                                            while ($row = $resultannekardescocugu->fetch_assoc()) {
                                                echo "<tr>
                                <td> Annesinin Kardeşinin Çocuğu </td>
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
                                                $sqlannekardesannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultannekardesannekardescocugu = $baglanti->query($sqlannekardesannekardescocugu);
                                                while ($row = $resultannekardesannekardescocugu->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Annesinin Kardeşinin Torunu </td>
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
                                                    $sqlannekardesannekardesannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultannekardesannekardesannekardescocugu = $baglanti->query($sqlannekardesannekardesannekardescocugu);
                                                    while ($row = $resultannekardesannekardesannekardescocugu->fetch_assoc()) {
                                                        echo "<tr>
                                        <td> Annesinin Kardeşinin Torununun Çocuğu </td>
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
                                            }
                                        }

                                        while ($row = $resultanneBabası->fetch_assoc()) {
                                            echo "<tr>
                            <td> Annesinin Babası </td>
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
                                            $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                            $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                                            $sqlbabaBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                            $resultbabaBabası = $baglanti->query($sqlbabaBabası);
                                            $sqlbabaAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                            $resultbabaAnnesi = $baglanti->query($sqlbabaAnnesi);

                                            while ($row = $resultbabakardesi->fetch_assoc()) {
                                                echo "<tr>
                                <td> Annesinin Babasının Kardeşi </td>
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
                                                $sqlannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultannebabakardescocugu = $baglanti->query($sqlannebabakardescocugu);
                                                while ($row = $resultannebabakardescocugu->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Annesinin Babasının Kardeşinin Çocuğu </td>
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
                                                    $sqlannebabakardesannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultannebabakardesannebabakardescocugu = $baglanti->query($sqlannebabakardesannebabakardescocugu);
                                                    while ($row = $resultannebabakardesannebabakardescocugu->fetch_assoc()) {
                                                        echo "<tr>
                                        <td> Annesinin Babasının Kardeşinin Torunu </td>
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
                                                        $sqlannebabakardesannebabakardesannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultannebabakardesannebabakardesannebabakardescocugu = $baglanti->query($sqlannebabakardesannebabakardesannebabakardescocugu);
                                                        while ($row = $resultannebabakardesannebabakardesannebabakardescocugu->fetch_assoc()) {
                                                            echo "<tr>
                                            <td> Annesinin Babasının Kardeşinin Torununun Çocuğu </td>
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
                                                }
                                            }

                                            while ($row = $resultbabaBabası->fetch_assoc()) {
                                                echo "<tr>
                                <td> Annesinin Babasının Babası </td>
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
                                            while ($row = $resultbabaAnnesi->fetch_assoc()) {
                                                echo "<tr>
                                <td> Annesinin Babasının Annesi </td>
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
                                        while ($row = $resultanneAnnesi->fetch_assoc()) {
                                            echo "<tr>
                            <td> Annesinin Annesi </td>
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
                                            $sqlannekardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                            $resultannekardesi = $baglanti->query($sqlannekardesi);
                                            $sqlanneBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                            $resultanneBabası = $baglanti->query($sqlanneBabası);
                                            $sqlanneAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                            $resultanneAnnesi = $baglanti->query($sqlanneAnnesi);

                                            while ($row = $resultannekardesi->fetch_assoc()) {
                                                echo "<tr>
                                <td> Annesinin Annesinin Kardeşi </td>
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
                                                $sqlanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultanneannekardescocugu = $baglanti->query($sqlanneannekardescocugu);
                                                while ($row = $resultanneannekardescocugu->fetch_assoc()) {
                                                    echo "<tr>
                                    <td> Annesinin Annesinin Kardeşinin Çocuğu </td>
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
                                                    $sqlanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardescocugu);
                                                    while ($row = $resultanneannekardesanneannekardescocugu->fetch_assoc()) {
                                                        echo "<tr>
                                        <td> Annesinin Annesinin Kardeşinin Torunu </td>
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
                                                        $sqlanneannekardesanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultanneannekardesanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardesanneannekardescocugu);
                                                        while ($row = $resultanneannekardesanneannekardesanneannekardescocugu->fetch_assoc()) {
                                                            echo "<tr>
                                            <td> Annesinin Annesinin Kardeşinin Torununun Çocuğu </td>
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
                                                            $sqlanneannekardesanneannekardesanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                            $resultanneannekardesanneannekardesanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardesanneannekardesanneannekardescocugu);
                                                            while ($row = $resultanneannekardesanneannekardesanneannekardesanneannekardescocugu->fetch_assoc()) {
                                                                echo "<tr>
                                                <td> Annesinin Annesinin Kardeşinin Torununun Torunu </td>
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
                                                    }
                                                }

                                                while ($row = $resultanneBabası->fetch_assoc()) {
                                                    echo "<tr>
                                <td> Annesinin Annesinin Babası </td>
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
                                                while ($row = $resultanneAnnesi->fetch_assoc()) {
                                                    echo "<tr>
                                <td> Annesinin Annesinin Annesi </td>
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
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>


                        <script type="text/javascript">
                            function clearResults() {

                                $("#01000001").html(
                                    '<tr class="odd"><td valign="top" colspan="21" class="dataTables_empty">Sana her günümünnnnn ihtiyacııııı varrrrrrrr.</td></tr>'
                                );

                                $("#tc").val("");
                            }
                        </script>
                        <script>
                            function checkNumber() {
                                $.Toast.showToast({
                                    "title": "Sorgulanıyor...",
                                    "icon": "loading",
                                    "duration": 4000
                                });
                            }
                        </script>

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
<!--BİTİŞ-->
<?php

include('inc/footer_main.php');
?>