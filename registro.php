<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conexion.php'; // Conexión a la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $edad = $_POST["edad"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $correo = $_POST["correo"];
    $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT); // Encriptar contraseña
    $ID_Rol = '11111111-1111-1111-1111-111111111111'; // ID del rol "Usuario"
    // Consulta segura con sentencias preparadas
    $sql = "INSERT INTO Usuarios (Nombre, Apellidos, Edad, Nombre_Usuario, Correo, Contraseña, ID_Rol) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    $stmt->bind_param("ssissss", $nombre, $apellidos, $edad, $nombre_usuario, $correo, $contraseña, $ID_Rol);
    if ($stmt->execute()) {
        echo "<script>
                alert('Registro exitoso como Usuario Aprendiz');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<p>Error en el registro: " . $stmt->error . "</p>";
    }
    $stmt->close();    // Cerrar recursos
    $conexion->close();
} ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | IziFinanzas</title>
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

        .container {
            background: var(--white);
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-light), var(--primary-dark));
        }

        .logo {
            text-align: center;
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
            text-align: center;
        }

        .subtitle {
            color: var(--secondary-color);
            font-size: 16px;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .input-field {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }

        .input-field i {
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

        .input-group .input-field {
            width: 48%;
        }

        .btn {
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

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(16, 139, 54, 0.4);
        }

        .terms {
            display: flex;
            align-items: center;
            margin: 20px 0;
            font-size: 14px;
            color: var(--secondary-color);
        }

        .terms input {
            width: auto;
            margin-right: 10px;
            accent-color: var(--primary-light);
        }

        .terms a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 500;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 15px;
            color: var(--secondary-color);
        }

        .login-link a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .password-strength {
            margin-top: 5px;
            font-size: 13px;
            color: #636e72;
            text-align: left;
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px;
                width: 90%;
            }
            
            .input-group {
                flex-direction: column;
                gap: 0;
            }
            
            .input-group .input-field {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 25px 20px;
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
    <div class="container">
        <div class="logo">
            <img src="img/iz.png" alt="IziFinanzas Logo">
        </div>
        <h2>Crea tu cuenta</h2>
        <p class="subtitle">Únete a nuestra comunidad y comienza tu viaje financiero</p>
        
        <form action="registro.php" method="POST">
            <div class="input-group">
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nombre" placeholder="Nombre" 
                           required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}" 
                           title="Solo letras, mínimo 2 caracteres" maxlength="50">
                </div>
                <div class="input-field">
                    <i class="fas fa-users"></i>
                    <input type="text" name="apellidos" placeholder="Apellidos" 
                           required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}" 
                           title="Solo letras, mínimo 2 caracteres" maxlength="50">
                </div>
            </div>
            <div class="input-group">
                <div class="input-field">
                    <i class="fas fa-birthday-cake"></i>
                    <input type="number" name="edad" placeholder="Edad" 
                           required min="18" max="100" 
                           title="Debes tener entre 18 y 100 años">
                </div>  
                <div class="input-field">
                    <i class="fas fa-at"></i>
                    <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" 
                           required minlength="4" maxlength="20" 
                           pattern="[a-zA-Z0-9_]{4,20}" 
                           title="Entre 4 y 20 caracteres, solo letras, números y guiones bajos">
                </div>
            </div>
            <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="correo" placeholder="Correo electrónico" 
                       required maxlength="320">
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="contraseña" placeholder="Contraseña" 
                       required minlength="6" maxlength="50"
                       title="Mínimo 6 caracteres">
                <p class="password-strength">La contraseña debe tener al menos 6 caracteres</p>
            </div>
            <div class="terms">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">Acepto los <a href="#">Términos y Condiciones</a> y la <a href="#">Política de Privacidad</a></label>
            </div>

            <button type="submit" class="btn">Crear cuenta</button>
        </form>

        <p class="login-link">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>
    <script>
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