<?php
require_once '../init.php';

session_start();
if (empty($_SESSION['user_role'])) {
    header("LOCATION: ../dashboard/login.php");
}

require_once 'assets/common/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = htmlspecialchars($_POST['name']);
    $product_price = (float) $_POST['price'];
    $product_image = 'images/' . $_POST['image'];

    if (!empty($product_name) && !empty($product_price) && !empty($product_image)) {
        $status = makeDBQuery("INSERT INTO products (`name`, `price`, `image`) VALUE ('" . $product_name . "', " . (float) $product_price . ", '" . $product_image . "')", true);
    } else {
        $status = null;
    }

    print_r($saved_product);
}

?>

<section calss="mt-5">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
      <?php
            if (!is_null($status))  {
            ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>Product has been Saved!</div>
                </div>
            <?php
            }
        ?>
        <div class="row justify-content-center">
            <h2 class="col-6 text-danger text-center bg-warning rounded mb-5 p-2">Add New Product</h3>
            <form action="" method="POST">

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example3" name="name" class="form-control" required />
                <label class="form-label" for="form6Example3">Product Name</label>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example4" name="price" min="0" class="form-control" required />
                <label class="form-label" for="form6Example4">Price</label>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example5" name="image" class="form-control" required />
                <label class="form-label" for="form6Example5">Image Name</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="col-4 btn btn-success btn-block mb-4 p-3"><i class="fa-regular fa-floppy-disk" style="color: #ffffff;"></i> Save Product</button>
            </form>
    </div>
      </div>
        </div>
</section>



<?php
include_once 'assets/common/footer.php';
?>