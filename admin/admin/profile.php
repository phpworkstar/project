
  <?php
 session_start();
include("./includes/db.php");
if (isset($_POST['re_password']))
  {
  $email=$_SESSION['admin_email'];
  $old_pass = $_POST['old_pass'];
  $oldp = md5($old_pass);
  $new_pass = $_POST['new_pass'];
  $re_pass = $_POST['re_pass'];
  $password_query = mysqli_query($con,"select * from admin_info where admin_email='$email'");
  $password_row = mysqli_fetch_array($password_query);
  $database_password = $password_row['admin_password'];
  if ($database_password == $oldp)
    {
    if ($new_pass == $re_pass)
      {
        $pass = md5($re_pass);
      $update_pwd = mysqli_query($con,"UPDATE admin_info set admin_password='$pass' where admin_id='1'");
      echo "<script>alert('Новые данные сохранены'); </script>";
      }
      else
      {
      echo "<script>alert('Ваш старый и новый пароль не совпадают'); </script>";
      }
    }
    else
    {
    echo "<script>alert('Вы ввели неправильный старый пароль'); </script>";
    }
  }
 
include "sidenav.php";
include "topheader.php";

?>
      <!-- End Navbar -->
   <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Редактировать профиль</h4>
                  <p class="card-category">Заполните свой профиль</p>
                </div>
                <div class="card-body">
                  <form method="post" action="profile.php">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">
                            <?php  if (isset($_SESSION['admin_name'])) : ?><?php echo $_SESSION['admin_name']; ?>
             <?php endif ?>
                          
                        </label>
                          <input type="text" class="form-control" disabled="">
                        </div>
                      </div>
                     <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Введите старый пароль</label>
                          <input type="text" class="form-control" name="old_pass" id="npwd">
                        </div>
                      </div>
                    
                  
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Новый пароль</label>
                          <input type="text" class="form-control" name="new_pass" id="npwd">
                        </div>
                      </div>
                     
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Подтвердите новый пароль</label>
                          <input type="text" class="form-control" name="re_pass" id="npwd">
                        </div>
                      </div>
               
                    <button class="mb mb-primary pull-right" type="submit" name="re_password">Обновить профиль</button>
                   
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
         
          </div>
        </div>
      </div>
      <?php
include "footer.php";
?>