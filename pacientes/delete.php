<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "control_medico");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verifica si el numero_expediente está presente en la URL
if (isset($_GET['numero_expediente'])) {
    $numero_expediente = $_GET['numero_expediente'];

    // Consulta SQL para eliminar el paciente
    $sql = "DELETE FROM pacientes WHERE numero_expediente = '$numero_expediente'";

    if ($conexion->query($sql) === TRUE) {
        echo "Paciente eliminado con éxito.";
        header("Location: view.php"); // Redirige de vuelta a la vista de pacientes
        exit();
    } else {
        echo "Error al eliminar el paciente: " . $conexion->error;
    }
} else {
    echo "Número de expediente no proporcionado.";
}

$conexion->close();
?>
