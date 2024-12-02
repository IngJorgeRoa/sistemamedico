<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new mysqli("localhost", "root", "", "control_medico");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $nombre = $_POST['nombre'];

    $sql = "INSERT INTO medicos (nombre) VALUES ('$nombre')";
    if ($conexion->query($sql) === TRUE) {
        header("Location: medicos.php");
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Médico</title>
    <link rel="stylesheet" href="../assets/css/style02medicos.css">
</head>
<body>
    <div class="form-container">
        <h2>Agregar Médico</h2>
        <form action="" method="POST">
            <label for="nombre">Nombre del Médico</label>
            <input type="text" id="nombre" name="nombre" required>
            <button type="submit" class="btn">Guardar</button>
        </form>
    </div>
</body>
</html>
