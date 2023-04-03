<?php

$servername = "localhost";
$username = "root";
$password = "root";
$db = "shopnew";

// Создать подключение
$con = mysqli_connect($servername, $username, $password, $db);

// Проверить подключение
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
