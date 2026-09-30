# Pista 4: URL y autorización

`recurso.php?id=1&rol=admin&acceso=1` contiene una identificación posible y dos afirmaciones manipulables. El servidor debe ignorar `rol` y `acceso` para decidir permisos.

Después de autenticar, piensen en una matriz: rol, propietario, estado del recurso y acción. Un administrador no necesariamente debe hacer todo; un cliente no necesariamente puede ver todo lo que existe.

También revisen si conviene devolver el mismo mensaje público para recurso inexistente y recurso ajeno.
