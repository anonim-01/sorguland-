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

$page_title = 'Seri No Sorgu';
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
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Seri No Sorgu</h4>
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-body" style="font-weight: normal;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            Şu anda kullandığınız sistem beta aşamasında olduğu için bazı hatalarla karşılaşabilirsiniz.
                        </div>
                    </div>
                    <div class="block-content tab-content">
                        <form action="serino" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input class="form-control" type="text" id="tcno" name="tcno" min="11" max="11" placeholder="Kimlik Numarası" autocomplete="off" required><br>
                                <div style="display: flex; flex-direction: row;">
                                </div>
                                <br>
                            </div>
                            <center class="nw">
                                <button onclick="checkNumber()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula <span id="sorgulanumber"></span></button>
                                <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                                <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                                <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır </button><br><br>
                            </center>
                        </form>
                        <div class="table-responsive">

                            <table id="01000001" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>TC</th>
                                        <th>Adı</th>
                                        <th>Soyadı</th>
                                        <th>Anne Adı</th>
                                        <th>Baba Adı</th>
                                        <th>Cinsiyet</th>
                                        <th>Doğum Tarihi</th>
                                        <th>Doğum Yeri</th>
                                        <th>Medeni Hali</th>
                                        <th>İl</th>
                                        <th>İlçe</th>
                                        <th>Mahalle</th>
                                        <th>Cilt No</th>
                                        <th>Aile Sıra No</th>
                                        <th>Sıra No</th>
                                        <th>Cüzdan Türü</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {

                                        echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                        $tc = htmlspecialchars(strip_tags($_POST['tcno']));

                                        $db = new PDO("mysql:host=localhost;dbname=test2;charset=utf8", "root", "");

                                        if ($tc != "" && strlen($tc) == 11) {
                                            $query = $db->query("SELECT * FROM serino WHERE TCKN = '$tc'");
                                        }

                                        while ($data = $query->fetch()) {

                                    ?>
                                            <tr>
                                                <td> <?php echo $data['TCKN']; ?> </td>
                                                <td> <?php echo $data['AD']; ?> </td>
                                                <td> <?php echo $data['SOYAD']; ?> </td>
                                                <td> <?php echo $data['BABA-ADI']; ?> </td>
                                                <td> <?php echo $data['ANNE-ADI']; ?> </td>
                                                <td> <?php echo $data['CİNSİYET']; ?> </td>
                                                <td> <?php echo $data['DOĞUM-TARİHİ']; ?> </td>
                                                <td> <?php echo $data['DOĞUM-YERİ']; ?> </td>
                                                <td> <?php echo $data['MEDENİ-HAL']; ?> </td>
                                                <td> <?php echo $data['NUFUS-İL']; ?> </td>
                                                <td> <?php echo $data['NUFUS-İLÇE']; ?> </td>
                                                <td> <?php echo $data['NUFUS-MAHALLE']; ?> </td>
                                                <td> <?php echo $data['CİLT-NO']; ?> </td>
                                                <td> <?php echo $data['AİLE-SIRA-NO']; ?> </td>
                                                <td> <?php echo $data['SIRA-NO']; ?> </td>
                                                <td> <?php echo $data['CÜZDAN-TÜR']; ?> </td>
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