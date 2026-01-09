<?php
// Checks if there is a session active, if theres no session active then start one.
if (session_status() === PHP_SESSION_NONE) {
    include_once "config.php";
}
$name_messages = $_SESSION["change_name_messages"] ?? [];
unset($_SESSION["change_name_messages"]);

$email_messages = $_SESSION["change_email_messages"] ?? [];
unset($_SESSION["change_email_messages"]);

$password_messages = $_SESSION["change_password_messages"] ?? [];
unset($_SESSION["change_password_messages"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Wheelspire | Profile</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body class="darkmode">
    <?php include 'navbar.php'; ?>
    <main class="checkout">
        <div class=" center">
            <!-- Div for the entire profile section -->
            <div class="profile">
                <!-- Navbar to navigate to other sections of the profile page. -->
                <div class="profile-nav">
                    <nav>
                        <a class="nav-links-active" id="profile">
                            <img id="userinfo" src="Assets/profile-blue.svg" alt="User Info" />
                            <span>User Info</span>
                        </a>
                        <a href="orders.php" class="nav-links" id="orders">
                            <img id="orders" src="Assets/orders-grey.svg" alt="Orders" />
                            <span>Orders</span>
                        </a>
                        <a class="nav-links-logout" id="logout">
                            <img id="logout" src="Assets/logout-grey.svg" alt="Logout" />
                            <span>Logout</span>
                        </a>
                    </nav>
                </div>
                <!-- Div where all the profile content is.-->
                <div class="profile-container">

                    <!-- Form for editing any informationa about the currently logged in user. -->
                    <p class="profile-header">My Profile</p>
                    <form id="my-profile-section" method="post" action="includes/profile.inc.php">
                        <!-- My Profile section -->
                        <div class=" my-profile-section">
                            <div class=" edit-input">
                                <!-- Option to change the first name -->
                                <label for="first_name">First Name</label>
                                <input type="text" class="profile-input" id="first_name" name="first_name" placeholder="<?php echo htmlspecialchars($_SESSION["first_name"]) ?>">
                            </div>
                            <div class="edit-input">
                                <!-- Option to change the last name -->
                                <label for="last_name">Last Name</label>
                                <input type="text" class="profile-input" id="last_name" name="last_name" placeholder="<?php echo htmlspecialchars($_SESSION["last_name"]) ?>">
                            </div>
                        </div>
                        <!-- Check if the success message is set. -->
                        <?php if (isset($name_messages["name_success"])): ?>
                            <!-- Display the success message to the user. -->
                            <p class="success-message"> <?php echo $name_messages["name_success"]; ?></p>
                            <!-- Check if the unsuccess message is set. -->
                        <?php elseif ((isset($name_messages["name_unsuccessful"]))): ?>
                            <!-- Display the unsuccess message to the user. -->
                            <p class="unsuccess-message"> <?php echo $name_messages["name_unsuccessful"]; ?></p>
                        <?php endif ?>
                        <br>
                        <!-- Button to submit the changes if the user changed their -->
                        <input type="submit" name="edit-name" class="save-changes" value="Save Changes">
                    </form>
                    <br>

                    <!-- Form for editing the users email. -->
                    <p class="profile-header">Account Security</p>
                    <form method="post" action="includes/profile.inc.php">
                        <div class="account-security-section">
                            <div class="edit-input">
                                <label for="email">Email</label>
                                <input type="email" class="profile-input" id="email" name="email" placeholder="<?php echo htmlspecialchars($_SESSION["email"]) ?>">
                            </div>
                        </div>
                        <!-- Check if the success message is set. -->
                        <?php if (isset($email_messages["email_success"])): ?>
                            <!-- Display the success message to the user. -->
                            <p class="success-message"> <?php echo $email_messages["email_success"]; ?></p>
                            <!-- Check if the unsuccess message is set. -->
                        <?php elseif ((isset($email_messages["email_unsuccessful"]))): ?>
                            <!-- Display the unsuccess message to the user. -->
                            <p class="unsuccess-message"> <?php echo $email_messages["email_unsuccessful"]; ?></p>
                        <?php endif ?>
                        <br>
                        <input type="submit" name="edit-email" class="save-changes" value="Change Email">
                    </form>

                    <!-- Form for editing the users password. -->
                    <form method="post" action="includes/profile.inc.php">
                        <div class="password-section">
                            <div class="edit-input">
                                <label for="password">Enter Current Password</label>
                                <input type="password" class="profile-input" id="password" name="current_password" minlength="8" placeholder="********">
                            </div>
                            <div class="edit-input">
                                <label for="new_password">New Password</label>
                                <input type="password" class="profile-input" id="new_password" name="new_password" minlength="8" placeholder="********">
                            </div>
                        </div>
                        <!-- Check if the success message is set. -->
                        <?php if (isset($password_messages["password_success"])): ?>
                            <!-- Display the success message to the user. -->
                            <p class="success-message"> <?php echo $password_messages["password_success"]; ?></p>
                            <!-- Check if the unsuccess message is set. -->
                        <?php elseif ((isset($password_messages["password_unsuccessful"]))): ?>
                            <!-- Display the unsuccess message to the user. -->
                            <p class="unsuccess-message"> <?php echo $password_messages["password_unsuccessful"]; ?></p>
                        <?php endif ?>
                        <br>
                        <input type="submit" name="edit-password" class="save-changes" value="Change Password">
                    </form>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>