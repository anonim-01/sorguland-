<?php
include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'IP Sorgu';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

error_reporting(0);

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
<style>
    .alert-secondary {
        font-family: Poppins;
        font-weight: bolder;
		background-color: #010409;
        border: 1px solid #2d2d3f;
        color: #fff;
        font-weight: normal !important;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> IP Sorgu</h4>
                </div>
                <div class="card">
                    <div class="card-body" style="margin-top: -35px !important;">

                        <div class="alert alert-danger">IPv4 bilgilerini tutan hiç bir firmada (ana sağlayıcı dışında) açık adres bulunmamaktadır.</div>

                        <form action="ipsorgu" method="post">

                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <div class="mb-3 input-group">
                                    <input type="text" maxlength="18" class="form-control" name="ip_adresi" id="number" autocomplete="off" placeholder="Sorgulanacak IP Adresi" required><br>
                                </div>

                            </div>

                            <br>
                            <center>
                                <button type="submit" name="sorgula" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula</button>
                        </form>
                        <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                        <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="font-weight: 400;font-family: Poppins;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                        <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır</button><br><br>
                        </center>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12 col-md-6">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
						<center>
                            <div class="alert alert-secondary" style="padding: 15px;">
                                IP Bilgileri
                            </div>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-bordered">
							<?php
                            if (isset($_POST['sorgula'])) {

                                $ip_bilgi = file_get_contents('http://ip-api.com/json/' . htmlspecialchars(strip_tags($_POST['ip_adresi'])));
                                $json_coz = json_decode($ip_bilgi, true);
							}
                            ?>
                                <tbody>
                                    <tr>
                                        <th>IP Adresi</th>
                                        <td><?php echo $json_coz['query']; ?> </td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ülke </th>
                                        <td><?php echo $json_coz['country']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Ülke Kodu </th>
                                        <td><?php echo $json_coz['countryCode']; ?> </td>
                                    </tr>

                                    <tr>
                                        <th>Bölge</th>
                                        <td><?php echo $json_coz['regionName']; ?> </td>
                                    </tr>

                                    <tr>
                                        <th>Bölge Kodu</th>
                                        <td><?php echo $json_coz['region']; ?> </td>
                                    </tr>

                                    <tr>
                                        <th>Şehir</th>
                                        <td><?php echo $json_coz['city']; ?> </td>
                                    </tr>
									
									<tr>
                                        <th>Posta Kodu</th>
                                        <td><?php echo $json_coz['zip']; ?> </td>
                                    </tr>
									
                                    <tr>
                                        <th>Zaman Dilimi</th>
                                        <td><?php echo $json_coz['timezone']; ?> </td>
                                    </tr>
									
                                    <tr>
                                        <th>Enlem</th>
                                        <td><?php echo $json_coz['lat']; ?> </td>
                                    </tr>

                                    <tr>
                                        <th>Boylam</th>
                                        <td><?php echo $json_coz['lon']; ?> </td>
                                    </tr>
									
									<tr>
                                        <th>Organizasyon</th>
                                        <td><?php echo $json_coz['org']; ?> </td>
                                    </tr>
									
                                    <tr>
                                        <th>ISP</th>
                                        <td><?php echo $json_coz['isp']; ?> </td>
                                    </tr>

                                    <tr>
                                        <th>As Numarası/Adı</th>
                                        <td><?php echo $json_coz['as']; ?> </td>
                                    </tr>
                        </div>
                        <center>
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

</div>

</div>
<!-- end row -->

</div>
<!-- container-fluid -->
</div>

</div>
<!--BİTİŞ-->
<?php

include('inc/footer_main.php');
?>