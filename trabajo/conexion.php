<?php
// Configurar las cabeceras para permitir JSON y CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

// --- 🔗 Conexión a PostgreSQL (CockroachDB) ---
$host = "elite-chinook-8290.j77.aws-us-west-2.cockroachlabs.cloud";
$port = "26257";
$dbname = "defaultdb";
$user = "erick";
$password = "CnG6U2if2Gy32onB4q8gWQ"; // Reemplaza con tu contraseña real

try {
    // Crear conexión con PDO
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=verify-full";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Manejo de errores
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Obtener resultados como array asociativo
    ];
    $conn = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die(json_encode(["error" => "Error de conexión: " . $e->getMessage()]));
}

// --- 📌 Si la solicitud es GET, obtener todos los registros ---
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $stmt = $conn->query("SELECT * FROM usuarios");
        $usuarios = $stmt->fetchAll();
        echo json_encode($usuarios);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error al obtener datos: " . $e->getMessage()]);
    }
    exit;
}

// --- 📌 Si la solicitud es POST, insertar un nuevo usuario ---
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);

if (!$data || !isset($data["nombre"]) || !isset($data["email"])) {
    echo json_encode(["error" => "Faltan datos"]);
    exit;
}

$nombre = $data["nombre"];
$email = $data["email"];

try {
    $query = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    echo json_encode(["success" => "Datos guardados correctamente"]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error al guardar los datos: " . $e->getMessage()]);
}

?>
