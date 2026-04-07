<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "sistema_ventas";

// Conectar a la base de datos
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario (enviados por fetch)
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $cliente = $data['cliente'];
    $producto = $data['producto'];
    $cantidad = $data['cantidad'];
    $precio = $data['precio'];
    $total = $data['total'];

    $sql = "INSERT INTO ventas (cliente, producto, cantidad, precio, total) 
            VALUES ('$cliente', '$producto', '$cantidad', '$precio', '$total')";

    if ($conexion->query($sql) === TRUE) {
        echo json_encode(["mensaje" => "Venta registrada con éxito"]);
    } else {
        echo json_encode(["error" => "Error al registrar: " . $conexion->error]);
    }
}

$conexion->close();
?>