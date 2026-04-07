<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "sistema_ventas";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die(json_encode(["error" => "Error de conexión"]));
}

// Recibir la acción (eliminar_ultimo o eliminar_todo)
$data = json_decode(file_get_contents("php://input"), true);
$accion = $data['accion'];

if ($accion === "eliminar_ultimo") {
    // Elimina el registro con el ID más alto
    $sql = "DELETE FROM ventas ORDER BY id DESC LIMIT 1";
    $msg = "Último registro eliminado";
} else if ($accion === "eliminar_todo") {
    // Vacía toda la tabla
    $sql = "TRUNCATE TABLE ventas";
    $msg = "Todos los datos han sido borrados";
}

if ($conexion->query($sql) === TRUE) {
    echo json_encode(["mensaje" => $msg]);
} else {
    echo json_encode(["error" => "Error al eliminar: " . $conexion->error]);
}

$conexion->close();
?>