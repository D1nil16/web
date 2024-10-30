<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
</head>
<body>
<nav class="search">
  <a href="storage.php" class="link">Перейти в каталог</a>
  <a href="admin/admin.php" class="link">Админ панель(Временно)</a>
<form action="storage.php" method="post">
<button type="submit">Перейти к оформлению</button>
</form>
</nav>

<div class="products-container">

<?php
session_start();

if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
    echo 'Корзина пуста';
} else {
    echo '<h2>Ваша корзина:</h2>';
    echo '<link rel="stylesheet" href="css/bucket.css">';
    
    // Группируем товары по идентификатору
    $groupedProducts = [];
    foreach ($_SESSION['products'] as $product) {
        if (!isset($groupedProducts[$product['id']])) {
            $groupedProducts[$product['id']] = $product;
            $groupedProducts[$product['id']]['quantity'] = 1; // Инициализируем количество
        } else {
            $groupedProducts[$product['id']]['quantity']++; // Увеличиваем количество
        }
    }

    // Выводим сгруппированные товары
    foreach ($groupedProducts as $product) {
        echo '<div class="product-card">';
        echo '<img src="' . htmlspecialchars($product['image']) . '" alt="Изображение товара" class="product-image">';
        echo '<h2 class="product-title">' . htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') . '</h2>';
        echo '<p class="product-price">Цена: ' . htmlspecialchars($product['price']) . ' руб.</p>';
        echo '<p>Количество: ' . htmlspecialchars($product['quantity']) . '</p>'; // Показываем общее количество
        echo '<form action="" method="post" style="display:inline;">'; // Убираем лишнюю обертку
        echo '<input type="hidden" name="remove_id" value="' . htmlspecialchars($product['id']) . '">';
        echo '<button class="product-button" name="remove_from_cart">Удалить из корзины</button>';
        echo '</form>';
        echo '</div>';
    }
}

// Удаление товара из корзины
if (isset($_POST['remove_from_cart'])) {
    $remove_id = $_POST['remove_id'];
    foreach ($_SESSION['products'] as $index => $product) {
        if ($product['id'] == $remove_id) {
            unset($_SESSION['products'][$index]);
            break;
        }
    }
    header("Location: bucket.php"); 
    exit();
}
?>
</div>

</body>
</html>

