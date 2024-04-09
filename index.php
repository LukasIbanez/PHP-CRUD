<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario PHP</title>
</head>
<body>
    <h1>Formulario PHP</h1>
    
    <form action="insertar.php" method="post">
        <label for="rut">RUT:</label>
        <input type="text" id="rut" name="rut" required><br><br>
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>
        
        <input type="submit" value="Guardar">
    </form>
    
    <h2>Datos de Personas</h2>
    <table border="1">
        <tr>
            <th>RUT</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "phptest");
        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error en la conexión: " . $conexion->connect_error);
        }
        // Consultar datos de la tabla persona
        $sql = "SELECT rut, nombre, apellido, edad FROM persona";
        $result = $conexion->query($sql);
        // Mostrar los datos en la tabla
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<form action='actualizar.php' method='post'>";
                echo "<td style='color:gray;'>" . $row["rut"] . "</td>";
                echo "<td><input type='text' name='nombre' value='" . $row["nombre"] . "'></td>";
                echo "<td><input type='text' name='apellido' value='" . $row["apellido"] . "'></td>";
                echo "<td><input type='number' name='edad' value='" . $row["edad"] . "'></td>";
                echo "<td>
                        <input type='hidden' name='rut' value='" . $row["rut"] . "'>
                        <input type='submit' value='Editar'>
                    </td>";
                echo "</form>";
                echo "<form action='borrar.php' method='post'>";
                echo "<td>
                        <input type='hidden' name='rut' value='" . $row["rut"] . "'>
                        <input type='submit' value='Eliminar'>
                    </td>";
                echo "</form>";
                echo "</tr>";

            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron datos</td></tr>";
        }
        if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
            $rut = isset($_GET['rut']) ? $_GET['rut'] : '';
            echo "<script>
                    window.onload = function() { 
                        alert('Se editó el RUT " . $rut . " correctamente');
                        window.location.replace(window.location.href.split('?')[0]);
                    }
                  </script>";
        }
        // Cerrar la conexión
        $conexion->close();
        ?>
    </table>
</body>
</html>
