<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once '../config.php';
    $errors = [];
    // Check if the user is logged in.
    if (isset($_SESSION["userid"])) {
        // Important! - Requires order matters, the Database has to be loaded first and then cart can be used.
        require_once "../Classes/Dbh.php";
        require_once "../Classes/CartDBHandler.php";

        $cart = new CartDBHandler();

        // Get the current page that the user is on.
        $current_page = $_POST['current_page'];
        // Check if they clicked the clear cart button and their cart is not empty.
        if (isset($_POST["clear_cart"]) && !$cart->isCartEmpty($_SESSION["userid"])) {
            // Clear everything from the users cart.
            $cart->clearEntireCart($_SESSION["userid"]);
            // Use header to keep the user on the same page.
            header("Location: $current_page");
            exit();
        }
        // Check if the user added something to their cart.
        if (isset($_POST["productid"], $_POST["quantity"], $_POST["color"])) {
            // Get the category the user is currently on
            $category = $_POST["category"];
            // Insert the product into the users cart.
            $cart->insertCart($_POST["productid"], $_SESSION["userid"], $_POST["quantity"], $_POST["color"]);
            header("Location: ../Categories/" . strtolower($category) . ".php");
            exit();
        }
        // Check if the user clicked checkout and navigate them.
        if (isset($_POST["checkout"])) {
            header("Location: ../checkout.php");
            exit();
        }
    } else {
        header("Location: ../loginform.php");
        exit();
    }
}
