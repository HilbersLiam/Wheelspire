<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once '../config.php';

    // Important! - Requires order matters, the Database has to be loaded first and then cart can be used.
    require_once "../Classes/Dbh.php";
    require_once "../Classes/CartDBHandler.php";
    require_once "../Classes/Orders.php";

    $order_total = 0;
    $total_products = 0;

    $cart = new CartDbHandler();
    $cart_items = $cart->getCart($_SESSION["userid"]);
    print_r($cart_items);
    // Calculate order total by looping through the cart.
    foreach ($cart_items as $cart_item) {
        $order_total += $cart_item["price"] * $cart_item["quantity"];
        $total_products++;
    }

    $order = new Orders();
    $orderid = $order->createOrder($_SESSION["userid"], $order_total, $total_products);
    var_dump($orderid);


    foreach ($cart_items as $cart_item) {
        $order->addOrderItems($orderid, $cart_item["productid"], $cart_item["quantity"], $cart_item["option"]);
    }

    $cart->clearEntireCart($_SESSION["userid"]);
    header("Location: ../checkout.php");
    exit();
}
