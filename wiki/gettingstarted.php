<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Wheelspire | Getting Started</title>
    <!-- Stylesheets-->
    <link rel="icon" type="image/x-icon" href="Assets/Logo-darkmode.svg">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/navbar.css">

</head>

<body>
    <?php include '../navbar.php'; ?>
    <!-- Wiki guide on getting started.-->
    <section class="wiki">
        <div class="center">
            <div class="wiki-container">
                <p class="wiki-headers">Getting Started - Customers</p>
                <p class="wiki-p">
                    Welcome to Wheelspire! As a customer, you can easily browse our selection of over 20 products categorized by brands, each available with two customization options.
                    To get started, create an account by signing up, this allows you add products to your cart and place orders.
                    <br><br>
                    Once logged in, you can add products to your shopping cart and place orders at checkout. <a class="wiki-links" href="wiki/placeorders.php">Click here to learn how to place an order.</a>
                    You can also manage your account details anytime by updating your profile information, including your contact details and password.
                    <a class="wiki-links" href="wiki/manageaccount.php">Click here to learn how to manage your account.</a>
                </p>

                <br>
                <p class="wiki-headers">Getting Started - Admins</p>
                <p class="wiki-p">
                    Wheelspire is a project website designed to showcase 20+ different products to users, each with two available options. Users can
                    create an account, add products to their cart, place orders and edit their profile. With an interactive admin page in the background, any account with admin
                    privileges can access the admin page. No programming expeirence is required, the admin page was designed to give non-programmers an easy expeirence to manage their website.
                    <br><br>
                    If you’re customizing the site, all product data is stored in a database file, and can be edited through the admin page. Making it easy to add or
                    update products without touching the core code. All you need is an image and product information.
                    <a class="wiki-links" href="wiki/updateproducts.php">Click here to learn how to add a new product.</a>
                    <br><br>
                    If you’re managing the users, all user data is stored in a database file, and can be edited through the admin page. Making it easy to change users roles or disable the accounts.
                    <a class="wiki-links" href="wiki/manageusers.php">Click here to learn how to manage users.</a>
                </p>
            </div>
        </div>
    </section>
    <?php include '../footer.php'; ?>
</body>

</html>