<?php

//conexion a la base de datos

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ravenmarket';

//crear conexion
$conn = new mysqli($host,$user, $password, $database);

if  ($conn->connect_error){
    die("No se pudo conectar a la base de datos" . $conn->connect_error);
}else {
    echo 'conexion correcta';
}

?>