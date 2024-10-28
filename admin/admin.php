<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
</head>
<body>
    <form action="post.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Название товара" />
        <br />
        <input type="text" name="description" placeholder="Описание товара" />
        <br />
        <input type="text" name="price" placeholder="Цена товара" />
        <br />
        <input type="file" name="image" />
        <br />
        <input type="submit" name="add_product" placeholder="Добавить" />
    </form>
</body>
</html>