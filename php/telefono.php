<?php
session_start();
require_once 'Conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = trim($_POST['telefono']);

    // Generar un correo temporal único
    $correoTemporal = "temp_" . uniqid() . "@ut-tijuana.edu.mx";

    // Sentencia SQL para insertar teléfono y correo temporal
    $sql = "INSERT INTO Usuarios (telefono, correo) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $telefono, $correoTemporal);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->insert_id; // Guardar el ID del usuario en la sesión
        header("Location: http://192.168.100.7/ProyectoUtt/Equipo/email.html"); // Redirigir a la siguiente página
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
