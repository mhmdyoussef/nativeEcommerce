<?php
// requirement files
require_once 'init.php';

// session start
session_start();

$session_id = $_SESSION['session_id'];

// add to cart handling
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {

    $product_id = $_POST['product_id'];
    $quantity =  $_POST['quantity'];
    $sql_query = makeDBQuery("SELECT * FROM cart WHERE product_id = $product_id AND session_id = '" . $session_id . "'");
    if (count($sql_query) > 1) {
        makeDBQuery("DELETE FROM cart WHERE product_id = $product_id AND session_id = '" . $session_id . "'");
        makeDBQuery("REPLACE INTO cart (`product_id`,`session_id`,`quantity`) VALUE ($product_id, '" . $session_id . "', $quantity)");
    } else if(count($sql_query) == 1) {
        $row_id = $sql_query[0]['id'];
        $query_to_save_product_to_cart = makeDBQuery("REPLACE INTO cart (`id`,`product_id`,`session_id`,`quantity`) VALUE ($row_id, $product_id, '" . $session_id . "', $quantity)");
    } else {
        makeDBQuery("INSERT INTO cart (`product_id`,`session_id`,`quantity`) VALUE ($product_id, '" . $session_id . "', $quantity)");
    }
}

$products_in_cart = makeDBQuery("SELECT * FROM cart WHERE session_id = '" . $session_id . "'");

$products = array();
$sub_total = (float) 0;
$total = '';

// shipping cost
$shipping_cost = 10;

