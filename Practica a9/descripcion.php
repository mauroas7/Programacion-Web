<?php
if (!isset($_GET["id"])) {
    exit;
}

$id = intval($_GET["id"]);

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "clinica");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT descripcion FROM especialidades WHERE id = ?");
//bind_param se utiliza para vincular variables a marcadores de posición en una consulta SQL preparada
//"i" para entero
$stmt->bind_param("i", $id);
$stmt->execute();

//bind_result se utiliza para enlazar variables a una sentencia preparada para almacenar los resultados de una consulta a base de datos
$stmt->bind_result($descripcion);

if ($stmt->fetch()) {
    echo $descripcion;
} else {
    echo "Especialidad no encontrada.";
}

$stmt->close();
$conn->close();
?>