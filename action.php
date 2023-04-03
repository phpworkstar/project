<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
    
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		
            
            <div class='aside'>
							<h3 class='aside-title'>Категории</h3>
							<div class='mb-group-vertical'>
	";
	if(mysqli_num_rows($run_query) > 0){
        $i=1;
		while($row = mysqli_fetch_array($run_query)){
            
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
            $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_cat=$i";
            $query = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($query);
            $count=$row["count_items"];
            $i++;
			echo "
					
                    <div type='button' class='mb navbar-mb category' cid='$cid'>
									
									<a href='#'>
										<span  ></span>
										$cat_name
										<small class='qty'>($count)</small>
									</a>
								</div>
                    
			";
            
		}
        
        
		echo "</div>";
	}
}
if(isset($_POST["brand"])){
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div class='aside'>
							<h3 class='aside-title'>Бренд</h3>
							<div class='mb-group-vertical'>
	";
	if(mysqli_num_rows($run_query) > 0){
        $i=1;
		while($row = mysqli_fetch_array($run_query)){
            
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
            $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_brand=$i";
            $query = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($query);
            $count=$row["count_items"];
            $i++;
			echo "
					
                    
                    <div type='button' class='mb navbar-mb selectBrand' bid='$bid'>
									
									<a href='#'>
										<span ></span>
										$brand_name
										<small >($count)</small>
									</a>
								</div>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["page"])){
	$cid = $_POST["cid"];
	$sql = "SELECT * FROM products Where product_cat='$cid'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#product-row' page='$i' id='page' cid='$cid'  class='active'>$i</a></li>
            
            
		";
	}
}
if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	if(isset($_POST["cid"])){
		$cat_id = $_POST["cid"];
	}else{
		$cat_id = $_POST["cat_id"];
	}
	
	$product_query = "SELECT * FROM products,categories WHERE product_cat = '$cat_id' AND product_cat=cat_id LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
            $cat_name = $row["cat_title"];
			echo "
				
                        
                        <div class='col-md-4 col-xs-6' >
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>BYN $pro_price</h4>
										<div class='product-rating'>";
										$rating_query = "SELECT ROUND(AVG(rating),1) AS avg_rating  FROM reviews WHERE product_id='$pro_id '";
										$run_review_query = mysqli_query($con,$rating_query);
										$review_row = mysqli_fetch_array($run_review_query);
										if($review_row > 0){
											$avg_count=$review_row["avg_rating"];
												$i=1;
												while($i <= round($avg_count)){
													$i++;
													echo'
													<i class="ml ml-star"></i>';
												}
												$i=1;
												while($i <= 5-round($avg_count)){
													$i++;
													echo'
													<i class="ml ml-star-o empty"></i>';
												}
											
										}
										echo "</div>
										<div class='product-mbs'>
											<button pid='$pro_id' id='wishlist' class='add-to-wishlist'><i class='ml ml-heart-o'></i><span class='tooltipp'>Добавить в избранное</span></button>
											<button class='add-to-compare'><i class='ml ml-exchange'></i><span class='tooltipp'>Добавить для сравнения</span></button>
											<button class='quick-view'><i class='ml ml-eye'></i><span class='tooltipp'>Быстрый просмотр</span></button>
										</div>
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' class='add-to-cart-mb block2-mb-towishlist' href='#'><i class='ml ml-shopping-cart'></i> Добавить в корзину</button>
									</div>
								</div>
							</div>
                        
			";
		}
	}
}


