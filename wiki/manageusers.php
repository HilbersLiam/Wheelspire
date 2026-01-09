<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Wheelspire | Manage Users</title>
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
                <h2 class="wiki-headers">Admins - Managing Users</h2>
                <p class="wiki-p">
                    Once you have logged in as an admin. You can navigate to this url: <a class="wiki-links" href="admin/index.php">https://wheelspire.liamhilbers.dev/admin/index.php</a>.
                </p>
                <br>
                <h3 class="wiki-headers">Step 1: Edit Users</h3>
                <p class="wiki-p">
                    Editing users is easy, you can change the users roles to either customer or admin by selecting the dropdown and it will automatically change when you select your option. If you want to disable a user, switch the dropdown from active to disabled.
                </p>
                <br>
                <img class="wiki-img" src="/Assets/edit-users.png" alt="Screenshot showing users." />
                <br><br>
            </div>
        </div>
    </section>
    <?php include '../footer.php'; ?>
</body>

</html>