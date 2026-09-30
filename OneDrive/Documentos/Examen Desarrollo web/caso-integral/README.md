# Laboratorio full stack: Portal de recursos de una organización

Este ejercicio es para que ustedes practiquen cómo se analiza una aplicación completa antes de corregirla. Van a trabajar con HTML, CSS, JavaScript, PHP y MySQL. La aplicación simula un portal donde las personas consultan recursos internos y administran su cuenta.

No se espera que escriban muchas pantallas. Se espera que observen, hagan preguntas, encuentren riesgos, ordenen un flujo y justifiquen cada cambio.

## Situación

Una organización tiene un portal con tres funciones:

- iniciar sesión;
- ver el detalle de un recurso;
- cambiar la contraseña desde un formulario que usa `fetch`.

El portal fue creciendo con cambios rápidos. Funciona en una demostración, pero mezcla datos del navegador con datos confiables, repite condiciones y tiene decisiones de seguridad en lugares equivocados.

Su trabajo es convertir esta versión de laboratorio en una propuesta coherente.

## Cómo comenzar

1. Importen `database/portal.sql` en MySQL o MariaDB.
2. Revisen `config.php` y ajusten la conexión local.
3. Abran `public/login.php` desde Apache/MAMP.
4. Usen las cuentas ficticias indicadas en el SQL.
5. Lean el flujo completo antes de corregirlo: formulario, JavaScript, PHP y consultas.

## Pistas intencionales que deben investigar

Estas situaciones están incluidas a propósito. No las corrijan sin antes explicar el problema, el impacto y una alternativa.

### 1. Flujo de autenticación desordenado

En `public/login.php` y `src/Auth.php` se comprueba primero si el usuario existe y después si la solicitud realmente es una autenticación válida. Organicen el flujo: método HTTP, datos recibidos, credenciales, cuenta activa y cookie segura. Expliquen qué información se debe revelar cuando falla el acceso.

### 2. Autorización enviada en la URL

`public/recurso.php` recibe en la URL `id`, `rol` y `acceso`, por ejemplo:

```text
recurso.php?id=2&rol=admin&acceso=1
```

Analicen por qué no se pueden confiar en esos parametros. La URL solo puede identificar una solicitud; la identidad, el rol vigente y la pertenencia deben salir de la sesión y de la base de datos.

### 3. Cambiar contraseña con un ID recibido por `fetch`

`public/js/cuenta.js` envía `user_id` en el cuerpo JSON. `api/cambiar_password.php` usa ese valor para decidir qué cuenta actualizar. Detecten el problema y modifiquen el flujo para obtener el usuario autenticado desde la sesión, validar el método, el token CSRF, la contraseña actual y la nueva contraseña.

### 4. Condicionales anidados

`src/ResourceService.php` contiene una cadena de `if` anidados que mezcla autenticación, rol, estado del recurso y construcción de respuesta. Refactoricen con guard clauses, funciones pequeñas y `match` o una política de permisos. Conserven el comportamiento que sí sea correcto y cambien el que viole las reglas.

### 5. SQL redundante

`database/portal.sql` contiene columnas repetidas, nombres poco claros, estados como texto libre y una relación que puede producir inconsistencias. Analicen qué debe normalizarse, qué debe ser `NOT NULL`, qué índices hacen falta y qué restricciones pueden agregar sin volver el modelo innecesariamente complejo. Entreguen una versión optimizada y expliquen cada cambio.

## Reglas que debe cumplir la versión corregida

- El servidor obtiene la identidad desde una sesión o cookie de sesión válida, nunca desde un rol o ID de usuario enviado por el cliente.
- La cuenta debe existir y estar activa.
- El rol se consulta desde la base de datos y se aplica a la acción concreta.
- El recurso debe existir y el usuario debe tener una relación autorizada con él.
- Las consultas usan parámetros.
- Las contraseñas se almacenan con `password_hash` y se verifican con `password_verify`.
- Las respuestas no filtran SQL, rutas internas ni información de otras cuentas.
- La interfaz puede mejorar la experiencia, pero PHP repite las validaciones críticas.

## Si quieren que este caso se siga analizando en clase, deben realizar los siguientes entregables y lo iremos trabajando en el laboratorio:

- Diagnóstico con al menos diez observaciones clasificadas por autenticación, autorización, datos, diseño y mantenibilidad.
- Diagrama del flujo corregido de login, consulta de recurso y cambio de contraseña.
- SQL original anotado y SQL optimizado.
- Refactor de `ResourceService` con explicación de las decisiones.
- Corrección de los defectos de URL y `fetch`.
- Lista de escenarios que probarían manualmente, incluyendo casos permitidos, rechazados y solicitudes manipuladas.

No se incluyen tests automáticos: la revisión y las pruebas se realizarán en clase. Las pistas son deliberadas; una solución correcta debe explicar por qué cambia cada cosa.
