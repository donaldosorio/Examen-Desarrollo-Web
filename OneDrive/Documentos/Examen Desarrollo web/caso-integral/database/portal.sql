CREATE DATABASE IF NOT EXISTS portal_laboratorio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE portal_laboratorio;

-- Versión inicial deliberadamente redundante para analizar
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120),
  email VARCHAR(180),
  correo VARCHAR(180),
  password VARCHAR(255),
  rol VARCHAR(40),
  rol_nombre VARCHAR(80),
  activo TINYINT(1),
  departamento VARCHAR(100),
  creado_en DATETIME
);

CREATE TABLE recursos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(180),
  descripcion TEXT,
  propietario_id INT,
  propietario_nombre VARCHAR(120),
  propietario_email VARCHAR(180),
  tipo VARCHAR(40),
  estado VARCHAR(40),
  departamento VARCHAR(100),
  visible TINYINT(1),
  creado_en DATETIME,
  FOREIGN KEY (propietario_id) REFERENCES usuarios(id)
);

CREATE TABLE accesos_recursos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  recurso_id INT,
  usuario_id INT,
  rol VARCHAR(40),
  puede_ver TINYINT(1),
  puede_editar TINYINT(1),
  FOREIGN KEY (recurso_id) REFERENCES recursos(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

INSERT INTO usuarios (nombre,email,correo,password,rol,rol_nombre,activo,departamento,creado_en)
VALUES
  ('Ana Cliente','ana@example.test','ana@example.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro2xGf2Qw9Qp7A4F3w7Jzv7K', 'cliente','Cliente',1,'Ventas',NOW()),
  ('Bruno Admin','bruno@example.test','bruno@example.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro2xGf2Qw9Qp7A4F3w7Jzv7K', 'admin','Administrador',1,'TI',NOW()),
  ('Carla Inactiva','carla@example.test','carla@example.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro2xGf2Qw9Qp7A4F3w7Jzv7K', 'cliente','Cliente',0,'Ventas',NOW());

INSERT INTO recursos (titulo,descripcion,propietario_id,propietario_nombre,propietario_email,tipo,estado,departamento,visible,creado_en)
VALUES
  ('Manual de ventas','Documento interno de ejemplo',1,'Ana Cliente','ana@example.test','documento','publicado','Ventas',1,NOW()),
  ('Plan anual de TI','Documento restringido de ejemplo',2,'Bruno Admin','bruno@example.test','documento','publicado','TI',1,NOW());

INSERT INTO accesos_recursos (recurso_id,usuario_id,rol,puede_ver,puede_editar)
VALUES
  (1,1,'cliente',1,0),
  (2,2,'admin',1,1);