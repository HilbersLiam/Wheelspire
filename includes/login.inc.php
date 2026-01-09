<?php
// Check if there is a POST request coming in
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recieve the needed login information.
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Important! - Requires order matters, the Database has to be loaded first and then UserHandler before Login can be used.
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Dbh.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/UserHandler.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Login.php";

    // Create a new Login object with the login information.
    $login = new Login($email, $password);
    // Call the loginUser() function.
    $login->loginUser();
    // Recieve any errors that were passed.
    $errors = $login->getFormMessage();
    // Start the session
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

    // Check if loginUser() returned true, if so then the user is logged in and redirect them to the home page.
    if ($login->loginUser()) {
        header("Location: /index.php");
        exit();
        // If loginUser() returned false then that means there is errors and we need to set the SESSION variable for the errors.
    } else {
        $_SESSION["errors_login"] = $errors;
        header("Location: /loginform.php");
        exit();
    }
}
