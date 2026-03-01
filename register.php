<?php
session_start();
require_once 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role_name = $_POST['role'] ?? 'employee'; // Default to employee

    if (!empty($username) && !empty($email) && !empty($password)) {
        // Get role ID
        $stmt = $pdo->prepare("SELECT id FROM roles WHERE role_name = ?");
        $stmt->execute([$role_name]);
        $role = $stmt->fetch();
        
        if ($role) {
            $role_id = $role['id'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try {
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)");
                $stmt->execute([$username, $email, $hashed_password, $role_id]);
                
                $_SESSION['success'] = "Registration successful! Please login.";
                header("Location: login.php");
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = "Registration failed: " . $e->getMessage();
            }
        }
    } else {
        $_SESSION['error'] = "All fields are required.";
    }
}
header("Location: login.php");
exit();
?>
