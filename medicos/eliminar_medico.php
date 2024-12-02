<?php
$conexion = new mysqli("localhost", "root", "", "control_medico");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM medicos WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: medicos.php");
    } else {
        echo "Error: " . $conexion->error;
    }
}

$conexion->close();
?>
