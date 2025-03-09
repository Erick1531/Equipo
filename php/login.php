<?php
require_once 'Conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; // Capturamos la contraseña del formulario

    $sql = "SELECT correo, password FROM Usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $usuario['password'])) {
            echo "<script>
                alert('Bienvenido, $email');
                window.location.href='http://192.168.100.7/ProyectoUtt/Equipo/Homepage.php';
            </script>";
        } else {
            echo "<script>alert('Correo o contraseña incorrecta'); window.location.href='../login.html';</script>";
        }
    } else {
        echo "<script>alert('Correo no registrado'); window.location.href='../login.html';</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>
