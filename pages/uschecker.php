<?php
include_once "../server/rolecontrol.php";

$customCSS = array();
$customJAVA = array();

function rig_geoulke($ip)
{
    $details = json_decode(file_get_contents("https://extreme-ip-lookup.com/json/{$ip}"));
    return $details->country;
}

$page_title = 'CC Checker';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<style>
.alert-success{
	background-color: rgba(52,195,143,.8)!important;
	color: #fff;
	border: 2px solid #34c38f!important;
}

.alert-danger{
	background-color: hsla(0,86%,69%,.8);
	color: #fff;
	border: 2px solid #f46a6a;
}
</style>
<div class="card-body">
    <div class="md-form">
        <div class="col-md-12">
            <center>
                <div class="md-form">
                    <h4 class="card-title mb-4"><i class="fas fa-credit-card"></i> CC Checker</h4>
                    <textarea type="text" id="lista" name="lista" style="text-align: center; background-color: transparent;color:black ;" placeholder="Datayı bu alana giriniz
Örnek: 4444555566667777|01|21|001" class="md-textarea form-control" rows="5"></textarea>
                    <div class="mb-3 mt-3"><label class="form-label"></label>
                        <button id="testar" onclick="enviar()" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-play"></i> Başlat</button>
                        <button id="stoper" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-stop"></i> Durdur</button>
                        <button id="temizleButon" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"> Temizle</button>
                    </div>
                </div>
            </center>
        </div>

        <div class="card-body">
            <div class="alert alert-success" role="alert">Aktif Kartlar <span id="cCharge2"></span></h6>
            </div>
            <div class="alert alert-danger" role="alert">Kapalı Kartlar <span id="cDie2"></span></h6>
            </div>
        </div>
    </div>
</div>

<script>
    function enviar() {
        var linha = $("#lista").val();
        var linhaenviar = linha.split("\n");
        var total = linhaenviar.length;
        var ap = 0;
        var rp = 0;
        var rCredits;
        linhaenviar.forEach(function(value, index) {
            setTimeout(
                function() {
                    Array.prototype.randomElement = function() {
                        return this[Math.floor(Math.random() * this.length)]
                    }
                    $.ajax({
                        url: 'pages/api/api.php?lista=' + value,
                        async: true,
                        success: function(resultado) {
                            if (resultado.match("#Aktif")) {
                                removelinha();
                                ap++;
                                aprovadas(resultado + "");
                            } else {
                                removelinha();
                                rp++;
                                reprovadas(resultado + "");
                            }

                            $('#carregadas').html(total);

                            var fila = parseInt(ap) + parseInt(rp);
                            $('#cCharge2').html(ap);
                            $('#cDie2').html(rp);
                            $('#total').html(fila);
                            $('#cCharge2').html(ap);
                            $('#cDie2').html(rp);
                        }
                    });
                }, 100 * index);
        });
    }

    function aprovadas(str) {
        $(".aprovadas").append(str);
    }

    function reprovadas(str) {
        $(".reprovadas").append(str);
    }

    function removelinha() {
        var lines = $("#lista").val().split('\n');
        lines.splice(0, 1);
        $("#lista").val(lines.join("\n"));
    }
</script>
<?php

include('inc/footer_main.php');
?>