$(document).ready(function(){
	cat();
    cathome();
	brand();
	product();
    
    producthome();
    reviewData();
    
	//cat() — это функция, извлекающая запись категории из базы данных всякий раз, когда загружается страница.
	function cat(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{category:1},
			success	:	function(data){
				$("#get_category").html(data);
				
			}
		})
	}
    function cathome(){
		$.ajax({
			url	:	"actionstart.php",
			method:	"POST",
			data	:	{categoryhome:1},
			success	:	function(data){
				$("#get_category_home").html(data);
				
			}
		})
	}
	//brand() — это функция, извлекающая запись бренда из базы данных всякий раз, когда загружается страница.
	function brand(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{brand:1},
			success	:	function(data){
				$("#get_brand").html(data);
			}
		})
	}
	//product () — это функция, извлекающая запись о продукте из базы данных всякий раз, когда загружается страница.
	function product(){
		var cid = $("#get_product").attr("cid");
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getProduct:1,cat_id:cid},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	}
	function launch_toast() {
		var x = document.getElementById("toast")
		x.className = "show";
		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
	}
	function reviewData(){
		var pid = $("#review_action").attr("pid");
		$("#review_action").html("<h3>Loading...</h3>");
		$(".overlay").show();
		$.ajax({
			url : "review_action.php",
			method : "POST",
			data : {review_action:1,proId:pid},
			success : function(data){
				console.log("reviewData");
				$(".overlay").hide();
				$("#review_action").html(data);
				ratingReviews();
			}
		})
	}
	function ratingReviews(){
		var pid = $("#review_action").attr("pid");
		$(".overlay").show();
		$.ajax({
			url : "review_action.php",
			method : "POST",
			data : {rating_reviews:1,proId:pid},
			success : function(data){
				console.log("ratingReviews");
				$(".overlay").hide();
				$("#rating_reviews").html(data);
			}
		})
	}

    gethomeproduts();
    function gethomeproduts(){
		$.ajax({
			url	:	"actionstart.php",
			method:	"POST",
			data	:	{gethomeProduct:1},
			success	:	function(data){
				$("#get_home_product").html(data);
			}
		})
	}
    function producthome(){
		$.ajax({
			url	:	"actionstart.php",
			method:	"POST",
			data	:	{getProducthome:1},
			success	:	function(data){
				$("#get_product_home").html(data);
			}
		})
	}
   
    
