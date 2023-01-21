<?php
session_start();

// если переменная user не существует, делаем переадесацию

if (!$_SESSION['user']) {
    header('Location: /auth.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><!DOCTYPE html>
        <head>
        <title>Пример dropdown</title>
    <link rel="stylesheet" href="css/style123.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/head.php';
?>
-
<a href="vendor/logout.php" class="logout">Выход</a>
<br>


<div class="sl-container">
    <div class="swipe">
        <div class="panel" data-img="images/2.webp"></div>
        <div class="panel" data-img="images/3.webp"></div>
        <div class="panel" data-img="images/5.webp"></div>
    </div>
    <div class="sl-info">
        <div class="inner">
            <h3>Магазин виниловых пластинок</h3>
            <p>Большой асортимент</p>
        </div>
        <div class="sl-buttons">
            <button class="btn-prev" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                     stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button class="btn-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                     stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>
</div>


<div id="mini-cart">

</div>
<a href="view/later.html" id="f">Желания</a>
<?php
session_start();

// если переменная user не существует, делаем переадесацию

if ($_SESSION['user']['login'] === 'admin') {
    echo '<a href="admin/admin.php">Админка</a>';

}

?>
<div id="goods">

</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/eshop.js"></script>

<script src="js/jq.js"></script>
<script src="js/main.js"></script>
<!--<script src="admin/js/admin.js"></script>-->

</body>
</html>