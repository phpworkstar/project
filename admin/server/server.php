<?php
session_start();
?>

<?php

// инициализация переменных
$name = "";
$username = "";
$usn = "";
$email    = "";
$errors = array();
$reg_date = date("Y/m/d");

// подключиться к базе данных
$db = mysqli_connect('localhost', 'root', 'root', 'shopnew');


// Регистрация пользователя
if (isset($_POST['reg_user'])) {
  // получить все входные значения из формы
  $username = mysqli_real_escape_string($db, $_POST['admin_name']);
  $email = mysqli_real_escape_string($db, $_POST['admin_email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

   // проверка формы: убедиться, что форма заполнена правильно...
   // путем добавления (array_push()) соответствующей ошибки в массив $errors
  if (empty($username)) { array_push($errors, "Введите имя пользователя"); }
  if (empty($email)) { array_push($errors, "Введите адрес электронной почты"); }
  if (empty($password_1)) { array_push($errors, "Введите пароль"); }
  if ($password_1 != $password_2) {
  array_push($errors, "Пароли не совпадают");
  }

   // сначала проверяем базу данных, чтобы убедиться
   // пользователь с таким именем и/или адресом электронной почты еще не существует
  $user_query = "SELECT * FROM admin_info WHERE admin_name='$username' OR admin_email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // если пользователь существует
    if ($user['admin_name'] === $username) {
      array_push($errors, "Такой пользователь уже зарегистрирован");
    }

    if ($user['admin_email'] === $email) {
      array_push($errors, "Такой адрес электронной почты уже зарегистрирован");
    }
  }

  // Зарегистрировать пользователя, если нету ошибок в форме
  if (count($errors) == 0) {
    $password = md5($password_1);//зашифровать пароль перед сохранением в базе данных

    $query = "INSERT INTO admin_info (admin_name, admin_email, admin_password)
          VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['admin_name'] = $username;
    $_SESSION['admin_email'] = $email;

    $_SESSION['success'] = "Вы вошли";
    header('location: ./admin/');
  }
}






if (isset($_POST['login_admin'])) {
  $admin_username = mysqli_real_escape_string($db, $_POST['admin_username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($admin_username)) {
    array_push($errors, "Введите имя пользователя или адрес электронной почты");
  }
  if (empty($password)) {
    array_push($errors, "Введите пароль");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM admin_info WHERE admin_email='$admin_username' AND admin_password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
       $_SESSION['admin_email'] = $email;
      $_SESSION['admin_name'] = $admin_username;
      $_SESSION['success'] = "Вы вошли";
      header('location: ./admin/');
    }else {
      array_push($errors, "Неправильный логин или пароль");
    }
  }
}


?>

