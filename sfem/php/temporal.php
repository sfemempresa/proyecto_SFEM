
<?php
require_once 'conexion.php';

// CREA UN ADMIN POR SI NO HAY NINGUNO CREADO

$cedula = "12345666";
$password_plana = "Admin123";
$password_hash = password_hash($password_plana, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("
        INSERT INTO usuarios (cedula, email, password_hash, nombre, apellido, id_rol)
        VALUES (:cedula, 'admin3@clinicas.gub.uy', :password, 'Admin', 'Sistema', 1)
    ");
    $stmt->execute([
        'cedula' => $cedula,
        'password' => $password_hash
    ]);
    echo "¡Administrador inicial creado exitosamente!<br>Cedula: $cedula <br>Contraseña: Admin123";
} catch (PDOException $e) {
    echo "Info: El usuario ya existia o ocurrio un error: " . $e->getMessage();
}
?>