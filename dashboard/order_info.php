<?php
require_once '../init.php';

session_start();
if (empty($_SESSION['user_role'])) {
    header("LOCATION: ../dashboard/login.php");
}

require_once 'assets/common/header.php';

if (isset($_GET['order_id'])) {

    $order_id = $_GET['order_id'];

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

<div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5 text-center">
                    <div class="invoice p-5">
                        <h3 class="text-center text-primary">Order #<?= $order_id; ?></h3>

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
                                                <span><?= $order_details[0]['payment_type'] ?></span> 
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
                                                <td width="20%"> <img src="../<?= $item['image'] ?>" width="90"> </td>
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
                                        <!-- <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>$7.65</span> </div>
                                            </td>
                                        </tr> -->
                                        <!-- <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="text-success">$168.50</span>
                                                </div>
                                            </td>
                                        </tr> -->
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


<?php
require_once 'assets/common/footer.php';
?>