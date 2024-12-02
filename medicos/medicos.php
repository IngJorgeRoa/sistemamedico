<?php
$conexion = new mysqli("localhost", "root", "", "control_medico");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$resultado = $conexion->query("SELECT * FROM medicos");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Médicos</title>
    <link rel="stylesheet" href="../assets/css/style02medicos.css">
</head>
<body>
    <div class="form-container">
        <h2>Lista de Médicos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $fila['id'] ?></td>
                    <td><?= $fila['nombre'] ?></td>
                    <td>
                        <a href="editar_medico.php?id=<?= $fila['id'] ?>">Editar</a> | 
                        <a href="eliminar_medico.php?id=<?= $fila['id'] ?>" class="delete-btn">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="agregar_medico.php" class="btn">Agregar Médico</a>
        <a href="../index.php" class="btn">Ir al menú principal</a>
    </div>
</body>
</html>
