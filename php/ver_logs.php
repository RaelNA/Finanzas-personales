<?php
session_start();
include 'conexion.php';

// Solo administradores
if (!isset($_SESSION['usuario']) || $_SESSION['id_tipo_usuario'] != 2) {
    header("Location: ../index.php");
    exit();
}

// Leer logs de la base de datos
$stmt = $conexion->prepare("SELECT fecha, usuario, accion FROM logs ORDER BY fecha DESC");
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Actividad del Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="bi bi-wallet2"></i> Finanzas Personales
        </a>
        <div class="ms-auto d-flex align-items-center">
            <?php if(isset($_SESSION['usuario'])): ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill"></i>
                        <?php 
                        if(!empty($_SESSION['usuario'])) {
                            echo htmlspecialchars($_SESSION['usuario']);
                        }
                        ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
<?php if (isset($_SESSION['id_tipo_usuario']) && $_SESSION['id_tipo_usuario'] == 2): ?>
    <li><a class="dropdown-item" href="admin_panel.php">
        <i class="bi bi-speedometer2"></i> Panel de Administrador
    </a></li>
    <li><hr class="dropdown-divider"></li>
<?php endif; ?>

                        <li><a class="dropdown-item" href="perfil.php">
                            <i class="bi bi-person-lines-fill"></i> Editar Perfil
                        </a></li>
                        <li><a class="dropdown-item" href="../php/cerrar_sesion.php">
                            <i class="bi bi-arrow-repeat"></i> Cambiar Usuario
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../php/cerrar_sesion.php">
                            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                        </a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<body class="bg-light text-dark">
<div class="container my-5">
    <h2 class="mb-4"><i class="bi bi-journal-text"></i> Actividad del Sistema</h2>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['fecha'] ?></td>
                    <td><?= htmlspecialchars($row['usuario']) ?></td>
                    <td><?= htmlspecialchars($row['accion']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="admin_panel.php" class="btn btn-outline-secondary mt-4">
        <i class="bi bi-arrow-left"></i> Volver al panel
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
