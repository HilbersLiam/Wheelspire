<?php
require_once '../config.php';

// Important! - Requires order matters, the Database has to be loaded first and then UserHandler before Login can be used.
require_once "../Classes/Dbh.php";
require_once "../Classes/UserHandler.php";
require_once "../Classes/Profile.php";
// Check if there is a POST request coming in
if (isset($_POST['edit-name'])) {

    $change_name = new Profile();
    $form_messages = $change_name->getFormMessage();

    if (!empty($_POST["first_name"])) {
        $change_name->changeName("first_name", $_SESSION["userid"], $_POST["first_name"]);
        $form_messages["name_success"] = "Name successfully changed.";
        $_SESSION["first_name"] = $_POST["first_name"];
    }
    if (!empty($_POST["last_name"])) {
        $change_name->changeName("last_name", $_SESSION["userid"], $_POST["last_name"]);
        $form_messages["name_success"] = "Name successfully changed.";
        $_SESSION["last_name"] = $_POST["last_name"];
    }

    // If the user doesn't enter anything in make sure they stay on the same page and
    // Display a message that nothing was entered.
    if (empty($_POST["first_name"]) && empty($_POST["last_name"])) {
        $form_messages["name_unsuccessful"] = "No information entered.";
    }
    if ($form_messages) {
        $_SESSION["change_name_messages"] = $form_messages;
        header("Location: ../profile.php");
        exit();
    }
}

if (isset($_POST['edit-email'])) {


    $change_email = new Profile();
    $form_messages = $change_email->getFormMessage();

    if (!empty($_POST["email"])) {
        $result = $change_email->changeEmail("email", $_SESSION["userid"], $_POST["email"]);
        if ($result) {
            $form_messages["email_success"] = "Email successfully changed.";
            $_SESSION["email"] = $_POST["email"];
        } else {
            $form_messages["email_unsuccessful"] = "Email already exists.";
        }

        // If the user doesn't enter anything in make sure they stay on the same page and
        // Display a message that nothing was entered.
    } else {
        $form_messages["email_unsuccessful"] = "No information entered.";
    }

    if ($form_messages) {
        $_SESSION["change_email_messages"] = $form_messages;
        header("Location: ../profile.php");
        exit();
    }
}

if (isset($_POST['edit-password'])) {


    $change_password = new Profile();
    $form_messages = $change_password->getFormMessage();

    if (!empty($_POST["current_password"]) && !empty($_POST["new_password"])) {
        $result = $change_password->changePassword("password", $_SESSION["userid"], $_POST["current_password"],  $_POST["new_password"]);
        if ($result) {
            $form_messages["password_success"] = "Password successfully changed.";
        } else {
            $form_messages["password_unsuccessful"] = "Current password is not correct.";
        }

        // If the user doesn't enter anything in make sure they stay on the same page and
        // Display a message that nothing was entered.
    } else {
        $form_messages["password_unsuccessful"] = "No information entered.";
    }

    if ($form_messages) {
        $_SESSION["change_password_messages"] = $form_messages;
        header("Location: ../profile.php");
        exit();
    }
}
