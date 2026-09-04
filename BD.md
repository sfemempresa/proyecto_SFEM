CREATE DATABASE IF NOT EXISTS hospital_clinicas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hospital_clinicas;

-- TABLA ROLES / TEMPORAL
CREATE TABLE temporal (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

-- TABLA USUARIOS
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    id_rol INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES temporal(id_rol)
);

-- TABLA ENCUESTAS
CREATE TABLE encuestas (
    id_encuesta INT AUTO_INCREMENT PRIMARY KEY,
    pregunta_1 ENUM('facil', 'no facil', 'dificil') NOT NULL,
    pregunta_2 ENUM('si', 'parcial', 'no') NOT NULL,
    sugerencias TEXT,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLA CATEGORIAS Y DOCUMENTOS
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

CREATE TABLE documentos (
    id_documento INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ruta VARCHAR(500) NOT NULL,
    id_categoria INT NOT NULL,
    id_usuario_creador INT NOT NULL,
    descripcion TEXT,
    fecha_publicacion DATE NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria),
    FOREIGN KEY (id_usuario_creador) REFERENCES usuarios(id_usuario)
);

-- TABLA VEHICULOS Y TRASLADOS
CREATE TABLE vehiculos (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL,
    matricula VARCHAR(20) UNIQUE NOT NULL,
    estado ENUM('disponible', 'en_servicio', 'mantenimiento') DEFAULT 'disponible'
);

CREATE TABLE solicitudes_traslado (
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    nombre_paciente VARCHAR(150) NOT NULL,
    tipo_traslado ENUM('Paciente', 'Medicamentos', 'Organos') NOT NULL,
    direccion_destino TEXT NOT NULL,
    anotaciones TEXT,
    estado ENUM('pendiente', 'en_trayecto', 'finalizado', 'cancelado') DEFAULT 'pendiente',
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE traslados (
    id_traslado INT AUTO_INCREMENT PRIMARY KEY,
    id_solicitud INT UNIQUE NOT NULL,
    id_vehiculo INT NOT NULL,
    id_chofer INT NOT NULL,
    enfermeros_asignados TEXT,
    estado ENUM('En Trayecto', 'Finalizado', 'Cancelado') DEFAULT 'En Trayecto',
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_finalizacion TIMESTAMP NULL,
    FOREIGN KEY (id_solicitud) REFERENCES solicitudes_traslado(id_solicitud),
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculos(id_vehiculo),
    FOREIGN KEY (id_chofer) REFERENCES usuarios(id_usuario)
);

-- DATOS INICIALES OBLIGATORIOS
INSERT INTO temporal (id_rol, nombre) VALUES (1, 'Administrador'), (2, 'Medico'), (3, 'Chofer');
INSERT INTO categorias (nombre) VALUES ('Instrucciones Prequirúrgicas'), ('Protocolos de Admisión'), ('Guías Alimentarias'), ('Documentación General');
INSERT INTO vehiculos (codigo, matricula) VALUES ('Móvil 01', 'AAA-1234'), ('Móvil 02', 'BBB-5678'), ('Móvil 03', 'CCC-9012');
