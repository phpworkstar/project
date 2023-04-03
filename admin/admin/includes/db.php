<?php

$servername = "localhost";
$username = "root";
$password = "root";
$db = "shopnew";


// Создать соединение
$con = mysqli_connect($servername, $username, $password, $db);

// Проверить соединение
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