if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products,categories WHERE product_cat = '$id' AND product_cat=cat_id " ;
        
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products,categories WHERE product_brand = '$id' AND product_cat=cat_id";
	}else {
        
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_pr LIKE '%$keyword%'";
       
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
            $cat_name = $row["cat_title"];
			
			echo "
					
                        
                        <div class='col-md-4 col-xs-6'>
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image'  style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>BYN $pro_price</h4>
										<div class='product-rating'>";
										$rating_query = "SELECT ROUND(AVG(rating),1) AS avg_rating  FROM reviews WHERE product_id='$pro_id '";
										$run_review_query = mysqli_query($con,$rating_query);
										$review_row = mysqli_fetch_array($run_review_query);
										if($review_row > 0){
											$avg_count=$review_row["avg_rating"];
												$i=1;
												while($i <= round($avg_count)){
													$i++;
													echo'
													<i class="ml ml-star"></i>';
												}
												$i=1;
												while($i <= 5-round($avg_count)){
													$i++;
													echo'
													<i class="ml ml-star-o empty"></i>';
												}
											
										}
										echo "</div>
										<div class='product-mbs'>
											<button pid='$pro_id' id='wishlist' class='add-to-wishlist' tabindex='0'><i class='ml ml-heart-o'></i><span class='tooltipp'>Добавить в избранное</span></button>
											<button class='add-to-compare'><i class='ml ml-exchange'></i><span class='tooltipp'>Добавить для сравнения</span></button>
											<button class='quick-view' ><i class='ml ml-eye'></i><span class='tooltipp'>Быстрый просмотр</span></button>
										</div>
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' href='#' tabindex='0' class='add-to-cart-mb'><i class='ml ml-shopping-cart'></i>Добавить в корзину</button>
									</div>
								</div>
							</div>
			";
		}
	}
	


	if(isset($_POST["addToCart"])){
		

		$p_id = $_POST["proId"];
		

		if(isset($_SESSION["uid"])){

		$user_id = $_SESSION["uid"];

		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Товар добавлен в корзину.</b>
				</div>
			";
		} else {
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if(mysqli_query($con,$sql)){
				$sql = "DELETE FROM wishlist WHERE p_id = '$p_id' AND user_id = '$_SESSION[uid]'";
			
				if(mysqli_query($con,$sql)){
					echo "<div class='alert alert-danger'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<b>Товар добавлен в корзину</b>
							</div>";
					
				}
			}
		}
		}else{
			$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = mysqli_query($con,$sql);
			if (mysqli_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Товар добавлен в корзину</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','-1','1')";
			if (mysqli_query($con,$sql)) {
				
				$sql = "DELETE FROM wishlist WHERE p_id = '$p_id' AND ip_add = '$ip_add'";

				if(mysqli_query($con,$sql)){
					echo "<div class='alert alert-danger'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<b>Товар добавлен в корзину</b>
							</div>";
					exit();
				}
			}
			
		}
		
	}

	if(isset($_POST["addToWishlist"])){
		

		$p_id = $_POST["proId"];
		

		if(isset($_SESSION["uid"])){

		$user_id = $_SESSION["uid"];

		$sql = "SELECT * FROM wishlist WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Товар добавлен в корзину</b>
				</div>
			";
		} else {
			$sql = "INSERT INTO `wishlist`
			(`p_id`, `ip_add`, `user_id`) 
			VALUES ('$p_id','$ip_add','$user_id')";
			if(mysqli_query($con,$sql)){
				$sql = "DELETE FROM cart WHERE p_id = '$p_id' AND user_id = '$_SESSION[uid]'";
			
				if(mysqli_query($con,$sql)){
					echo "<div class='alert alert-danger'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<b>Товар добавлен в корзину</b>
							</div>";
					
				}
			}
		}
		}else{
			$sql = "SELECT id FROM wishlist WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = mysqli_query($con,$sql);
			if (mysqli_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Товар добавлен в корзину</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO `wishlist`
			(`p_id`, `ip_add`, `user_id`) 
			VALUES ('$p_id','$ip_add','-1')";
			if (mysqli_query($con,$sql)) {
				$sql = "DELETE FROM cart WHERE p_id = '$p_id' AND ip_add = '$ip_add'";

				if(mysqli_query($con,$sql)){
					echo "<div class='alert alert-danger'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<b>Товар добавлен в корзину</b>
							</div>";
					exit();
				}
			}
			
		}
		
		
		
		
	}
