<?php
session_start();

if (!isset($_SESSION['products'])) {
  $_SESSION['products'] = [];
}

if (isset($_POST['add_to_cart'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];

  if (!empty($id) && !empty($name) && !empty($price) && !empty($image)) {
    $_SESSION['products'][] = [
      'id' => $id,
      'name' => $name,
      'price' => $price,
      'image' => $image
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
    <li><a href="admin/admin.php">Админ панель(Временно)</a></li>
    <li><a href="#">Пункт 3</a></li>
  </ul>
</div>

<div class="products-container">
<?php
$db = new SQLite3('db/database.db');
if (!$db) {
    die('Не удалось подключиться к базе данных');
}

$stmt = $db->prepare('SELECT * FROM products');
if (!$stmt) {
    die('Ошибка подготовки запроса');
}

$result = $stmt->execute();

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
  echo '<div class="product-card">';
  echo '<img src="' . htmlspecialchars(dirname($_SERVER['SCRIPT_NAME']) . '/' . $row['image']) . '" alt="Изображение товара" class="product-image">';
  echo '<h2 class="product-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h2>';
  echo '<p class="product-description">' . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . '</p>';
  echo '<p class="product-price">Цена: ' . htmlspecialchars($row['price']) . ' руб.</p>';
  echo '<form action="" method="post">';
  echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
  echo '<input type="hidden" name="name" value="' . htmlspecialchars($row['title']) . '">';
  echo '<input type="hidden" name="price" value="' . htmlspecialchars($row['price']) . '">';
  echo '<input type="hidden" name="image" value="' . htmlspecialchars(dirname($_SERVER['SCRIPT_NAME']) . '/' . $row['image']) . '">';
  echo '<button class="product-button" id="add-to-cart-' . htmlspecialchars($row['id']) . '" name="add_to_cart">Добавить в корзину</button>';
  echo '</form>';
  echo '</div>';
}

$db->close();
?>

</div>
</body>
</html>
