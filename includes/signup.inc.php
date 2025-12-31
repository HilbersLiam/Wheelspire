<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Start the session
require_once '../config.php';

// Check if there is a POST request coming in
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recieve the needed login information.
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $reenter_password = $_POST["reenter_password"];

    // Important! - Requires order matters, the Database has to be loaded first and then UserHandler before Signup can be used.
    require_once "../Classes/Dbh.php";
    require_once "../Classes/UserHandler.php";
    require_once "../Classes/Signup.php";

    // Creates a new signup object with the entered information.
    $signup = new Signup($first_name, $last_name, $email, $password, $reenter_password);
    // Calls createUser() with the information to insert the user into the DB.
    $signup->createUser();
    // Get any errors.
    $form_messages = $signup->getFormMessage();


    // If there is errors then set the errors to the SESSION variable and the header to signupform.php to display the errors on the same page.
    if (!empty($form_messages)) {
        $_SESSION["errors_signup"] = $form_messages;
        header("Location: ../signupform.php");
        exit();
    
    }else {
    header("Location: ../loginform.php");
    exit();
    }
}
