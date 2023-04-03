<?php
session_start();
include("../../db.php");

$product_id=$_REQUEST['product_id'];

$result=mysqli_query($con,"SELECT `product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_pr` from products  where product_id='$product_id'") or die ("query 1 incorrect.......");

list($product_id,$product_type,$brand,$product_name,$price,$details,$pic_name,$tags)=mysqli_fetch_array($result);

if(isset($_POST['mb_save']))
{
$product_name=$_POST['product_name'];
$details=$_POST['details'];
$price=$_POST['price'];
$product_type=$_POST['product_type'];
$brand=$_POST['brand'];
$tags=$_POST['tags'];
$price=$_POST['price'];

//Кодирование картинки
$picture_name=$_FILES['picture']['name'];
$picture_type=$_FILES['picture']['type'];
$picture_tmp_name=$_FILES['picture']['tmp_name'];
$picture_size=$_FILES['picture']['size'];

if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")
{
	if($picture_size<=50000000)
	
		$pic_name=time()."_".$picture_name;
        move_uploaded_file($picture_tmp_name,"../../product_images/".$pic_name);
        mysqli_query($con,"UPDATE `products` SET `product_title` = '$product_name', 
        `product_cat`= '$product_type',`product_brand`='$brand',
        `product_price`='$price',`product_desc`='$details',`product_image`='$pic_name',`product_pr`='$tags' WHERE `product_id` = '$product_id'") or die("Query 2 is inncorrect..........");
    header("location: products_list.php");
   
}else{
    mysqli_query($con,"UPDATE `products` SET `product_title` = '$product_name', 
        `product_cat`= '$product_type',`product_brand`='$brand',
        `product_price`='$price',`product_desc`='$details',`product_image`='$pic_name',`product_pr`='$tags' WHERE `product_id` = '$product_id'") or die("Query 2 is inncorrect..........");
    header("location: products_list.php");
}


mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
          <div class="row">
          
                
         <div class="col-md-7">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Редактировать товар</h5>
              </div>
              <div class="card-body">
                
                  <div class="row">
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Название товара</label>
                        <input type="text" id="product_name" required name="product_name" value="<?php echo $product_name; ?>" class="form-control">
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                    <img src='<?php echo "../../product_images/".$pic_name?>' style='width:50px; height:50px; border:groove #000'>
                      <div class="ml-image-1">
                        <label for="">Добавить картинку</label>
                        <input type="file" name="picture"  class="mb mb-fill mb-success" value="<?php echo "../../product_images/".$pic_name?>" id="picture" >
                      </div>
                    </div>
                     <div class="col-md-12">
                      <div class="form-group">
                        <label>Описание</label>
                        <textarea rows="4" cols="80" id="details" required name="details"  class="form-control"><?php echo $details;?></textarea>
                      </div>
                    </div>
                  
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Стоимость</label>
                        <input type="text" id="price" name="price" value="<?php echo $price ?>" required class="form-control" >
                      </div>
                    </div>
                  </div>
                 
                  
                
              </div>
              
            </div>
          </div>
          <div class="col-md-5">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Категории</h5>
              </div>
              <div class="card-body">
                
                  <div class="row">
                  <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Категории товаров</label>
                            <select id="product_type" name="product_type"  required class="form-control">
                            <option value="" style="color:black;">Выберите категорию</option>
                            <?php 
                                
                                    $result1=mysqli_query($con,"SELECT * FROM `categories` ORDER BY `cat_id` ASC") or die ("query 1 incorrect.....");

                                    while(list($cat_id,$cat_title)=mysqli_fetch_array($result1))
                                    {
                                    
                                        if($cat_id==$product_type){
                                            echo "<option value='$cat_id' style='color:black;' selected>$cat_title</option>";
                                        }else{
                                            echo "<option value='$cat_id' style='color:black;'>$cat_title</option>";
                                        }
                                    }
                                    
                                ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Название компании</label>
                            <select id="brand" name="brand" required class="form-control">
                            <option value="" style="color:black;">Выберите компанию</option>
                                <?php
                                    $result2=mysqli_query($con,"SELECT * FROM `brands`") or die ("query 1 incorrect.....");

                                    while(list($brand_id,$brand_title)=mysqli_fetch_array($result2))
                                    {
                                        if($brand_id==$brand){
                                            echo "<option value='$brand_id' style='color:black;' selected>$brand_title</option>";
                                        }else{
                                            echo "<option value='$brand_id' style='color:black;'>$brand_title</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                      <div class="form-group">
                        <label>Дополнительное описание</label>
                        <input type="text" id="tags" name="tags" value="<?php echo $tags; ?>" required class="form-control" >
                      </div>
                    </div>
                  </div>
                
              </div>
              <div class="card-footer">
                  <button type="submit" id="mb_save" name="mb_save" required class="mb mb-fill mb-primary">Добавить</button>
              </div>
            </div>
          </div>
          
        </div>
         </form>
          
        </div>
      </div>
      <?php
include "footer.php";
?>