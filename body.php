
   <div class="main main-raised">
        <div class="container mainn-raised" style="width:100%;">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
   

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="img/savushkin.jpg" alt="savushkin" style="width:100%;">
        
      </div>

      <div class="item">
        <img src="img/berezovik.jpg" alt="berezovik" style="width:100%;">
        
      </div>
    
      <div class="item">
        <img src="img/belriba.jpg" alt="belriba" style="width:100%;">
        
      </div>
      <div class="item">
        <img src="img/hleb.jpg" alt="hleb" style="width:100%;">
        
      </div>
      <div class="item">
        <img src="img/kartofan2.jpg" alt="Kartofel" style="width:100%;">
        
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control _26sdfg" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only" >Предыдущий</span>
    </a>
    <a class="right carousel-control _26sdfg" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Следующий</span>
    </a>
  </div>
</div>
     


		<!-- SECTION -->
		<div class="section mainn mainn-raised">
		
		
			<!-- container -->
			<div class="container">
			
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<a href="product.php?p=4"><div class="shop">
							<div class="shop-img">
								<img src="./products_images/riba.jpg" alt="">
							</div>
							<div class="shop-body">
								<h3>Свежая <br>рыба</h3>
								<a href="product.php?p=4" class="cta-mb">Купить сейчас <i class="ml ml-arrow-circle-right"></i></a>
							</div>
						</div></a>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<a href="product.php?p=1"><div class="shop">
							<div class="shop-img">
								<img src="./products_images/hleb.jpg" alt="">
							</div>
							<div class="shop-body">
								<h3>Свежий хлеб<br>только с хлебозавода</h3>
								<a href="product.php?p=1" class="cta-mb">Купить сейчас <i class="ml ml-arrow-circle-right"></i></a>
							</div>
						</div></a>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<a href="product.php?p=6"><div class="shop">
							<div class="shop-img">
								<img src="./products_images/kartofan.jpg" alt="">
							</div>
							<div class="shop-body">
								<h3>Картофель<br>Урожай 2022</h3>
								<a href="product.php?p=6" class="cta-mb">Купить сейчас <i class="ml ml-arrow-circle-right"></i></a>
							</div>
                            </div></a>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		  
		

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Безалкагольные напитки</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Сладкая газированная</a></li>
									<li><a data-toggle="tab" href="#tab1">Минеральная вода</a></li>
									<li><a ="tab" href="#tab1">Квас</a></li>
									<li><a data-toggle="tab" href="#tab1">Соки</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12 mainn mainn-raised">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1" >
									
									<?php
                    include 'db.php';
								
                    
					$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN 32 AND 36";
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
				
                        
                                
								<div class='product'>
									<a href='product.php?p=$pro_id'><div class='product-img'>
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
										<button pid='$pro_id' id='product' class='add-to-cart-mb block2-mb-towishlist' href='#'><i class='ml ml-shopping-cart'></i>Добавить в корзину</button>
									</div>
								</div>
                               
							
                        
			";
		}
        ;
      
}
?>
										<!-- product -->
										
	
										<!-- /product -->
										
										
										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section mainn mainn-raised">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>10</h3>
										<span>Дней</span>
									</div>
								</li>
								<li>
									<div>
										<h3>11</h3>
										<span>Часов</span>
									</div>
								</li>
								<li>
									<div>
										<h3>35</h3>
										<span>Минут</span>
									</div>
								</li>
								<li>
									<div>
										<h3>22</h3>
										<span>Секунды</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">В этом месяце</h2>
							<p>Крупа "Столичная" со скидкой по бонусной карте</p>
							<a class="primary-mb cta-mb" href="product.php?p=7">Купить сейчас</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->
		

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Новые товары</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab2">Молочные продукты</a></li>
									<li><a data-toggle="tab" href="#tab2">Хлебобулочные изделия</a></li>
									<li><a data-toggle="tab" href="#tab2">Крупы</a></li>
									<li><a data-toggle="tab" href="#tab2">Рыба</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12 mainn mainn-raised">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										<?php
                    include 'db.php';
								
                    
					$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN 15 AND 31";
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
				
                        
                                
								<div class='product'>
									<a href='product.php?p=$pro_id'><div class='product-img'>
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
                               
							
                        
			";
		}
        ;
      
}
?>
										
										<!-- /product -->
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Новые поступления</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>
						

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div id="get_product_home">
								<!-- product widget -->
								
								<!-- product widget -->
							</div>

							<div id="get_product_home2">
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/hleb5.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=11">Хлеб Пшеничка</a></h3>
										<h4 class="product-price">BYN 1</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/hleb7.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=12">Багет Белорусочка</a></h3>
										<h4 class="product-price">BYN 2</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/hleb6.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=13">Фитохлеб цельнозерновой</a></h3>
										<h4 class="product-price">BYN 5</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Новые поступления</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/moloko.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=18">Молоко Минская марка</a></h3>
										<h4 class="product-price">BYN 2</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/kefir.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=21">Кефир Славянские традиции</a></h3>
										<h4 class="product-price">BYN 2</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/yogurt1.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=26">Йогурт Персиковый</a></h3>
										<h4 class="product-price">BYN 1</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/riba7.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=54">Рыба морской окунь </a></h3>
										<h4 class="product-price">BYN 31</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/chipsi.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=37">Чипсы картофельные</a></h3>
										<h4 class="product-price">BYN 1</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/chipsi3.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=39">Чипсы картофельные Бульба</a></h3>
										<h4 class="product-price">BYN 2</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs">
					    
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Новые поступления</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/cake2.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=27">Торт Столичный</a></h3>
										<h4 class="product-price">BYN 20</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/cake3.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=28">Торт Услада</a></h3>
										<h4 class="product-price">BYN 22</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/cake5.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="#">Торт Медовый спас</a></h3>
										<h4 class="product-price">BYN 21</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/napitki1.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=32">Напиток безалкогольный Березовик</a></h3>
										<h4 class="product-price">BYN 2</h4>
									</div>
								</div>
								<!-- /product widget -->
								

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/napitki5.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=36">Минеральная вода Дарида</a></h3>
										<h4 class="product-price">BYN 1</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="./products_images/krupa5.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Категория</p>
										<h3 class="product-name"><a href="product.php?p=46">Крупа пшённая</a></h3>
										<h4 class="product-price">BYN 1</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
</div>
		