<?php

include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'Plaka Sorgu';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

?>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Plaka Sorgu</h4>
                    <p class="mb-1">
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <form action="plakasorgu" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input class="form-control" autocomplete="off" type="text" name="plaka" placeholder="Araç Plakası">
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
                                        <th>Araç Plaka</th>
                                        <th>Adı Soyadı</th>
                                        <th>Tarih</th>
                                        <th>Telefon Numarası</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {

                                        echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                        $veri = htmlspecialchars(strip_tags($_POST['plaka']));
                                        $plaka = str_replace(" ", "", $veri);

                                        // Site URL'si
                                        $url = "https://www.plakasorgula.net/search.php";

                                        // Cookie dosyasının yolu ve adı
                                        $cookie_file = "";

                                        // POST verileri
                                        $post_data = array(
                                            'plaka' => $plaka
                                        );

                                        // Curl başlat
                                        $ch = curl_init();

                                        // Curl ayarları
                                        curl_setopt($ch, CURLOPT_URL, $url);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
                                        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
                                        curl_setopt($ch, CURLOPT_POST, 1);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

                                        // Siteye bağlan
                                        $content = curl_exec($ch);

                                        // Curl sonlandır
                                        curl_close($ch);

                                        // td etiketlerindeki verileri almak için bir regular expression kullanabilirsiniz
                                        preg_match_all('/<td>(.*?)<\/td>/', $content, $matches);

                                    ?>
                                        <tr>
                                            <?php
                                            // Verileri sıra sıra yazdır
                                            foreach ($matches[1] as $match) {
                                                echo "<td>" . $match . "</td>";
                                            }
                                            ?>
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