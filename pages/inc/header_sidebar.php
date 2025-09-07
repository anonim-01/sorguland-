<?php

ini_set("display_errors", 0);

error_reporting(0);

include "../server/database.php";

include '../server/rolecontrol.php';

$USERSSID = $_SESSION['GET_USER_SSID'];

$UserRoleQry = $db->query("SELECT * FROM users WHERE k_key = '$USERSSID'");

while ($UserData = $UserRoleQry->fetch()) {
    $k_rol = $UserData['k_rol'];
    $k_image = $UserData['k_image'];
}

function Image($k_image)
{
    if ($k_image != "") {
        $Output = $k_image;
    } else {
        $Output = "assets/img/fwxmvmc.jpeg";
    }
    return $Output;
}

?>
<script src="https://use.fontawesome.com/452826394c.js"></script>
<div class="page-container">
    <div class="page-sidebar">
        <img alt="image" src="" class="FR13NDS">
        <ul class="list-unstyled accordion-menu">
            <li>
                <a href="panel"><i data-feather="home"></i>Ana Sayfa</a>
            </li>

            <li>
                <a href="#"><i data-feather="search"></i>Mernis 2023 <i class="fas fa-chevron-right dropdown-icon"></i></a>
                <ul>
                    <li>
                        <a href="adsoyadsorgu" class="active">Ad Soyad Sorgu</a>
                    </li>
                    <li>
                        <a href="tcsorgu" class="active">TC Sorgu</a>
                    </li>
                    <li>
                        <a href="annesorgu" class="active">Anne Sorgu</a>
                    </li>
                    <li>
                        <a href="babasorgu" class="active">Baba Sorgu</a>
                    </li>
                    <li>
                        <a href="ehliyetsorgu" class="active">Ehliyet Sorgu</a>
                    </li>
                    <li>
                        <a href="serino" class="active">Seri No Sorgu</a>
                    </li>
                    <li>
                        <a href="ininal" class="active">İninal Sorgu</a>
                    </li>
                    <li>
                        <a href="plakasorgu" class="active">Plaka Sorgu</a>
                    </li>
                    <li>
                        <a href="parselsorgu" class="active">Parsel Sorgu</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i data-feather="users"></i>Aile Çözümleri <i class="fas fa-chevron-right dropdown-icon"></i></a>
                <ul>
                    <li>
                        <a href="ailesorgu" class="active">Aile Sorgu</a>
                    </li>
                    <li>
                        <a href="soyagacisorgu" class="active">Soyağacı Sorgu</a>
                    </li>
                    <li>
                        <a href="akrabasorgu" class="active">Akraba Sorgu</a>
                    </li>
                    <li>
                        <a href="anneailesorgu" class="active">Anne Tarafı Sorgu</a>
                    </li>
                    <li>
                        <a href="babaailesorgu" class="active">Baba Tarafı Sorgu</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i data-feather="book"></i>Okul Çözümleri <i class="fas fa-chevron-right dropdown-icon"></i></a>
                <ul>
                    <li>
                        <a href="vesikasorgu" class="active">Vesika Sorgu</a>
                    </li>
                    <li>
                        <a href="okulnosorgu" class="active">Okul Numarası Sorgu</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i data-feather="smartphone"></i>GSM Çözümleri <i class="fas fa-chevron-right dropdown-icon"></i></a>
                <ul>
                    <li>
                        <a href="gsmtc" class="active">GSM'den TC</a>
                    </li>
                    <li>
                        <a href="tcgsm" class="active">TC'den GSM</a>
                    </li>
                    <li>
                        <a href="gsmisim" class="active">GSM'den İsim</a>
                    </li>
                    <li>
                        <a href="gsmfatura" class="active">GSM'den Fatura Sorgu</a>
                    </li>
                    <li>
                        <a href="gsmpro" class="active">GSM PRO Sorgu</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i data-feather="map-pin"></i>Adres Sorgu <i class="fas fa-chevron-right dropdown-icon"></i></a>
                <ul>
                    <li>
                        <a href="adressorgu" class="active">Adres Sorgu</a>
                    </li>
                    <li>
                        <a href="binasorgu" class="active">Bina Sorgu</a>
                    </li>
                    <li>
                        <a href="sokaksorgu" class="active">Sokak Sorgu</a>
                    </li>
                    <li>
                        <a href="dairesorgu" class="active">Daire Sorgu</a>
                    </li>
                    <li>
                        <a href="mahallesorgu" class="active">Mahalle Sorgu</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i data-feather="database"></i>Veritabanı <i class="fas fa-chevron-right dropdown-icon"></i></a>
                <ul>
                    <li>
                        <a href="facebooksorgu" class="active">Facebook Sorgu</a>
                    </li>
                    <li>
                        <a href="ttnetsorgu" class="active">TTNET Sorgu</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i data-feather="user-plus"></i>Mernis 2015 <i class="fas fa-chevron-right dropdown-icon"></i></a>
                <ul>
                    <li>
                        <a href="mernis2015" class="active">Ad Soyad Sorgu</a>
                    </li>
                    <li>
                        <a href="2015tc" class="active">TC Sorgu</a>
                    </li>
                    <li>
                        <a href="2015adres" class="active">Adres Sorgu</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i data-feather="tool"></i>Diğer Araçlar <i class="fas fa-chevron-right dropdown-icon"></i></a>
                <ul>
                    <li>
                        <a href="ipsorgu" class="active">IP Sorgu</a>
                    </li>
                    <li>
                        <a href="ibansorgu" class="active">IBAN Sorgu</a>
                    </li>
                    <li>
                        <a href="binchecker" class="active">BIN Checker</a>
                    </li>
                    <li>
                        <a href="dnschecker" class="active">DNS Checker</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="uschecker"><i data-feather="credit-card"></i>CC Checker</a>
            </li>

            <li>
                <a href="sms"><i data-feather="message-square"></i>SMS Bomber</a>
            </li>

            <li>
                <a href="paketler"><i data-feather="shopping-cart"></i>Market</a>
            </li>

            <li>
                <a href="kimlikolusturucu"><i data-feather="image"></i>Kimlik Oluşturucu</a>
            </li>

            <?php if ($k_rol == "1") { ?>
                <li>
                    <a href="#"><i data-feather="lock"></i>Admin <i class="fas fa-chevron-right dropdown-icon"></i></a>
                    <ul>
                        <li>
                            <a href="/users" class="active">Kullanıcılar</a>
                        </li>
                        <li>
                            <a href="/adduser" class="active">Kullanıcı Ekle</a>
                        </li>
                        <li>
                            <a href="/notice" class="active">Duyurular</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <li>
                <a href="logout"><i data-feather="power"></i>Çıkış Yap</a>
            </li>

        </ul>
    </div>