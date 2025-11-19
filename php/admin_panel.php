
<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['id_tipo_usuario'] != 2) {
    header("Location: ../principal.php");  // O redirige a principal si lo prefieres
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/styles.css">
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

                        <li><a class="dropdown-item" href="../perfil.php">
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
<body class="custom-bg">
<div class="container py-5">
    <h1 class="mb-4">Panel de Administración</h1>

    <div class="alert alert-success" role="alert">
        Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?>. Tienes permisos de administrador.
    </div>

    <ul class="list-group">
        <li class="list-group-item"><a href="usuarios.php">Gestión de usuarios</a></li>
        <li class="list-group-item"><a href="ver_logs.php">Ver actividad del sistema</a></li>
        <li class="list-group-item"><a href="../principal.php">Volver al panel principal</a></li>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
