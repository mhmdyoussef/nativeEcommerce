<?php
// database conection
require_once '../init.php';

// starting session
session_start();
if (empty($_SESSION['user_role'])) {
    header("LOCATION: ../dashboard/login.php");
}

// add header
require_once 'assets/common/header.php';

$products_list = makeDBQuery("SELECT * FROM products");

$product_id = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $product_id = (int) $_POST['delete'];
    makeDBQuery("DELETE FROM products WHERE id = " . $product_id);
    header("LOCATION: ../dashboard/products.php");

}


?>


<section class="intro">
    <div class="row text-center">
        <?php
            if ($product_id != 0)  {
            ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>Product has been removed!</div>
                </div>
            <?php
            } 

            if (empty($products_list)) {
            ?>
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="info:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>No Product has been added yet!</div>
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
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products_list as $product) {
                            ?>
                                <tr class="text-center">
                                <td><img src="../<?= $product['image']; ?>" height="60" /></td>
                                <td><?= $product['name']; ?></td>
                                <td>$<?= number_format($product['price'], 2); ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="number" name="delete" value="<?= $product['id']; ?>" hidden />
                                        <button type="submit" class="btn btn-danger btn-sm px-5" style="padding: 10px">
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
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
include_once 'assets/common/footer.php';
?>