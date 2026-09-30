<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Auth.php';
require_once __DIR__ . '/../src/ResourceService.php';
Auth::start();
$db = Database::connection();
$user = Auth::user($db);
$result = (new ResourceService($db))->show($_GET, $user);
http_response_code($result['status']);
?>
<!doctype html>
<html lang="es">
<meta charset="utf-8">
<title>Recurso</title>
<?php if (isset($result['resource'])): ?><h1><?= htmlspecialchars($result['resource']['titulo'], ENT_QUOTES, 'UTF-8') ?></h1>
    <p><?= htmlspecialchars($result['resource']['descripcion'], ENT_QUOTES, 'UTF-8') ?></p><?php else: ?><p><?= htmlspecialchars($result['message'] ?? 'Solicitud inválida', ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>