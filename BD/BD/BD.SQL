CREATE DATABASE companyDB;
USE companyDB;

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    salary DECIMAL(10,2) NOT NULL
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL
);

INSERT INTO productos (nombre, descripcion, precio, stock) VALUES
('Laptop Dell', 'Laptop con procesador i5, 8GB RAM y 256GB SSD.', 1200.50, 5),
('Mouse Inalámbrico', 'Mouse ergonómico con conexión Bluetooth.', 25.99, 15),
('Teclado Mecánico', 'Teclado con switches mecánicos y retroiluminación RGB.', 79.90, 10),
('Monitor 24"', 'Monitor Full HD con panel IPS y 75Hz de refresco.', 180.00, 8),
('Auriculares Gamer', 'Auriculares con sonido envolvente 7.1 y micrófono integrado.', 55.50, 12);

    Select * from productos