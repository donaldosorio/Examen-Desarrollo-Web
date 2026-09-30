# Pista 5: cambiar contraseña

El `user_id` del JSON es una pista evidente. Cambiarlo por `2` no debería permitir modificar la cuenta de otra persona.

El endpoint debe obtener al usuario desde la sesión, comprobar que la cuenta siga activa, verificar la contraseña actual, validar la nueva contraseña y actualizar únicamente esa cuenta. Añadan CSRF para una aplicación real y decidan qué sesiones deben invalidarse después del cambio.

El cliente puede mostrar errores; PHP debe repetir todas las decisiones críticas.
