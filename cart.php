<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
    <link rel="stylesheet" href="css/style123.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body>
<div><?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/head.php';
    ?>
<!--  В этом div отображаются товары из cart.js -->
<div id="my-cart">

</div>

<div class="email-field">
    <p>Имя: <input type="text" id="ename"></p>
    <p>Email: <input type="text" id="email"></p>
    <p>Телефон: <input type="text" id="ephone"></p>
<p><button class="send-email">Заказать</button></p>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/cart.js"></script>
</body>
</html>