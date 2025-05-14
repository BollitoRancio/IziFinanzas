<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];
    
    // Limpiar mensajes de error anteriores
    unset($_SESSION['error_login']);

    // Buscar el usuario en la base de datos
    $sql = "SELECT u.*, r.Nombre AS Nombre_Rol 
        FROM usuarios u
        JOIN roles r ON u.ID_Rol = r.ID_Rol
        WHERE u.nombre_usuario = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        // Verificar la contraseña encriptada
        if (password_verify($contraseña, $fila['Contraseña'])) {
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            $_SESSION['rol_usuario'] = $fila['Nombre_Rol'];
            $_SESSION['id_usuario'] = $fila['ID_Usuario'];
            $_SESSION['Nombre'] = $fila['Nombre']; 
            $_SESSION['Apellidos'] = $fila['Apellidos']; 
            $_SESSION['Correo'] = $fila['Correo']; 
            
            header("Location: http://localhost/IziFinanzas/inicio.php");
            exit();
        } else {
            // Contraseña incorrecta
            $_SESSION['error_login'] = "Nombre de usuario o contraseña incorrectos";
            header("Location: login.php");
            exit();
        }
    } else {
        // Usuario no encontrado
        $_SESSION['error_login'] = "Nombre de usuario o contraseña incorrectos";
        header("Location: login.php");
        exit();
    }
    $stmt->close();
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | IziFinanzas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #108b36;
            --primary-light: #1ec75f;
            --primary-dark: #0a5a24;
            --secondary-color: #2c3e50;
            --light-gray: #f8f9fa;
            --white: #ffffff;
            --text-color: #2d3436;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4f0f5 100%);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            line-height: 1.6;
        }

        .login-container {
            background: var(--white);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-light), var(--primary-dark));
        }

        .logo {
            margin-bottom: 25px;
        }

        .logo img {
            height: 50px;
        }

        h2 {
            color: var(--primary-dark);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--secondary-color);
            font-size: 16px;
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-light);
        }

        input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: var(--transition);
            background-color: #f8f9fa;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(30, 199, 95, 0.2);
            background-color: var(--white);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(16, 139, 54, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(16, 139, 54, 0.4);
        }

        .options {
            margin-top: 25px;
            font-size: 14px;
            color: var(--secondary-color);
        }

        .options a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .options a:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #b2bec3;
            font-weight: 500;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dfe6e9;
        }

        .divider::before {
            margin-right: 15px;
        }

        .divider::after {
            margin-left: 15px;
        }
        .register-link {
            margin-top: 30px;
            font-size: 15px;
            color: var(--secondary-color);
        }

        .register-link a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
        /* Mensaje de error */
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #c62828;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            animation: slideDown 0.5s ease-out;
        }

        .error-message i {
            font-size: 18px;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 24px;
            }
            
            .subtitle {
                font-size: 14px;
            }
            
            input {
                padding: 12px 12px 12px 40px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="img/iz.png" alt="IziFinanzas Logo">
        </div>
        <h2>Bienvenido de vuelta</h2>
        <p class="subtitle">Inicia sesión para acceder a tu cuenta</p>
        <?php if(isset($_SESSION['error_login'])): ?>
        <div class="error-message">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo $_SESSION['error_login']; ?></span>
        </div>
        <?php 
            unset($_SESSION['error_login']); // Limpiar el mensaje después de mostrarlo
        endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Iniciar sesión
            </button>
        </form>
        <p class="register-link">¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>
    </div>

    <script>
        // Animación para los campos al enfocar
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = '#108b36';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#1ec75f';
            });
        });
    </script>
</body>
</html>