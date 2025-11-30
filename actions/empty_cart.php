<?php
session_start();
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../cart.php';
header('Location: ' . $redirect);
exit;