if (!empty($products_in_cart)) {
    foreach ($products_in_cart as $product) {
        $products_details = makeDBQuery("SELECT * FROM products WHERE id = " . $product['product_id']);

        foreach ($products_details as $item) {

            $products[] = array(
                'id' => $item['id'],
                'name' => $item['name'],
                'total' => $item['price'] * $product['quantity'],
                'price' => $item['price'],
                'image' => $item['image'],
                'quantity' => $product['quantity'],
            );
        }
    }

    
    foreach($products as $product) {
        $sub_total += $product['total'];
    }

    $total = number_format($sub_total + $shipping_cost, 2);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['email'])) {

    // customer details
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $telephone = (int) $_POST['telephone'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // shipping details
    $address = htmlspecialchars($_POST['address']);
    $city = $_POST['city'];
    $country = $_POST['country'];
    $payment_type = 'Express delivery';
    $shipping_type = 'COD';

    $products_id = [];

    foreach ($products as $product) {
        $product_id[] = [$product['id'], $product['quantity']];
    }

    $products_serilazation = json_encode($product_id);

    $order_id = makeDBQuery("INSERT INTO shop.orders (`products_id`, `payment_type`, `shipping_type`, `sub_total`, `shipping_fee`, `total`, `address`, `city`, `country`, `customer_first_name`, `customer_last_name`, `customer_email`, `customer_telephone`, `date_added`) VALUES ('$products_serilazation', '$payment_type', '$shipping_type', $sub_total, $shipping_cost, $total, '$address', '$city', '$country', '$first_name', '$last_name', '$email', '$telephone', current_timestamp());", true);
    
    if (is_numeric($order_id)) {
        var_dump($order_id, $telephone);
        makeDBQuery("DELETE FROM cart WHERE session_id = '" . $_SESSION['session_id'] . "'");
        unset($_SESSION['session_id']);
        $_SESSION['order_id'] = $order_id;
        header("LOCATION: checkout.php");
    }   
} 



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

<section class="bg-light py-5">
  <div class="container">
    <div class="row text-center">
        <?php
            if (!empty($_POST['product_id']))  {
            ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <p calss="p-5 bg-light">Product has been added to cart!</p>
                </div>
            <?php
            }
        ?>
    </div>
    <div class="row">
      <div class="col-xl-8 col-lg-8 mb-4">
        <form action="" method="POST">
        <!-- Checkout -->
        <div class="card shadow-0 border">
          <div class="p-4">
            <h2 class="card-title mb-3">Checkout</h2>
            <div class="row">
              <div class="col-6 mb-3">
                <p class="mb-0">First name</p>
                <div class="form-outline">
                  <input type="text" id="typeText" name="first_name" placeholder="First name" class="form-control" required />
                </div>
              </div>

              <div class="col-6">
                <p class="mb-0">Last name</p>
                <div class="form-outline">
                  <input type="text" id="typeText" name="last_name" placeholder="Last name" class="form-control" required />
                </div>
              </div>

              <div class="col-6 mb-3">
                <p class="mb-0">Phone</p>
                <div class="form-outline">
                  <input type="text" id="typePhone" name="telephone" placeholder="+987 654 321 4321" class="form-control" required />
                </div>
              </div>

              <div class="col-6 mb-3">
                <p class="mb-0">Email</p>
                <div class="form-outline">
                  <input type="email" id="typeEmail" name="email" placeholder="example@gmail.com" class="form-control" required />
                </div>
              </div>
            </div>

            <hr class="my-4" />

            <h5 class="card-title mb-3">Shipping & Payment info</h5>

            <div class="row mb-3">
              <div class="col-lg-6 mb-3">
                <!-- Default checked radio -->
                <div class="form-check h-100 border rounded-3">
                  <div class="p-3">
                    <input class="form-check-input" type="checkbox" name="shipping" id="flexRadioDefault1" checked />
                    <label class="form-check-label" for="flexRadioDefault1">
                      Express delivery <br />
                      <small class="text-muted">3-4 days via Fedex </small>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 mb-3">
                <!-- Default radio -->
                <div class="form-check h-100 border rounded-3">
                  <div class="p-3">
                    <input class="form-check-input" type="checkbox" name="payment" id="flexRadioDefault2" checked />
                    <label class="form-check-label" for="flexRadioDefault2">
                      Payment <br />
                      <small class="text-muted">Cash on Delevery</small>
                    </label>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-sm-12 mb-3">
                <p class="mb-0">Address</p>
                <div class="form-outline">
                  <input type="text" id="typeText" name="address" placeholder="Type here" class="form-control" required />
                </div>
              </div>

              <div class="col-sm-6 mb-3">
                <p class="mb-0">City</p>
                <select name="city" class="form-select">
                  <option value="New York">New York</option>
                  <option value="Moscow">Moscow</option>
                  <option value="Samarqand">Samarqand</option>
                </select>
              </div>

              <div class="col-sm-6 mb-3">
                <p class="mb-0">Country</p>
                <select name="country" class="form-select">
                  <option value="Tunisia">Tunisia</option>
                  <option value="Morocco">Morocco</option>
                  <option value="Libya">Libya</option>
                </select>
              </div>
            </div>

            <div class="float-end text-center mt-5">
              <button class="btn btn-light border col-4">Continue Shopping</button>
              <button class="btn btn-success shadow-0 border col-4" type="submit">Continue</button>
            </div>
          </div>
        </div>
        </form>
        <!-- Checkout -->
      </div>
      <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
        <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
        <strong><h4 class="text-dark my-4">Items in cart</h6></strong>

          <?php
            foreach ($products as $product) {
            ?>
                <div class="d-flex align-items-center mb-4">
                    <div class="me-3 position-relative" style="margin-right: 8px;">
                      <!-- <span class="position-absolute top-100 start-100 translate-middle badge rounded-pill badge-secondary"><?= $product['quantity']; ?></span> -->
                      <img src="<?= $product['image']; ?>" width="60" class="img-sm rounded border" />
                    </div>
                    <div class="position-relative">
                        <p><?= $product['name']; ?></p>
                        <div class="price text-muted">Item Price: $<?= number_format($product['price'], 2) . " x " . $product['quantity']; ?></div>
                    </div>
              </div>
            <?php
            }
          ?>

          <hr/>
          <strong><h4 class="mb-3">Summary</h6></strong>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Sub-Total:	</p>
            <p class="mb-2">$<?= number_format($sub_total, 2); ?></p>
          </div>
          <!-- <div class="d-flex justify-content-between">
            <p class="mb-2">Discount:</p>
            <p class="mb-2 text-danger">- $60.00</p>
          </div> -->
          <div class="d-flex justify-content-between">
            <p class="mb-2">Shipping cost: </p>
            <p class="mb-2">+ $<?= number_format($shipping_cost, 2); ?></p>
          </div>
          <hr />
          <div class="d-flex justify-content-between">
            <p class="mb-2">Total price: </p>
            <p class="mb-2 fw-bold">$<?= number_format($total, 2); ?></p>
          </div>

          <div class="input-group mt-3 mb-4">
            <input type="text" class="form-control border" name="" placeholder="Promo code" />
            <button class="btn btn-light text-primary border">Apply</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

   <!--  footer -->
   <?php include_once 'assets/common/footer.php'; ?>
   <!-- end footer -->
</body>

</html>