//Подсчет товара в корзине пользователя
if (isset($_POST["count_item"])) {
	//Когда пользователь вошел в систему, мы будем подсчитывать количество товаров в корзине, используя идентификатор сеанса пользователя.
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
	}else{
		//Когда пользователь не вошел в систему, мы будем подсчитывать количество товаров в корзине, используя уникальный IP-адрес пользователя.
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Подсчет товара в корзине пользователя
if (isset($_POST["count_Wishlist_item"])) {
	//Когда пользователь вошел в систему, мы будем подсчитывать количество товаров в корзине, используя идентификатор сеанса пользователя.
	if (isset($_SESSION["uid"])) { 
		$sql = "SELECT COUNT(*) AS count_wishlist_item FROM wishlist WHERE user_id = $_SESSION[uid] AND p_id > 0" ;
	}else{
		//Когда пользователь не вошел в систему, мы будем подсчитывать количество товаров в корзине, используя уникальный IP-адрес пользователя.
		$sql = "SELECT COUNT(*) AS count_wishlist_item FROM wishlist WHERE ip_add = '$ip_add' AND user_id < 0 AND p_id > 0";
	}
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_wishlist_item"];
	exit();
}
//Получить элемент корзины из базы данных в раскрывающееся меню
if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		//Когда пользователь войдет в систему, этот запрос будет выполнен
		$sql = "SELECT p.product_id,p.product_title,p.product_price,p.product_desc,p.product_image,c.id,c.qty FROM products p,cart c WHERE p.product_id=c.p_id AND c.user_id='$_SESSION[uid]'";
	}else{
		//Когда пользователь не вошел в систему, этот запрос будет выполняться
		$sql = "SELECT p.product_id,p.product_title,p.product_price,p.product_image,p.product_desc,c.id,c.qty FROM products p,cart c WHERE p.product_id=c.p_id AND c.ip_add='$ip_add' AND c.user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//отображать товар в корзине в раскрывающемся меню
		if (mysqli_num_rows($query) > 0) {
			$n=0;
			$total_price=0;
			while ($row=mysqli_fetch_array($query)) {
                
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				$total_price=$total_price+$product_price;
				echo '
					
                    
                    <div class="product-widget">
												<div class="product-img">
													<img src="product_images/'.$product_image.'" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">'.$product_title.'</a></h3>
													<h4 class="product-price"><span class="qty">'.$n.'</span>BYN '.$product_price.'</h4>
												</div>
												
											</div>'
                    
                    
                    ;
				
			}
            
            echo '<div class="cart-summary">
				    <small class="qty">'.$n.' Товар(ов) выбрано</small>
				    <h5>BYN '.$total_price.'</h5>
				</div>'
            ?>
				
				
			<?php
			
			exit();
		}
	}
	
    
    
    if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			//отображать элемент корзины пользователя с кнопкой «Оформить заказ», если пользователь не вошел в систему
			echo '<div class="main ">
			<div class="table-responsive">
			<form method="post" action="login_form.php">
			
	               <table id="cart" class="table table-hover table-condensed" id="">
    				<thead>
						<tr>
							<th style="width:50%">Товар</th>
							<th style="width:10%">Стоимость</th>
							<th style="width:8%">Количество</th>
							<th style="width:7%" class="text-center">Предварительная стоимость</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                    ';
				$n=0;
				while ($row=mysqli_fetch_array($query)) {
					$n++;
					$product_id = $row["product_id"];
					$product_title = $row["product_title"];
					$product_price = $row["product_price"];
					$product_desc = $row["product_desc"];
					$product_image = $row["product_image"];
					$cart_item_id = $row["id"];
					$qty = $row["qty"];

					echo 
						'
                             
						<tr>
							<td data-th="Product" >
								<div class="row">
								
									<div class="col-sm-4 "><img src="product_images/'.$product_image.'" style="height: 70px;width:75px;"/>
									<h4 class="nomargin product-name header-cart-item-name"><a href="product.php?p='.$product_id.'">'.$product_title.'</a></h4>
									</div>
									<div class="col-sm-6">
										<div style="max-width=50px;">
										<p>'.$product_desc.'</p>
										</div>
									</div>
									
									
								</div>
							</td>
                            <input type="hidden" name="product_id[]" value="'.$product_id.'"/>
				            <input type="hidden" name="" value="'.$cart_item_id.'"/>
							<td data-th="Price"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></td>
							<td data-th="Quantity">
								<input type="text" class="form-control qty" value="'.$qty.'" >
							</td>
							<td data-th="Subtotal" class="text-center"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></td>
							<td class="actions" data-th="">
							<div class="mb-group">
								<a href="#" class="mb mb-info mb-sm update" update_id="'.$product_id.'"><i class="ml ml-refresh"></i></a>
								
								<a href="#" class="mb mb-danger mb-sm remove" remove_id="'.$product_id.'"><i class="ml ml-trash-o"></i></a>		
							</div>							
							</td>
							<td>
								<a href="#" id="wishlist" pid="'.$product_id.'" class="mb mb-warning">Добавить в избранное <i class="ml ml-angle-right"></i> </a>
							</td>
						</tr>
					
                            
                            ';
				}
				
				echo '</tbody>
				<tfoot>
					
					<tr>
						<td><a href="index.php" class="mb mb-warning"><i class="ml ml-angle-left"></i> Продолжить покупки</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td class="hidden-xs text-center"><b class="net_total" ></b></td>
						<div id="issessionset"></div>
                        <td>
							
							';
				if (!isset($_SESSION["uid"])) {
					echo '
					
							<a href="signup_form.php" class="mb mb-success">Оформить заказ</a></td>
								</tr>
							</tfoot>
				
							</table></div></div>';
                }else if(isset($_SESSION["uid"])){
					echo '
					</form>
					
						<form action="checkout.php" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="info@produkti.by">
							<input type="hidden" name="upload" value="1">';
							  
							$i=0;
							$sql = "SELECT p.product_id,p.product_title,p.product_price,p.product_image,c.id,c.qty FROM products p,cart c WHERE p.product_id=c.p_id AND c.user_id='$_SESSION[uid]'";
							$query = mysqli_query($con,$sql);
							while($row=mysqli_fetch_array($query)){
								$i++;
								echo  	

									'<input type="hidden" name="total_count" value="'.$i.'">
									<input type="hidden" name="item_name_'.$i.'" value="'.$row["product_title"].'">
								  	 <input type="hidden" name="item_number_'.$i.'" value="'.$i.'">
								     <input type="hidden" name="amount_'.$i.'" value="'.$row["product_price"].'">
								     <input type="hidden" name="quantity_'.$i.'" value="'.$row["qty"].'">';
								}
							  
							echo   
								'<input type="hidden" name="return" value="payment_success.php">
					                <input type="hidden" name="notify_url" value="payment_success.php">
									<input type="hidden" name="currency_code" value="BYN"/>
									<input type="hidden" name="custom" value="'.$_SESSION["uid"].'"/>
									<input type="submit" id="submit" name="login_user_with_product" name="submit" class="mb mb-success" value="Оформить заказ">
									</form></td>
									
									</tr>
									
									</tfoot>
									
							</table></div></div>    
								';
				}
			}
	}

	
	
	
}

