<?php
include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = 'Hesabım';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

$GET_SESSION_TOKEN = $_SESSION['GET_USER_SSID'];

$CheckAccount = $db->query("SELECT * FROM users WHERE k_key = '$GET_SESSION_TOKEN'");
$CheckAccountCount = $CheckAccount->rowCount();

while ($GetInfo = $CheckAccount->fetch()) {
    $GET_USER_NICK = $GetInfo['k_adi'];
    $GET_LAST_LOGIN = $GetInfo['k_lastlogin'];
    $GET_EXPIRE_DATE = $GetInfo['k_time'];
    $GET_ACCESS_LEVEL = $GetInfo['k_rol'];
    $GET_BROWSER = $GetInfo['k_browser'];
    $GET_PROFILE_IMG = $GetInfo['k_image'];
    $GET_SYSTEM = $GetInfo['k_os'];
    $GET_USER_ID = $GetInfo['id'];
}


if ($GET_ACCESS_LEVEL == 1) {
    $Result = "Administrator";
} else {
    $Result = "Normal Üye";
}


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

    .card {
        border: 0.5px solid #30363d;
        border-radius: 6px;
        border-color: #2d2d3f !important;
    }

    .banner {
        background-color: #010409;
        border: 0.5px solid #30363d;
        border-color: #2d2d3f !important;
        color: #fff;
        padding: 20px;
        text-align: center;
        border-radius: 8px;
        width: 100%;
        box-shadow: 0 0 10px 0 rgba(0,0,0,0.1), 0 10px 10px 0 rgba(0,0,0,0.2), 0 20px 20px 0 rgba(0,0,0,0.1);
    }

    .banner h1 {
        font-size: 3rem;
        margin: 0;
    }

    .mb-75{
        font-size: small;
    }

    .card-text{
        font-size: small;
    }
</style>
<div class="container-x">
    <section id="profile-info">
        <div class="row mt-5">
            <div class="banner">
                <h1>Hesabım</h1>
            </div>
            <div style="padding: 10px;"></div>
            <div class="col-lg-3 col-12 order-2 order-lg-1">
                <div class="card">
                    <div class="card-body" style="padding: 20px;">
                        <div class="mt-2">
                            <h5 class="mb-75">Kullanıcı Adı</h5>
                            <p class="card-text"><?= $GET_USER_NICK; ?></p>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h5 class="mb-75">Son Giriş Tarihi</h5>
                            <p class="card-text"><?= $GET_LAST_LOGIN; ?></p>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h5 class="mb-75">Süre Dolma Tarihi</h5>
                            <p class="card-text"><?= $GET_EXPIRE_DATE; ?></p>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h5 class="mb-75">Mevcut Üyeliğiniz</h5>
                            <p class="card-text"><?= $Result; ?></p>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h5 class="mb-75">Tarayıcı</h5>
                            <p class="card-text"><?= $GET_BROWSER; ?></p>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h5 class="mb-75">İşletim Sistemi</h5>
                            <p class="card-text"><?= $GET_SYSTEM; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
            <div class="col-lg-6 col-12 order-1 order-lg-2">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-white">Avatar</h2>
                        <form action="myaccount" method="POST">
                            <div style="padding: 3px;"></div>
                            <input class="form-control" id="image" name="profileimage" type="text" value="<?= $GET_PROFILE_IMG; ?>" placeholder="Resim URL'sini Giriniz Örneğin : https://example.com/picture.gif">
                            <br>
                            <button type="submit" name="" class="btn btn-sm btn-outline-primary">Avatarı Değiştir</button>
                            <button type="button" onclick="Reset();" class="btn btn-sm btn-outline-danger">Avatarı Kaldır</button>
                        </form>
                        <script>
                            function Reset() {
                                let image = document.getElementById('image');

                                image.value = '';

                                return false;
                            }
                        </script>
                        <?php

                        if ($_POST) {
                            $post_image = $_POST['profileimage'];
                            $post_id = $GET_USER_ID;

                            echo '<script type="text/javascript">toastr.success("Başarıyla güncellendi!");</script>';
                            $sonuc = $db->exec("UPDATE users SET k_image = '$post_image' WHERE id = '$post_id'");
                            echo '<script type="text/javascript">setTimeout(() => window.location = "myaccount", 1000);</script>';
                        }

                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-12 order-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Hoşgeldiniz 👋</h5>
                        <div style="padding: 1px;"></div>
                        <?php

                        $query = $db->query("SELECT * FROM users ORDER BY id DESC LIMIT 5");

                        while ($data = $query->fetch()) {

                        ?>
                            <div class="d-flex justify-content-start align-items-center mt-2">
                                <div class="avatar me-75" style="padding: 5px;">
                                    <?php

                                    $profile_img = $data['k_image'];

                                    if ($profile_img != "") {
                                        echo "<img style='border-radius: 25px;' src='$profile_img' height='40' width='40'>";
                                    } else {
                                        echo "<img style='border-radius: 25px;' src='assets/img/fwxmvmc.jpeg' height='40' width='40'>";
                                    }

                                    ?>
                                </div>
                                <div class="profile-user-info" style="padding: 3px;">
                                    <h6 class="mb-0">
                                        <?php

                                        echo $data['k_adi'];

                                        if ($data['k_rol'] == 1) {
                                            $Resultx = "Admin";
                                        } else {
                                            $Resultx = "Normal Üye";
                                        }

                                        ?>
                                    </h6>
                                    <small class="text-muted"><?= $Resultx; ?></small>
                                </div>
                            </div>
                        <?php

                        }

                        ?>

                    </div>
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