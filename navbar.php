<?php
// Checks if there is a session active, if theres no session active then start one.
if (session_status() === PHP_SESSION_NONE) {
    include_once "config.php";
}

unset($_SESSION["errors_cart"]);

if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
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
    <title>Navbar</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/navbar.css">
    <link rel="stylesheet" href="/styles/cart.css">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">


    <!-- Function to show the dropdown for the cart or login on click -->
    <script src="/javascript/navbar.js" defer></script>
    <script src="/javascript/themes.js" defer></script>
</head>
<?php

// If the user clicks the logout button destroy the session and send them to the login page.
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: /loginform.php");
    exit();
}
?>

<body class="darkmode">
    <div class="navbar">
        <!-- Center the navbar content -->
        <nav class="center">
            <div style="gap:5px;">
                <!-- Display the logo on the far left.-->
                <!-- Display the logo on the far left.-->
                <div class="logo">
                </div>
            </div>
            <!-- Left side div to seperate the left side links from the right side links (Home, Wiki, Products)-->
            <div class="left-side">
                <a class="links" href="/index.php">Home</a>
                <a class="links" href="/about.php">About</a>
                <div class="dropdown">
                    <!-- When the user clicks the products button, the displayContent function will set the display to flex, default is set to none to hide the content.-->
                    <a class="links" onclick="displayContent('products-dropdown')" id="icons">
                        <span>Products</span>
                    </a>
                    <!-- This is content that will be displayed on click.-->
                    <div class="dropdown-products" id="products-dropdown">

                        <!-- Links to send user to the different categories for products-->
                        <a class="dropdown-links" onclick="closeDropdown()" href="/Categories/all-products.php">
                            <span>All Products </span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/Categories/audi.php">
                            <span>Audi </span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/Categories/bmw.php">
                            <span>BMW </span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/Categories/ferrari.php">
                            <span>Ferrari </span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/Categories/lamborghini.php">
                            <span>Lamborghini</span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/Categories/mustang.php">
                            <span>Mustang</span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/Categories/porsche.php">
                            <span>Porsche</span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/Categories/nissan.php">
                            <span>Nissan</span>
                        </a>
                    </div>
                </div>
                <div class="dropdown">
                    <!-- When the user clicks the products button, the displayContent function will set the display to flex, default is set to none to hide the content.-->
                    <a class="links" onclick="displayContent('videos-dropdown')" id="icons">
                        <span>Videos</span>
                    </a>
                    <!-- This is content that will be displayed on click.-->
                    <div class="dropdown-content" id="videos-dropdown">

                        <!-- Links to send user to the different videos-->
                        <a class="dropdown-links" onclick="closeDropdown()" href="/videos/howtoclean.php">
                            <span>How To Clean</span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/videos/about.php">
                            <span>About Car Models </span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/videos/howtodisplay.php">
                            <span>How To Display</span>
                        </a>

                    </div>
                </div>
                <div class="dropdown">
                    <!-- When the user clicks the products button, the displayContent function will set the display to flex, default is set to none to hide the content.-->
                    <a class="links" onclick="displayContent('wiki-dropdown')" id="icons">
                        <span>Wiki</span>
                    </a>
                    <!-- This is content that will be displayed on click.-->
                    <div class="dropdown-products" id="wiki-dropdown">

                        <!-- Links to send user to the different wiki-->
                        <a class="dropdown-links" onclick="closeDropdown()" href="/wiki/gettingstarted.php">
                            <span>Getting Started</span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/wiki/placeorders.php">
                            <span>Placing Orders</span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/wiki/manageaccount.php">
                            <span>Managing Your Account</span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/wiki/updateproducts.php">
                            <span>Updating Products</span>
                        </a>
                        <a class="dropdown-links" onclick="closeDropdown()" href="/wiki/manageusers.php">
                            <span>Manage Users</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- right side div to seperate the right side links from the right side links (Signup, Login, Cart, theme switch)-->
            <div class="right-side">
                <!-- Check if the userID session variable is set, if it is then that means the user is logged in. -->
                <?php if (isset($_SESSION['userid'])): ?>
                    <!-- Dropdown div for Profile dropdown and cart dropdown. -->
                    <div class="dropdown">
                        <!-- When the user clicks the profile button, the displayContent function will set the display to flex, default is set to none to hide the content.-->
                        <a class="links" onclick="displayContent('profile-dropdown')" id="icons">
                            <img id="login" src="/Assets/Login-icon.svg" alt="Login" />
                            <span>Profile</span>
                        </a>
                        <!-- This is content that will be displayed on click.-->
                        <div class="dropdown-content" id="profile-dropdown">
                            <!-- Link to send user to edit profile section.-->
                            <a class="profile-links" href="/profile.php">
                                <img id="edit-profile" src="/Assets/edit-profile.svg" alt="Profile" />
                                <span> Edit Profile </span>
                            </a>
                            <!-- Link to send user to their orders..-->
                            <a class="profile-links" href="/orders.php">
                                <img id="view-orders" src="/Assets/view-orders.svg" alt="Orders" />
                                <span>Your Orders</span>
                            </a>
                            <hr>
                            <!-- Logout button that will send a post request to PHP to destroy the session.-->
                            <form method="post">
                                <button type="submit" name="logout" class="logout-button">
                                    <img id="logout-button" src="/Assets/logout-button.svg" />
                                    <span>Logout </span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Display the cart if the user is logged in.-->
                    <div class="dropdown">
                        <a class="links" onclick="displayContent('cart-dropdown')" id="icons">
                            <img id="cart" src="/Assets/ShoppingCart.svg" alt="Shopping Cart" />
                            <span>Cart</span>
                            <!-- Display the current count of items in the users cart next to the cart icon on the navbar.-->
                            <span class="cart-count"> <?php echo htmlspecialchars($_SESSION['cart-count']) ?></span>
                        </a>
                        <!-- This is content that will be displayed on click.-->

                        <!-- Check if the cart is empty.-->
                        <?php if ($cart->isCartEmpty($_SESSION['userid'])): ?>
                            <div class="dropdown-content" id="cart-dropdown">
                                <div class="cart-content">
                                    <p class="empty-cart">Your cart is currently empty.</p>
                                </div>

                            </div>
                            <!-- If the cart is not empty then display the cart content:-->
                        <?php else: ?>
                            <div class="dropdown-content" id="cart-dropdown">
                                <!-- On click call the renderCart method with the current userid in the session global variable-->
                                <!-- This will render everything in the users cart currently.-->

                                <div class="cart-content">
                                    <?php $cartobj->renderCart($_SESSION['userid']) ?>
                                </div>
                                <div class="cart-bottom-buttons">
                                    <form class="cart-submit" method="post" action="/includes/cart.inc.php">
                                        <input type="hidden" name="current_page" value="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                        <input type="submit" class="clear-cart" name="clear_cart" value="Clear Cart">
                                        <input type="submit" class="checkout-cart" name="checkout" value="Checkout">
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- If the user is not logged in then display the Signup link and Login link.-->
                <?php else: ?>
                    <a class="links" href="/signupform.php" id="icons">
                        <img id="signup" src="/Assets/Signup-icon.svg" alt="Signup" />
                        <span>Signup</span>
                    </a>
                    <a class="links" href="/loginform.php" id="icons">
                        <img id="login" src="/Assets/Login-icon.svg" alt="Login" />
                        <span>Login</span>
                    </a>
                <?php endif; ?>

                <!-- Theme Selector Dropdown -->
                <select id="theme-selector" class="theme-selector">
                    <option value="darkmode">Darkmode</option>
                    <option value="lightmode">Lightmode</option>
                    <option value="blue">Blue</option>
                </select>
            </div>
        </nav>
    </div>
    <script>
        function closeDropdown() {
            document.getElementById("products-dropdown").style.display = "none";
        }

        document.addEventListener("DOMContentLoaded", () => {
            closeDropdown(); // ensures dropdowns are hidden on first page load
        });
    </script>
</body>

</html>