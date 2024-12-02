<?php
$conexion = new mysqli("localhost", "root", "", "control_medico");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $resultado = $conexion->query("SELECT * FROM medicos WHERE id = $id");
    $medico = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    $sql = "UPDATE medicos SET nombre = '$nombre' WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: medicos.php");
    } else {
        echo "Error: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Médico</title>
    <link rel="stylesheet" href="../assets/css/style02medicos.css">
</head>
<body>
    <div class="form-container">
        <h2>Editar Médico</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $medico['id'] ?>">
            <label for="nombre">Nombre del Médico</label>
            <input type="text" id="nombre" name="nombre" value="<?= $medico['nombre'] ?>" required>
            <button type="submit" class="btn">Actualizar</button>
        </form>
    </div>
</body>
</html>
