# Pista 8: verificar sin tests automáticos

Construyan una tabla con solicitud, usuario, datos manipulados, resultado esperado y resultado observado.

Incluyan al menos:

- visitante sin sesión;
- usuario inactivo;
- cliente viendo su recurso;
- cliente cambiando el ID por otro;
- rol cambiado en la URL;
- `user_id` cambiado en `fetch`;
- recurso inexistente;
- recurso en estado no publicado;
- contraseña actual incorrecta;
- nueva contraseña inválida;
- campos con HTML o SQL en la entrada.

Una corrección está completa cuando pueden explicar por qué cada escenario se permite o se rechaza y qué dato confiable tomó la decisión.
