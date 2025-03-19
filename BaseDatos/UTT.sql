CREATE DATABASE ravenmarket;
USE ravenmarket;

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    telefono VARCHAR(15) UNIQUE NOT NULL,
    correo VARCHAR(255) UNIQUE NOT NULL CHECK (correo LIKE '%@ut-tijuana.edu.mx'),
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    password VARCHAR(255),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('incompleto', 'completo') DEFAULT 'incompleto' -- Para saber si el usuario terminó su registro
);
-- tabla de productos 
CREATE TABLE Productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255) NOT NULL, -- Almacena la ruta de la imagen
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE
);

ALTER TABLE Productos ADD COLUMN categoria_id INT;
ALTER TABLE Productos ADD FOREIGN KEY (categoria_id) REFERENCES Categorias(id) ON DELETE SET NULL;


CREATE Table categorias(
id INT AUTO_INCREMENT PRIMARY KEY,
Category VARCHAR(255) NOT NULL
);



INSERT INTO categorias (Category) VALUES ('Electronics');

SELECT * FROM categorias;
