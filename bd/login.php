<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar la base de datos
    $query = "SELECT * FROM usuarios WHERE email = '$email' AND password = MD5('$password')";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_role'] = $user['rol'];

        // Redirigir según el rol
        if ($user['rol'] == 'admin') {
            header('Location: ../index.php');
        } else {
            header('Location: ../login.html');
        }
    } else {
        echo "<script>alert('Correo o contraseña incorrectos'); window.location='login.html';</script>";
    }
}
