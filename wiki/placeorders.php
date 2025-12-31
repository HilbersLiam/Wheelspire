<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Wheelspire | Placing Orders</title>
    <!-- Stylesheets-->
    <link rel="icon" type="image/x-icon" href="Assets/Logo-darkmode.svg">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/navbar.css">
</head>

<body>
    <?php include '../navbar.php'; ?>
    <!-- Wiki guide on how creating a theme.-->
    <section class="wiki">
        <div class="center">
            <div class="wiki-container">
                <h2 class="wiki-headers">How To Place An Order</h2>
                <p class="wiki-p">
                    Placing your order requires an account, if you don't have an account <a class="wiki-links" href="signupform.php">create one.</a>
                </p>
                <br>
                <h3 class="wiki-headers">Step 1: Adding Products To Your Cart</h3>
                <p class="wiki-p">
                    Navigate to the <a class="wiki-links" href="Categories/all-products.php">products section</a>. To add a product to your cart, select the color option and then click <strong>Add To Cart </strong>.
                    You will see the number next to your cart on your navbar increase. Click the cart on the navbar to view your current cart at any time.
                </p>
                <br>

                <img class="wiki-img" src="Assets/cart-image.png" alt="Screenshot showing the cart." />
                <br>
                <h3 class="wiki-headers">Step 2: Placing Your Order</h3>
                <p class="wiki-p">
                    Once you've added items to your cart, and you want to checkout. Click the cart on the navbar and click checkout. This will bring you to the checkout page.
                    Once you click <strong> place order </strong>, your order will be placed and will show up under <strong> Profile -> My Orders </strong>.
                </p>
                <br>
                <img class="wiki-img" src="Assets/checkout.png" alt="Screenshot showing the cart." />
            </div>
        </div>
    </section>
    <?php include '../footer.php'; ?>
</body>

</html>