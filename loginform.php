<?php
include_once 'config.php';

$form_messages = $_SESSION["errors_login"] ?? [];
unset($_SESSION["errors_login"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Wheelspire | Login</title>
    <link rel="stylesheet" href="styles/form.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>


<body class="darkmode">
    <?php include 'navbar.php'; ?>
    <div class="center">
        <main>
            <div class="signup-container">
                <div class="signup-form">
                    <h2>Login</h2>
                    <!-- Signup form using POST method and submitted form data will get sent to the current page, instead of redirecting to a different page. 
                     Using specialchar filter to filter out any scripts that can be sent for security. -->
                    <form class="signup-form" method="post" action="includes/login.inc.php">
                        <label for="email"></label>
                        <input type="email" class="email" name="email" placeholder="Your email"><br>
                        <!-- Error message if theres any issues with the submitted input: -->
                        <span class="error">* <?php echo $form_messages["email"]  ?? ''; ?></span>
                        <br>

                        <label for="password"></label>
                        <input type="password" class="password" name="password" placeholder="Your password"><br>
                        <!-- Error message if theres any issues with the submitted input: -->
                        <span class="error">* <?php echo $form_messages["password"] ?? ''; ?></span>
                        <br>
                        <input type="submit" class="form-submit" value="Login"><br>
                        <span class="error"> <?php echo $form_messages["user_exists"] ?? '';
                                                echo $form_messages["invalid_user"] ?? ''; ?></span>
                    </form>
                </div>
                <div class="signup-image">
                    <img src="Assets/Signup-car.png" class="signup-car" alt="Blue Car" />
                    <p> Don't have an account? <a href="#" class="login-link">Signup Now</a></p>
                </div>
            </div>
        </main>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>