<?php

  if (!isset($_SESSION['admin_name'])) {
    $_SESSION['msg'] = "Вы должны сначала войти";
    header('location: .././login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_name']);
    header("location: .././login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Управление сайтом. Produkti.by
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="dark-edition">
    <div class="wrapper ">
        <div class="sidebar" data-color="green" data-background-color="black" data-image="../assets/img/ground.jpg">
            <!--
Совет 1. Вы можете изменить цвет боковой панели, используя: data-color="здесь цвет который вы хотите поставить"

         Совет 2: вы также можете добавить изображение, используя тег data-image
    -->
            <div class="logo"><a href="index.php" class="simple-text logo-normal">
                    <img src="./assets/img/logo.png">
                </a></div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active  ">
                        <a class="nav-link" href="index.php">
                            <i class="material-icons">dashboard</i>
                            <p>Управление</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="add_suppliers.php">
                            <i class="material-icons">person</i>
                            <p>Добавить клиента</p>
                        </a>
                        
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="add_products.php">
                        <i class="material-icons">add</i>
                        <p>Добавить товар</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products_list.php">
                        <i class="material-icons">list</i>
                        <p>Список товаров</p>
                        </a>
                        
                    </li>
                     <li class="nav-item ">
                        <a class="nav-link" href="manageuser.php">
                            <i class="material-icons">person</i>
                            <p>Управление клиентами</p>
                        </a>
                    </li>

                   
                    <li class="nav-item ">
                        <a class="nav-link" href="profile.php">
                            <icons-image _ngcontent-aye-c22="" _nghost-aye-c19=""><i _ngcontent-aye-c19="" class="material-icons icon-image-preview">settings</i></icons-image>
                            <p>Настройки</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="allorders.php">
                            <i class="material-icons">library_books</i>
                            <p>Продажи</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>