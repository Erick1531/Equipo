<?php
require_once 'Conexion.php';
$email = $_POST['email'];


$sql = "SELECT * FROM Correo WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$email);


if ($stmt -> execute()) {
    echo "<script>
    alert('Bienvenido'.$email);
    window.location.href='http://localhost/ProyectoUtt/Equipo/Homepage.html'
    </script>";
}else{
    echo "<script>alert('Correo o contraseña incorrecta: " . $conn->error . "');</script>";
}
