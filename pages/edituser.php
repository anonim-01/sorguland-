<?php
$customCSS = array();
$customJAVA = array(
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);
$customCSS = array(
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);

require '../server/database.php';
require '../server/admincontrol.php';

$page_title = 'Kullanıcı Düzenle';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

$id = intval(preg_replace("/[^0-9]+/", "", htmlspecialchars($_GET["id"])));
if (!isset($id) || empty($id)) {
    header("Location: /users");
    die();
}

session_start();

$ekleyenssid = $_SESSION['GET_USER_SSID'];

$ekleyenqry = $db->query("SELECT * FROM users WHERE k_key = '$ekleyenssid'");

while ($ekleyendata = $ekleyenqry->fetch()) {
    $ssid = $ekleyendata['id'];
}

?>
<?php
$query = $db->query("SELECT * FROM `users` WHERE id='$id'");
if ($query->rowCount() < 1) {
    header("Location: /users");
}
while ($getvar = $query->fetch()) { ?>
    <style>
        .date-icon {
            position: absolute;
            top: 38px;
            right: 23px;
            pointer-events: none;
            color: #aaa;
        }

        i:hover {
            cursor: pointer;
        }

        label {
            padding: 2px;
        }
    </style>
    <div class="row">
        <div class="col">
            <div class="card">
                <?php
                if ($ssid == $id) {
                ?>
                    <br>
                    <h4 style="color: red;">Kendinle aynı yetkideki bir kullanıcıyı düzenleyemez veya silemezsin!</h4>
                <?php
                } else if ($ssid != $id) {
                ?>
                    <?php

                    $query = $db->query("SELECT * FROM users WHERE id = '$id'");

                    while ($data = $query->fetch()) {
                        $Username = $data['k_adi'];
                        $Token = $data['k_key'];
                        $Access = $data['k_rol'];
                        $Expire = $data['k_time'];
                    }

                    ?>
                    <form action="../server/adminrequest.php" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <section id="floating-label-input">
                                    <div class="row">
                                        <div class="col-sm-12 col-12 mb-1 mb-sm-0">
                                            <div class="form-floating">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Anahtar</label>
                                                    <input style="cursor: pointer;" type="text" disabled value="<?= $Token; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Kullanıcı Adı </label>
                                                    <input type="text" name="username" value="<?= $Username; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Üyelik </label>
                                                    <select style="background-color: #010409;color: #fff;" name="access_level" class="form-select">
                                                        <option name="access_level" selected value="0">Normal Üye</option>
                                                        <?php

                                                        if ($ssid == 1) {

                                                        ?>
                                                            <option name="access_level" value="1">Admin</option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Üyelik Sona Erme Tarihi </label>
                                                    <input type="date" name="expire_date" value="<?= $Expire; ?>" class="form-control">
                                                    <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <div style="padding: 2px;"></div>

                                <div class="card-header" style="border: none;">
                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                    <button type="submit" name="updatex" class="btn waves-effect toast-basic-toggler waves-light btn-rounded btn-outline-primary" style="width: 180px; height: 45px; outline: none;"> Düzenle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php
                } else {
                ?>
                    <h4 style="color: red;">Kendinle aynı yetkideki bir kullanıcıyı düzenleyemez veya silemezsin!</h4>
                <?php
                }
                ?>
                </li>
                </ul>
            </div>
        <?php } ?>
        </center>
        <?php
        include('inc/footer_main.php');
        ?>