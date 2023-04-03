<?php
if(isset($_SESSION["uid"])){
	header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Страница для регистрации нового клиента</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet"/>

<!-- Bootstrap -->
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

<!-- Font Awesome Icon -->
<link rel="stylesheet" href="css/font-awesome.min.css">


<link rel="stylesheet" type="text/css" href="css/login_reg.css">
<link rel="stylesheet" type="text/css" href="css/utils.css">

</head>
	<body style="background-color: #999999;">
		<div class="limiter">
		<div class="container-login100">
		<div class="login100-more" style="background-image: url('img/regpage.jpg');-webkit-transform: scaleX(-1);
  transform: scaleX(-1);"></div>
		<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
		<form id="signup_form" onsubmit="return false" class="login100-form validate-form">
		<span class="login100-form-title p-b-59">
		Зарегистрироваться
		</span>
		<div class="wrap-input100 validate-input" data-validate="Name is required">
		<span class="label-input100">Полное имя</span>
		<input class="input100" type="text" name="f_name" id="f_name" placeholder="First Name">
		<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input" data-validate="Name is required">
		<span class="label-input100">Фамилия</span>
		<input class="input100" type="text" name="l_name" id="l_name" placeholder="Last Name">
		<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
		<span class="label-input100">Адрес электронной почты</span>
		<input class="input100" type="email" name="email"  placeholder="Email addess">
		<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input" data-validate="Mobile no is required">
		<span class="label-input100">Телефон</span>
		<input class="input100" type="text" name="mobile" id="mobile" placeholder="phone number">
		<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input" data-validate="Password is required">
		<span class="label-input100">Пароль</span>
		<input class="input100" type="password" name="password" id="password" placeholder="*************">
		<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input" data-validate="Repeat Password is required">
		<span class="label-input100">Повторите пароль</span>
		<input class="input100" type="password" name="confpassword" id="confpassword" placeholder="*************">
		<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input" data-validate="Address is required">
		<span class="label-input100">Адрес</span>
		<input class="input100" type="text" name="address1" id="address1" placeholder="Address">
		<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input" data-validate="City is required">
		<span class="label-input100">Город</span>
		<input class="input100" type="text" name="address2" id="address2" placeholder="City">
		<span class="focus-input100"></span>
		</div>
		<div class="flex-m w-full p-b-33">
		<div class="contact100-form-checkbox">
		<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
		<label class="label-checkbox100" for="ckb1">
		<span class="txt1">
		Я согласен с
		<a href="#" class="txt2 hov1">
		правилами использования сайта
		</a>
		</span>
		</label>
		</div>
		</div>
		<div class="container-login100-form-mb">
		<div class="wrap-login100-form-mb">
			<div class="login100-form-bgmb"></div>
			<button class="login100-form-mb" type="submit">
			Зарегистрироваться
			</button>
			
		</div>
		
		<a href="signin_form.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
		У меня уже есть аккаунт
		<i class="ml ml-long-arrow-right m-l-5"></i>
		</a>

		<a href="index.php" class="dis-block txt3 hov1 p-r-30 p-t-40 p-b-10 p-l-180">
		Выйти на главную страницу
		<i class="ml ml-long-arrow-right m-l-5"></i>
		</a>
		<div class="col-md-8" id="signup_msg"></div>
		</div>
		</form>
		</div>
		</div>
		</div>

		<script src="js/jquery.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				
				<script src="js/login_reg.js"></script>
				<script src="js/actions.js"></script>

		
	</body>
</html>