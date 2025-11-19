<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Finanzas Personales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="bi bi-wallet2"></i> Finanzas Personales</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h5><i class="bi bi-box-arrow-in-right"></i> Acceso</h5>
                </div>
                <div class="card-body">
                    <form id="loginForm" action="php/login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="toggleForms()">Registrarse</button>
                        </div>
                    </form>
                    <form id="registerForm" action="php/registro.php" method="POST" style="display: none;">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success">Registrarse</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="toggleForms()">Volver al Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="js/principal.js"></script>
</body>
</html>
