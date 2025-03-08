<?php
require_once 'Conexion.php';

$email = $_POST['email'];

$sql = "INSERT into Correo (correo) values (?)";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("s",$email);

if ($stmt -> execute()) {
    echo "Registro exitoso 🎉";
    header("location: http://localhost/Proyectoutt/equipo/personalInfo.html");
}else {
 echo "Error al registrar: " . $conn -> error;
};