<?php
session_start();
include 'conexion.php';

// Si no hay sesión, redirige al login
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

// Obtiene el nombre del usuario
$nombre = $_SESSION['nombre'];

// Consulta todos los cursos
$sql = "SELECT * FROM cursos ORDER BY fecha_creacion DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario - Plataforma de Capacitación</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fb;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0b2d48;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .contenedor {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
        }

        h2 {
            color: #0b2d48;
        }

        .cursos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .curso {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 15px;
            text-align: center;
            transition: 0.2s;
        }

        .curso:hover {
            transform: scale(1.03);
        }

        .btn-inscribir {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #0097a7;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-inscribir:hover {
            background-color: #007c8a;
        }

        .logout {
            text-align: right;
            margin-top: 10px;
        }

        .logout a {
            color: #ff5252;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenido, <?php echo htmlspecialchars($nombre); ?> 👋</h1>
</header>

<div class="contenedor">
    <div class="logout">
        <a href="logout.php">Cerrar sesión</a>
    </div>

    <h2>📚 Cursos Disponibles</h2>

    <div class="cursos">
        <?php
        if ($resultado->num_rows > 0) {
            while ($curso = $resultado->fetch_assoc()) {
                echo "
                <div class='curso'>
                    <h3>{$curso['nombre_curso']}</h3>
                    <p>{$curso['descripcion']}</p>
                    <p><b>Duración:</b> {$curso['duracion']}</p>
                    <p><b>Nivel:</b> {$curso['nivel']}</p>
                    <a class='btn-inscribir' href='inscribirse.php?id_curso={$curso['id_curso']}'>Inscribirme</a>
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
