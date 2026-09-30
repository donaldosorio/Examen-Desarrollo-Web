# Pista 3: ordenar la autenticación

Un flujo razonable pregunta en este orden:

1. ¿La solicitud usa el método esperado?
2. ¿Llegaron los campos necesarios y tienen formato válido?
3. ¿Las credenciales corresponden a una cuenta?
4. ¿La contraseña coincide usando `password_verify`?
5. ¿La cuenta está activa?
6. ¿Se regenera el identificador de sesión después de entrar?

No construyan mensajes que permitan enumerar correos existentes. En una autenticación fallida, una respuesta general suele revelar menos información.
