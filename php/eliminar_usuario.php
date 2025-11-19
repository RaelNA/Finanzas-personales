<?php
session_start();
include 'conexion.php';

// Solo admins
if (!isset($_SESSION['usuario']) || $_SESSION['id_tipo_usuario'] != 2) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id_usuario = intval($_POST['id']);

    if ($_SESSION['id_usuario'] == $id_usuario) {
        header("Location: usuarios.php");
        exit();
    }

    // Obtener nombre del usuario eliminado
    $stmt = $conexion->prepare("SELECT usuario FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->bind_result($usuario_eliminado);
    $stmt->fetch();
    $stmt->close();

    // Eliminar
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->close();

    // Registrar log
    $accion = "Eliminó al usuario: $usuario_eliminado";
    $usuario_admin = $_SESSION['usuario'];
    $stmt_log = $conexion->prepare("INSERT INTO logs (usuario, accion) VALUES (?, ?)");
    $stmt_log->bind_param("ss", $usuario_admin, $accion);
    $stmt_log->execute();
    $stmt_log->close();
}

header("Location: usuarios.php");
exit();
?>
