<?php
// Conexión a la base de datos
require_once '../Equipo/php/Conexion.php';

// Consulta para obtener los productos
$sql = "SELECT titulo, descripcion, precio, imagen FROM Productos ORDER BY fecha_publicacion DESC";
$resultado = $conn->query($sql);

// Verificar si hay errores en la consulta
if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="./css/Home.css">
</head>
<body>

    <!-- Encabezado con imagen de portada y foto de perfil -->
    <div class="imgContainer">
        <div>
            <img src="./img/Captura de pantalla 2025-01-29 211719.png" alt="404" width="80%" height="80%">
        </div>
        <img class="FotoPerfil" src="./img/portada-foto-perfil-redes-sociales-consejos.jpg" alt="Foto de perfil">
        <a href="../Equipo/categorias.html">
            <button>Categorys</button>
        </a>
        <a href="../Equipo/vender.php">
            <button>Sell</button>
        </a>
    </div>

    <!-- Título de la sección de productos -->
    <h1>Productos en venta</h1>

    <!-- Lista de productos -->
    <div class="productos">
        <?php while ($producto = $resultado->fetch_assoc()): ?>
            <div class="producto">
                <!-- Mostrar la imagen del producto -->
                <img src=".//php/uploads/<?php echo $producto['imagen']; ?>" alt="Imagen de <?php echo $producto['titulo']; ?>">
                <h2><?php echo $producto['titulo']; ?></h2>
                <p><?php echo $producto['descripcion']; ?></p>
                <p><strong>$<?php echo number_format($producto['precio'], 2); ?></strong></p>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>