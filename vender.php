<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Producto</title>
</head>
<body>
    <h3>Nuevo Producto</h3>
    <h3>Añadir imagen al producto</h3>
    <div>
        <form action="../Equipo/php/subirProducto.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file" accept="image/*" required>
            <input type="text" placeholder="Título" name="titulo" required>
            <input type="number" placeholder="Precio" name="precio" required>
            <select name="categoria_id" id="categoria_id" required>
                <?php
                require_once '../Equipo/php/Conexion.php';
                $sql = "SELECT * FROM categorias";
                $resultado = $conn->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($categoria = $resultado->fetch_assoc()) {
                        echo "<option value='$categoria[id]'>$categoria[Category]</option>";
                    }
                } else {
                    echo "<option>No hay categorías disponibles</option>";
                }
                ?>
            </select>
            <input type="text" placeholder="Descripción" name="descripcion" required>
            <button type="submit">Publicar</button>
        </form>
    </div>
</body>
</html>