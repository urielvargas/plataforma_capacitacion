<?php
session_start();
include 'conexion.php';

// Verifica si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Busca el usuario por correo
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verifica la contraseña
        if (password_verify($password, $usuario['password'])) {
            // Guarda datos en la sesión
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['correo'] = $usuario['correo'];

            // Redirige al panel principal del usuario
            header("Location: panel_usuario.php");
            exit();
        } else {
            echo "<p>Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p>No se encontró el usuario.</p>";
    }
}
?>
