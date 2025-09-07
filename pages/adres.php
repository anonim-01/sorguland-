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

$page_title = 'Adres Sorgu';
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
                        Adres Sorgu
                    </h4>
                    <p style="color: #fff">Sorgulanacak Kişinin Kimlik Numarasını Giriniz.</p><br>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <form action="adressorgu" method="POST">
                            <input require maxlength="11" minlength="11" class="form-control" type="text" autocomplete="off" name="txttc" placeholder="Kimlik Numarası"><br>

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
                                            <th>Kimlik Numarası</th>
                                            <th>Adres</th>
                                        </tr>
                                    </thead>

                                    <tbody id="00001010">
                                        <?php

                                        if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                            $tc = htmlspecialchars(strip_tags($_POST['txttc']));

                                            if (strlen($tc) == 11){

                                            $filename = file_get_contents("https://illegale.dev/platform/ikametgahrw?tc=$tc&hash=1943wqrtrt");

                                            $json_decode = json_decode($filename, true);

                                        ?>
                                        <tr>
                                            <td><?= $tc; ?></td>
                                            <td><?= $json_decode["Ikametgah"]; ?></td>
                                        </tr>

                                        <?php
                                        } }
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