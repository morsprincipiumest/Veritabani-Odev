<!DOCTYPE html>
<html>
<head>
  <title>Ürün Listesi</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Kategorileri yükleme
    function loadCategories() {
      $.ajax({
        url: "get_categories.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            var categories = response.data;
            var categoryList = $("#category-list");

            categoryList.empty();

            // Kategorileri listeye ekleme
            $.each(categories, function (index, category) {
              var listItem = $("<li>")
                .addClass("menu-item")
                .text(category.kategoriAdi)
                .data("category-id", category.urunKategoriID);

              categoryList.append(listItem);
            });

            // Kategoriye tıklama işlemi
            categoryList.on("click", "li", function () {
              var categoryId = $(this).data("category-id");
              loadProducts(categoryId);
            });

            // Tüm kategorileri yükleme
            loadProducts("");
          }
        },
        error: function (xhr, status, error) {
          console.log("Error:", error);
        }
      });
    }

    // Ürünleri yükleme
    function loadProducts(categoryId) {
  var sortBy = $("#sort-by").val();
  var activeCategoryId = $("#category-list .active").data("category-id");

  // Eğer bir kategori seçiliyse ve categoryId değeri boşsa, activeCategoryId'i kullan
  if (categoryId === "" && activeCategoryId !== undefined) {
    categoryId = activeCategoryId;
  }

  $.ajax({
    url: "get_products.php",
    type: "GET",
    dataType: "json",
    data: {
      categoryID: categoryId,
      sortBy: sortBy
    },
    success: function (response) {
      if (response.status === "success") {
        var products = response.data;
        var productContainer = $("#product-container");

        productContainer.empty();

        // Ürünleri listeye ekleme
        $.each(products, function (index, product) {
          var card = $("<div>").addClass("product-card");
          var image = $("<img>").attr("src", "images/"+product.urunResim);
          var title = $("<h3>").text(product.urunAdi);
          var price = $("<p>").addClass("price").text("Fiyat: " + product.urunFiyat);
          var category = $("<p>").addClass("category").text("Kategori: " + product.kategoriAdi);
          var features = $("<p>").addClass("features").text("Özellikler: " + product.urunOzellikleri);
          var date = $("<p>").addClass("date").text("Eklenme Tarihi: " + product.eklenmeTarihi);

          card.append(image, title, price, category, features, date);
          productContainer.append(card);
        });
      }
    },
    error: function (xhr, status, error) {
      console.log("Error:", error);
    }
  });
}

    // Sayfa yüklendiğinde çalışacak kodlar
    $(document).ready(function () {
      loadCategories();
    });
  </script>
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <h2>Kategoriler</h2>
      <ul id="category-list">
        <!-- Kategoriler burada oluşturulacak -->
      </ul>
    </div>
    <div class="product-grid">
      <h1 class="title">Ürün Listesi</h1>
      <div>
        <label for="sort-by">Sırala:</label>
        <select id="sort-by" onchange="loadProducts($('#category-list .active').data('category-id'))">
        <option value="">Varsayılan</option>
        <option value="name">İsme Göre</option>
        <option value="price">Fiyata Göre</option>
        <option value="date">Eklenme Tarihine Göre</option>
    </select>
      </div>
      <div id="product-container">
        <!-- Ürünler burada listelenecek -->
      </div>
    </div>
  </div>



  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      // Ürün ekleme formunu yakala
      var form = $("#product-form");

      // Form gönderildiğinde çalışacak fonksiyon
      form.submit(function (event) {
        event.preventDefault();

        // Form verilerini al
        var formData = new FormData(form[0]);

        // Ürün ekleme isteği
        $.ajax({
          url: "add_product.php",
          type: "POST",
          data: formData,
          dataType: "json",
          processData: false,
          contentType: false,
          success: function (response) {
            if (response.status === "success") {
              // Başarılı mesajı göster
              alert("Ürün başarıyla eklendi.");

              // Formu sıfırla
              form[0].reset();
            } else {
              // Hata mesajı göster
              alert("Ürün eklenirken bir hata oluştu.");
            }
          },
          error: function (xhr, status, error) {
            console.log("Error:", error);
          }
        });
      });
    });
  </script>





<script>
  // Kategorileri yükleme
  function addProductCategories() {
    $.ajax({
      url: "get_categories.php",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          var categories = response.data;
          var categorySelect = $("#product-category");

          // Option listesini oluşturma
          $.each(categories, function (index, category) {
            var option = $("<option>")
              .val(category.urunKategoriID)
              .text(category.kategoriAdi);

            categorySelect.append(option);
          });
        }
      },
      error: function (xhr, status, error) {
        console.log("Error:", error);
      }
    });
  }

  // Sayfa yüklendiğinde çalışacak kodlar
  $(document).ready(function () {
    addProductCategories();
  });
</script>

  <div id="container-add-product">
    <h1>Ürün Ekle</h1>
    <form id="product-form">
      <div>
        <label for="urunAdi">Ürün Adı:</label>
        <input type="text" id="urunAdi" name="urunAdi" required>
      </div>
      <div>
        <label for="urunFiyat">Ürün Fiyatı:</label>
        <input type="number" id="urunFiyat" name="urunFiyat" step="0.01" required>
      </div>
      <div>
        <label for="urunKategoriID">Kategori:</label>
        <select id="product-category" name="urunKategoriID" required>
      <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category['urunKategoriID']; ?>"><?php echo $category['kategoriAdi']; ?></option>
      <?php endforeach; ?>
    </select>
      </div>
      <div>
        <label for="urunOzellikleri">Ürün Özellikleri:</label>
        <textarea id="urunOzellikleri" name="urunOzellikleri"></textarea>
      </div>
      <button type="submit">Ürünü Ekle</button>
    </form>
  </div>


</body>
</html>


