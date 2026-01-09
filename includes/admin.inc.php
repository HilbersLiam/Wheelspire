<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once $_SERVER['DOCUMENT_ROOT'] .  '/config.php';

    // Important! - Requires order matters, the Database has to be loaded first and then admin can be used.
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/Classes/Dbh.php";
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/Classes/UserHandler.php";
    require_once $_SERVER['DOCUMENT_ROOT'] .  "/Classes/Admin.php";

    $adminObj = new Admin();
    $userObj = new UserHandler();
    // If admin used the change role dropdown, edit the users role.
    if (isset($_POST['change_role'])) {
        $userObj->editColumn('role', $_POST['change_role'], $_POST['userid']);
        header('Location: /admin/manageusers.php');
        exit();
        // If admin used the change status dropdown, edit the users status.
    } elseif (isset($_POST['change_status'])) {
        $userObj->editColumn('status', $_POST['change_status'], $_POST['userid']);
        header('Location: /admin/manageusers.php');
        exit();
        // If admin clicked edit product on one of the products.
    } elseif (isset($_POST['edit-product'])) {
        $_SESSION['productid'] = $_POST['productid'];
        $adminObj->getProduct($_POST['productid']);
        header('Location: /admin/editproduct.php');
        exit();
    }
    // Check if the admin clicked on the save changes button while editing a product.
    if (isset($_POST['submit-product'])) {
        // If they did then go through each input option and check if any of them were changed.
        if (isset($_POST['edit-name'])) {
            $adminObj->editProduct('name', $_POST['edit-name'], $_POST['productid']);
        }
        if (isset($_POST['edit-description'])) {
            $adminObj->editProduct('description', $_POST['edit-description'], $_POST['productid']);
        }
        if (isset($_POST['edit-price'])) {
            $adminObj->editProduct('price', $_POST['edit-price'], $_POST['productid']);
        }
        if (isset($_POST['edit-quantity'])) {
            $adminObj->editProduct('quantity', $_POST['edit-quantity'], $_POST['productid']);
        }
        if (isset($_POST['edit-image'])) {
            $adminObj->editProduct('image_url', $_POST['edit-image'], $_POST['productid']);
        }
        if (isset($_POST['edit-category'])) {
            $adminObj->editProduct('category', $_POST['edit-category'], $_POST['productid']);
        }
        header('Location: /admin/manageproducts.php'); // redirect after save
        exit();
    }
}
