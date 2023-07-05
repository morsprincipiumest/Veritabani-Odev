<?php
// MySQL veritabanı bağlantısı ve sorgusu
$host = "localhost";
$dbname = "vtys";
$username = "root";
$password = "";
try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT * FROM kategoriler";
  $stmt = $db->prepare($sql);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // "Hepsi" seçeneğini kategoriler listesine ekleme
  $categories = array();
  $allCategory = array(
    "urunKategoriID" => "",
    "kategoriAdi" => "Hepsi"
  );
  $categories[] = $allCategory;
  foreach ($result as $row) {
    $category = array(
      "urunKategoriID" => $row['urunKategoriID'],
      "kategoriAdi" => $row['kategoriAdi']
    );

    $categories[] = $category;
  }

  $response = array(
    "status" => "success",
    "data" => $categories
  );
  echo json_encode($response);
} catch (PDOException $e) {
  $response = array(
    "status" => "error",
    "message" => $e->getMessage()
  );
  echo json_encode($response);
}