/* когда страница успешно загружена, появляется список категорий, когда пользователь нажимает на категорию, мы получаем идентификатор категории и
по id затем показывает товары
	*/
	$("body").delegate(".category","click",function(event){
		event.preventDefault();
		$("#get_product").html("<h3>Загрузка...</h3>");
		
		var cid = $(this).attr('cid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{get_seleted_Category:1,cat_id:cid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})
    

/* когда страница успешно загружена, появляется список брендов, когда пользователь нажимает на бренд, мы получаем идентификатор бренда и
в соответствии с идентификатором бренда показывает товары
	*/
	$("body").delegate(".selectBrand","click",function(event){
		event.preventDefault();
		$("#get_product").html("<h3>Загрузка...</h3>");
		var bid = $(this).attr('bid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{selectBrand:1,brand_id:bid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})
	/*
В верхней части страницы есть окно поиска с кнопкой поиска, когда пользователь вводит название продукта, тогда мы возьмем пользователя
заданная строка, и с помощью запроса sql мы сопоставим заданную пользователем строку со столбцом ключевых слов нашей базы данных, а затем сопоставим продукт
мы покажем
	*/
	$("body").delegate("#search_mb","click",function(event){
		$("#get_product").html("<h3>Загрузка...</h3>");
		var keyword = $("#search").val();
		if(keyword != ""){
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{search:1,keyword:keyword},
			success	:	function(data){ 
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
		}
	})
	//end


	/*
Здесь #login - это идентификатор формы входа, и эта форма доступна на странице index.php.
отсюда входные данные отправляются на страницу login.php
если вы получаете строку login_success со страницы login.php, это означает, что пользователь успешно вошел в систему, а window.location
используется для перенаправления пользователя с домашней страницы на страницу profile.php
	*/
	$("#login").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url	:	"login.php",
			method:	"POST",
			data	:$("#login").serialize(),
			success	:function(data){
				if(data == "login_success"){
					
					window.location.href = "#";
					$("#desc").html("Вы вошли");
					launch_toast();
				}else if(data == "cart_login"){
					window.location.href = "cart.php";
					$("#desc").html("Вы вошли");
					launch_toast();
				}else{
					$("#desc").html(data);
					launch_toast();
					$("#e_msg").html(data);
					$(".overlay").hide();
				}
			}
		})
	})
	//end
	
	//Получить информацию о пользователе перед оформлением заказа
	$("#signup_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "register.php",
			method : "POST",
			data : $("#signup_form").serialize(),
			success : function(data){
				$(".overlay").hide();
				if (data == "register_success") {
					window.location.href = "cart.php";
					$("#desc").html("Вы зарегистрировались");
					launch_toast();
				}else{
					$("#signup_msg").html(data);
				}
				
			}
		})
	})

	$("#review_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "review.php",
			method : "POST",
			data : $("#review_form").serialize(),
			success : function(data){
				$(".overlay").hide();
				$("#review_msg").html(data);
				$('#review_form')[0].reset();
				reviewData();
				$("#desc").html("Отзыв добавлен");
				launch_toast();
			}
		})
	})
	
	
    $("#offer_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "prevmail.php",
			method : "POST",
			data : $("#offer_form").serialize(),
			success : function(data){
				$("#desc").html(data);
				launch_toast();
				$(".overlay").hide();
				
			}
		})
	})
    
    
    
	//Получить информацию о пользователе перед завершением оформления заказа здесь

	//Добавление товаров в корзину

	$("body").delegate("#product","click",function(event){
		var pid = $(this).attr("pid");
		
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {addToCart:1,proId:pid},
			success : function(data){
				$("#desc").html("Добавлено в корзину");
				launch_toast();
				count_item();
				count_wishlist_item();
				getCartItem();
				WishlistDetails();
				$('#product_msg').html(data);
				$('.overlay').hide();
			}
		})
	})

	$("body").delegate("#wishlist","click",function(event){
		var pid = $(this).attr("pid");
		
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {addToWishlist:1,proId:pid},
			success : function(data){
				$("#desc").html("Добавлен в избранное");
				launch_toast();
				count_wishlist_item();
				count_item();
				checkOutDetails();
				$('#product_msg').html(data);
				$('.overlay').hide();
			}
		})
	})
	
	//End Добавить товар в корзину 

	//Функция подсчета товаров в корзине пользователя
	count_item();
	function count_item(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {count_item:1},
			success : function(data){
				$(".badge").html(data);
			}
		})
	}
	count_wishlist_item();
	function count_wishlist_item(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {count_Wishlist_item:1},
			success : function(data){
				$("#wishlist-badge").html(data);
			}
		})
	}
	// End функция подсчета товаров в корзине пользователя

	//Выбрать элемент корзины из базы данных в раскрывающееся меню
	getCartItem();
	function getCartItem(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,getCartItem:1},
			success : function(data){
				$("#cart_product").html(data);
                net_total();
                
			}
		})
	}

	//Выбрать элемент корзины из базы данных в раскрывающееся меню

	/*
Всякий раз, когда пользователь меняет количество, мы немедленно обновляем их общую сумму с помощью функции keyup.
но всякий раз, когда пользователь помещает что-то (например, ?''"",.()''и т. д.), отличное от числа, мы делаем qty=1
если пользователь поставил qty 0 или меньше 0, то мы снова сделаем его 1 qty=1
('.total').each() это повторение функции цикла для класса .total, и при каждом повторении мы будем выполнять операцию суммирования значения класса .total
а затем показать результат в классе .net_total
	*/

	$("body").delegate(".qty","keyup",function(event){
		event.preventDefault();
		var row = $(this).parent().parent();
		var price = row.find('.price').val();
		var qty = row.find('.qty').val();
		if (isNaN(qty)) {
			qty = 1;
		};
		if (qty < 1) {
			qty = 1;
		};
		var total = price * qty;
		row.find('.total').val(total);
		var net_total=0;
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').html("Итого : BYN " +net_total);

	})
	//End Изменить количество

	/*
		Всякий раз, когда пользователь нажимает на класс .remove, мы берем идентификатор продукта этой строки
и отправьте его в action.php для выполнения операции удаления продукта
	*/

	   
    $("body").delegate(".remove","click",function(event){
        var remove = $(this).parent().parent().parent();
		var remove_id = remove.find(".remove").attr("remove_id");
		
        $.ajax({
            url	:	"action.php",
            method	:	"POST",
            data	:	{removeItemFromCart:1,rid:remove_id},
            success	:	function(data){
				$("#desc").html("Товар удалён");
				launch_toast();
                $("#cart_msg").html(data);
				checkOutDetails();
				count_item();
                }
            })
	})
	
	$("body").delegate(".wishlist-remove","click",function(event){
        var remove = $(this).parent().parent().parent();
		var remove_id = remove.find(".wishlist-remove").attr("remove_id");
        $.ajax({
            url	:	"action.php",
            method	:	"POST",
            data	:	{removeItemFromwishList:1,rid:remove_id},
            success	:	function(data){
				$("#desc").html("Товар удалён");
				launch_toast();
                $("#cart_msg").html(data);
                WishlistDetails();
                }
            })
    })
    
    
	/*
Всякий раз, когда пользователь нажимает на класс .update, мы берем идентификатор продукта этой строки
и отправьте его в action.php для выполнения операции обновления количества продукта.
	*/

	$("body").delegate(".update","click",function(event){
		var update = $(this).parent().parent().parent();
		var update_id = update.find(".update").attr("update_id");
		var qty = update.find(".qty").val();
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{updateCartItem:1,update_id:update_id,qty:qty},
			success	:	function(data){
				$("#desc").html("Корзина обновлена");
				launch_toast();
				$("#cart_msg").html(data);
				checkOutDetails();
			}
		})


	})
	checkOutDetails();
	WishlistDetails();
	net_total();
	/*

Функция checkOutDetails() работает для двух назначений.
Сначала он включит php isset($_POST["Common"]) на странице action.php и внутри нее
есть две функции isset: isset($_POST["getCartItem"]) и isset($_POST["checkOutDetials"])
getCartItem используется для отображения элемента корзины в раскрывающемся меню.
checkOutDetails используется для отображения элемента корзины на странице Cart.php.
	*/
	function checkOutDetails(){
	 $('.overlay').show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,checkOutDetails:1},
			success : function(data){
				$('.overlay').hide();
				$("#cart_checkout").html(data);
					net_total();
			}
		})
	}

	function WishlistDetails(){
		$('.overlay').show();
		   $.ajax({
			   url : "action.php",
			   method : "POST",
			   data : {wishListCommon:1, wishlistDetails:1},
			   success : function(data){
				   $('.overlay').hide();
				   $("#wishlist_data").html(data);
					   net_total();
			   }
		   })
	   }
	/*
		net_total функция используется для расчета общей суммы товара в корзине
	*/
	function net_total(){
		var net_total = 0;
		$('.qty').each(function(){
			var row = $(this).parent().parent();
			var price  = row.find('.price').val();
			var total = price * $(this).val()-0;
			row.find('.total').val(total);
		})
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').html("Итого : BYN " +net_total);
	}

	//удалить товар из корзины

	page();
	function page(){
		var cat_id = $('#pageno').attr("cid");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{page:1,cid:cat_id},
			success	:	function(data){
				$("#pageno").html(data);
			}
		})
	}
	$("body").delegate("#page","click",function(){
		var pn = $(this).attr("page");
		var cat_id = $(this).attr("cid");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{getProduct:1,setPage:1,pageNumber:pn,cid:cat_id},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	})
})






