if (isset($_POST["wishListCommon"])) {

	if (isset($_SESSION["uid"])) {
		//Когда пользователь войдет в систему, этот запрос будет выполнен
		$sql = "SELECT p.product_id,p.product_title,p.product_price,p.product_image,p.product_desc,w.id FROM products p,wishlist w WHERE p.product_id=w.p_id AND w.user_id='$_SESSION[uid]'";
	}else{
		//Когда пользователь не вошел в систему, этот запрос будет выполняться
		$sql = "SELECT p.product_id,p.product_title,p.product_price,p.product_image,p.product_desc,w.id FROM products p,wishlist w WHERE p.product_id=w.p_id AND w.ip_add='$ip_add' AND w.user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	
    

	if (isset($_POST["wishlistDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			//отображать элемент корзины пользователя с кнопкой «Оформить заказ», если пользователь не вошел в систему
			echo '<div class="main ">
			<div class="table-responsive">
			<form method="post" action="login_form.php">
			
	               <table id="wishlist" class="table table-hover table-condensed" id="">
    				<thead>
						<tr>
							<th style="width:50%">Товар</th>
							<th style="width:10%">Стоимость</th>
							<th style="width:7%" class="text-center">Итого</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                    ';
				$n=0;
				while ($row=mysqli_fetch_array($query)) {
					$n++;
					$product_id = $row["product_id"];
					$product_title = $row["product_title"];
					$product_desc = $row["product_desc"];
					$product_price = $row["product_price"];
					$product_image = $row["product_image"];
					$wishlist_item_id = $row["id"];

					echo 
						'
                             
						<tr>
							<td data-th="Product" >
								<div class="row">
								
									<div class="col-sm-4 "><img src="product_images/'.$product_image.'" style="height: 70px;width:75px;"/>
									<h4 class="nomargin product-name header-cart-item-name"><a href="product.php?p='.$product_id.'">'.$product_title.'</a></h4>
									</div>
									<div class="col-sm-6">
										<div style="max-width=50px;">
										<p>'.$product_desc.'</p>
										</div>
									</div>
									
									
								</div>
							</td>
                            <input type="hidden" name="product_id[]" value="'.$product_id.'"/>
				            <input type="hidden" name="" value="'.$wishlist_item_id.'"/>
							<td data-th="Price"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></td>
							
							<td data-th="Subtotal" class="text-center"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></td>
							<td class="actions" data-th="">
							<div class="mb-group">
								
								<a href="#" class="mb mb-danger mb-sm wishlist-remove" remove_id="'.$product_id.'"><i class="ml ml-trash-o"></i></a>	
									
							</div>							
							</td>
							<td class="actions" data-th="">
							<a href="#" id="product" pid="'.$product_id.'" class="mb mb-success">Перенести в корзину</a>
							</td>
						</tr>
					
                            
                            ';
				}
				
				echo '</tbody>
				<tfoot>
					
					<tr>
						<td><a href="index.php" class="mb mb-warning"><i class="ml ml-angle-left"></i> Продолжить покупки</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td class="hidden-xs text-center"><b class="net_total" ></b></td>
						</tfoot>
				
						</table></div></div>
							
							';
				
			}
	}
	
	
}

//Удалить товар из корзины

if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Товар удалён</b>
				</div>";
		exit();
	}
}

if (isset($_POST["removeItemFromwishList"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM wishlist WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM wishlist WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Товар удалён</b>
				</div>";
		exit();
	}
}

//Обновить(пересчитать) товар в корзине

if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Товар Добавлен</b>
				</div>";
		exit();
	}
}




?>






