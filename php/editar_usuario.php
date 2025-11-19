<?php
session_start();
include 'conexion.php';

// Solo admins pueden acceder
if (!isset($_SESSION['usuario']) || $_SESSION['id_tipo_usuario'] != 2) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id_usuario = intval($_POST['id']);

    // Evitar que el admin se modifique a sí mismo
    if ($_SESSION['id_usuario'] == $id_usuario) {
        header("Location: usuarios.php");
        exit();
    }

    // Obtener el rol actual
    $stmt = $conexion->prepare("SELECT id_tipo_usuario FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->bind_result($rol_actual);
    $stmt->fetch();
    $stmt->close();

    // Alternar rol: 1 <-> 2
    $nuevo_rol = ($rol_actual == 2) ? 1 : 2;

    $stmt = $conexion->prepare("UPDATE usuarios SET id_tipo_usuario = ? WHERE id = ?");
    $stmt->bind_param("ii", $nuevo_rol, $id_usuario);
    $stmt->execute();
    $stmt->close();
}

header("Location: usuarios.php");
exit();
?>
