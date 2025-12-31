<?php
// Checks if there is a session active, if theres no session active then start one.
if (session_status() === PHP_SESSION_NONE) {
    include_once "config.php";
}

// Require the classes needed to handle the cart
require_once "Classes/Dbh.php";
require_once "Classes/CartDBHandler.php";
require_once "Classes/CartDisplay.php";

if (isset($_SESSION['userid'])) {
    // Create a new cart object from the CartDBHandler class.
    $cart = new CartDBHandler();
    // Call the getCart method with the current userID in the session variable.
    $cart->getCart($_SESSION["userid"]);

    // Set the count of the cart items using countCart method to display how many items the user has in their cart on the navbar.
    $_SESSION["cart-count"] = $cart->countCart();

    // Create a new CartDisplay object.
    $cartobj = new CartDisplay();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project</title>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body class="darkmode">
    <?php include 'navbar.php'; ?>
    <main class="checkout">
        <div class=" center">
            <?php if ($cart->isCartEmpty($_SESSION['userid'])): ?>
                <div class="checkout-container">
                    <div class="checkout-items" id="checkout-items">
                        <div class="cart-content">
                            <p class="checkout-headers">Your Cart
                                <span style="float: right;"><?php echo htmlspecialchars($_SESSION['cart-count']) ?> Items</span>
                            </p>
                            <div class="cart-empty">
                                <p> Your cart is currently empty. </p>
                                <p> Add a product to place an order!</p>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-total">
                        <p class="checkout-headers">Order Total </p>
                        <p class="totals"> Subtotal:
                            <span style="float: right; color:var(--text-color);"><?php echo "$" . $cart->cartTotal($_SESSION["userid"]); ?></span>
                        </p>
                        <p class="totals"> Hst:
                            <span style="float: right; color:var(--text-color);"><?php echo "$" . 0.13 * $cart->cartTotal($_SESSION["userid"]); ?></span>
                        </p>
                        <p class="totals"> Delivery Fee:
                            <span style="float: right; color:var(--text-color);"> $0</span>
                        </p>
                        <hr style="width: 100%; color:var(--color-primary);">
                        <p class="totals"> Total:
                            <span style="float: right; color:var(--text-color);"> $0 </span>
                        </p>
                    </div>
                </div>

            <?php else: ?>
                <div class="checkout-container">
                    <div class="checkout-items" id="checkout-items">
                        <div class="cart-content">
                            <p class="checkout-headers">Your Cart
                                <span style="float: right;"><?php echo htmlspecialchars($_SESSION['cart-count']) ?> Items</span>
                            </p>
                            <?php $cartobj->renderCart($_SESSION['userid']) ?>
                        </div>
                    </div>
                    <div class="checkout-total">
                        <p class="checkout-headers">Order Total </p>
                        <p class="totals"> Subtotal:
                            <span style="float: right; color:var(--text-color);"><?php echo "$" . $cart->cartTotal($_SESSION["userid"]); ?></span>
                        </p>
                        <p class="totals"> Hst:
                            <span style="float: right; color:var(--text-color);"><?php echo "$" . 0.13 * $cart->cartTotal($_SESSION["userid"]); ?></span>
                        </p>
                        <p class="totals"> Delivery Fee:
                            <span style="float: right; color:var(--text-color);"> $20</span>
                        </p>
                        <hr style="width: 100%; color:var(--color-primary);">
                        <p class="totals"> Total:
                            <span style="float: right; color:var(--text-color);"><?php echo "$" . 1.13 * $cart->cartTotal($_SESSION["userid"]) + 20; ?></span>
                        </p>
                        <form method="post" action="includes/orders.inc.php">
                            <input type="submit" name="place_order" class="order-button" value="Place Order">
                        </form>
                    </div>
                </div>
        </div>
    <?php endif ?>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>