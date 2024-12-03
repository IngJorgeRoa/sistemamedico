<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Administrador</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <header>
            <h1>Bienvenido, Administrador</h1>
            <nav>
                <ul>
                    <li><a href="pacientes/view.php">Pacientes</a></li>
                    <li><a href="tratamientos/tratamientos.php">Tratamientos</a></li>
                    <li><a href="medicos/medicos.php">Doctores</a></li>
                    <li><a href="cajas/cajas.php">Cajas</a></li>
                    <li><a href="bd/destroy.php" class="logout-btn">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h2>Panel de Control</h2>
            <p>Selecciona una opción en el menú para gestionar los módulos.</p>
        </main>
    </div>
</body>
</html>
