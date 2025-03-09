<?php
require_once '../Equipo/php/Conexion.php';

$sql = "SELECT titulo, descripcion, precio, imagen FROM Productos ORDER BY fecha_publicacion DESC";
$resultado = $conn->query($sql);
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

    <div class="imgContainer">
        <div>
            <img src="./img/Captura de pantalla 2025-01-29 211719.png" alt="404" width="80%" height="80%">
        </div>
        <img class="FotoPerfil" src="./img/portada-foto-perfil-redes-sociales-consejos.jpg" alt="Foto de perfil">
        <a href="../Equipo/categorias.html">
            <button>Categorys</button>
        </a>
    </div>
        <a href="../Equipo/vender.html">
            <button>Seld</button>
        </a>
    <h1>Productos en venta</h1>
    
    <div class="productos">
        <?php while ($producto = $resultado->fetch_assoc()): ?>
            <div class="producto">
                <img src="<?php echo $producto['imagen']; ?>" alt="Imagen de <?php echo $producto['titulo']; ?>">
                <h2><?php echo $producto['titulo']; ?></h2>
                <p><?php echo $producto['descripcion']; ?></p>
                <p><strong>$<?php echo number_format($producto['precio'], 2); ?></strong></p>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>

<?php $conn->close(); ?>
