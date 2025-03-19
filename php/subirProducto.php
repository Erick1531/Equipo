<?php
session_start();
require_once 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria_id = $_POST['categoria_id'];

    // Manejar la subida de la imagen
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $imagen = $_FILES['file']['name']; // Nombre del archivo
        $temp_name = $_FILES['file']['tmp_name']; // Ruta temporal del archivo
        $upload_dir = 'uploads/'; // Carpeta donde se guardará la imagen

        // Crear la carpeta "uploads" si no existe
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Mover el archivo a la carpeta "uploads"
        if (move_uploaded_file($temp_name, $upload_dir . $imagen)) {
            // El archivo se subió correctamente
        } else {
            echo '<script>alert("Error al subir la imagen.");
            window.location.href="http://192.168.100.7/ProyectoUtt/Equipo/vender.php";
            </script>';
            exit();
        }
    } else {
        echo '<script>alert("No se subió ninguna imagen.");
        window.location.href="http://192.168.100.7/ProyectoUtt/Equipo/vender.php";
        </script>';
        exit();
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO Productos (titulo, descripcion, precio, imagen, id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $titulo, $descripcion, $precio, $imagen, $categoria_id);

    if ($stmt->execute()) {
        echo '<script>alert("Producto publicado 🎉");
        window.location.href="http://192.168.100.7/ProyectoUtt/Equipo/vender.php";
        </script>';
    } else {
        echo '<script>alert("Error al publicar el producto.");
        window.location.href="http://192.168.100.7/ProyectoUtt/Equipo/vender.php";
        </script>';
    }
}