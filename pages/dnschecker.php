<?php

include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'DNS Checker';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

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

    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .container {
        display: block;
        position: relative;
        cursor: pointer;
        font-size: 20px;
        user-select: none;
    }

    .checkmark {
        position: relative;
        top: 0;
        left: 0;
        height: 1.3em;
        width: 1.3em;
        background-color: #ccc;
        transition: all 0.3s;
        border-radius: 5px;
    }

    .container input:checked~.checkmark {
        background-color: #47da99;
        animation: pop 0.5s;
        animation-direction: alternate;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .container input:checked~.checkmark:after {
        display: block;
    }

    .container .checkmark:after {
        left: 0.45em;
        top: 0.25em;
        width: 0.25em;
        height: 0.5em;
        border: solid white;
        border-width: 0 0.15em 0.15em 0;
        transform: rotate(45deg);
    }

    @keyframes pop {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(0.9);
        }

        100% {
            transform: scale(1);
        }
    }

    input [type=radio] {
        background-color: #556ee6;
    }

    iframe {
        border: none;
        width: 100%;
        height: 84px;
    }

    iframe#autocomplete-host {
        display: none;
    }

    .no-transition {
        -webkit-transition: none;
        -o-transition: none;
        transition: none;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"> DNS Checker</h4>
                    <p class="mb-1">
                    </p>
                    </p>
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-body" style="font-weight: normal;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            DNS Checker işlemini bu sayfada gerçekleştirebilirsiniz.
                        </div>
                    </div>
                    <div class="block-content tab-content">
                        <form method="POST" action="dnschecker">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="example.com" id="domain" name="domain">
                                </div>
                            </div>
                            <br>
                            <center class="nw">
                                <button onclick="checkNumber()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula </button>
                                <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                                <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="font-weight: 400;font-family: Poppins;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                                <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır</button><br><br>
                            </center>
                        </form>
                        <br>
                        <div class="table-responsive">
                            <table id="01000001" class="table table-hover" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Domain</th>
                                        <th scope="col">IP</th>
                                        <th scope="col">NS</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                        $domain = htmlspecialchars(strip_tags($_POST['domain']));

                                        if ($domain != "") {

                                            $ip = gethostbyname($domain);

                                            $ns = dns_get_record($domain, DNS_NS);

                                            foreach ($ns as $record) {
                                                $nameserver = $record['target'];
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $domain; ?></td>
                                            <td><?= $ip; ?></td>
                                            <td><?php if ($nameserver == "") {
                                                    echo "-";
                                                } else {
                                                    echo $nameserver;
                                                } ?></td>
                                        </tr>

                                    <?php
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php
include('inc/footer_main.php');
?>