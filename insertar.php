<?php
// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
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
    
    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO persona (rut, nombre, apellido, edad) VALUES ('$rut', '$nombre', '$apellido', $edad)";
    
    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error al insertar los datos: " . $conexion->error;
    }
    
    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se enviaron datos del formulario, redirigir a la página principal
    header("Location: index.php");
    exit();
}
?>
