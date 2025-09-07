<?php

$customCSS = array(
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

require '../server/database.php';
require '../server/admincontrol.php';

$page_title = 'Duyuru Yönetimi';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

if ($_POST) {

    $content = $_POST['content'];

    date_default_timezone_set('Europe/Istanbul');

    $DateTimeNow = date('d.m.y H:i');

    if ($content != "") {
        $sql = "INSERT INTO news (d_icerik, d_time) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$content, $DateTimeNow]);
    }
}

?>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/notice.png" alt="">&nbsp;Duyuru Yönetimi</h4>
                    <br>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" role="tabpanel">

                            <form method="post">
                                <input class="form-control" type="text" name="content" id="content" placeholder="Duyuru İçeriği Giriniz"><br>
                        </div>

                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="width: 180px; height: 45px; outline: none; "> Paylaş </button> </form>
                        </form>
                        <br>
                        <div class="table-responsive">

                            <table id="01000001" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>İçerik</th>
                                        <th>Paylaşılan Tarih</th>
                                        <th>İşlem</th>
                                    </tr>
                                </thead>
                                <?php
                                $query = $db->query("SELECT * FROM `news` LIMIT 50");
                                while ($getvar = $query->fetch()) {
                                    echo '
								<tr><td>' . $getvar['d_icerik'] . '</td>
								<td>' . $getvar['d_time'] . '</td>
								<td><form method="POST" action="../server/adminrequest.php"><input type="hidden" name="deleteid" value="'.$getvar['id'].'"><button class="btn btn-outline-danger type="submit" name="delete">Kaldır</button></form></td>
								';
                                }
                                ?>
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