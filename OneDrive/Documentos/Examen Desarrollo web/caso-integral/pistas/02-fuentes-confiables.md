# Pista 2: separar fuentes confiables

El navegador puede cambiar la URL, los campos del formulario y el JSON de `fetch`. Por eso `id`, `rol`, `acceso` y `user_id` recibidos del cliente son datos de solicitud, no pruebas de identidad ni permisos.

La cookie de sesión solo permite encontrar una sesión. El usuario, su estado y su rol vigente deben consultarse en la base de datos. El recurso y su propietario también deben consultarse allí.
