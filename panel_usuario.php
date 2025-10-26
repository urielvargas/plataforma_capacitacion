<?php
session_start();
include 'conexion.php';

// Verifica si el usuario tiene sesión activa
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

// Obtiene el nombre del usuario logueado
$nombre = $_SESSION['nombre'];

// Consulta todos los cursos de la base de datos
$sql = "SELECT * FROM cursos ORDER BY fecha_creacion DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario - Plataforma de Capacitación</title>
    <link rel="stylesheet" href="css/panel_usuario.css">
</head>
<body>

<header>
    <h1>Bienvenido, <?php echo htmlspecialchars($nombre); ?> 👋</h1>
</header>

<div class="contenedor">
    <div class="logout">
        <a href="logout.php">Cerrar sesión</a>
    </div>

    <h2> Cursos Disponibles</h2>

    <div class="cursos">
        <?php
        if ($resultado->num_rows > 0) {
            while ($curso = $resultado->fetch_assoc()) {
                echo "
                <div class='curso'>
                    <h3>" . htmlspecialchars($curso['nombre_curso']) . "</h3>
                    <p>" . htmlspecialchars($curso['descripcion']) . "</p>
                    <p><b>Duración:</b> " . htmlspecialchars($curso['duracion']) . "</p>
                    <p><b>Nivel:</b> " . htmlspecialchars($curso['nivel']) . "</p>
                    <a class='btn-inscribir' href='inscribirse.php?id_curso=" . $curso['id_curso'] . "'>Inscribirme</a>
                </div>
                ";
            }
        } else {
            echo "<p>No hay cursos disponibles por el momento.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
