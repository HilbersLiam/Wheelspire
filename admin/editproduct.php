<?php
// Start session if not already started and include configuration and class files
if (session_status() === PHP_SESSION_NONE) {
    include_once "../config.php";
}
require_once "../Classes/Dbh.php";  // Database connection class
require_once "../Classes/Admin.php"; // Admin class with admin  DB functions

$adminObj = new Admin(); // Create instance of Admin to use its methods

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="https://wheelspire.page.gd/">
    <title>Admin Page</title>
    <!-- CSS stylesheets and Google Fonts -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/admin.css">
</head>

<body>
    <?php if ($_SESSION['user_role'] == 'admin') { // Only allow access if user is admin 
    ?>
        <div class="sidebar">
            <!-- Sidebar navigation for admin -->
            <img class="sidebar-logo" src="Assets/Logo-darkmode.svg" alt="darkmode logo" />
            <a href="admin/index.php" class="link">
                <img src="Assets/Admin-Images/dashboard-icon.svg" alt="Dashboard Icon" />
                <p>Dashboard</p>
            </a>
            <a href="admin/manageusers.php" class="link">
                <img src="Assets/Admin-Images/accounts-icon.svg" alt="Accounts Icon" />
                <p>Manage Users</p>
            </a>
            <a href="admin/manageproducts.php" class="active-link">
                <img src="Assets/Admin-Images/products-icon.svg" alt="Products Icon" />
                <p>Manage Products</p>
            </a>
            <a href="admin/serverinformation.php" class="link">
                <img src="Assets/Admin-Images/server-icon.svg" alt="Server Icon" />
                <p>Server Information</p>
            </a>
            <a href="index.php" class="link">
                <img src="Assets/Admin-Images/home-icon.svg" alt="Home Icon" />
                <p>Home Page</p>
            </a>
        </div>
        <header class="header"></header>

        <div class="content">
            <h3>Edit Product</h3>
            <br>
            <?php
            // Fetch product details to populate the form fields
            $product = $adminObj->getProduct($_SESSION['productid']);
            ?>
            <div class="product-form">
                <form method="post" action="includes/admin.inc.php">
                    <!-- Inputs prefilled with current product info -->
                    <label for="edit-name">Name</label>
                    <input type="text" name="edit-name" value="<?= htmlspecialchars($product['name']) ?>">

                    <label for="edit-description">Description</label>
                    <input type="text" name="edit-description" value="<?= htmlspecialchars($product['description']) ?>">

                    <label for="edit-price">Price</label>
                    <input type="text" name="edit-price" value="<?= htmlspecialchars($product['price']) ?>">

                    <label for="edit-quantity">Quantity</label>
                    <input type="text" name="edit-quantity" value="<?= htmlspecialchars($product['quantity']) ?>">

                    <label for="edit-image">Image</label>
                    <input type="text" name="edit-image" value="<?= htmlspecialchars($product['image_url']) ?>">

                    <label for="edit-category">Category</label>
                    <input type="text" name="edit-category" value="<?= htmlspecialchars($product['category']) ?>">

                    <!-- Hidden input to keep track of which product is being edited -->
                    <input type="hidden" name="productid" value="<?= $product['productid'] ?>">
                    <input type="submit" name="submit-product" value="Save Changes">
                </form>
            </div>
        </div>
    <?php } else { // Non-admin users see this message and a login link 
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