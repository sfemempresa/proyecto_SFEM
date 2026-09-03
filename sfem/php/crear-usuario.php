<?php
session_start();
require_once 'conexion.php';

// VALIDA QUE ESTES INICIADO
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

if (($_SESSION['id_rol_num'] ?? 0) != 1) {
    echo "Acceso denegado: No tienes permisos para crear usuarios.";
    exit();
}

$mensaje = '';
$tipo_mensaje = '';

// LEE LA TABLA temporal PARA MOSTRAR LOS ROLES
$stmt_roles = $pdo->query("SELECT id_rol, nombre FROM temporal ORDER BY nombre ASC");
$roles = $stmt_roles->fetchAll();

// PRECESA Y ENVIA LOS DATOS
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula   = trim($_POST['cedula'] ?? '');
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $id_rol   = $_POST['id_rol'] ?? '';

    if (empty($cedula) || empty($nombre) || empty($apellido) || empty($email) || empty($password) || empty($id_rol)) {
        $mensaje = "Todos los campos son obligatorios.";
        $tipo_mensaje = "error";
    } else {
        try {
            $checkUser = $pdo->prepare("SELECT cedula, email FROM usuarios WHERE cedula = :cedula OR email = :email");
            $checkUser->execute([':cedula' => $cedula, ':email' => $email]);
            $usuarioExistente = $checkUser->fetch();

            if ($usuarioExistente) {
                if ($usuarioExistente['cedula'] === $cedula) {
                    $mensaje = "Ya existe un usuario registrado con esa Cedula.";
                } else {
                    $mensaje = "Ya existe un usuario registrado con ese Correo Electronico.";
                }
                $tipo_mensaje = "error";
            } else {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuarios (cedula, nombre, apellido, email, password_hash, id_rol) 
                        VALUES (:cedula, :nombre, :apellido, :email, :password_hash, :id_rol)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':cedula'        => $cedula,
                    ':nombre'        => $nombre,
                    ':apellido'      => $apellido,
                    ':email'         => $email,
                    ':password_hash' => $password_hash,
                    ':id_rol'        => $id_rol
                ]);

                $mensaje = "Usuario registrado exitosamente en el sistema.";
                $tipo_mensaje = "exito";
            }
        } catch (PDOException $e) {
            $mensaje = "Error al guardar en la base de datos: " . $e->getMessage();
            $tipo_mensaje = "error";
        }
    }
}

// DATOS DE LA BARRA SUPERIOR
$nombre_usuario = $_SESSION['usuario_nombre'] ?? 'Administrador';
$rol_usuario    = $_SESSION['usuario_rol'] ?? 'Usuario';
$inicial_avatar = strtoupper(substr($nombre_usuario, 0, 1));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - Hospital de Clinicas</title>
    <link rel="stylesheet" href="../css/crear-usuario.css">
</head>
<body>

    <!-- BARRA DE NAVEGACION -->
    <header class="barra-nav">
        <div class="logo-nav">
            <img src="../imgs/logo_clinicas.png" height="75px" alt="Logo">
        </div>
        <div class="btns-nav">
            <a href="trazabilidad.php" class="btn-traza">
                <span>&larr;</span> Volver al Sistema
            </a>
            <div class="info-user">
                <div class="avatar"><?= $inicial_avatar; ?></div>
                <div class="user-info">
                    <span class="user-label"><?= htmlspecialchars($rol_usuario); ?></span>
                    <span class="user-name"><?= htmlspecialchars($nombre_usuario); ?></span>
                </div>
            </div>
            <div class="btn-cierre">
                <a href="logout.php" class="btn-nav">Salir</a>
            </div>
        </div>
    </header>

    <!-- CONTENEDOR PRINCIPAL -->
    <main class="principal">
        
        <section class="nuevo-doc">
            <div class="titulo-sec">
                <h2>Registrar Nuevo Usuario</h2>
            </div>

            <?php if (!empty($mensaje)): ?>
                <div class="alerta <?= ($tipo_mensaje === 'exito') ? 'alerta-exito' : 'alerta-error'; ?>">
                    <?= htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <form action="crear-usuario.php" method="POST">
                
                <div class="area-arch">
                    <label for="cedula" class="titulo-area">Cedula</label>
                    <input type="text" id="cedula" name="cedula" class="input-texto" placeholder="Ej: 12345678" required>
                </div>

                <div class="area-arch">
                    <label for="nombre" class="titulo-area">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="input-texto" placeholder="Ej: Juan" required>
                </div>

                <div class="area-arch">
                    <label for="apellido" class="titulo-area">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="input-texto" placeholder="Ej: Perez" required>
                </div>

                <div class="area-arch">
                    <label for="email" class="titulo-area">Correo Electronico</label>
                    <input type="email" id="email" name="email" class="input-texto" placeholder="juan.perez@hospital.com" required>
                </div>

                <div class="area-arch">
                    <label for="password" class="titulo-area">Contraseña</label>
                    <input type="password" id="password" name="password" class="input-texto" placeholder="*******" required>
                </div>

                <div class="area-cat">
                    <label for="id_rol" class="titulo-area">Rol del Usuario</label>
                    <select id="id_rol" name="id_rol" class="selec-cat" required>
                        <option value="" disabled selected>Seleccione un rol...</option>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= $rol['id_rol']; ?>">
                                <?= htmlspecialchars($rol['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="area-acc">
                    <button type="submit" class="btn-guardar">
                        <span>&#10010;</span> Registrar Usuario
                    </button>
                </div>

            </form>
        </section>

    </main>

</body>
</html>