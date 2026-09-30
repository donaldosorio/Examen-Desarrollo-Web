<?php

final class Auth
{
    public static function start(): void
    {
        $config = require __DIR__ . '/../config.php';
        session_name($config['session_name']);
        session_start();
    }

    public static function user(PDO $db): ?array
    {
        $id = $_SESSION['user_id'] ?? null;
        if (!is_int($id)) return null;
        $query = $db->prepare('SELECT id, nombre, email, rol, activo, departamento FROM usuarios WHERE id = :id');
        $query->execute(['id' => $id]);
        $user = $query->fetch();
        return $user ?: null;
    }
}
