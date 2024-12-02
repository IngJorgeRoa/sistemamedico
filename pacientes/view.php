<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "control_medico");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener todos los pacientes
$sql = "SELECT * FROM pacientes";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" href="../assets/css/style01pacientes.css">
</head>
<body>
    <div class="container">
        <h2>Pacientes Registrados</h2>
        <a href="nuevopaciente.php"><button type="submit" class="btn">Nuevo paciente</button></a>
        <br>
        <a href="../index.php"><button type="submit" class="btn">Ir a menú</button></a>
        <table>
            <thead>
                <tr>
                    <th>Número de Expediente</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Municipio</th>
                    <th>Colonia</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $fila['numero_expediente'] ?></td>
                        <td><?= $fila['nombre_paciente'] ?></td>
                        <td><?= $fila['telefono'] ?></td>
                        <td><?= $fila['municipio'] ?></td>
                        <td><?= $fila['colonia'] ?></td>
                        <td><?= $fila['fecha'] ?></td>
                        <td>
                        <a href="edit.php?numero_expediente=<?php echo $fila['numero_expediente']; ?>" class="btn btn-warning">Editar</a>
                        <a href="delete.php?numero_expediente=<?php echo $fila['numero_expediente']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conexion->close();
