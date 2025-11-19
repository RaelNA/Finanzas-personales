
<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($id_usuario);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = trim($_POST['descripcion']);
    $categoria = trim($_POST['categoria']);
    $cantidad = floatval($_POST['cantidad']);
    $type = $_POST['type'];
    $method = $_POST['method'];

    if (
        $cantidad <= 0 ||
        !in_array($type, ['ingreso', 'gasto']) ||
        !in_array($method, ['efectivo', 'tarjeta', 'transferencia']) ||
        empty($descripcion) ||
        empty($categoria)
    ) {
        echo "Datos inválidos.";
        exit();
    }

    $stmt = $conexion->prepare("INSERT INTO transacciones (id_usuario, cantidad, type, method, descripcion, categoria) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("idssss", $id_usuario, $cantidad, $type, $method, $descripcion, $categoria);

    if ($stmt->execute()) {
        header("Location: ../principal.php");
        exit();
    } else {
        echo "Error al guardar: " . $stmt->error;
    }

    $stmt->close();
}
?>
