<?php
// Conectar a la base de datos
include("../bd/conexion.php");

// Verificar si se ha enviado un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener el tratamiento a editar
    $query = "SELECT * FROM tratamientos WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $tratamiento = mysqli_fetch_assoc($result);
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_expediente = $_POST['numero_expediente'];
    $nombre_paciente = $_POST['nombre_paciente'];
    $tratamiento = $_POST['tratamiento'];
    $cantidad = $_POST['cantidad'];
    $costo_unitario = $_POST['costo_unitario'];
    $costo_total = $cantidad * $costo_unitario;
    $fecha = $_POST['fecha'];

    // Actualizar los datos en la base de datos
    $query = "UPDATE tratamientos SET
                numero_expediente = '$numero_expediente',
                nombre_paciente = '$nombre_paciente',
                tratamiento = '$tratamiento',
                cantidad = '$cantidad',
                costo_unitario = '$costo_unitario',
                costo_total = '$costo_total',
                fecha = '$fecha'
              WHERE id = $id";
    mysqli_query($conn, $query);

    // Redirigir después de guardar
    header("Location: tratamientos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tratamiento</title>
    <link rel="stylesheet" href="../assets/css/style03tratamientos.css">
</head>
<body>
    <div class="container">
        <h2>Editar Tratamiento</h2>
        <form method="POST">
            <label for="numero_expediente">Número de Expediente:</label>
            <input type="text" id="numero_expediente" name="numero_expediente" value="<?php echo $tratamiento['numero_expediente']; ?>" required>

            <label for="nombre_paciente">Nombre del Paciente:</label>
            <input type="text" id="nombre_paciente" name="nombre_paciente" value="<?php echo $tratamiento['nombre_paciente']; ?>" required>

            <label for="tratamiento">Tratamiento:</label>
            <input type="text" id="tratamiento" name="tratamiento" value="<?php echo $tratamiento['tratamiento']; ?>" required>

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" value="<?php echo $tratamiento['cantidad']; ?>" required>

            <label for="costo_unitario">Costo Unitario:</label>
            <input type="number" step="0.01" id="costo_unitario" name="costo_unitario" value="<?php echo $tratamiento['costo_unitario']; ?>" required>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $tratamiento['fecha']; ?>" required>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
