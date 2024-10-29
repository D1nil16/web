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
    image TEXT
)');

echo ini_get('upload_max_filesize');
if ($_FILES['image']['size'] > 3 * 1_024 * 1_024) {
    echo 'Файл слишком большой';
}

if (move_uploaded_file($_FILES['image']['tmp_name'], '../img/' . $_FILES['image']['name'])) {
    echo 'Файл загружен';
} else {
    echo 'Файл не загружен';
}

class addProduct
{
    const IMAGE_DIR = 'img';

    private array $current_file;

    public function __construct(array $arr)
    {
        if(!file_exists(self::IMAGE_DIR)) {
            mkdir(self::IMAGE_DIR, 0777);
        }

        $this->current_file = $arr;
    }
}


$stmt = $db->prepare('INSERT INTO products (title, description, price, image) VALUES (:title, :description, :price, :img)');

$stmt->bindValue(':title', $title);
$stmt->bindValue(':description', $description);
$stmt->bindValue(':price', $price);
$img_path = 'img/' . $_FILES['image']['name'];
$stmt->bindValue(':img', $img_path);

if ($stmt->execute()) {
    echo 'Товар добавлен';
}else {
    echo 'Товар не добавлен';
}
$db->close();


?>
