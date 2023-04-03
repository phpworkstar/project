  <?php 
include("../../db.php");
 
  ?>

  <div class="row" style="padding-top: 10vh;">
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                      <i class="material-icons">content_copy</i>
                  </div>
                  <p class="card-category">Всего клиентов</p>
                  <h3 class="card-title">
                      <?php  $query = "SELECT user_id FROM user_info"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // Возвращает количество строк в таблице.
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // Закрыть результат. 
                        }  ?>
                  </h3>
              </div>

          </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                      <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Всего категорий</p>
                  <h3 class="card-title"> <?php  $query = "SELECT cat_id FROM categories"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                    { 
                        // Возвращает количество строк в таблице.
                        $row = mysqli_num_rows($result); 
                          
                        printf(" " . $row); 
                    
                        // Закрыть результат. 
                    } ?></h3>
              </div>

          </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                      <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">Всего продаж</p>
                  <h3 class="card-title"><?php  $query = "SELECT user_id FROM user_info"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                    { 
                        // Вернуть количество строк в таблице.
                        $row = mysqli_num_rows($result); 
                          
                        printf(" " . $row); 
                    
                        // Закрыть результат. 
                    } ?></h3>
              </div>

          </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                  <i class="material-icons">analytics</i>
                  </div>
                  <p class="card-category">Всего заказов</p>
                  <h3 class="card-title"><?php  $query = "SELECT order_id FROM orders_info"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // Вернуть количество строк в таблице.
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // Закрыть результат.  
                        }  ?></h3>
              </div>

          </div>
      </div>
  </div>