<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
<?php
require '../server/database.php';
require '../server/admincontrol.php';

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'Kullanıcı Yönetimi';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

if ($_GET['status'] == "true") {
    echo '<script type="text/javascript"> 
    Swal.fire({
        title: "Başarılı!",
        text: "Hesap başarıyla düzenlendi!",
        icon: "success",
        width: "400px",
        showConfirmButton: false,
        allowOutsideClick: false,
        background: "#283046",
        timer: 2000,
    });setTimeout (() => window.location = "users", 2000);</script>';
}

?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kullanıcı Yönetimi</h5>
                <p>Bu sayfada kullanıcıları yönetebilirsiniz.</p>
                <table id="01000001" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kullanıcı Adı</th>
                            <th>Kalan Zaman</th>
                            <th>İşletim Sistemi</th>
                            <th>Tarayıcı</th>
                            <th>Son Giriş Tarihi</th>
                            <th>IP Adresi</th>
                            <th>Ekleyen</th>
                            <th>Üyelik</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $db->query("SELECT * FROM `users`");

                        while ($getvar = $query->fetch()) {
                            $m = 1;

                            $uyetarih = $getvar['k_time'];
                            if ($uyetarih != "1") {
                                $nowDate = date("Y-m-d");
                                $d1 = new DateTime($nowDate);
                                $d2 = new DateTime($uyetarih);
                                $gun = $d1->diff($d2)->days;
                            } else if ($uyetarih == "1") {
                                $gun = "0";
                            }
                            if (!empty($uyeliktarih)) {
                                echo $uyeliktarih;
                            }
                        ?>
                            <tr>
                                <td><?php echo $m++; ?></td>
                                <td><?php echo $getvar['k_adi']; ?></td>
                                <td><?php echo $gun; ?> Gün</td>
                                <td>
                                    <div class="platform_icon"><?php getos($getvar['k_os']) ?></div>
                                </td>
                                <td><?php echo $getvar['k_browser']; ?></td>
                                <td><?php echo $getvar['k_lastlogin']; ?></td>
                                <td><?php echo $getvar['k_ip']; ?></td>
                                <td><?php echo $getvar['k_ekleyen']; ?></td>
                                <td>
                                    <?php
                                    $roll = $getvar['k_rol'];
                                    switch ($roll) {
                                        case '0':
                                            $uyelik = "Normal Üye";
                                            break;
                                        case '1':
                                            $uyelik = "Admin";
                                            break;
                                    }
                                    echo $uyelik;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo '<a href="edituser/' . $getvar['id'] . '"><button type="button" class="btn btn-outline-primary m-b-x">Düzenle</button></a>';
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php

include('inc/footer_main.php');
?>