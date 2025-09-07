<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
<?php
$customCSS = array();
$customJAVA = array();
$customCSS = array(
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
require '../server/database.php';
require '../server/admincontrol.php';

$page_title = 'Kullanıcı Ekle';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

date_default_timezone_set('Europe/Istanbul');

?>
<?php

$ekleyenssid = $_SESSION['GET_USER_SSID'];

$ekleyenqry = $db->query("SELECT * FROM users WHERE k_key = '$ekleyenssid'");

while ($ekleyendata = $ekleyenqry->fetch()) {
    $ekleyen = $ekleyendata['k_adi'];
    $id = $ekleyendata['id'];
}

if ($_POST) {

    $developer = true;

    $content = $_POST['username'];
    $expire = $_POST['expire'];

    $access = $_POST['access_level'];

    date_default_timezone_set('Europe/Istanbul');

    $DateTimeNow = date('d.m.y H:i:s');

    $Result = bin2hex(random_bytes(25));

    $CheckTokenCount = $db->query("SELECT * FROM users WHERE k_key = '$Result'");
    $TokenCount = $CheckTokenCount->rowCount();

    if ($content == "" || $expire == "" || $access == "") {
        echo '
                <script type="text/javascript">
                Swal.fire({
                    title: "Hata!",
                    text: "Boş alan olamaz!",
                    icon: "error",
                    width: "400px",
                    confirmButtonColor: "#6610f2",
                    allowOutsideClick: false,
                    background: "#283046",
                })
                </script>
                ';
    } else if ($TokenCount == "1") {
        echo '
                <script type="text/javascript">
                Swal.fire({
                    title: "Hata!",
                    text: "Bu token zaten mevcut! tekrar deneyin",
                    icon: "error",
                    width: "400px",
                    confirmButtonColor: "#6610f2",
                    allowOutsideClick: false,
                    background: "#283046",
                })
                </script>
        ';
    } else {
        echo "<script> 
                Swal.fire({
                    title: 'Hesap Oluşturuldu!',
                    text: 'Anahtar $Result',
                    icon: 'success',
                    width: '600px',
                    id: 'testsweet',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    background: '#283046',
                    timer: 6000,
                })</script>";
        $sql = "INSERT INTO users (k_adi, k_key, k_rol, k_time, k_ekleyen) VALUES (?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$content, $Result, $access, $expire, $ekleyen]);
    }
}

?>
<style>
    .date-icon {
        position: absolute;
        top: 13px;
        right: 13px;
        pointer-events: none;
        color: #aaa;
    }

    i:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <form action="adduser" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <section id="floating-label-input">
                                <div class="row">
                                    <div class="col-sm-12 col-12 mb-1 mb-sm-0">
                                        <div class="form-floating">
                                            <div class="mb-1">
                                                <input type="text" class="form-control" placeholder="Oluşturulacak anahtar için bir kullanıcı adı belirleyin" name="username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12 mb-1 mb-sm-0">
                                        <div class="form-floating">
                                            <div class="mb-1 mt-2" id="hover">
                                                <input type="date" class="form-control" name="expire">
                                                <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12 mb-1 mb-sm-0">
                                        <div class="form-floating">
                                            <div class="mb-1 mt-2">
                                                <select style="background-color: #010409;color:#FFFFFF" name="access_level" class="form-select">
                                                    <?php

                                                    if ($id == 1) {

                                                    ?>
                                                        <option name="access_level" selected value="0">Normal Üye</option>
                                                        <option name="access_level" value="1">Admin</option>
                                                    <?php

                                                    } else {

                                                    ?>
                                                        <option name="access_level" selected value="0">Normal Üye</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div>
                                <br>
                                <button type="submit" class="btn waves-effect toast-basic-toggler waves-light btn-rounded btn-outline-primary" style="width: 180px; height: 45px; outline: none;"> Kullanıcı Ekle</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('inc/footer_main.php');
?>