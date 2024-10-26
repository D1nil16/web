<?php
session_start();

// Создайте массив для хранения товаров с количеством
$products_with_quantity = [
  1 => [
    'id' => 1,
    'name' => 'Игровой монитор LOC',
    'price' => 15000,
    'quantity' => 1,
  ],
  2 => [
    'id' => 2,
    'name' => 'Клавиатура',
    'price' => 5000,
    'quantity' => 1,
  ],
];

// Переберите товары в корзине
foreach ($_SESSION['products'] as $product) {
  // Проверьте, есть ли товар в массиве
  if (isset($products_with_quantity[$product['id']])) {
    // Если товар уже есть в массиве, увеличьте его количество
    $products_with_quantity[$product['id']]['quantity']++;
  } else {
    // Если товара нет в массиве, добавьте его с количеством 1
    $products_with_quantity[$product['id']] = [
      'name' => $product['name'],
      'price' => $product['price'],
      'quantity' => 1,
    ];
  }
}

// Выведите товары с количеством
echo '<h1>Товары</h1>';
foreach ($products_with_quantity as $product) {
  echo '<link rel="stylesheet" href="css/bucket.css">';
  echo '<form action="" method="post">';
  echo '<div class="product-card">';
  echo '<img src="img/' . $product['id'] . '.jpg" alt="Изображение товара" class="product-image">';
  echo '<h2>' . $product['name'] . '</h2>';
  echo '<p>Цена: ' . $product['price'] . ' руб.</p>';
  echo '<p>Количество: ' . $product['quantity'] . '</p>';
  echo '<button type="submit" name="remove_from_cart" value="' . $product['id'] . '" class="product-button">Убрать из корзины</button>';
  echo '</div>';
  echo '</form>';
}

// Удалите товар из корзины
if (isset($_POST['remove_from_cart'])) {
  $product_id = $_POST['remove_from_cart'];
  // Удалите товар из сессии
  foreach ($_SESSION['products'] as $key => $product) {
    if ($product['id'] == $product_id) {
      unset($_SESSION['products'][$key]);
      break;
    }
  }
  // Обновите массив $products_with_quantity
  foreach ($products_with_quantity as $key => $product) {
    if ($product['id'] == $product_id) {
      unset($products_with_quantity[$key]);
      break;
    }
  }
}

if ($_SESSION['products'] == 1) {
  echo '<p>В корзине 1 товар</p>';
} else {
  echo '<p>В корзине ' . count($_SESSION['products']) . ' товаров</p>';
}


?>
<a href="storage.php">Вернуться назад</a>