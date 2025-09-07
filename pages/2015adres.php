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

$page_title = 'Mernis 2015 Adres Sorgu';
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
                    <img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Mernis 2015 Adres Sorgu
                    </h4>
                    <p style="color: #fff">Sorgulanacak kişinin TC kimlik numarasını giriniz.</p><br>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <form action="2015adres" method="POST">
                                <input require maxlength="30" autocomplete="off" class="form-control" type="text" name="tc" placeholder="Kimlik Numarası"><br>
                                <center class="nw">
                                    <button onclick="checkNumber()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula <span id="sorgulanumber"></span></button>
                                    <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                                    <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                                    <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır </button><br><br>
                                </center>
                            </form>
                            <div class="table-responsive" id="scroll">
                                <table id="01000001" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="color: white; font-weight: bold;">Kimlik No</th>
                                            <th style="color: white; font-weight: bold;">Ad</th>
                                            <th style="color: white; font-weight: bold;">Soyad</th>
                                            <th style="color: white; font-weight: bold;">İl</th>
                                            <th style="color: white; font-weight: bold;">İlçe</th>
                                            <th style="color: white; font-weight: bold;">Mahalle</th>
                                            <th style="color: white; font-weight: bold;">Sokak</th>
                                            <th style="color: white; font-weight: bold;">Kapı No</th>
                                            <th style="color: white; font-weight: bold;">Daire No</th>
                                        </tr>
                                    </thead>

                                    <tbody id="00001010">
                                        <?php

                                        if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                            $tc = htmlspecialchars(strip_tags($_POST['tc']));

                                            $db = new PDO("mysql:host=localhost;dbname=secmen;charset=utf8", "root", "");

                                            $query = $db->query("SELECT * FROM secmen2015 WHERE TC = '$tc'");

                                            while ($data = $query->fetch()) {

                                        ?>
                                                <tr>
                                                    <td> <?php echo $data['TC']; ?> </td>
                                                    <td> <?php echo $data['ADI']; ?> </td>
                                                    <td> <?php echo $data['SOYADI']; ?> </td>
                                                    <td> <?php echo $data['ADRESIL']; ?> </td>
                                                    <td> <?php echo $data['ADRESILCE']; ?> </td>
                                                    <td> <?php echo $data['MAHALLE']; ?> </td>
                                                    <td> <?php echo $data['CADDE']; ?> </td>
                                                    <td> <?php echo $data['KAPINO']; ?> </td>
                                                    <td> <?php echo $data['DAIRENO']; ?> </td>
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