<?php
// Verificar si se recibió un ID válido para actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["rut"])) {
    // Obtener los datos enviados por el formulario
    $rut = $_POST["rut"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $edad = $_POST["edad"];
    
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "phptest");
    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    
    // Preparar la consulta SQL para actualizar el registro
    $sql = "UPDATE persona SET nombre=?, apellido=?, edad=? WHERE rut=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssis", $nombre, $apellido, $edad, $rut);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: index.php?edit_success=true&rut=" . urlencode($rut));
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
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
