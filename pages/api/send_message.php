<?php

error_reporting(0);

session_start();

include "../../server/database.php";

include "../../server/rolecontrol.php";

if (isset($_POST)) {

  $message = htmlspecialchars(strip_tags($_POST['message']));

  if ($message != "" && strlen($message) < 75) {

    $messagessid = $_SESSION['GET_USER_SSID'];

    $messagequery = $db->query("SELECT * FROM `users` WHERE k_key = '$messagessid'");

    while ($messagedata = $messagequery->fetch()) {
      $getusername = $messagedata['k_adi'];
      $getpremium = $messagedata['k_premium'];
      $getadmin = $messagedata['k_adi'];
      $getimage = $messagedata['k_image'];
    }

    function Image($getimage)
    {
      if ($getimage != "") {
        $Output = $getimage;
      } else {
        $Output = "assets/img/fwxmvmc.jpeg";
      }
      return $Output;
    }

    $username = $getusername; // kullanıcı adı

    $time = date('Y-m-d H:i:s'); // gönderim zamanı

    // Küfür kelime listesi
    $badwords = array("sg", "oç", "oçe", "anan", "sokuk", "kaltak", "ananı", "ananı sikim", "anneni sikim", "anneni sikeyim", "ananı sikeyim", "annen", "ağzına", "ağzına sıçim", "ağzına sıçayım", "ağzına s", "am", "ambiti", "amını", "amını s", "amcık", "amcik", "amcığını", "amciğini", "amcığını", "amcığını s", "amck", "amckskm", "amcuk", "amına", "amına k", "amınakoyim", "amına s", "amunu", "amını", "amın oğlu", "amın o", "amınoğlu", "amk", "aq", "amnskm", "anaskm", "ananskm", "amkafa", "amk çocuğu", "amk oç", "piç", "amk ç", "amlar", "amcıklar", "amq", "amındaki", "amnskm", "ananı", "anan", "ananın am", "ananızın", "aneni", "aneni s", "annen", "anen", "ananın dölü", "sperm", "döl", "anasının am", "anası orospu", "orospu", "orosp,", "kahpe", "kahbe", "kahße", "ayklarmalrmsikerim", "ananı avradını", "avrat", "avradını", "avradını s", "babanı", "babanı s", "babanın amk", "annenin amk", "ananın amk", "bacı", "bacını s", "babası pezevenk", "pezevenk", "pezeveng", "kaşar", "a.q", "a.q.", "bitch", "çük", "yarrak", "am", "cibiliyetini", "bokbok", "bombok", "dallama", "göt", "götünü s", "ebenin", "ebeni", "ecdadını", "gavat", "gavad", "ebeni", "ebe", "fahişe", "sürtük", "fuck", "gotten", "götten", "göt", "gtveren", "gttn", "gtnde", "gtn", "hassiktir", "hasiktir", "hsktr", "haysiyetsiz", "ibne", "ibine", "ipne", "kaltık", "kancık", "kevaşe", "kevase", "kodumun", "orosbu", "fucker", "penis", "pic", "porno", "sex", "sikiş", "s1kerim", "s1k", "puşt", "sakso", "sik", "skcm", "siktir", "sktr", "skecem", "skeym", "slaleni", "sokam", "sokuş", "sokarım", "sokarm", "sokaym", "şerefsiz", "şrfsz", "sürtük", "taşak", "taşşak", "tasak", "tipini s", "yarram", "yararmorospunun", "yarramın başı", "yarramınbaşı", "yarraminbasi", "yrrk", "zikeyim", "zikik", "zkym");

    // Metin string
    $message_sw = $message;

    // Küfürleri kontrol etmek için bir döngü kullanın
    foreach ($badwords as $badword) {
      // Eğer küfür kelimesi metin içinde geçiyorsa
      if (stripos($message_sw, $badword) !== false) {
        exit('swear');
        die();
      }
    }

    session_start();
    $limit = 60; // saniye cinsinden limit (1 dakika)
    $max_messages = 7; // 1 dakikada en fazla gönderilebilecek mesaj sayısı
    if (isset($_SESSION['message_count']) && isset($_SESSION['last_message_time']) && time() - $_SESSION['last_message_time'] < $limit) {
      // hız limiti aşıldı
      if ($_SESSION['message_count'] >= $max_messages) {
        exit('limit');
        die();
      } else {
        $_SESSION['message_count']++;
      }
    } else {
      $_SESSION['message_count'] = 1;
      $_SESSION['last_message_time'] = time();
    }

    if (is_numeric($message)) {
      exit("numeric");
      die();
    }

    if (preg_match('/http(s)?:\/\/[^\s]+/', $_POST['message'])) {
      exit("special");
      die();
    }


    $sql = "INSERT INTO messages (username, message, time, image) VALUES (:username, :message, :time, :image)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':image', Image($getimage));
    $stmt->execute();
    $_SESSION['last_message_time'] = time();
    session_write_close();
  }
}
