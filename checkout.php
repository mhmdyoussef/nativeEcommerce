<?php
// requirement files
require_once 'init.php';

// session start
session_start();
$order_id = $_SESSION['order_id'];
session_destroy();

if (isset($order_id)) {

    $order_details = makeDBQuery("SELECT * FROM orders WHERE id = " . $order_id);

    $product_ids = json_decode($order_details[0]['products_id']);

    $product_details = array();

    foreach ($product_ids as $product) {
        $product_query = makeDBQuery("SELECT * FROM products WHERE id = " . $product[0]);

        foreach ($product_query as $item) {
            $product_details[] = array(
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'image' => $item['image'],
                'quantity' => $product[1],
            );
        }
    }

}


?>

<!-- header -->
<?php include_once 'assets/common/header.php'; ?>
<!-- header -->

<!-- body -->

<body class="main-layout footer_to90 project_page">
    <!-- loader  -->
    <!-- <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
   </div> -->
    <!-- end loader -->
    <!-- topbar -->
    <?php include_once 'assets/common/topbar.php'; ?>
    <!-- topbar -->

    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5 text-center"> <img src="images/7efs.gif" width="250"> </div>
                    <div class="invoice p-5">
                        <h3 class="text-center text-success">Your order Confirmed!</h3> <span class="font-weight-bold d-block mt-4">Hello, <?= $order_details[0]['customer_first_name']; ?></span>
                        <span>You order has been confirmed and will be shipped in next two days!</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order Date</span>
                                                <span><?= $order_details[0]['date_added'] ?></span> </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order No</span>
                                                <span>MT00<?= $order_details[0]['id'] ?></span> </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Payment</span>
                                                <span><?= $order_details[0]['shipping_type'] ?></span> 
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Shiping Address</span>
                                                <span><?= $order_details[0]['address'] . ", " . $order_details[0]['city'] . ", " . $order_details[0]['country'] ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <?php
                                        foreach ($product_details as $item) {
                                            ?>
                                            <tr>
                                                <td width="20%"> <img src="<?= $item['image'] ?>" width="90"> </td>
                                                <td width="60%"> <span class="font-weight-bold"><?= $item['name'] ?></span>
                                                    <div class="product-qty"> <span class="d-block">Quantity: <?= $item['quantity'] ?></span>
                                                        
                                                </td>
                                                <td width="20%">
                                                    <div class="text-right"> <span class="font-weight-bold">$<?= number_format($item['price'], 2) ?></span> </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>$<?= number_format($order_details[0]['sub_total'], 2) ?></span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Shipping Fee</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>$<?= number_format($order_details[0]['shipping_fee'], 2) ?></span> </div>
                                            </td>
                                        </tr>
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left"> <span class="font-weight-bold">Subtotal</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="font-weight-bold">$<?= number_format($order_details[0]['total'], 2) ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                        <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> 
                    </div>
                    <div class="d-flex justify-content-between footer p-3"> <span>Need Help? visit our <a href="#"> help
                                center</a></span> <span><?= $order_details[0]['date_added'] ?></span> </div>
                </div>
            </div>
        </div>
    </div>

    <!--  footer -->
    <?php include_once 'assets/common/footer.php'; ?>
    <!-- end footer -->
</body>

</html>