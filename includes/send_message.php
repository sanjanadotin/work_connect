<?php
// includes/send_message.php
require_once 'db_connect.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if it's JSON or Form data
    $contentType = $_SERVER["CONTENT_TYPE"] ?? '';
    
    if (strpos($contentType, 'application/json') !== false) {
        $data = json_decode(file_get_contents('php://input'), true);
        $receiver_id = $data['receiver_id'] ?? null;
        $message = $data['message'] ?? '';
    } else {
        $receiver_id = $_POST['receiver_id'] ?? null;
        $message = $_POST['message'] ?? '';
    }
    
    $sender_id = $_SESSION['user_id'];

    if ($receiver_id && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
            $stmt->execute([$sender_id, $receiver_id, $message]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid data']);
    }
}
?>
