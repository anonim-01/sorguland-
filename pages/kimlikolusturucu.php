<?php

include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'Kimlik Oluşturucu';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

?>
<style id="Config">
    .form-label {
        padding-bottom: 5px;
        padding-top: 13px;
    }

    input[type="file"] {
        background-color: #010409;
    }
</style>
<link href="assets/css/style.min.css" rel="stylesheet">
<div class="row">
    <div class="container-fluid">
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="#" method="POST" class="row" id="form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="basicInput">İsim:</label>
                                            <input type="text" class="form-control" name="name" placeholder="Kimlik üzerinde yazacak ismi girin." required />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="helpInputTop">Soyisim:</label>
                                            <input type="text" class="form-control" name="surname" placeholder="Kimlik üzerinde yazacak soyismi girin." required />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="disabledInput">Doğum Tarihi:</label>
                                            <input class="form-control" name="birth_date" type="date" required />
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basicSelect">Cinsiyet:</label>
                                        <select name="gender" style="background-color: #010409;" class="form-select" id="basicSelect">
                                            <option value="E / M" option>Erkek</option>
                                            <option value="K / F">Kadın</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="helperText">T.C. Kimlik Numarası:</label>
                                            <input type="number" name="tckn" placeholder="Kimlik üzerinde yazacak TC numarasını girin." required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1 mb-md-0">
                                        <div class="mb-1">
                                            <label class="form-label" for="disabledInput">Seri Numarası:</label>
                                            <input type="text" class="form-control" name="document_number" placeholder="Kimlik üzerinde yazacak seri numarasını girin." required />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1 mb-md-0">
                                        <div class="mb-1">
                                            <label class="form-label" for="disabledInput">Son Geçerlilik Tarihi:</label>
                                            <input class="form-control" name="valid_until" type="date" required />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1 mb-md-0">
                                        <div class="mb-1">
                                            <label class="form-label" for="disabledInput">Uyruk:</label>
                                            <input class="form-control" value="T.C./TUR" readonly />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1 mb-md-0">
                                        <div class="mb-1">
                                            <label class="form-label" for="disabledInput">Anne Adı:</label>
                                            <input type="text" class="form-control" name="mother_name" placeholder="Kimlik üzerinde yazacak anne ismini girin." required />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1 mb-md-0">
                                        <div class="mb-1">
                                            <label class="form-label" for="disabledInput">Baba Adı:</label>
                                            <input type="text" class="form-control" name="father_name" placeholder="Kimlik üzerinde yazacak baba ismini girin." required" />
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="disabledInput">Kimlik Fotoğrafı:</label>
                                        <input class="form-control" type="file" name="image" accept="image/*" required />
                                    </div>
                                    <div class="content-body mb-0">
                                        <br>
                                        <button onclick="generateID();" class="btn btn-success mt-2 form-control" style="background-color: #28C76F;border-color: #28C76F;" type="submit">Kimlik Oluştur</button>
                                    </div>
                        </form>
                        <script>
                            function generateID() {
                                $.Toast.showToast({
                                    "title": "Yükleniyor",
                                    "icon": "loading",
                                    "duration": 1000
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top: -20px;margin-left: -7px;">
        <div class="card-body mt-0">
            <div class="row">
                <div class="text-one" style="margin-top: -25px;">Yukarıdaki form aracılığı ile kimlik oluşturduğunuzda burada gözükecektir.
                </div>
                <div class="text-two d-none" style="margin-top: -25px;">Oluşturulan kimlik görselleri aşağıda gösterilmiştir. Butona tıklayarak
                    cihazınıza indirebilirsiniz.</div>
                <div class="col-lg-6 mt-3">
                    <img src="assets/img/front-empty.png" class="front-image mw-100">
                    <button class="btn btn-success shadow mt-3" id="download-front" disabled>Görseli İndir</button>
                </div>
                <div class="col-lg-6 mt-3">
                    <img src="assets/img/back-empty.png" class="back-image mw-100">
                    <button class="btn btn-success shadow mt-3" id="download-back" disabled>Görseli İndir</button>
                </div>
            </div>
        </div>

        <div class="side-container">
            <div class="front">
                <img src="#" class="face">
                <img src="#" class="face-right">
                <div class="tckn"></div>
                <div class="name"></div>
                <div class="surname"></div>
                <div class="birth_date"></div>
                <div class="gender"></div>
                <div class="document_number"></div>
                <div class="valid_until"></div>
            </div>
            <div class="back">
                <div class="mother_name"></div>
                <div class="father_name"></div>
                <div class="mrz"></div>
            </div>
        </div>
    </div>


    <script src="assets/vendors/js/vendors.min.js"></script>
    <script src="assets/js/core/menu.js"></script>
    <script src="assets/js/core/app.js"></script>
    <script src="assets/js/scripts/customizer.min.js"></script>
    <script src="assets/js/domtoimage.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script src="assets/js/scripts/forms/form-tooltip-valid.js"></script>
    <script src="assets/js/scripts/components/components-bs-toast.js"></script>

    <?php
    include('inc/footer_main.php');
    ?>