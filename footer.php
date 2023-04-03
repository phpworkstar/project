<footer id="footer">
		<style>
		#toast {
    visibility: hidden;
    max-width: 50px;
    height: 50px;
    margin: auto;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;

    position: fixed;
    z-index: 10;
    left: 0;right:0;
	bottom:30px;
    font-size: 17px;
    white-space: nowrap;
}
#toast #img{
width: 50px;
height: 50px;
    
    float: left;
    
    padding-top: 16px;
    padding-bottom: 16px;
    
    box-sizing: border-box;

    
    background-color: #111;
    color: #fff;
}
#toast #desc{

    
    color: #fff;
   
    padding: 16px;
    
    overflow: hidden;
white-space: nowrap;
}

#toast.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 2s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 4s, fadeout 0.5s 4.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes expand {
    from {min-width: 50px} 
    to {min-width: 350px}
}

@keyframes expand {
    from {min-width: 50px}
    to {min-width: 350px}
}
@-webkit-keyframes stay {
    from {min-width: 350px} 
    to {min-width: 350px}
}

@keyframes stay {
    from {min-width: 350px}
    to {min-width: 350px}
}
@-webkit-keyframes shrink {
    from {min-width: 350px;} 
    to {min-width: 50px;}
}

@keyframes shrink {
    from {min-width: 350px;} 
    to {min-width: 50px;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 60px; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 60px; opacity: 0;}
}
	</style>
		<div id="toast"><div id="desc">Данные для входа</div></div>
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">О нас</h3>
								<p>"Магазин продуктов"</p>
								<ul class="footer-links">
									<li><a href="#"><i class="ml ml-map-marker"></i>Минск, Республика Беларусь</a></li>
									<li><a href="#"><i class="ml ml-phone"></i><a href="tel:+3752921179222">+3752921179222</a></li>
									<li><a href="#"><i class="ml ml-envelope-o"></i><a href="mailto:info@produkti.by">info@produkti.by</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 text-center" style="margin-top:80px;">
							<ul class="footer-payments">
								<li><a href="#"><i class="ml ml-cc-visa"></i></a></li>
								<li><a href="#"><i class="ml ml-credit-card"></i></a></li>
								<li><a href="#"><i class="ml ml-cc-mastercard"></i></a></li>
							</ul>
							<span class="protected">
								
							 Этот проект адоптирован в <script>document.write(new Date().getFullYear());</script>
							
							</span>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Категории</h3>
								<ul class="footer-links">
									<li><a href="products.php?cat_id=1">Хлебобулочные изделия</a></li>
									<li><a href="products.php?cat_id=2">Молочные продукты</a></li>
									<li><a href="products.php?cat_id=3">Крупы</a></li>
									<li><a href="products.php?cat_id=4">Рыба</a></li>
									<li><a href="products.php?cat_id=5">Чипсы и Снеки</a></li>
									<li><a href="products.php?cat_id=6">Кондитерские изделия</a></li>
									<li><a href="products.php?cat_id=7">Бакалея</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->
                

			<!-- bottom footer -->
			
			<!-- /bottom footer -->
		</footer>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/actions.js"></script>
		<script src="js/sweetalert.min"></script>
		<script src="js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="js/script.js"></script>
		<script>var c = 0;
        function menu(){
          if(c % 2 == 0) {
            document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu active";    
            document.querySelector('.cont_icon_trg').className = "cont_icon_trg active";    
            c++; 
              }else{
            document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu disable";        
            document.querySelector('.cont_icon_trg').className = "cont_icon_trg disable";        
            c++;
              }
		}
		
		
</script>
    <script type="text/javascript">
		$('.block2-mb-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "Добавлен в корзину", "Успешно");
			});
		});

		$('.block2-mb-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "Добавлен в избранное", "Успешно");
			});
		});
	</script>
	
