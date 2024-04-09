<?php
// Verificar si se recibió un ID válido para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["rut"])) {
    // Obtener el ID del registro a eliminar
    $rut = $_POST["rut"];
    
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "phptest");
    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    
    // Preparar la consulta SQL para eliminar el registro
    $sql = "DELETE FROM persona WHERE rut = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $rut);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
    
    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
} else {
    // Si no se recibió un ID válido, redirigir a la página principal
    header("Location: index.php");
    exit();
}
?>
