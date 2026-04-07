<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "sistema_ventas";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM ventas WHERE id = $id";
    $resultado = $conexion->query($sql);
    $venta = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $total = $_POST['total'];

    $sql = "UPDATE ventas 
            SET cliente='$cliente', producto='$producto', cantidad='$cantidad', precio='$precio', total='$total'
            WHERE id=$id";

    if ($conexion->query($sql) === TRUE) {
        echo "Venta actualizada correctamente";
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Venta</title>
</head>
<body>

<h2>Editar Venta</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $venta['id']; ?>">

    <label>Cliente:</label>
    <input type="text" name="cliente" value="<?php echo $venta['cliente']; ?>">

    <label>Producto:</label>
    <input type="text" name="producto" value="<?php echo $venta['producto']; ?>">

    <label>Cantidad:</label>
    <input type="number" name="cantidad" value="<?php echo $venta['cantidad']; ?>">

    <label>Precio:</label>
    <input type="number" name="precio" value="<?php echo $venta['precio']; ?>">

    <label>Total:</label>
    <input type="text" name="total" value="<?php echo $venta['total']; ?>">

    <button type="submit">Actualizar</button>
</form>

</body>
</html>