<?php
// Veritabanı bağlantısı
$host = "localhost";
$dbname = "vtys";
$username = "root";
$password = "";

try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Formdan gelen verileri al
  $urunAdi = $_POST['urunAdi'];
  $urunFiyat = $_POST['urunFiyat'];
  $urunKategoriID = $_POST['urunKategoriID'];
  $urunResim = $_FILES['urunResim']['name'] ?? null;
  $urunOzellikleri = $_POST['urunOzellikleri'];

  // Ürün ekleme sorgusu
  $sql = "INSERT INTO urunler (urunAdi, urunFiyat, urunKategoriID, urunResim, urunOzellikleri)
          VALUES (:urunAdi, :urunFiyat, :urunKategoriID, :urunResim, :urunOzellikleri)";

  $stmt = $db->prepare($sql);
  $stmt->bindParam(':urunAdi', $urunAdi);
  $stmt->bindParam(':urunFiyat', $urunFiyat);
  $stmt->bindParam(':urunKategoriID', $urunKategoriID);
  $stmt->bindParam(':urunResim', $urunResim);
  $stmt->bindParam(':urunOzellikleri', $urunOzellikleri);
  $stmt->execute();

  $response = array(
    "status" => "success"
  );
  echo json_encode($response);
} catch (PDOException $e) {
  $response = array(
    "status" => "error",
    "message" => $e->getMessage()
  );
  echo json_encode($response);
}
