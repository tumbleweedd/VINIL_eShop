<?php

session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$conn = connect();

//$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
//$check_admin = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = 'admin'");
$check_user = $conn->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
$check_admin = $conn->query("SELECT * FROM `users` WHERE `login` = 'admin'");


// Если пользователи есть
if ($check_user->columnCount() > 0) {

    // Берём пользователя
    $user = $check_user->fetch(PDO::FETCH_ASSOC);

    // создание сессии для пользователя
    $_SESSION['user'] = [
        "id" => $user['id'],
        "full_name" => $user['full_name'],
        "login" => $user['login'],
        "avatar" => $user['avatar'],
        "email" => $user['email']
    ];

    header('Location: ../profile.php');

} else {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location: ../auth.php');
}
?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>
