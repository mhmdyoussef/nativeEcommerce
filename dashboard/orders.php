<?php
require_once '../init.php';

session_start();
if (empty($_SESSION['user_role'])) {
    header("LOCATION: ../dashboard/login.php");
}

require_once 'assets/common/header.php';

$orders = makeDBQuery("SELECT * FROM orders");

?>


<section class="intro">
    <div class="row text-center">
        <?php
            if (empty($orders)) {
            ?>
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="info:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>No Orders has been added yet!</div>
                </div>
            <?php
            }

        ?>
    </div>
  <div class="bg-image h-100">
    <div class="mask d-flex align-items-center h-50">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-borderless mb-0">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">OrderID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date</th>
                        <th scope="col">View</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orders as $order) {
                            ?>
                                <tr class="text-center">
                                <td>#<?= $order['id'] ?></td>
                                <td><?= $order['customer_first_name'] . " " . $order['customer_last_name'] ?></td>
                                <td>$<?= number_format($order['total'], 2) ?></td>
                                <td>$<?= $order['date_added'] ?></td>
                                <td>
                                    <form action="../dashboard/order_info.php" method="GET">
                                        <input type="number" name="order_id" value="<?= $order['id']; ?>" hidden />
                                        <button type="submit" class="btn btn-primary btn-sm px-5" style="padding: 10px">
                                        <i class="fa-solid fa-eye" style="color: #ffffff;"></i>
                                        </button>
                                    </form>
                                </td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once 'assets/common/footer.php';
?>