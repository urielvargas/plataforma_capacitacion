<?php
include('conexion.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);
    $confirmar = trim($_POST['confirmar']);

    // Verificar que las contraseñas coincidan
    if ($password !== $confirmar) {
        die("Error: Las contraseñas no coinciden.");
    }

    // Encriptar la contraseña antes de guardar
    $password_segura = password_hash($password, PASSWORD_DEFAULT);

    // Preparar e insertar los datos
    $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $password_segura);

    if ($stmt->execute()) {
        echo "<h2>¡Registro exitoso!</h2>";
        echo "<p>Bienvenido, $nombre.</p>";
        echo "<a href='login.html'>Iniciar sesión</a>";
    } else {
        if ($conn->errno == 1062) {
            echo "Error: El correo ya está registrado.";
        } else {
            echo "Error al registrar: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
