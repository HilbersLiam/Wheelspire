<?php
require_once "Classes/Dbh.php";
require_once "Classes/Products.php";
$productsobj = new Products();

// start the session before any html.
if (session_status() === PHP_SESSION_NONE) {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Wheelspire | Premium Toy-Sized Model Cars for Collectors & Enthusiasts </title>
    <meta name="description" content="Discover high-quality toy-sized model cars at Wheelspire. Perfect for collectors, hobbyists, and car lovers of all ages. 
    Shop detailed replicas of your favorite vehicles today.">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body class="darkmode">
    <?php include 'navbar.php'; ?>
    <section class="hero">
        <div class="center">
            <div class="hero-content">
                <div class="hero-text">
                    <h2>
                        Built for Collectors.</span>
                        <br>
                        Designed to Impress.</span>
                    </h2>
                    <p class="hero-subheading">Discover detailed replicas of the cars you love.</p>
                    <div class="hero-cta">
                        <a href="Categories/all-products.php" class="products-link">Products</a>
                        <a href="signupform.php" class="signup-link">Signup</a>
                    </div>
                </div>
                <img src="Assets/Hero-car.png" class="hero-car" alt="Blue Car" />
            </div>
        </div>
    </section>
    <main>
        <div class="center">
            <div class="best-selling">
                <h3 class="section-headers">Best Selling Products</h3>
                <div class="products">
                    <?php $productsobj->display_products("Ferrari") ?>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
