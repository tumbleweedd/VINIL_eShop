<?php
// читать json файл
$json = file_get_contents('../goods.json');
$json = json_decode($json, true);

//письмо
$message = '';
$message .= '<h1>Заказ в магазине</h1>';
$message .= '<p>Телефон: ' . $_POST['ephone'] . '</p>';
$message .= '<p>Почта: ' . $_POST['email'] . '</p>';
$message .= '<p>Клиент: ' . $_POST['ename'] . '</p>';

// Берём корзину
$cart = $_POST['cart'];
$sum = 0;
// Добавляем больше информации о товаре в переменную message
foreach ($cart as $id => $count) {
    $message .= $json[$id]['name'] . ' --- ';
    $message .= $count . ' --- ';
    $message .= $count * $json[$id]['price'];
    $message .= '<br>';
    $sum = $sum + $count * $json[$id]['price'];
}
$message .= 'Всего: ' . $sum;

print_r($message);

// Поля для формирования корректного отображения письма
$to = 'molodkin.98@mail.ru'.',';
$to .= $_POST['email'];
$spectext = '<!DOCTYPE HTML><html><head><title>Заказ</title></head><body>';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$m = mail($to, 'Заказ в магазине', $spectext . $message . '</body></html>', $headers);
//$m = mail($to, 'Зака в магазине', $message, implode("\r\n", $headers));

if ($m) {
    echo 1;
} else {
    echo 0;
}

