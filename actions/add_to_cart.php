<?php
session_start();

// Require login before allowing add-to-cart
if (empty($_SESSION['user'])) {
    // Save a message to be shown on the login page
    $_SESSION['login_error'] = 'Login First to proceed';
    // Remember where the user came from so we can return after login
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $_SESSION['after_login_redirect'] = $_SERVER['HTTP_REFERER'];
    }
    header('Location: ../login_Register/login.php');
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Expect POST: id, title, price, qty(optional)
$id = isset($_POST['id']) ? trim($_POST['id']) : null;
$title = isset($_POST['title']) ? trim($_POST['title']) : 'Item';
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$qty = isset($_POST['qty']) ? max(1, (int)$_POST['qty']) : 1;

if ($id === null) {
    header('Location: ../property-single.php');
    exit;
}

// add or increment
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += $qty;
} else {
    $_SESSION['cart'][$id] = [
        'id' => $id,
        'title' => $title,
        'price' => $price,
        'qty' => $qty,
    ];
}

// redirect back to property page or to cart
$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../property-single.php';
header('Location: ' . $redirect);
exit;
