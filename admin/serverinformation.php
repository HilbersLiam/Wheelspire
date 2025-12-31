<?php
// Check if a session exists, if not, include config (which may start the session)
if (session_status() === PHP_SESSION_NONE) {
    include_once "../config.php";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="https://wheelspire.page.gd/">
    <title>Admin Page</title>
    <!-- Stylesheets and Google Fonts -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php if ($_SESSION['user_role'] == 'admin') { // Only show this page if user is admin 
    ?>
        <div class="sidebar">
            <!-- Sidebar navigation -->
            <img class="sidebar-logo" src="Assets/Logo-darkmode.svg" alt="darkmode logo" />
            <a href="admin/index.php" class="link">
                <img src="Assets/Admin-Images/dashboard-icon.svg" alt="Dashboard Icon" />
                <p>Dashboard</p>
            </a>
            <a href="admin/manageusers.php" class="link">
                <img src="Assets/Admin-Images/accounts-icon.svg" alt="Accounts Icon" />
                <p>Manage Users</p>
            </a>
            <a href="admin/manageproducts.php" class="link">
                <img src="Assets/Admin-Images/products-icon.svg" alt="Products Icon" />
                <p>Manage Products</p>
            </a>
            <a href="admin/serverinformation.php" class="active-link">
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
            <h3>Server Information</h3>
            <br>
            <table>
                <tr>
                    <th>Server Component</th>
                    <th>Value</th>
                </tr>
                <!-- Display various server-related info using $_SERVER superglobal -->
                <tr>
                    <td>Server Name</td>
                    <td><?= htmlspecialchars($_SERVER['SERVER_NAME']) ?></td>
                </tr>
                <tr>
                    <td>Server Address</td>
                    <td><?= htmlspecialchars($_SERVER['SERVER_ADDR']) ?></td>
                </tr>
                <tr>
                    <td>Server Software</td>
                    <td><?= htmlspecialchars($_SERVER['SERVER_SOFTWARE']) ?></td>
                </tr>
                <tr>
                    <td>Server Protocol</td>
                    <td><?= htmlspecialchars($_SERVER['SERVER_PROTOCOL']) ?></td>
                </tr>
                <tr>
                    <td>Server Port</td>
                    <td><?= htmlspecialchars($_SERVER['SERVER_PORT']) ?></td>
                </tr>
            </table>
        </div>
    <?php } else { // If not admin, show message and login link 
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