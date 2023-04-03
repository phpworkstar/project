<?php
include 'header.php';
$cat_id = $_GET['cat_id'];
?>
     
      <div class="main main-raised"> 
        
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div id="get_category">
				        </div>
						<!-- /aside Widget -->

						<!-- aside Widget -->

						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div id="get_brand">
				        </div>
						<!-- /aside Widget -->

						<!-- aside Widget -->

						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">

						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row" id="product-row">
						<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
							<!-- product -->
							<div id="get_product" cid=<?php echo "$cat_id"; ?>>
							<!--Здесь получаем product jquery Ajax запрос-->
						</div>
							
							<!-- /product -->
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Перейти на следующую страницу товаров</span>
							<ul class="store-pagination" id="pageno" cid=<?php echo "$cat_id"; ?>>
								<li ><a class="active" href="#aside">1</a></li>
								
								<li><a href="#"><i class="ml ml-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
</div>
<?php
include "newsletter.php";
include "footer.php";
?>