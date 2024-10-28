<?php
session_start();

if (!isset($_SESSION['products'])) {
  $_SESSION['products'] = [];
}

if (isset($_POST['add_to_cart'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];

  if (!empty($id) && !empty($name) && !empty($price)) {
    $_SESSION['products'][] = [
      'id' => $id,
      'name' => $name,
      'price' => $price
    ];
  } else {
    echo 'Ошибка добавления товара в корзину';
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Товары</title>
  <script src="js/storage.js"></script>
  <link rel="stylesheet" href="css/storage.css">
</head>
<body>
<nav class="search">
  <input type="text" id="search-input" placeholder="Найти товар...">
  <button id="search-button">Найти</button>
</nav>

<div class="sidebar">
  <h2>Добавить фильтр</h2>
  <ul>
  <a href="bucket.php">Перейти в корзину</a>
    <li><a href="#">Пункт 2</a></li>
    <li><a href="#">Пункт 3</a></li>
  </ul>
</div>
<div class="product cards">
<div class="product-card">
  <img src="img/1.jpg" alt="Изображение товара" class="product-image">
  <h2 class="product-title">Игровой монитор LOC</h2>
  <p class="product-description">Игровой монитор LOC с частотой обновления 75 Гц</p>
  <p class="product-price">Цена: 15000 руб.</p>
  <form action="" method="post">
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="name" value="Игровой монитор LOC">
    <input type="hidden" name="price" value="15000">
    <button class="product-button" id="add-to-cart-1" name="add_to_cart">Добавить в корзину</button>
  </form>
</div>
</form>
</div>
</div>


</body>
</html>