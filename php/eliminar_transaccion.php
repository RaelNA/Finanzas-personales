
<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario']) || !isset($_POST['id'])) {
    header("Location: ../principal.php");
    exit();
}

$id_transaccion = intval($_POST['id']);
$usuario = $_SESSION['usuario'];

$stmt = $conexion->prepare("SELECT t.id FROM transacciones t JOIN usuarios u ON t.id_usuario = u.id WHERE t.id = ? AND u.usuario = ?");
$stmt->bind_param("is", $id_transaccion, $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    // No cerrar aún
    $delete = $conexion->prepare("DELETE FROM transacciones WHERE id = ?");
    $delete->bind_param("i", $id_transaccion);
    $delete->execute();
    $delete->close();
}

$stmt->close(); // Solo se cierra una vez aquí

header("Location: ../principal.php");
exit();
?>
