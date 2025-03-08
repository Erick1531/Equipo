<?php
session_start();
require_once 'Conexion.php';

$email = $_POST['email'];

$sql = "UPDATE Usuarios SET correo = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $email, $_SESSION['user_id']); // "si" -> string (correo), integer (id)

if ($stmt->execute()) {
    echo "<script>
            alert('Registro exitoso 🎉');
            window.location.href = 'http://localhost/Proyectoutt/equipo/PersonalInfo.html';
          </script>";
    exit();
} else {
    echo "<script>alert('Error al registrar el correo: " . $conn->error . "');</script>";
}

$stmt->close();
$conn->close();
?>
