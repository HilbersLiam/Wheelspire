<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Dbh.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Products.php";
$productsobj = new Products();
// Require once will include this php file in every page on the website.
// Config file for security.

// start the session before any html.
if (session_status() === PHP_SESSION_NONE) {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/products.css">
</head>

<!-- Render the selected categories products -->
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/navbar.php'; ?>
    <div class="products-background">
        <div class="center">
            <main>
                <div class="products">
                    <?php $productsobj->display_products("Audi") ?>
                    <?php $productsobj->display_products("BMW") ?>
                    <?php $productsobj->display_products("Ferrari") ?>
                    <?php $productsobj->display_products("Lamborghini") ?>
                    <?php $productsobj->display_products("Mustang") ?>
                    <?php $productsobj->display_products("Nissan") ?>
                    <?php $productsobj->display_products("Porsche") ?>
                </div>
            </main>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</body>

</html>
