<?php
session_start();


if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Создание массива для хранения товаров с количеством
$products_with_quantity = [
    1 => [
        'id' => 1,
        'name' => 'Игровой монитор LOC',
        'price' => 15000,
        'quantity' => 0,
    ],
    2 => [
        'id' => 2,
        'name' => 'Клавиатура',
        'price' => 5000,
        'quantity' => 0,
    ],
];

// Перебор товаров в корзине
foreach ($_SESSION['products'] as $product) {
    if (isset($products_with_quantity[$product['id']])) {
        $products_with_quantity[$product['id']]['quantity']++;
    } else {
        $products_with_quantity[$product['id']] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
        ];
    }
}

// Вывод товаров с количеством
echo '<link rel="stylesheet" href="css/bucket.css">';
echo '<h1>Товары</h1>';
foreach ($products_with_quantity as $product) {
    if ($product['quantity'] > 0) {
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
}

// Удаление товаров из корзины
if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['remove_from_cart'];
    foreach ($_SESSION['products'] as $key => $product) {
        if ($product['id'] == $product_id) {
            unset($_SESSION['products'][$key]);
            break;
        }
    }
}

// Проверка
if (count($_SESSION['products']) == 1) {
    echo '<p>В корзине 1 товар</p>';
} else {
    echo '<p>В корзине ' . count($_SESSION['products']) . ' товаров</p>';
}
?>
<a href="storage.php">Вернуться назад</a>
