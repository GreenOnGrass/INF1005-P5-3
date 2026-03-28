<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

$userId = $_SESSION['user_id'] ?? 'guest';
$sessionKey = "user_" . $userId;

if (isset($data['index']) && isset($_SESSION[$sessionKey][$data['index']])) {
    $_SESSION[$sessionKey][$data['index']]['flipped'] = true;
    echo json_encode(['success' => true]);
}
?>