<?php
include_once 'config.php';

$form_messages = $_SESSION["errors_signup"] ?? [];
unset($_SESSION["errors_signup"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Wheelspire | Signup</title>
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
                <div class="signup-image">
                    <img src="Assets/Signup-car.png" class="signup-car" alt="Blue Car" />
                    <p> Already have an account? <a href="#" class="login-link">Log in</a></p>
                </div>
                <div class="signup-form">

                    <h2>Sign Up</h2>
                    <!-- Signup form using POST method and submitted form data will get sent to the current page, instead of redirecting to a different page. 
                     Using specialchar filter to filter out any scripts that can be sent for security. -->
                    <form class="signup-form" method="post" action="includes/signup.inc.php">
                        <label for="first_name"></label>
                        <input type="text" class="username" name="first_name" placeholder="First Name">
                        <!-- Error message if theres any issues with the submitted input: -->
                        <span class="error">* <?php echo $form_messages["first_name"] ?? ''; ?></span>
                        <br>

                        <label for="last_name"></label>
                        <input type="text" class="username" name="last_name" placeholder="Last Name">
                        <!-- Error message if theres any issues with the submitted input: -->
                        <span class="error">* <?php echo $form_messages["last_name"] ?? ''; ?></span>
                        <br>

                        <label for="email"></label>
                        <input type="email" class="email" name="email" placeholder="Your email"><br>
                        <!-- Error message if theres any issues with the submitted input: -->
                        <span class="error">* <?php echo $form_messages["email"] ?? '';
                                                echo $form_messages["email_exists"] ?? ''; ?></span>
                        <br>

                        <label for="password"></label>
                        <input type="password" class="password" name="password" placeholder="Your password"><br>
                        <!-- Error message if theres any issues with the submitted input: -->
                        <span class="error">* <?php echo $form_messages["password"] ?? ''; ?></span>
                        <br>

                        <label for="password-again"></label>
                        <input type="password" class="password-again" name="reenter_password" placeholder="Reenter your password"><br>
                        <!-- Error message if theres any issues with the submitted input: -->
                        <span class="error">* <?php echo $form_messages["password_match"] ?? '';
                                                echo $form_messages["reenter_password"] ?? ''; ?></span>
                        <br>
                        <input type="submit" class="form-submit" value="Submit"><br>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>