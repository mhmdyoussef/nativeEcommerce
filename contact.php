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
      <!-- banner -->
      <div class="blue_bg">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Contact Us</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section -->
      <div id="contact" class="contact">
         <div class="con_bg">
            <div class="container">
               <div class="row">
                  <div class="col-md-10 offset-md-1">
                     <form id="request" class="main_form">
                        <div class="row">
                           <div class="col-md-6 col-sm-6">
                              <input class="contactus" placeholder="Name" type="type" name="Name"> 
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number"> 
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <input class="contactus" placeholder="Email" type="type" name="Email">                          
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <input class="contactus" placeholder="Address" type="type" name="Address">                          
                           </div>
                           <div class="col-md-12">
                              <input class="contactusmess" placeholder="Message" type="type" Message="Name">
                           </div>
                           <div class="col-md-12">
                              <button class="send_btn">Send</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <!--  footer -->
   <?php include_once 'assets/common/footer.php'; ?>
   <!-- end footer -->

