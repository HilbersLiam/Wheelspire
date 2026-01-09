<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1. Use absolute paths for requires
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    
    $errors = [];

    if (isset($_SESSION["userid"])) {
        // 2. Use absolute paths for Classes
        require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Dbh.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/CartDBHandler.php";

        $cart = new CartDBHandler();
        $current_page = $_POST['current_page'];

        // --- Clear Cart Logic ---
        if (isset($_POST["clear_cart"]) && !$cart->isCartEmpty($_SESSION["userid"])) {
            $cart->clearEntireCart($_SESSION["userid"]);
            // Redirect using a leading slash to stay at root
            header("Location: /" . ltrim($current_page, '/'));
            exit();
        }

        // --- Add to Cart Logic ---
        if (isset($_POST["productid"], $_POST["quantity"], $_POST["color"])) {
            $category = $_POST["category"];
            $cart->insertCart($_POST["productid"], $_SESSION["userid"], $_POST["quantity"], $_POST["color"]);
            // Use leading slash for Categories folder
            header("Location: /Categories/" . strtolower($category) . ".php");
            exit();
        }

        // --- Checkout Logic ---
        if (isset($_POST["checkout"])) {
            header("Location: /checkout.php");
            exit();
        }
    } else {
        // --- Not Logged In Logic ---
        header("Location: /loginform.php");
        exit();
    }
}
