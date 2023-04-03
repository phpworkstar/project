<?php
include "db.php";

session_start();


//Сценарий входа начинается здесь
//Если предоставленные пользователем учетные данные успешно совпадают с данными, доступными в базе данных, мы выведем строку login_success
//строка login_success вернется к вызываемой анонимной функции $("login").click()

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($con,$_POST["email"]);
	$password = $_POST["password"];
	$sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
		
// мы создали файл cookie на странице login_form.php, поэтому, если этот файл cookie доступен, это означает, что пользователь не вошел в систему
        
//если запись о пользователе есть в БД, то $count будет равно 1

	if($count == 1){
			
			if (isset($_COOKIE["product_list"])) {
				
				$p_list = stripcslashes($_COOKIE["product_list"]);
				// здесь мы декодируем сохраненный файл cookie со списком продуктов json в обычный массив
				$product_list = json_decode($p_list,true);
				for ($i=0; $i < count($product_list); $i++) { 
					//После получения идентификатора пользователя из базы данных здесь мы проверяем элемент корзины пользователя, указан ли уже продукт или нет
					$verify_cart = "SELECT id FROM cart WHERE user_id = $_SESSION[uid] AND p_id = ".$product_list[$i];
					$result  = mysqli_query($con,$verify_cart);
					if(mysqli_num_rows($result) < 1){
						//если пользователь впервые добавляет товар в корзину, мы обновим user_id в таблице базы данных с действительным идентификатором
						$update_cart = "UPDATE cart SET user_id = '$_SESSION[uid]' WHERE ip_add = '$ip_add' AND user_id = -1";
						mysqli_query($con,$update_cart);
					}else{
						//если этот продукт уже доступен в таблице базы данных, мы удалим эту запись
						$delete_existing_product = "DELETE FROM cart WHERE user_id = -1 AND ip_add = '$ip_add' AND p_id = ".$product_list[$i];
						mysqli_query($con,$delete_existing_product);
					}
				}
				//здесь мы уничтожаем пользовательские cookie
				setcookie("product_list","",strtotime("-1 day"),"/");
				//если пользователь входит со страницы после корзины, мы отправим cart_login
				echo "cart_login";
				
				
				exit();
				
			}
			//если пользователь входит со страницы, мы отправим login_success
			$_SESSION["uid"] = $row["user_id"];
			$_SESSION["name"] = $row["first_name"];
			$ip_add = getenv("REMOTE_ADDR");
			$sql = "UPDATE cart SET user_id = '$_SESSION[uid]' WHERE ip_add='$ip_add' AND user_id = -1";
			$wishlist_sql = "UPDATE wishlist SET user_id = '$_SESSION[uid]' WHERE ip_add='$ip_add' AND user_id = -1";
			if(mysqli_query($con,$sql)){
				
				echo "login_success";
				$BackToMyPage = $_SERVER['HTTP_REFERER'];
				if(mysqli_query($con,$wishlist_sql)){
					if(!isset($BackToMyPage)) {
						header('Location: '.$BackToMyPage);
						echo"<script type='text/javascript'>
						
						</script>";
					} else {
						echo "<script> location.href='index.php'; </script>" ;
					} 
				}
			}
			
				
			
            exit;

		}else{
                $email = mysqli_real_escape_string($con,$_POST["email"]);
                $password =md5($_POST["password"]) ;
                $sql = "SELECT * FROM admin_info WHERE admin_email = '$email' AND admin_password = '$password'";
                $run_query = mysqli_query($con,$sql);
                $count = mysqli_num_rows($run_query);

            //если запись о пользователе есть в БД, то $count будет равно 1
            if($count == 1){
                $row = mysqli_fetch_array($run_query);
                $_SESSION["uid"] = $row["admin_id"];
                $_SESSION["name"] = $row["admin_name"];
                $ip_add = getenv("REMOTE_ADDR");
                // мы создали файл cookie на странице login_form.php, поэтому, если этот файл cookie доступен, это означает, что пользователь не вошел в систему


                    //если пользователь входит со страницы, мы отправим login_success
                    echo "login_success";

                    echo "<script> location.href='admin/add_products.php'; </script>";
                    exit;

                }else{
                    echo "<span style='color:red;'>Неправильный логин или пароль</span>";
                    exit();
                }
    
	
}
    
	
}

?>