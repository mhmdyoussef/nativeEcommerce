<?php
require_once "init.php";

// session start
session_start();

   $products = makeDBQuery('SELECT * FROM products ORDER BY id DESC');

?>

<!-- header -->
<?php include_once 'assets/common/header.php'; ?>
<!-- header -->

<!-- body -->
<body class="main-layout footer_to90 project_page">
   <!-- loader  -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
   </div>
   <!-- end loader -->
   <!-- topbar -->
   <?php include_once 'assets/common/topbar.php'; ?>
   <!-- topbar -->
      <div class="blue_bg">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Rents Products</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- project section -->
      <div id="project" class="project">
      <div class="container">
      <div class="row">
            <div class="product_main">
               <?php
                  if (!empty($products)) {
                     foreach($products as $product) {
                        ?>
                           <div class="project_box ">
                              <a href="product.php?product_id=<?= $product['id']; ?>">
                                 <div class="dark_white_bg"><img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>" /></div>
                                 <h3><?= $product['name']; ?></h3>
                              </a>
                              <p></p>$<?= $product['price']; ?></p>
                              <div class="mt-3">
                                 <form action="cart.php" method="post">
                                    <input type="text" name="product_id" value="<?= $product['id']; ?>" hidden />
                                    <div class="form-outline" style="width: 4rem;">
                                       <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" />
                                       <button id="addToCart" class="btn btn-success" type="submit">Buy Now</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        <?php
                     }
                  }
               ?>

               <div class="col-md-12">
                  <a class="read_more" href="#">See More</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--  footer -->
   <?php include_once 'assets/common/footer.php'; ?>
   <!-- end footer -->
