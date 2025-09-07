<?php
include_once "../server/rolecontrol.php";

$customCSS = array();
$customJAVA = array();

$page_title = 'Üyelik Paketleri';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<center>
    <br>
    <br>
    <h3 class="content-heading" style="color: rgb(208, 210, 214);">Üyelik Paketleri</h5>
        <div style="padding: 1px;"></div>
        <h7 class="content-heading" style="color: #B4B7BD;">Tüm planlar, 20'den fazla gelişmiş araç ve özellik içerir. İhtiyaçlarınıza uygun en iyi planı seçin.</h7>
        <br>
        <br>
        <br>
        <div class="block block-rounded">
            <div class="table-responsive">
                <table class="table table-borderless table-hover table-vcenter text-center mb-0">
                    <thead class="table-dark text-uppercase fs-sm" style="border: 0.5px solid #30363d;">
                        <tr>
                            <th style="background-color: #010409 !important;" class="py-3" style="width: 180px;"></th>
                            <th style="background-color: #010409 !important;font-family: Poppins;font-weight: bold;" class="text-muted py-3">Haftalık Üyelik</th>
                            <th style="background-color: #010409 !important;font-family: Poppins;font-weight: bold;" class="text-muted py-3">Aylık Üyelik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-body-light">
                            <td></td>
                            <td class="py-4">
                                <div class="h1 fw-bold mb-2">150 ₺</div>
                                <div class="h6 text-muted mb-0">haftalık</div>
                            </td>
                            <td class="py-4">
                                <div class="h1 fw-bold mb-2">350 ₺</div>
                                <div class="h6 text-muted mb-0">aylık</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Ad Soyad Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">TC Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Anne Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Baba Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Ehliyet Vesika Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">İninal Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Seri No Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Plaka Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Aile Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Akraba Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Soyağacı Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Anne Tarafı Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Baba Tarafı Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">E-Okul Vesika Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Okul Numarası Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">GSM'den TC Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">TC'den GSM Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">GSM'den İsim Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">GSM'den Fatura Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Adres Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Bina Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Sokak Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Daire Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Mahalle Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Facebook Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">TTNET Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Mernis 2015 Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">IP Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">IBAN Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Godness Sorgu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">İhbar Formu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">CC Checker</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">BIN Checker</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">SMS Bomber</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-start">Kimlik Oluşturucu</td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                            <td><i class="fa fa-check fa-fw text-success"></i></td>
                        </tr>
                    </tbody>
                </table>
				<div style="padding: 10px;"></div>
            </div>
        </div>
</center>
<?php

include('inc/footer_main.php');
?>