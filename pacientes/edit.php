<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "control_medico");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verifica si el número de expediente está presente en la URL
if (isset($_GET['numero_expediente'])) {
    $numero_expediente = $_GET['numero_expediente'];

    // Obtener los datos del paciente para mostrarlos en el formulario
    $sql = "SELECT * FROM pacientes WHERE numero_expediente = '$numero_expediente'";
    $resultado = $conexion->query($sql);
    $paciente = $resultado->fetch_assoc();
}

// Procesar la actualización del paciente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_paciente = $_POST['nombre_paciente'];
    $telefono = $_POST['telefono'];
    $municipio = $_POST['municipio'];
    $colonia = $_POST['colonia'];
    $fecha = $_POST['fecha'];

    // Actualizar los datos del paciente en la base de datos
    $update_sql = "UPDATE pacientes SET 
                    nombre_paciente = '$nombre_paciente', 
                    telefono = '$telefono',
                    municipio = '$municipio',
                    colonia = '$colonia',
                    fecha = '$fecha'
                    WHERE numero_expediente = '$numero_expediente'";

    if ($conexion->query($update_sql) === TRUE) {
        // Redirigir a la página de vista de pacientes después de editar
        header("Location: view.php");
        exit(); // Es importante llamar a exit() después de header para detener la ejecución del script
    } else {
        echo "Error al actualizar el paciente: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="../assets/css/style01pacientes.css">
</head>
<body>
    <h2>Editar Paciente</h2>
    <form method="POST" action="edit.php?numero_expediente=<?= $numero_expediente ?>">
        <label for="nombre_paciente">Nombre del Paciente:</label>
        <input type="text" name="nombre_paciente" id="nombre_paciente" value="<?= $paciente['nombre_paciente'] ?>" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="<?= $paciente['telefono'] ?>" required><br><br>

        <label for="municipio">Municipio:</label>
        <input type="text" name="municipio" id="municipio" value="<?= $paciente['municipio'] ?>" required><br><br>

        <label for="colonia">Colonia:</label>
        <input type="text" name="colonia" id="colonia" value="<?= $paciente['colonia'] ?>"><br><br>

        <label for="fecha">Fecha de Registro:</label>
        <input type="date" name="fecha" id="fecha" value="<?= $paciente['fecha'] ?>" required><br><br>

        <button type="submit">Actualizar Paciente</button>
    </form>
</body>
</html>
