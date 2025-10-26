<?php
session_start();

// Verificamos que haya sesión iniciada
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cursos de Tecnología</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?> 👋</h1>
        <nav>
            <a href="inicio.php">Inicio</a>
            <a href="cursos.php" class="activo">Cursos</a>
            <a href="logout.php">Cerrar sesión</a>
        </nav>
    </header>

    <section class="contenedor">
        <h2>Cursos de Tecnología</h2>
        <div class="cursos-grid">
            <div class="curso">
                <h3>Desarrollo Web</h3>
                <p>Aprende HTML, CSS, JavaScript y PHP para crear sitios dinámicos.</p>
                <button>Inscribirme</button>
            </div>
            <div class="curso">
                <h3>Introducción a Bases de Datos</h3>
                <p>Domina MySQL y el diseño de bases de datos relacionales.</p>
                <button>Inscribirme</button>
            </div>
            <div class="curso">
                <h3>Python desde Cero</h3>
                <p>Comienza tu camino en la programación con uno de los lenguajes más populares.</p>
                <button>Inscribirme</button>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 Plataforma de Capacitación - Todos los derechos reservados</p>
    </footer>
</body>
</html>
