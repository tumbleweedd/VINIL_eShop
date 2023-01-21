<?php
// Старт сессии для нового пользователя
session_start();
// Подключаем файл
require_once 'connect.php';
$conn = connect();

// Получение данных пользователя с формы
$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password === $password_confirm) {
    // загрузка аватара в папку ..images/
    $path = 'images/' . time() . $_FILES['avatar']['name'];
    // Ошибка при загрузке файла
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
        $_SESSION['message'] = 'Ошибка при загрузке сообщения';
        header('Location: ../register.php');
    }

    // Хеширование пароля
    $password = md5($password);


    // Вставка записей в БД
//        mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email', '$password', '$path')");
    $conn->query("INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email', '$password', '$path')");

    // Сообщение при успешной регистрации
    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header('Location: ../auth.php');


    // Ошибка регистрации
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../register.php');
}

?>
