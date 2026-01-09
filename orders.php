<?php
// Checks if there is a session active, if theres no session active then start one.
if (session_status() === PHP_SESSION_NONE) {
    include_once "config.php";
}
require_once "Classes/Dbh.php";
require_once "Classes/Orders.php";

$ordersobj = new Orders();
$orders = $ordersobj->getOrders($_SESSION["userid"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Wheelspire | My Orders</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/orders.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body class="darkmode">
    <?php include 'navbar.php'; ?>
    <main class="checkout">
        <div class=" center">
            <!-- Div for the entire profile section -->
            <div class="profile">
                <!-- Navbar to navigate to other sections of the profile page. -->
                <div class="profile-nav">
                    <nav>
                        <a href="profile.php" class="nav-links" id="profile">
                            <img id="userinfo" src="Assets/profile-grey.svg" alt="User Info" />
                            <span>User Info</span>
                        </a>
                        <a class="nav-links-active" id="orders">
                            <img id="orders" src="Assets/orders-blue.svg" alt="Orders" />
                            <span>Orders</span>
                        </a>
                        <a class="nav-links-logout" id="logout">
                            <img id="logout" src="Assets/logout-grey.svg" alt="Logout" />
                            <span>Logout</span>
                        </a>
                    </nav>
                </div>
                <!-- Div where all the order content is.-->
                <div class="orders-container">
                    <p class="orders-header">My Orders</p>
                    <!-- Loop through the orders and each orderid for the user..-->
                    <?php foreach ($orders as $orderid => $orderdata) { ?>
                        <!-- Display the order info.-->
                        <hr class="seperator">
                        <p class="order-num"><?= "Order #: " . htmlspecialchars($orderid) ?></p>
                        <div class="order-info">
                            <p class="order-data"><?= htmlspecialchars($orderdata['order_info']['total_products']) . " Products" ?></p>
                            <p class="order-data"> | </p>
                            <p class="order-data"><?= htmlspecialchars($orderdata['order_info']['orderdate']) ?></p>
                        </div>
                        <div class="order-status-container">
                            <div class="order-column">
                                <p class="order-status">Status: </p>
                                <p class="order-total">Total: </p>
                            </div>
                            <div class="order-column">
                                <p class="order-status"><?= htmlspecialchars($orderdata['order_info']['order_status']) ?></p>
                                <p class="order-total"><?= "CAD " . htmlspecialchars($orderdata['order_info']['ordertotal']) ?></p>
                            </div>
                        </div>
                        <hr class="seperator">
                        <!-- Loop through the order items array to get each item.-->
                        <div class="order-items-container">
                            <?php foreach ($orderdata['order_info']['items'] as $item) { ?>
                                <div class="order-items">
                                    <img class="order-image" src=<?= htmlspecialchars($item['image_url']) ?> alt<?= htmlspecialchars($item['name']) ?>>
                                    <div class="order-items-text">
                                        <p class="order-items-name"><?= htmlspecialchars($item['name']) ?></p>
                                        <p class="order-items-info"><?= "Description: " .  htmlspecialchars($item['description']) ?></p>
                                        <p class="order-items-info"><?= "Quantity: " . htmlspecialchars($item['quantity']) . "x" . " = " . htmlspecialchars($item['quantity']) * htmlspecialchars($item['price']) . "CAD" ?></p>
                                        <p class="order-items-info"><?= "Option: " .  htmlspecialchars($item['product_option']) ?></p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>