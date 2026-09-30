# Pista 6: mejorar el SQL

Empiecen preguntando cuál es la única fuente de cada dato. Si el correo cambia, ¿cuántas columnas habría que actualizar? Si un rol tiene permisos, ¿por qué aparece tanto en usuarios como en accesos?

Consideren separar roles, permisos y relaciones de acceso; usar nombres únicos; declarar `NOT NULL`; agregar índices a claves foráneas; y usar estados controlados. No normalicen por reflejo: cada cambio debe resolver una inconsistencia concreta.
