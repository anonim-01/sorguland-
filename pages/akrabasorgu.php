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

$page_title = 'Akraba Sorgu';
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
                        <img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Akraba Sorgu
                    </h4>
                    <p style="color: #fff">Sorgulanacak kişinin kimlik numarasını giriniz.</p><br>
                    <form action="akrabasorgu" method="POST">
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input require maxlength="30" class="form-control" autocomplete="off" type="text" name="number" placeholder="Kimlik Numarası"><br>
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
                                    <th>Yakınlık</th>
                                    <th>TC</th>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                    <th>Doğum Tarihi</th>
                                    <th>Adres İl</th>
                                    <th>Adres İlçe</th>
                                    <th>Anne Adı</th>
                                    <th>Anne TC</th>
                                    <th>Baba Adı</th>
                                    <th>Baba TC</th>
                                </tr>
                            </thead>

                            <tbody id="01000001" style="color: white;">
                                <?php

                                if (isset($_POST['Sorgula'])) {
                                    echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                    $number = htmlspecialchars(strip_tags($_POST['number']));

                                    $baglanti = new mysqli('localhost', 'root', '', '101m');

                                    $str = $number;
                                    $sth = $baglanti->prepare("SELECT * FROM `101m`");

                                    $sql = "SELECT * FROM `101m` WHERE `TC` = '$str'";
                                    $result = $baglanti->query($sql);

                                    while ($row = $result->fetch_assoc()) {

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

                                            $sqlkendikendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                            $resultkendikendicocugu = $baglanti->query($sqlkendikendicocugu);
                                            while ($row = $resultkendikendicocugu->fetch_assoc()) {

                                                $sqlkendikendikendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultkendikendikendicocugu = $baglanti->query($sqlkendikendikendicocugu);
                                                while ($row = $resultkendikendikendicocugu->fetch_assoc()) {
                                                }
                                            }
                                        }
                                        while ($row = $resultkardesi->fetch_assoc()) {

                                            $sqlkardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                            $resultkardescocugu = $baglanti->query($sqlkardescocugu);
                                            while ($row = $resultkardescocugu->fetch_assoc()) {

                                                $sqlkardeskardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultkardeskardescocugu = $baglanti->query($sqlkardeskardescocugu);
                                                while ($row = $resultkardeskardescocugu->fetch_assoc()) {

                                                    $sqlkardeskardeskardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultkardeskardeskardescocugu = $baglanti->query($sqlkardeskardeskardescocugu);
                                                    while ($row = $resultkardeskardeskardescocugu->fetch_assoc()) {
                                                    }
                                                }
                                            }
                                        }

                                        while ($row = $resultBabası->fetch_assoc()) {

                                            $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                            $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                                            $sqlbabaBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                            $resultbabaBabası = $baglanti->query($sqlbabaBabası);
                                            $sqlbabaAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                            $resultbabaAnnesi = $baglanti->query($sqlbabaAnnesi);

                                            while ($row = $resultbabakardesi->fetch_assoc()) {
                                                echo "<tr>
<td> Halası/Amcası </td>
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
<td> Kuzeni </td>
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
                                                        $sqlbabakardesbabakardesbabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultbabakardesbabakardesbabakardescocugu = $baglanti->query($sqlbabakardesbabakardesbabakardescocugu);
                                                        while ($row = $resultbabakardesbabakardesbabakardescocugu->fetch_assoc()) {
                                                        }
                                                    }
                                                }
                                            }

                                            while ($row = $resultbabaBabası->fetch_assoc()) {
                                                $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                                $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                                                $sqlbabaBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                                $resultbabaBabası = $baglanti->query($sqlbabaBabası);
                                                $sqlbabaAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                                $resultbabaAnnesi = $baglanti->query($sqlbabaAnnesi);

                                                while ($row = $resultbabakardesi->fetch_assoc()) {
                                                    $sqlbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultbabababakardescocugu = $baglanti->query($sqlbabababakardescocugu);
                                                    while ($row = $resultbabababakardescocugu->fetch_assoc()) {
                                                        $sqlbabababakardesbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultbabababakardesbabababakardescocugu = $baglanti->query($sqlbabababakardesbabababakardescocugu);
                                                        while ($row = $resultbabababakardesbabababakardescocugu->fetch_assoc()) {
                                                            $sqlbabababakardesbabababakardesbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                            $resultbabababakardesbabababakardesbabababakardescocugu = $baglanti->query($sqlbabababakardesbabababakardesbabababakardescocugu);
                                                            while ($row = $resultbabababakardesbabababakardesbabababakardescocugu->fetch_assoc()) {
                                                            }
                                                        }
                                                    }
                                                }
                                                while ($row = $resultbabaBabası->fetch_assoc()) {
                                                }
                                                while ($row = $resultbabaAnnesi->fetch_assoc()) {
                                                }
                                            }
                                            while ($row = $resultbabaAnnesi->fetch_assoc()) {
                                                $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                                $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                                                $sqlbabaBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                                $resultbabaBabası = $baglanti->query($sqlbabaBabası);
                                                $sqlbabaAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                                $resultbabaAnnesi = $baglanti->query($sqlbabaAnnesi);

                                                while ($row = $resultbabakardesi->fetch_assoc()) {
                                                    $sqlbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultbabaannekardescocugu = $baglanti->query($sqlbabaannekardescocugu);
                                                    while ($row = $resultbabaannekardescocugu->fetch_assoc()) {
                                                        $sqlbabaannekardesbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultbabaannekardesbabaannekardescocugu = $baglanti->query($sqlbabaannekardesbabaannekardescocugu);
                                                        while ($row = $resultbabaannekardesbabaannekardescocugu->fetch_assoc()) {
                                                            $sqlbabaannekardesbabaannekardesbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                            $resultbabaannekardesbabaannekardesbabaannekardescocugu = $baglanti->query($sqlbabaannekardesbabaannekardesbabaannekardescocugu);
                                                            while ($row = $resultbabaannekardesbabaannekardesbabaannekardescocugu->fetch_assoc()) {
                                                            }
                                                        }
                                                    }
                                                }

                                                while ($row = $resultbabaBabası->fetch_assoc()) {
                                                }
                                                while ($row = $resultbabaAnnesi->fetch_assoc()) {
                                                }
                                            }
                                        }
                                    }
                                    while ($row = $resultAnnesi->fetch_assoc()) {
                                        $sqlannekardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                        $resultannekardesi = $baglanti->query($sqlannekardesi);
                                        $sqlanneBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                        $resultanneBabası = $baglanti->query($sqlanneBabası);
                                        $sqlanneAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                        $resultanneAnnesi = $baglanti->query($sqlanneAnnesi);

                                        while ($row = $resultannekardesi->fetch_assoc()) {
                                            echo "<tr>
<td> Teyzesi </td>
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
<td> Kuzeni </td>
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
                                                    $sqlannekardesannekardesannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultannekardesannekardesannekardescocugu = $baglanti->query($sqlannekardesannekardesannekardescocugu);
                                                    while ($row = $resultannekardesannekardesannekardescocugu->fetch_assoc()) {
                                                    }
                                                }
                                            }
                                        }

                                        while ($row = $resultanneBabası->fetch_assoc()) {
                                            $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                            $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                                            $sqlbabaBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                            $resultbabaBabası = $baglanti->query($sqlbabaBabası);
                                            $sqlbabaAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                            $resultbabaAnnesi = $baglanti->query($sqlbabaAnnesi);

                                            while ($row = $resultbabakardesi->fetch_assoc()) {
                                                $sqlannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultannebabakardescocugu = $baglanti->query($sqlannebabakardescocugu);
                                                while ($row = $resultannebabakardescocugu->fetch_assoc()) {
                                                    $sqlannebabakardesannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultannebabakardesannebabakardescocugu = $baglanti->query($sqlannebabakardesannebabakardescocugu);
                                                    while ($row = $resultannebabakardesannebabakardescocugu->fetch_assoc()) {
                                                        $sqlannebabakardesannebabakardesannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultannebabakardesannebabakardesannebabakardescocugu = $baglanti->query($sqlannebabakardesannebabakardesannebabakardescocugu);
                                                        while ($row = $resultannebabakardesannebabakardesannebabakardescocugu->fetch_assoc()) {
                                                        }
                                                    }
                                                }
                                            }

                                            while ($row = $resultbabaBabası->fetch_assoc()) {
                                            }
                                            while ($row = $resultbabaAnnesi->fetch_assoc()) {
                                            }
                                        }
                                        while ($row = $resultanneAnnesi->fetch_assoc()) {
                                            $sqlannekardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["BABATC"] . "' OR `ANNETC` = '" . $row["ANNETC"] . "' ) ";
                                            $resultannekardesi = $baglanti->query($sqlannekardesi);
                                            $sqlanneBabası = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] . "' ";
                                            $resultanneBabası = $baglanti->query($sqlanneBabası);
                                            $sqlanneAnnesi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] . "' ";
                                            $resultanneAnnesi = $baglanti->query($sqlanneAnnesi);

                                            while ($row = $resultannekardesi->fetch_assoc()) {
                                                $sqlanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                $resultanneannekardescocugu = $baglanti->query($sqlanneannekardescocugu);
                                                while ($row = $resultanneannekardescocugu->fetch_assoc()) {
                                                    $sqlanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                    $resultanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardescocugu);
                                                    while ($row = $resultanneannekardesanneannekardescocugu->fetch_assoc()) {
                                                        $sqlanneannekardesanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                        $resultanneannekardesanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardesanneannekardescocugu);
                                                        while ($row = $resultanneannekardesanneannekardesanneannekardescocugu->fetch_assoc()) {
                                                            $sqlanneannekardesanneannekardesanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '" . $row["TC"] . "'  AND (`BABATC` = '" . $row["TC"] . "' OR `ANNETC` = '" . $row["TC"] . "' ) ";
                                                            $resultanneannekardesanneannekardesanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardesanneannekardesanneannekardescocugu);
                                                            while ($row = $resultanneannekardesanneannekardesanneannekardesanneannekardescocugu->fetch_assoc()) {
                                                            }
                                                        }
                                                    }
                                                }
                                                while ($row = $resultanneBabası->fetch_assoc()) {
                                                }
                                                while ($row = $resultanneAnnesi->fetch_assoc()) {
                                                }
                                            }
                                        }
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
<!--BİTİŞ-->
<?php

include('inc/footer_main.php');
?>