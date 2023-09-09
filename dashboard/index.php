<?php
// requirement files
require_once '../init.php';

// session start
session_start();

if (empty($_SESSION['user_role'])) {
    header("LOCATION: ../dashboard/login.php");
}

require_once 'assets/common/header.php';

$products_on_store = makeDBQuery("SELECT COUNT(*) AS total_products FROM products");
$orders_on_store = makeDBQuery("SELECT COUNT(*) AS total_order FROM orders");
$total_orders_amount = makeDBQuery("SELECT SUM(total) AS total FROM orders");
$total_sales = '$' . number_format($total_orders_amount[0]['total'], 2);


?>
<div class="container">
    <div class="row mt-5">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.8.13/tailwind.min.css" />
        <section class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full max-w-6xl" >
            <div class="relative p-5 bg-gradient-to-r from-teal-400 to-green-500 rounded-md overflow-hidden">
            <div class="relative z-10 mb-4 text-white text-4xl leading-none font-semibold"><?= $total_sales ?></div>
            <div class="relative z-10 text-green-200 leading-none font-semibold">Total Sales</div>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="absolute right-0 bottom-0 h-32 w-32 -mr-8 -mb-8 text-green-600 opacity-50">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            </div>
            <div class="relative p-5 bg-gradient-to-r from-blue-400 to-blue-600 rounded-md overflow-hidden">
            <div class="relative z-10 mb-4 text-white text-4xl leading-none font-semibold"><?= $orders_on_store[0]['total_order'] ?></div>
            <div class="relative z-10 text-blue-200 leading-none font-semibold">Orders</div>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="absolute right-0 bottom-0 h-32 w-32 -mr-8 -mb-8 text-blue-700 opacity-50">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            </div>
            <div class="relative p-5 bg-gradient-to-r from-red-400 to-red-600 rounded-md overflow-hidden">
            <div class="relative z-10 mb-4 text-white text-4xl leading-none font-semibold"><?= $products_on_store[0]['total_products'] ?></div>
            <div class="relative z-10 text-red-200 leading-none font-semibold">Products</div>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="absolute right-0 bottom-0 h-32 w-32 -mr-8 -mb-8 text-red-700 opacity-50">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            </div>
        </section>
    </div>
</div>
<?php
require_once 'assets/common/footer.php';
?>