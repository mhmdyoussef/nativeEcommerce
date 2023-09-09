<?php

// session start
session_start();

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
      <!-- end header -->
      <div class="blue_bg">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>About</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section -->
      <div class="about">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="about_text">
                     <h3>The standard Lorem Ipsum </h3>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                     <a class="read_more" href="#">Read More</a>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="about_img">
                     <figure><img src="images/black-red.png" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <!--  footer -->
   <?php include_once 'assets/common/footer.php'; ?>
   <!-- end footer -->