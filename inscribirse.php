<?php
session_start();
include 'conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

// Verifica si se recibió el id del curso
if (isset($_GET['id_curso'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_curso = intval($_GET['id_curso']);

    // Verifica si ya está inscrito
    $verificar = "SELECT * FROM inscripciones WHERE id_usuario = $id_usuario AND id_curso = $id_curso";
    $resultado = $conn->query($verificar);

    if ($resultado->num_rows > 0) {
        echo "<script>alert('Ya estás inscrito en este curso.'); window.location='panel_usuario.php';</script>";
        exit();
    }

    // Inserta la inscripción
    $sql = "INSERT INTO inscripciones (id_usuario, id_curso) VALUES ($id_usuario, $id_curso)";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Inscripción exitosa 🎓'); window.location='panel_usuario.php';</script>";
    } else {
        echo "Error al inscribirse: " . $conn->error;
    }

} else {
    echo "<script>alert('Curso no especificado.'); window.location='panel_usuario.php';</script>";
}
?>
