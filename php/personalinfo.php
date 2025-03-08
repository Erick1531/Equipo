<?php
session_start(); // Iniciar sesión
require_once 'Conexion.php';

// Verificar si el usuario está en sesión
if (!isset($_SESSION['user_id'])) {
    die("Error: No hay usuario en sesión.");
}

$name = trim($_POST['name']);
$lastname = trim($_POST['lastname']);
$password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); // Hashear la contraseña

$sql = "UPDATE Usuarios SET nombre = ?, apellido = ?, password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación: " . $conn->error);
}

$stmt->bind_param("sssi", $name, $lastname, $password, $_SESSION['user_id']);

if ($stmt->execute()) {
    echo "<script>
    alert('Registro exitoso 🎉');
    window.location.href='http://localhost/ProyectoUtt/Equipo/login.html';
    </script>";
} else {
    echo "Error al registrar: " . $conn->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
