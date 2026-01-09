<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}

// Check if a session is active, if not, include config which may start session and set constants
if (session_status() === PHP_SESSION_NONE) {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
}
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Dbh.php";      // Database connection class
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Admin.php";

$adminObj = new Admin();  // Admin object to access product data
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Page</title>
    <!-- Link to stylesheets and fonts -->
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/admin.css">
</head>

<body>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') { // Show admin dashboard only if user is admin 
    ?>
        <div class="sidebar">
            <!-- Sidebar navigation -->
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
            <h3>Manage Products</h3>
            <br>
            <?php
            // Retrieve all products from the database
            $rows = $adminObj->getAllProducts();
            ?>
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Created</th>
                    <th>Edit Product</th>
                </tr>

                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <!-- Display product details -->
                        <td><?= htmlspecialchars($row["productid"]) ?></td>
                        <td><?= htmlspecialchars($row["name"]) ?></td>
                        <td><?= htmlspecialchars($row["description"]) ?></td>
                        <td><?= htmlspecialchars($row["price"]) ?></td>
                        <td><?= htmlspecialchars($row["quantity"]) ?></td>
                        <td><?= htmlspecialchars($row["image_url"]) ?></td>
                        <td><?= htmlspecialchars($row["category"]) ?></td>
                        <td><?= htmlspecialchars($row["created_at"]) ?></td>
                        <td>
                            <!-- Form to submit product ID for editing -->
                            <form method="post" action="includes/admin.inc.php">
                                <input class="edit-product" type="submit" name="edit-product" value="Edit Product">
                                <input type="hidden" name="productid" value="<?= htmlspecialchars($row['productid']) ?>">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } else { // Show message and login link if not admin 
    ?>
        <div class="content">
            <h3>You're not logged into an admin account.</h3>
            <a href="loginform.php" class="link">
                <img src="Assets/Admin-Images/products-icon.svg" alt="Products Icon" />
                <p>Login Now</p>
            </a>
        </div>
    <?php } ?>
</body>

</html>