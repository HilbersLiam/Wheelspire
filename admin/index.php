<?php

if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}

// Start session if none is active and include config (which may start session and set constants)
if (session_status() === PHP_SESSION_NONE) {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
}
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Dbh.php";      // Database connection class
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Admin.php";    // Admin class with methods for dashboard data

$adminObj = new Admin();  // Admin object to fetch data
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Page</title>
    <!-- Stylesheets and fonts -->
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/admin.css">
</head>

<body>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') { // Show admin dashboard only if user is admin 
    ?>
        <div class="sidebar">
            <!-- Admin navigation menu -->
            <img class="sidebar-logo" src="/Assets/Logo-darkmode.svg" alt="darkmode logo" />
            <a href="/admin/index.php" class="active-link">
                <img src="/Assets/Admin-Images/dashboard-icon.svg" alt="Dashboard Icon" />
                <p>Dashboard</p>
            </a>
            <a href="/admin/manageusers.php" class="link">
                <img src="/Assets/Admin-Images/accounts-icon.svg" alt="Accounts Icon" />
                <p>Manage Users</p>
            </a>
            <a href="/admin/manageproducts.php" class="link">
                <img src="/Assets/Admin-Images/products-icon.svg" alt="Products Icon" />
                <p>Manage Products</p>
            </a>
            <a href="/admin/serverinformation.php" class="link">
                <img src="/Assets/Admin-Images/server-icon.svg" alt="Server Icon" />
                <p>Server Information</p>
            </a>
            <a href="https://wheelspire.liamhilbers.dev/" class="link">
                <img src="/Assets/Admin-Images/home-icon.svg" alt="Home Icon" />
                <p>Home Page</p>
            </a>
        </div>
        <header class="header"></header>

        <div class="content">
            <h3>Dashboard</h3>
            <br>
            <?php
            // Fetch totals for users, orders, and sales to display
            $rows = $adminObj->getTotals();
            ?>
            <div class="analytics-container">
                <div class="analytics">
                    <div class="circle">
                        <img class="totals-icon" src="/Assets/Admin-Images/Total-users.svg" alt="Total Users Icon" />
                    </div>
                    <div class="totals-text">
                        <h4><?= $adminObj->totals['totalusers'] ?></h4>
                        <p>Total Users</p>
                    </div>
                </div>
                <div class="analytics">
                    <div class="circle">
                        <img class="totals-icon" src="/Assets/Admin-Images/Total-orders.svg" alt="Total Orders Icon" />
                    </div>
                    <div class="totals-text">
                        <h4><?= $adminObj->totals['totalorders'] ?></h4>
                        <p>Total Orders</p>
                    </div>
                </div>
                <div class="analytics">
                    <div class="circle">
                        <img class="totals-icon" src="/Assets/Admin-Images/Total-sales.svg" alt="Total Sales Icon" />
                    </div>
                    <div class="totals-text">
                        <h4><?= $adminObj->totals['totalsales'] ?></h4>
                        <p>Total Sales</p>
                    </div>
                </div>
            </div>

            <?php
            // Fetch recent orders to list in a table
            $rows = $adminObj->getRecentOrders();
            ?>
            <h4>Recent Orders</h4>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Order Time</th>
                    <th>Order Status</th>
                    <th>Order Total</th>
                    <th>Customer</th>
                </tr>
                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row["orderid"]) ?></td>
                        <td><?= htmlspecialchars($row["orderdate"]) ?></td>
                        <td><?= htmlspecialchars($row["status"]) ?></td>
                        <td><?= htmlspecialchars($row["ordertotal"]) . " CAD" ?></td>
                        <td><?= htmlspecialchars($row["first_name"]) . " " .  htmlspecialchars($row["last_name"]) ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } else { // Message and login prompt for non-admin users 
    ?>
        <div class="content">
            <h3>You're not logged into an admin account.</h3>
            <a href="loginform.php" class="link">
                <img src="/Assets/Admin-Images/products-icon.svg" alt="Products Icon" />
                <p>Login Now</p>
            </a>
        </div>
    <?php } ?>
</body>

</html>