<?php
session_start();
require_once 'conexion.php';

$error = '';

// RECIBE LA INFO DEL USUARIA Y LA VERIFICA
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = trim($_POST['cedula'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($cedula) && !empty($password)) {
        $stmt = $pdo->prepare("
            SELECT u.id_usuario, u.cedula, u.password_hash, u.nombre, u.apellido, u.id_rol, r.nombre AS rol 
            FROM usuarios u
            INNER JOIN temporal r ON u.id_rol = r.id_rol
            WHERE u.cedula = :cedula
        ");
        $stmt->execute(['cedula' => $cedula]);
        $usuario = $stmt->fetch();

        // VERIFICACION
        if ($usuario && password_verify($password, $usuario['password_hash'])) {
            $_SESSION['usuario_id']     = $usuario['id_usuario'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'] . ' ' . $usuario['apellido'];
            $_SESSION['usuario_rol']    = $usuario['rol'];
            $_SESSION['id_rol_num']     = $usuario['id_rol'];

            header("Location: gestor-documentos.php");
            exit();
        } else {
            $error = 'Cedula o contraseña incorrectas.';
        }
    } else {
        $error = 'Por favor, complete todos los campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital de Clinicas - Iniciar Sesion</title>
    <!-- ESTE HREF ES SOLO UNA FUENTE (Inter), LOS NUMEROS SON EL GROSOR -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="lado-izq">
        <div class="logo-clinicas">
            <img src="../imgs/logo_clinicas.png" alt="Logo del clinicas" height="150px">
        </div>
        <h1 class="titulo-izq">Excelencia clinica y calidez humana a su servicio</h1>
    </div>

    <div class="parte-login">
        <div class="login">            
            <img src="../imgs/logo_clinicas.png" alt="Logo del clinicas" height="100px">
            <h2 class="form-title">Bienvenido</h2>
            <p class="form-subtitle">Por favor, ingrese sus credenciales para acceder al sistema clinico.</p>

            <!-- MENSAJE DE ERROR -->
            <?php if (!empty($error)): ?>
                <div class="msj-error">
                    <i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="index.php" method="POST">
                <label for="cedula">Cedula de Identidad</label>
                <i class="fa-regular fa-envelope"></i>
                <input type="text" id="cedula" name="cedula" placeholder="Ingrese su cedula" value="<?php echo htmlspecialchars($_POST['cedula'] ?? ''); ?>" required>

                <label for="password">Contraseña</label>
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

                <a href="#" class="forgot-link">¿Olvido su contraseña?</a>

                <button type="submit" class="btn-GD">Iniciar Sesion</button>
                <a href="panel-paciente.php" class="btn-PP">Portal de Pacientes</a>
            </form>

            <div class="soporte">
                ¿Necesita ayuda tecnica? <a href="#">Contacte a Soporte de TI</a>
            </div>
        </div>
    </div>
</body>
</html>