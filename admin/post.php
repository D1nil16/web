<?php
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$price = intval($_POST['price'] ?? 0);
$img = $_FILES['image'] ?? null;

$db = new SQLite3('../db/database.db');

$db->exec('CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    description TEXT,
    price INTEGER,
    image BLOB
)
');

if (!empty($title) && !empty($description) && !empty($price) && $img && isset($img['tmp_name']) && !empty($img['tmp_name'])) {
    
    if ($img['error'] === UPLOAD_ERR_OK) {
        $stmt = $db->prepare('INSERT INTO products (title, description, price, image) VALUES (:title, :description, :price, :image)');
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':image', file_get_contents($img['tmp_name']));
        
        if ($stmt->execute()) {
            echo 'Товар успешно добавлен в базу данных';
        } else {
            echo 'Ошибка выполнения запроса: ';
        }
    } else {
        echo 'Ошибка загрузки файла: ' . $img['error'];
    }
} else {
    echo 'Ошибка добавления товара в базу данных. Проверьте все поля.';
}

$db->close();
?>
