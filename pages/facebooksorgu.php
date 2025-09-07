<?php
include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = 'Facebook Sorgu';
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
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Facebook Sorgu</h4>
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
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <form action="facebooksorgu" method="POST">
                                <div style="display: flex; flex-direction: row;">
                                    <input autocomplete="off" style="margin-right: 50px;" autocomplete="off" maxlength="16" name="txtad" class="form-control" type="text" id="ad" placeholder="Ad">
                                    <br>
                                    <input autocomplete="off" class="form-control" autocomplete="off" type="text" maxlength="16" name="txtsoyad" id="soyad" placeholder="Soyad">
                                    <br>
                                </div>
                                <br>
                                <input autocomplete="off" maxlength="10" minlength="10" type="text" name="txtno" class="form-control" id="numara" placeholder="Telefon Numarası"><br>
                                <input autocomplete="off" type="text" name="txtfbid" class="form-control" id="numara" placeholder="Facebook ID"><br>
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
                                        <th>ID</th>
                                        <th>NUMARA</th>
                                        <th>ADI</th>
                                        <th>SOYADI</th>
                                        <th>EPOSTA</th>
                                        <th>DOGUMTARIHI</th>
                                        <th>CINSIYET</th>
                                        <th>MEMLEKET</th>
                                        <th>YER</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if ($_POST) {

                                        $gsm = $_POST['txtno'];
                                        $ad = $_POST['txtad'];
                                        $soyad = $_POST['txtsoyad'];
                                        $fbid = $_POST['txtfbid'];

                                            $db = new PDO("mysql:host=localhost;dbname=facebook;charset=utf8", "root", "");

                                            if ($fbid != "") {
                                                $query = $db->query("SELECT * FROM facebook WHERE id = '$fbid'");
                                            } else if ($gsm != "") {
                                                $query = $db->query("SELECT * FROM facebook WHERE NUMARA = '$gsm'");
                                            } else {
                                                $query = $db->query("SELECT * FROM facebook WHERE AD = '$ad' AND SOYAD = '$soyad'");
                                            }


                                        while ($data = $query->fetch()) {

                                    ?>
                                            <tr>
                                                <td> <?php echo $data['id']; ?> </td>
                                                <td> <?php echo $data['NUMARA']; ?> </td>
                                                <td> <?php echo $data['AD']; ?> </td>
                                                <td> <?php echo $data['SOYAD']; ?> </td>
                                                <td> <?php echo $data['email']; ?> </td>
                                                <td> <?php echo $data['birthday']; ?> </td>
                                                <td>
                                                    <?php

                                                    if ($data['gender'] == "male") {
                                                        echo "Erkek";
                                                    } else if ($data['gender'] == "female") {
                                                        echo "Kadın";
                                                    } else {
                                                        echo "Bilinmiyor";
                                                    }

                                                    ?>
                                                </td>
                                                <td> <?php echo $data['hometown']; ?> </td>
                                                <td> <?php echo $data['location']; ?> </td>
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