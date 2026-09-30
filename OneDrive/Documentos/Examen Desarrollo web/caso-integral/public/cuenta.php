<?php require_once __DIR__ . '/../src/Auth.php';
Auth::start(); ?>
<!doctype html>
<html lang="es">
<meta charset="utf-8">
<title>Cuenta</title>
<h1>Cambiar contraseña</h1>
<form id="password-form"><input type="password" name="current_password" placeholder="Actual" required><input type="password" name="new_password" placeholder="Nueva" required><button>Cambiar</button></form>
<p id="message"></p>
<script src="js/cuenta.js"></script>