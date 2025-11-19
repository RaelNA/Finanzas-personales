<?php
session_start(); // Siempre al principio
session_destroy();

echo '<script>
    alert("Sesión cerrada correctamente");
    window.location = "../index.php";
</script>';
exit;
?>