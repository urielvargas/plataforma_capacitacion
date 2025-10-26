<?php
session_start();
include('conexion.php');

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$id_curso = intval($_POST['id_curso']);

// Verificar si ya está inscrito
$verificar = $conn->prepare("SELECT * FROM inscripciones WHERE id_usuario = ? AND id_curso = ?");
$verificar->bind_param("ii", $id_usuario, $id_curso);
$verificar->execute();
$res = $verificar->get_result();

if ($res->num_rows > 0) {
    echo "<p>⚠️ Ya estás inscrito en este curso.</p>";
    echo "<a href='panel_usuario.php'>Volver al panel</a>";
} else {
    $stmt = $conn->prepare("INSERT INTO inscripciones (id_usuario, id_curso) VALUES (?, ?)");
    $stmt->bind_param("ii", $id_usuario, $id_curso);
    if ($stmt->execute()) {
        echo "<h2>✅ Inscripción exitosa</h2>";
        echo "<a href='panel_usuario.php'>Volver al panel</a>";
    } else {
        echo "Error al inscribirse: " . $conn->error;
    }
}

$conn->close();
?>
