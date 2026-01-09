<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Wheelspire | Manage Account</title>
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
                <h2 class="wiki-headers">How To Manage Your Account</h2>
                <p class="wiki-p">
                    If you don't have an account <a class="wiki-links" href="signupform.php">create one.</a>
                </p>
                <br>
                <h3 class="wiki-headers">Step 1: Editing Your Details</h3>
                <p class="wiki-p">
                    Navigate to your profile section. Here you can change your first name, last name, email or even your password. You can change your name, email or password at anytime.
                    The email has to be a unique email and it can't already be taken by another user.
                </p>
                <br>
                <img class="wiki-img" src="/Assets/profile-image.png" alt="Screenshot showing the cart." />
                <br><br>
                <h3 class="wiki-headers">Step 2: Viewing Your Orders</h3>
                <p class="wiki-p">
                    Once you've placed an order you can view it in your <strong> Profile -> My Orders </strong> page. If you don't know how to place an order, follow this <a class="wiki-links" href="wiki/placeorders.php"> guide</a>.
                </p>
                <br>
                <img class="wiki-img" src="/Assets/view-orders.png" alt="Screenshot showing the cart." />
            </div>
        </div>
    </section>
    <?php include '../footer.php'; ?>
</body>

</html>