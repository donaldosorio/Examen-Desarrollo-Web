<?php
require_once __DIR__ . '/../src/Database.php'; require_once __DIR__ . '/../src/Auth.php';
Auth::start(); header('Content-Type: application/json');
$body = json_decode(file_get_contents('php://input'), true) ?: [];
$userId = $body['user_id'] ?? null; // Pista principal: debe salir de Auth::user(), no del JSON.
$db = Database::connection();
$query = $db->prepare('SELECT * FROM usuarios WHERE id = :id'); $query->execute(['id'=>$userId]); $user = $query->fetch();
if (!$user || !password_verify($body['current_password'] ?? '', $user['password'])) { http_response_code(400); echo json_encode(['message'=>'No se pudo cambiar la contraseña']); exit; }
$update = $db->prepare('UPDATE usuarios SET password = :password WHERE id = :id'); $update->execute(['password'=>password_hash($body['new_password'], PASSWORD_DEFAULT), 'id'=>$userId]);
echo json_encode(['message'=>'Contraseña actualizada']);
