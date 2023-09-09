<?php
?>

<!DOCTYPE>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="MY-Dev">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body style="position: relative;">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../dashboard/index.php">
        <img src="../images/dashboard-alt-svgrepo-com.svg" width="38" height="40" class="me-3" alt="Bootstrap">
        Dashboard
    </a>
    <?php
    if ($_SESSION['user_role'] == 'admin') {
        ?>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../images/product-guide-svgrepo-com.svg" width="38" height="30" class="" alt="Bootstrap">
                    Products
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="products.php">Products List</a></li>
                    <li><a class="dropdown-item" href="product_form.php">Add product</a></li>
                </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../images/cart-check-svgrepo-com.svg" width="38" height="30" class="" alt="Bootstrap">
                    Orders
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="orders.php">Orders List</a></li>
                </ul>
                </li>
            </ul>
            </div>
            <a class="navbar-brand" href="../dashboard/logout.php">
                Logout
                <img src="../images/logout-svgrepo-com.svg" width="38" height="40" class="me-3" alt="Bootstrap">
            </a>
        <?php
    }
    ?>
</div>
</nav>