-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Haz 2023, 13:55:05
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `agahyoutube`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `username` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `premium` varchar(255) DEFAULT NULL,
  `admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`username`, `message`, `time`, `id`, `image`, `premium`, `admin`) VALUES
('Agah', ': Merhaba Youtube', '2023-06-03 23:01:09', 214, 'https://i.hizliresim.com/jehjlgr.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `d_icerik` varchar(255) NOT NULL,
  `d_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `news`
--

INSERT INTO `news` (`id`, `d_icerik`, `d_time`) VALUES
(2265, 'DİSCORD.GG/QUATROXCHECK', '03.06.23 21:42');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `k_ip` varchar(32) NOT NULL DEFAULT '0',
  `k_browser` varchar(32) NOT NULL,
  `k_os` varchar(32) NOT NULL,
  `k_time` varchar(32) NOT NULL,
  `k_key` varchar(255) NOT NULL,
  `k_adi` varchar(255) NOT NULL,
  `k_lastlogin` varchar(255) NOT NULL,
  `k_ekleyen` varchar(255) NOT NULL,
  `k_updatesync` varchar(255) NOT NULL,
  `k_cookie` varchar(255) DEFAULT NULL,
  `k_rol` varchar(255) NOT NULL,
  `k_premium` varchar(255) NOT NULL,
  `k_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `k_ip`, `k_browser`, `k_os`, `k_time`, `k_key`, `k_adi`, `k_lastlogin`, `k_ekleyen`, `k_updatesync`, `k_cookie`, `k_rol`, `k_premium`, `k_image`) VALUES
(146, '0', '', '', '2024-06-04', 'd85a1ad5024dea9065566bf092a7f69328e78985b1c4e0d6e7', 'DENEM', '', 'Agah', '', NULL, '0', '', NULL),
(147, '0', '', '', '2024-06-04', 'agahadmin', 'Agah', '', 'Agah', '04.06.23 10:01', NULL, '1', '', 'https://i.hizliresim.com/jehjlgr.jpg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- Tablo için AUTO_INCREMENT değeri `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2266;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
