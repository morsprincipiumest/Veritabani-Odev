<?php
// MySQL veritabanı bağlantısı ve sorgusu
$host = "localhost";
$dbname = "vtys";
$username = "root";
$password = "";

try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $categoryID = $_GET['categoryID'] ?? '';

  if ($categoryID) {
    $sql = "SELECT u.urunResim, u.urunAdi, u.urunFiyat, k.kategoriAdi, u.urunOzellikleri, u.eklenmeTarihi
          FROM urunler u
          INNER JOIN kategoriler k ON u.urunKategoriID = k.urunKategoriID
          WHERE u.urunKategoriID = :categoryID";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':categoryID', $categoryID);
  } else {
    $sql = "SELECT u.urunResim, u.urunAdi, u.urunFiyat, k.kategoriAdi, u.urunOzellikleri, u.eklenmeTarihi
          FROM urunler u
          INNER JOIN kategoriler k ON u.urunKategoriID = k.urunKategoriID";
    $stmt = $db->prepare($sql);
  }

  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Placeholder resim yolu
  $placeholderImage = "placeholder.png";

  // Ürünlerin listesini oluşturma
  $products = array();
  foreach ($result as $row) {
    $product = array(
      "urunResim" => $row['urunResim'] ?? $placeholderImage,
      "urunAdi" => $row['urunAdi'],
      "urunFiyat" => $row['urunFiyat'],
      "kategoriAdi" => $row['kategoriAdi'],
      "urunOzellikleri" => $row['urunOzellikleri'],
      "eklenmeTarihi" => $row['eklenmeTarihi']
    );

    $products[] = $product;
  }

  function sortProducts($products, $sortBy) {
    switch ($sortBy) {
      case "name":
        usort($products, function ($a, $b) {
          return strnatcasecmp($a['urunAdi'], $b['urunAdi']);
        });
        break;
      case "price":
        usort($products, function ($a, $b) {
          return $a['urunFiyat'] - $b['urunFiyat'];
        });
        break;
      case "date":
        usort($products, function ($a, $b) {
          return strtotime($b['eklenmeTarihi']) - strtotime($a['eklenmeTarihi']);
        });
        break;
      default:
        break;
    }

    return $products;
  }

  // Sıralama parametresini al
  $sortBy = $_GET['sortBy'] ?? '';

  // Ürünleri sırala
  if ($sortBy) {
    $products = sortProducts($products, $sortBy);
  }

  $response = array(
    "status" => "success",
    "data" => $products
  );
  echo json_encode($response);
} catch (PDOException $e) {
  $response = array(
    "status" => "error",
    "message" => $e->getMessage()
  );
  echo json_encode($response);
}
