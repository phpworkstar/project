<?php
include "header.php";
?>
		<!-- /BreadCrumb Навигационная цепочка -->
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
</script>
		<script>
    
    (function (global) {
	if(typeof (global) === "undefined")
	{
		throw new Error("window is undefined");
	}
    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };	
	// Ранее мы установили SetInterval
    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };
    global.onload = function () {        
		noBackPlease();
		// отключает backspace на странице, за исключением полей ввода и текстовой области.
		document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // остановка события, всплывающего в дереве DOM..
            e.stopPropagation();
        };		
    };
})(window);
</script>

		<!-- SECTION -->
		<div class="section main main-raised">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					
					<?php 
								include 'db.php';
								$product_id = $_GET['p'];
								
								$sql = " SELECT * FROM products AS P,categories AS C WHERE P.product_cat = C.cat_id  AND P.product_id = '$product_id'";
								if (!$con) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0) 
								{
									while($row = mysqli_fetch_assoc($result)) 
									{
									echo '
									
                                    
                                
                                <div class="col-md-5 col-md-push-2">
                                <div id="product-main-img">
                                    <div class="product-preview">
                                        <img src="product_images/'.$row['product_image'].'" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/'.$row['product_image'].'" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/'.$row['product_image'].'" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/'.$row['product_image'].'" alt="">
                                    </div>
                                </div>
                            </div>
                                
                                <div class="col-md-2  col-md-pull-5">
                                <div id="product-imgs">
                                    <div class="product-preview">
                                        <img src="product_images/'.$row['product_image'].'" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/'.$row['product_image'].'" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/'.$row['product_image'].'g" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/'.$row['product_image'].'" alt="">
                                    </div>
                                </div>
                            </div>

                                 
									';
                                    

									echo '
									
                                    
                                   
							<div class="col-md-5">
								<div class="product-details">
									<h2 class="product-name">'.$row['product_title'].'</h2>
									<div id = "rating_reviews">
										
									</div>
									<div>
										<h3 class="product-price">BYN'.$row['product_price'].'</h3>
										<span class="product-available">В наличии</span>
									</div>
									<p>Для покупки товара вы можете добавить его в корзину</p>

									<div class="add-to-cart">
										<div class="qty-label">
										</div>
										<div class="mb-group" style="margin-left: 25px; margin-top: 15px">
										<button class="add-to-cart-mb" pid="'.$row['product_id'].'"  id="product" ><i class="ml ml-shopping-cart"></i> Добавить в корзину</button>
										</div>
										
										
									</div>

									<ul class="product-mbs">
										<li><a href="#" pid="'.$row['product_id'].'"  id="wishlist" ><i class="ml ml-heart-o"></i> Добавить в избранное</a></li>
										<li><a href="#"><i class="ml ml-exchange"></i> Добавить для сравнения</a></li>
									</ul>

									<ul class="product-links">
										<li>Категория:</li>
										<li><a href="#">'.$row["cat_title"].'</a></li>
									</ul>

									<ul class="product-links">
										<li>Соц сети:</li>
										<li><a href="index.php"><i class="ml ml-facebook"></i></a></li>
										<li><a href="index.php"><i class="ml ml-twitter"></i></a></li>
										<li><a href="index.php"><i class="ml ml-envelope"></i></a></li>
									</ul>

								</div>
							</div>
							';
							$_SESSION['product_id'] = $row['product_id'];
							}
						} 
						?>		
					
					
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Описание</a></li>

								<li><a data-toggle="tab" href="#tab2">Особенности</a></li>
								<?php
												include 'db.php';
												$product_id = $_GET['p'];
									
												$product_query = "SELECT COUNT(*) AS count FROM reviews WHERE product_id='$product_id'";
												$run_query = mysqli_query($con,$product_query);
												$row = mysqli_fetch_array($run_query);
												$reviews_count=$row["count"];
												echo '<li><a data-toggle="tab" href="#tab3">Отзывы ('.$reviews_count.')</a></li>';
								?>
								
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">

										<?php 
								include 'db.php';

								
								$sql = " SELECT * FROM products AS product_desc,categories AS C WHERE product_cat = C.cat_id  AND product_id = '$product_id'";
								if (!$con) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0) 
								
									while($row = mysqli_fetch_assoc($result))

									echo '
									
									<h4 class="product-desc">'.$row['product_desc'].'</h4>
									
									'
									?>



											<br><p>Продуктовый магазин produkti.by</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->

								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">

								<?php 
								include 'db.php';

										$sql = " SELECT * FROM products AS product_pr,categories AS C WHERE product_cat = C.cat_id  AND product_id = '$product_id'";
								if (!$con) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0) 
								
									while($row = mysqli_fetch_assoc($result))

									echo '
									
									<h4 class="product-pr">'.$row['product_pr'].'</h4>
                                    '
									?>

											<br><p>Онлайн покупка и доставка в течении всего нескольких часов</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div id="review_action" pid='<?php echo"$product_id"; ?>'></div>
										
										<!-- Review Form -->
										<div class="col-md-3 mainn">
											<div id="review-form">
												<form class="review-form" onsubmit="return false" id="review_form" required>
													<input class="input" type="text" name="name" placeholder="Ваше имя" required>
													<input class="input" type="email" name="email" placeholder="Ваш адрес электронной почты" required>
													<?php 
														$product_id = $_GET['p'];
														echo'<input  name="product_id" value="'.$product_id.'" hidden required>'
													?>
													
													<textarea class="input" name="review" placeholder="Ваш отзыв"></textarea>
													<div class="input-rating">
														<span>Рейтинг </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio" required><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio" required><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio" required><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio" required><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio" required><label for="star1"></label>
														</div>
													</div>
													<button class="primary-mb" name="review_submit">Отправить</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section main main-raised">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    
					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Вы также можете купить:</h3>
							
						</div>
					</div>
                    
								<?php
                    include 'db.php';
								$product_id = $_GET['p'];
                    
					$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN $product_id AND $product_id+3";
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
				
                        
                                <div class='col-md-3 col-xs-6'>
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>BYN $pro_price </h4>
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
        ;
      
}
?>
					<!-- product -->
					
					<!-- /product -->

				</div>
				<!-- /row -->
                
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

		<!-- NEWSLETTER -->
		
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
<?php
include "newsletter.php";
include "footer.php";

?>
