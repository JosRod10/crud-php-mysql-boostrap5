<?php
include("../config/config.php");

$fecha_actual = date("Y-m-d");
$filename = "empleados_" . $fecha_actual . ".xls";

// Configurar las cabeceras para forzar la descarga de un archivo Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

// Encabezados para el archivo Excel
$fields = array('ID', 'Nombre', 'Edad', 'Cedula', 'Sexo', 'Telefono', 'Cargo', 'Avatar');

// Consulta SQL para obtener los datos de los empleados
$sql = "SELECT * FROM tbl_empleados";
// Ejecutar la consulta
$result = $conexion->query($sql);

// Iniciar la salida de la tabla en formato Excel
echo "<table border='1'>";
echo "<tr><th>" . implode("</th><th>", $fields) . "</th></tr>";

// Escribir los datos en la tabla
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($fields as $field) {
            echo "<td>" . htmlspecialchars($row[strtolower($field)]) . "</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='" . count($fields) . "'>No hay empleados disponibles</td></tr>";
}

echo "</table>";

// Cerrar la conexión
$conexion->close();
exit();