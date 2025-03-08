<?php
require_once 'Conexion.php';

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$password = $_POST['password'];

$sql = "INSERT INTO Informacion_personal (name, lastname, password) VALUES (?, ? ,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $lastname, $password);

if ($stmt->execute()) {
    header("location: http://localhost/ProyectoUtt/Equipo/login.html");
} else {
    echo "Error al registrar: " . $conn->error;
}
// Cerrar conexión
$stmt->close();
$conn->close();
?>