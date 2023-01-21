<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_Shop";

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

// Выводиим список товаров для их изменения
function init()
{
    //вывожу список товаров в Select
    $conn = connect();
    $sql = "SELECT id, name FROM goods";
//    $result = mysqli_query($conn, $sql);
    $result = $conn->query($sql);
    // если количество строк в базе > 0
    if ($result->columnCount() > 0) {
        // создаём массив
        $out = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    $conn = null;
}

function selectOneGoods()
{
    $conn = connect();
    $id = $_POST['gid'];
    $sql = "SELECT * FROM goods WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->columnCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);
    } else {
        echo "0";
    }
    $conn = null;
}

function updateGoods()
{
    $conn = connect();
    $id = $_POST['id'];
    $name = $_POST['gname'];
    $price = $_POST['gcost'];
    $desc = $_POST['gdec'];
    $ord = $_POST['gorder'];
    $img = $_POST['gimg'];

    $sql = "UPDATE goods SET name = '$name', price = '$price', description = '$desc', ord = '$ord', image = '$img' WHERE id='$id'";

    if ($conn->query($sql)) {
        echo "1";
    } else {
        echo "Error updating record: " . $conn->errorCode();
    }

    $conn = null;
    writeJSON();
}

function newGoods()
{
    $conn = connect();
    $name = $_POST['gname'];
    $price = $_POST['gcost'];
    $desc = $_POST['gdec'];
    $ord = $_POST['gorder'];
    $img = "images/" . $_POST['gimg'];

    $sql = "INSERT INTO goods (name, price, description, ord, image)
VALUES ('$name', '$price', '$desc','$ord', '$img')";

    if ($conn->query($sql)) {
        echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->errorCode();
    }

    mysqli_close($conn);
    writeJSON();
}

function writeJSON()
{
    $conn = connect();
    $sql = "SELECT * FROM goods";
    $result = $conn->query($sql);

    if ($result->columnCount() > 0) {
        $out = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $out[$row["id"]] = $row;
        }
        $a = file_put_contents("../goods.json", json_encode($out));
        echo 'write+' . $a;
    } else {
        echo "0";
    }
    $conn = null;

}

// Загружаем товары из БД
function loadG()
{
    $conn = connect();
    $sql = "SELECT * FROM goods";
//    $result = mysqli_query($conn, $sql);
    $result = $conn->query($sql);
    if ($result->columnCount() > 0) {
        $out = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
//    mysqli_close($conn);
    $conn = null;
}

// Берём товар по id из url страницы
function loadSingleGoods()
{
    $id = $_POST['id'];
    $conn = connect();
    $sql = "SELECT * FROM goods where id='$id'";
    $result = $conn->query($sql);

    // Если товар существует
    if ($result->columnCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);
    } else {
        echo "0";
    }
    $conn = null;

}