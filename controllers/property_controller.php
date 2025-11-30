<?php
// controllers/property_controller.php
// Minimal property-related DB functions used by views/controllers

require_once __DIR__ . '/../settings/connection.php';

function get_all_properties($limit = 50) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT p.*, u.full_name as seller_name FROM properties p LEFT JOIN users u ON p.seller_id = u.user_id ORDER BY p.is_premium DESC, p.created_at DESC LIMIT :lim');
    $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function get_property_by_id($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT p.*, u.full_name as seller_name FROM properties p LEFT JOIN users u ON p.seller_id = u.user_id WHERE p.property_id = :id LIMIT 1');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function add_property($seller_id, $cat_id, $title, $description, $price, $location, $is_premium = 0) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO properties (seller_id, cat_id, title, description, price, location, is_premium, status, created_at) VALUES (:seller,:cat,:title,:desc,:price,:loc,:prem,"Available",NOW())');
    $stmt->execute([
        'seller' => $seller_id,
        'cat' => $cat_id,
        'title' => $title,
        'desc' => $description,
        'price' => $price,
        'loc' => $location,
        'prem' => $is_premium,
    ]);

    return $pdo->lastInsertId();
}
