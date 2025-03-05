<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$dbname = "companydb";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener los productos
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $query = "SELECT id, nombre, descripcion, precio, stock FROM productos";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    }

    // Agregar un producto
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"));
        
        if (isset($data->nombre) && isset($data->descripcion) && isset($data->precio) && isset($data->stock)) {
            $query = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (:nombre, :descripcion, :precio, :stock)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":nombre", $data->nombre);
            $stmt->bindParam(":descripcion", $data->descripcion);
            $stmt->bindParam(":precio", $data->precio);
            $stmt->bindParam(":stock", $data->stock);
            $stmt->execute();
            echo json_encode(["message" => "Producto agregado con éxito"]);
        } else {
            echo json_encode(["error" => "Faltan parámetros"]);
        }
    }

    // Eliminar un producto
    elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $data = json_decode(file_get_contents("php://input"));
        
        if (isset($data->id)) {
            $query = "DELETE FROM productos WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $data->id);
            $stmt->execute();
            echo json_encode(["message" => "Producto eliminado con éxito"]);
        } else {
            echo json_encode(["error" => "Faltan parámetros"]);
        }
    }

} catch (PDOException $e) {
    echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
}
?>
