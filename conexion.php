<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$base_datos = "plataforma_capacitacion";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $clave, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
