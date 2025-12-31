<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Wheelspire | Manage Products</title>
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
                <h2 class="wiki-headers">Admins - Managing Products</h2>
                <p class="wiki-p">
                    Once you have logged in as an admin. You can navigate to this url: <a class="wiki-links" href="admin/index.php">https://hilbersw.myweb.cs.uwindsor.ca/3340-Project/admin/index.php</a>.
                </p>
                <br>
                <h3 class="wiki-headers">Step 1: Products</h3>
                <p class="wiki-p">
                Once you're on the admin page, navigate to the <strong>Manage Products</strong> section using the sidebar. To edit any of the produts click the edit product button on the right.
                </p>
                <br>
                <img class="wiki-img" src="Assets/products.png" alt="Screenshot of the admin products" />
                <br><br>
                <h3 class="wiki-headers">Step 2: Edit Products Form</h3>
                <p class="wiki-p">
                   Once you selected a product you want to edit, simply fill in the information you want to change and click save changes. This will change the product details instantly.
                </p>
                <br>
                <img class="wiki-img" src="Assets/edit-products.png" alt="Screenshot showing the cart." />
            </div>
        </div>
    </section>
    <?php include '../footer.php'; ?>
</body>

</html>