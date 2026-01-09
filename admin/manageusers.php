<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}

// Checks if there is a session active, if theres no session active then start one.
if (session_status() === PHP_SESSION_NONE) {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
}
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Dbh.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Admin.php";

$adminObj = new Admin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') { ?>
        <div class="sidebar">
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
            <h3>Manage Users</h3>
            <br>
            <?php $rows = $adminObj->getAllUsers(); ?>
            <table>
                <tr>
                    <th> User ID</th>
                    <th> First Name</th>
                    <th> Last Name</th>
                    <th> Email</th>
                    <th> Role</th>
                    <th> Date Registered</th>
                    <th> Status</th>
                </tr>
                <?php foreach ($rows as $row) {
                ?>
                    <tr>
                        <td><?= $row["userid"] ?></td>
                        <td><?= $row["first_name"] ?></td>
                        <td><?= $row["last_name"] ?></td>
                        <td><?= $row["email"] ?></td>
                        <td><?php if ($row["role"] == 'customer'): {
                            ?>
                                    <form method="post" action="../includes/admin.inc.php">
                                        <select id="role" name="change_role" onchange="this.form.submit()">
                                            <option value="customer" selected>Customer</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                        <input type="hidden" name="userid" value="<?= $row['userid'] ?>">
                                    </form>
                                <?php } ?>
                                <?php elseif ($row["role"] == 'admin'): {
                                ?>
                                    <form method="post" action="../includes/admin.inc.php">
                                        <select id="role" name="change_role" onchange="this.form.submit()">
                                            <option value="customer">Customer</option>
                                            <option value="admin" selected>Admin</option>
                                        </select>
                                        <input type="hidden" name="userid" value="<?= $row['userid'] ?>">
                                    </form>
                            <?php }
                            endif ?>
                        </td>
                        <td><?= $row["date_registered"] ?></td>
                        <td><?php if ($row["status"] == 'active'): {
                            ?>
                                    <form method="post" action="../includes/admin.inc.php">
                                        <select id="status" name="change_status" onchange="this.form.submit()">
                                            <option value="active" selected>Active</option>
                                            <option value="disabled">Disabled</option>
                                        </select>
                                        <input type="hidden" name="userid" value="<?= $row['userid'] ?>">
                                    </form>
                                <?php } ?>
                                <?php elseif ($row["status"] == 'disabled'): {
                                ?>
                                    <form method="post" action="../includes/admin.inc.php">
                                        <select id="status" name="change_status" onchange="this.form.submit()">
                                            <option value="active">Active</option>
                                            <option value="disabled" selected>Disabled</option>
                                        </select>
                                        <input type="hidden" name="userid" value="<?= $row['userid'] ?>">
                                    </form>
                            <?php }
                            endif ?>
                        </td>
                    </tr>
                <?php }
                ?>
            </table>
        </div>
    <?php } else { ?>
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