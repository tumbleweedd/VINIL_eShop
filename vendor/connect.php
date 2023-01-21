<?php
    // Подключение к БД
//    $connect = mysqli_connect('localhost', 'root', '', 'e_Shop');
//
//    if (!$connect) {
//        // Ошибка при подключении
//        die('Error connect to DataBase');
//    }

function connect()
{
//    $conn = mysqli_connect("localhost", "root", "", "e_Shop");
//    if (!$conn) {
//        die("Connection failed: " . mysqli_connect_error());
//    }
//    mysqli_set_charset($conn, "utf8");
//    return $conn;

    try {
        $db_host = 'localhost';  //  hostname
        $db_name = 'e_Shop';  //  databasename
        $db_user = 'root';  //  username
        $user_pw = '';  //  password

        $con = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $user_pw);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->exec("SET CHARACTER SET utf8");
    } catch (PDOException $err) {
        echo "harmless error message if the connection fails";
        $err->getMessage() . "<br/>";
        file_put_contents('PDOErrors.txt', $err, FILE_APPEND);
        die();
    }
    return $con;
}