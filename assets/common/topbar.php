<?php
   if ($_SERVER['REQUEST_URI']) {
      
      $pages = ['home', 'about', 'products', 'contact'];

      $page_name = explode('/', $_SERVER['REQUEST_URI']);
      $current_page_index = array_key_last($page_name);
      $page_name = str_replace('.php', '', $page_name[$current_page_index]);
   }
?>
   <!-- body -->
   <body class="main-layout footer_to90 about_page">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="header_top d_none1">
               <div class="container">
                  <div class="row">
                     <div class="col-md-4">
                        <ul class="conta_icon">
                           <li><a href="#"><img src="images/call.png" alt="#"/>Call us: 94-965-322</a> </li>
                        </ul>
                     </div>
                     <div class="col-md-4">
                        <ul class="social_icon">
                           <li> <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>
                              </a>
                           </li>
                           <li> <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-4">
                        <div class="se_fonr1">
                           <form action="#" >
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header_midil">
               <div class="container">
                  <div class="row d_flex">
                     <div class="col-md-4">
                        <ul class="conta_icon d_none1">
                           <li><a href="#"><img src="images/email.png" alt="#"/> rayenmezrigui0@gmail.com</a> </li>
                        </ul>
                     </div>
                     <div class="col-md-4">
                        <a class="logo" href="home.php"><img src="images/logo.jpg" alt="#"/></a>
                     </div>
                     <div class="col-md-4">
                        <ul class="right_icon d_none1">
                           <li><a href="cart.php"><img src="images/shopping.png" alt="#"/></a> </li>
                           <a href="cart.php" class="order">Order Now</a> 
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header_bottom">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="navbar-toggler-icon"></span>
                           </button>
                           <div class="collapse navbar-collapse" id="navbarsExample04">
                              <ul class="navbar-nav mr-auto">
                              <?php
                                 
                                 foreach ($pages as $page) {
                                    if ($page_name == $page) {
                                    ?>
                                       <li class="nav-item active">
                                          <a class="nav-link" href="<?= $page; ?>.php"><?= ucfirst($page); ?></a>
                                       </li>
                                    <?php
                                    } else {
                                    ?>
                                       <li class="nav-item ">
                                          <a class="nav-link" href="<?= $page; ?>.php"><?= ucfirst($page); ?></a>
                                       </li>
                                    <?php
                                    }
                                 }
                              ?>
                              </ul>
                           </div>
                        </nav>
                     </div>
                     <div class="col-md-4">
                        <div class="search">
                           <form action="/action_page.php">
                              <input class="form_sea" type="text" placeholder="Search" name="search">
                              <button type="submit" class="seach_icon"><i class="fa fa-search"></i></button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header -->