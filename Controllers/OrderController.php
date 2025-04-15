<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        // User not logged in, redirect to login page
        header('Location: ../Views/login.php');
        exit();
    }

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // In a real app, save order to database here
        // For now, just clear the cart and show a success message

        $_SESSION['cart'] = [];
        $_SESSION['order_success'] = true;
        header('Location: ../Views/index.php');
        exit();
    } else {
        // Redirect to menu if no cart
        header('Location: ../Views/index.php');
        exit();
    }
} else {
    // Redirect to menu if wrong method
    header('Location: ../Views/index.php');
    exit();
}
?>
