<?php
session_start();

// если переменная user не существует, делаем переадесацию

if ($_SESSION['user']['login'] != 'admin') {
    header('Location: /index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/style123.css">
<!--    <link rel="stylesheet" href="admin.css">-->

    <style>

    </style>
</head>
<body>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/head.php';
?>

<div id="okno" style="margin-left: 600px; margin-bottom: 420px">
    <div class="goods-out"></div>
    <h2>Товар</h2>
    <p>Имя: <input type="text" id="gname"></p>
    <p>Стоимость: <input type="text" id="gcost"></p>
    <p>Описание: <textarea id="gdesc"></textarea></p>
    <p>Изображение: <input type="text" id="gimg"></p>
<!--    <input type="file" name="avatar" id="gimg">-->
    <p>Порядок: <input type="text" id="gorder"></p>
    <input type="hidden" id="gid">
    <button class="add-to-db">Обновить</button>
    <a href="../index.php" class="button">Назад</a>

</div>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="js/admin.js"></script>
</body>
</html>
