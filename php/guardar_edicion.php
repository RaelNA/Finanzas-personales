
<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../principal.php");
    exit();
}

$id_transaccion = intval($_POST['id']);
$usuario = $_SESSION['usuario'];

$descripcion = trim($_POST['descripcion']);
$categoria = $_POST['categoria'];
$cantidad = floatval($_POST['cantidad']);
$type = $_POST['type'];
$method = $_POST['method'];

// Validaciones básicas
if (
    $cantidad <= 0 ||
    !in_array($type, ['ingreso', 'gasto']) ||
    !in_array($method, ['efectivo', 'tarjeta', 'transferencia']) ||
    !in_array($categoria, ['Salario', 'Comida', 'Transporte', 'Ocio', 'Servicios', 'Otros']) ||
    empty($descripcion)
) {
    echo "Datos inválidos.";
    exit();
}

// Verificar que el usuario tiene permiso sobre esa transacción
$stmt = $conexion->prepare("SELECT t.id FROM transacciones t JOIN usuarios u ON t.id_usuario = u.id WHERE t.id = ? AND u.usuario = ?");
$stmt->bind_param("is", $id_transaccion, $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $stmt->close();
    header("Location: ../principal.php");
    exit();
}
$stmt->close();

// Realizar actualización
$stmt = $conexion->prepare("UPDATE transacciones SET cantidad = ?, type = ?, method = ?, descripcion = ?, categoria = ? WHERE id = ?");
$stmt->bind_param("dssssi", $cantidad, $type, $method, $descripcion, $categoria, $id_transaccion);
if ($stmt->execute()) {
    header("Location: ../principal.php");
    exit();
} else {
    echo "Error al guardar cambios.";
}
$stmt->close();
?>
