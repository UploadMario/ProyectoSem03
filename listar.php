<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "sistema_ventas";

// Conexión
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta
$sql = "SELECT * FROM ventas";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ventas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">
    <h2>Lista de Ventas</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>

        <?php if ($resultado->num_rows > 0) { ?>
            <?php while($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['cliente']; ?></td>
                    <td><?php echo $fila['producto']; ?></td>
                    <td><?php echo $fila['cantidad']; ?></td>
                    <td><?php echo $fila['precio']; ?></td>
                    <td><?php echo $fila['total']; ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6">No hay registros</td>
            </tr>
        <?php } ?>

    </table>

    <br>
    <a href="index.html">⬅ Volver</a>
</div>

</body>
</html>

<?php
$conexion->close();
?>

