-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Tem 2023, 14:20:41
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
-- Veritabanı: `vtys`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `urunKategoriID` int(11) NOT NULL,
  `kategoriAdi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`urunKategoriID`, `kategoriAdi`) VALUES
(1, 'Elektronik'),
(3, 'Oyun'),
(4, 'Süpermarket'),
(6, 'Giyim'),
(9, 'Cep Telefonu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `urunID` int(11) NOT NULL,
  `urunResim` varchar(255) DEFAULT NULL,
  `urunAdi` varchar(255) DEFAULT NULL,
  `urunFiyat` decimal(10,2) DEFAULT NULL,
  `urunKategoriID` int(11) DEFAULT NULL,
  `urunOzellikleri` varchar(255) DEFAULT NULL,
  `eklenmeTarihi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urunID`, `urunResim`, `urunAdi`, `urunFiyat`, `urunKategoriID`, `urunOzellikleri`, `eklenmeTarihi`) VALUES
(20, NULL, 'Samsung Galaxy S21', 4999.00, 9, 'Ekran Boyutu: 6.2 inç, Bellek: 8 GB RAM, Depolama: 128 GB, Kamera: 64 MP', '2023-07-04 22:57:28'),
(21, NULL, 'Apple iPhone 12', 6999.00, 9, 'Ekran Boyutu: 6.1 inç, Bellek: 4 GB RAM, Depolama: 64 GB, Kamera: 12 MP', '2023-07-04 22:57:28'),
(22, NULL, 'Sony PlayStation 5', 5499.00, 3, 'Konsol Türü: Oyun Konsolu, Depolama: 825 GB SSD, Çözünürlük: 4K UHD', '2023-07-04 22:57:28'),
(23, NULL, 'Samsung QLED TV', 6999.00, 1, 'Ekran Boyutu: 55 inç, Ekran Teknolojisi: QLED, Çözünürlük: 4K UHD', '2023-07-04 22:57:28'),
(24, NULL, 'Nike Air Max Spor Ayakkabı', 499.00, 6, 'Renk: Siyah/Beyaz, Numara: 42, Malzeme: Sentetik', '2023-07-04 22:57:28'),
(25, NULL, 'Coca-Cola Kutu İçecek', 2.50, 4, 'İçerik: Gazlı İçecek, Hacim: 330 ml', '2023-07-04 22:57:28'),
(26, NULL, 'Samsung SSD', 499.00, 1, 'Kapasite: 500 GB, Arabirim: SATA, Okuma Hızı: 550 MB/s, Yazma Hızı: 520 MB/s', '2023-07-04 22:57:28'),
(27, NULL, 'Dell Inspiron Dizüstü Bilgisayar', 3999.00, 1, 'Ekran Boyutu: 15.6 inç, İşlemci: Intel Core i5, Bellek: 8 GB RAM, Depolama: 512 GB SSD', '2023-07-04 22:57:28'),
(28, NULL, 'Canon EOS 80D Fotoğraf Makinesi', 4999.00, 1, 'Çözünürlük: 24.2 MP, Ekran Boyutu: 3.0 inç, Optik Zoom: 5x', '2023-07-04 22:57:28'),
(29, NULL, 'Adidas Essentials Sweatshirt', 199.00, 6, 'Renk: Gri, Beden: M, Malzeme: Pamuk', '2023-07-04 22:57:28'),
(30, NULL, 'Tide Deterjan', 25.00, 4, 'Hacim: 2 kg, Kullanım: Çamaşır Yıkama', '2023-07-04 22:57:28'),
(31, NULL, 'Logitech Kablosuz Klavye ve Mouse Seti', 199.00, 1, 'Bağlantı: 2.4 GHz Kablosuz, Uyumlu: Windows ve Mac', '2023-07-04 22:57:28'),
(32, NULL, 'FIFA 22 Oyunu', 299.00, 3, 'Platform: PlayStation 5, Tür: Spor, Çıkış Tarihi: Ekim 2022', '2023-07-04 22:57:28'),
(33, NULL, 'Samsung Galaxy Buds Kablosuz Kulaklık', 799.00, 9, 'Bağlantı: Bluetooth', '2023-07-04 22:57:28'),
(49, 'boseqc35ii.jpg', '213', 2323.00, 4, '', '2023-07-05 10:52:14'),
(50, NULL, 'Deneme Ürün', 1515.00, 6, '5535', '2023-07-05 11:17:15');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`urunKategoriID`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urunID`),
  ADD KEY `urunler` (`urunKategoriID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `urunKategoriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `urunID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `urunler` FOREIGN KEY (`urunKategoriID`) REFERENCES `kategoriler` (`urunKategoriID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
