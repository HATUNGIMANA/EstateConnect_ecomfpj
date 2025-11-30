<?php
// controllers/user_controller.php
// Basic user functions: create, find by email, verify password, get by id

require_once __DIR__ . '/../settings/connection.php';

function find_user_by_email($email) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}

function create_user($full_name, $email, $password_hash, $phone, $role_id = 2) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO users (role_id, full_name, email, password, phone_number, is_verified, created_at) VALUES (:role, :name, :email, :pwd, :phone, 0, NOW())');
    $stmt->execute([
        'role' => $role_id,
        'name' => $full_name,
        'email' => $email,
        'pwd' => $password_hash,
        'phone' => $phone,
    ]);
    return $pdo->lastInsertId();
}

function verify_user_password($email, $password) {
    $user = find_user_by_email($email);
    if (!$user) return false;
    if (password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function get_user_by_id($user_id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = :id LIMIT 1');
    $stmt->execute(['id' => $user_id]);
    return $stmt->fetch();
}
