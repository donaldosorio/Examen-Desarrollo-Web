<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Auth.php';
Auth::start();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::connection();
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    // Pista: este orden y esta respuesta necesitan análisis.
    $query = $db->prepare('SELECT * FROM usuarios WHERE email = :email');
    $query->execute(['email'=>$email]);
    $user = $query->fetch();
    if ($user && password_verify($password, $user['password']) && $user['activo']) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$user['id'];
        header('Location: recurso.php?id=1&rol=' . urlencode($user['rol']) . '&acceso=1');
        exit;
    }
    $message = 'No se pudo iniciar sesión.';
}
?>
<!doctype html><html lang="es"><meta charset="utf-8"><title>Acceso</title>
<h1>Portal de recursos</h1><p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
<form method="post"><label>Correo <input type="email" name="email" required></label><label>Contraseña <input type="password" name="password" required></label><button>Entrar</button></form>
