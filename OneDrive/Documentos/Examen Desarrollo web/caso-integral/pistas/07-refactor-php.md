# Pista 7: refactorizar PHP

En `ResourceService::show`, cada nivel de `if` agrega una condición distinta. Extraigan primero decisiones con nombres: usuario activo, ID válido, recurso visible y permiso.

Los retornos tempranos reducen el anidamiento. `match` puede expresar la política por rol. Una función debe tener una responsabilidad que pueda explicarse en una frase.

No cambien simultáneamente reglas, nombres y estructura. Primero describan el comportamiento actual; después cambien una dimensión y comprueben manualmente los mismos escenarios.
