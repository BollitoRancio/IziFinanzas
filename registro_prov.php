<?php
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];    // Datos generales
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $biografia = $_POST['biografia'];    // Datos adicionales pal proveedor
    $experiencia = $_POST['experiencia'];
    $especialidad = $_POST['especialidad'];
    // ID del rol "Proveedor", q no se olvidee
    $ID_Rol = '22222222-2222-2222-2222-222222222222'; //mucho ojooo
    // Subida de archivo, de mientras
    $certificacion = "";
    if (!empty($_FILES['certificacion']['name'])) {
        $carpeta = "uploads/";
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $nombre_archivo = basename($_FILES['certificacion']['name']);
        $ruta_archivo = $carpeta . time() . "_" . $nombre_archivo;
        if (move_uploaded_file($_FILES['certificacion']['tmp_name'], $ruta_archivo)) {
            $certificacion = $ruta_archivo;
        }
    }
    $sql_usuario = "INSERT INTO Usuarios (Nombre, Apellidos, Edad, Nombre_Usuario, Correo, Contraseña, ID_Rol) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bind_param("ssissss", $nombre, $apellidos, $edad, $nombre_usuario, $correo, $contraseña, $ID_Rol);

    if ($stmt_usuario->execute()) {
        $id_usuario = $stmt_usuario->insert_id; 
        $sql_proveedor = "INSERT INTO Proveedores (ID_Usuario, Biografia, Experiencia, Especialidad, CertificacionArchivo) 
                          VALUES (?, ?, ?, ?, ?)";
        $stmt_prov = $conexion->prepare($sql_proveedor);
        $stmt_prov->bind_param("issss", $id_usuario, $biografia, $experiencia, $especialidad, $certificacion);
        if ($stmt_prov->execute()) {
            echo "<script>
                    alert('Registro exitoso como Proveedor de Contenido.');
                    window.location.href = 'login.php';
                  </script>";
        } else {
            echo "<script>alert('Error al registrar datos de proveedor.');</script>";
        }
        $stmt_prov->close();
    } else {
        echo "<script>alert('Error al registrar usuario.');</script>";
    }
    $stmt_usuario->close();
    $conexion->close();
}?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Proveedor | IziFinanzas</title>
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
            max-width: 600px;
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

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 3px;
            background: #e0e0e0;
            transform: translateY(-50%);
            z-index: 1;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            color: #999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            position: relative;
            z-index: 2;
            transition: var(--transition);
        }

        .step.active {
            background: var(--primary-light);
            color: var(--white);
            box-shadow: 0 0 0 5px rgba(30, 199, 95, 0.2);
        }

        .step.completed {
            background: var(--primary-dark);
            color: var(--white);
        }

        .step-label {
            position: absolute;
            top: 45px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            font-weight: 500;
            color: #999;
            white-space: nowrap;
        }

        .step.active .step-label,
        .step.completed .step-label {
            color: var(--primary-dark);
            font-weight: 600;
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

        input, textarea, select {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: var(--transition);
            background-color: #f8f9fa;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 15px;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(30, 199, 95, 0.2);
            background-color: var(--white);
        }

        .input-group .input-field {
            width: 48%;
        }

        .file-upload {
            position: relative;
            margin-bottom: 20px;
        }

        .file-upload-label {
            display: block;
            padding: 15px;
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            background-color: #f8f9fa;
        }

        .file-upload-label:hover {
            border-color: var(--primary-light);
            background-color: rgba(30, 199, 95, 0.05);
        }

        .file-upload-label i {
            font-size: 24px;
            color: var(--primary-light);
            margin-bottom: 10px;
        }

        .file-upload-label span {
            display: block;
            font-size: 14px;
            color: #636e72;
        }

        .file-upload-label strong {
            color: var(--primary-light);
            font-weight: 600;
        }

        .file-upload input[type="file"] {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        .file-name {
            margin-top: 10px;
            font-size: 13px;
            color: var(--primary-dark);
            font-weight: 500;
            display: none;
        }

        .btn {
            padding: 15px 30px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(16, 139, 54, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(16, 139, 54, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-light);
            color: var(--primary-dark);
            box-shadow: none;
        }

        .btn-outline:hover {
            background: rgba(30, 199, 95, 0.1);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
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

        .password-strength, .hint {
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
            
            .button-group {
                flex-direction: column-reverse;
                gap: 10px;
            }
            
            .btn {
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
            
            input, textarea, select {
                padding: 12px 12px 12px 40px;
            }
            
            .step {
                width: 30px;
                height: 30px;
                font-size: 14px;
            }
            
            .step-label {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="img/iz.png" alt="IziFinanzas Logo">
        </div>
        <div class="progress-steps">
            <div class="step active" id="step1">
                <span>1</span>
                <span class="step-label">Información básica</span>
            </div>
            <div class="step" id="step2">
                <span>2</span>
                <span class="step-label">Datos profesionales</span>
            </div>
        </div>
        <form action="registro_prov.php" method="POST" enctype="multipart/form-data">
            <!-- Paso 1: Información básica -->
            <div id="form1">
                <h2>Registro de Proveedor</h2>
                <p class="subtitle">Completa tu información básica para comenzar</p>

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
                    <input type="checkbox" id="terminos" required>
                    <label for="terminos">Acepto los <a href="#">Términos y Condiciones</a> y la <a href="#">Política de Privacidad</a></label>
                </div>

                <div class="button-group">
                    <button type="button" id="continuar" class="btn">Continuar <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <!-- Paso 2: Datos profesionales -->
            <div id="form2" style="display: none;">
                <h2>Tus datos profesionales</h2>
                <p class="subtitle">Completa esta información para validar tu perfil de proveedor</p>

                <div class="input-field">
                    <i class="fas fa-pen"></i>
                    <textarea name="biografia" placeholder="Escribe una breve biografía (mínimo 30 caracteres)" 
                              required maxlength="500" minlength="30" 
                              title="Mínimo 30 caracteres, máximo 500."></textarea>
                    <p class="hint">Describe tu formación y experiencia en el campo financiero</p>
                </div>

                <div class="input-field">
                    <i class="fas fa-briefcase"></i>
                    <textarea name="experiencia" placeholder="Describe tu experiencia profesional (mínimo 30 caracteres)" 
                              required maxlength="500" minlength="30" 
                              title="Mínimo 30 caracteres, máximo 500."></textarea>
                    <p class="hint">Menciona tus logros y especialidades relevantes</p>
                </div>

                <div class="input-field">
                    <i class="fas fa-star"></i>
                    <select name="especialidad" id="especialidad" required>
                        <option value="">-- Selecciona tu área de especialidad --</option>
                        <option value="Finanzas">Finanzas</option>
                        <option value="Presupuestos">Presupuestos</option>
                        <option value="Economía">Economía</option>
                        <option value="Mercados">Mercados</option>
                        <option value="Criptomonedas">Criptomonedas</option>
                        <option value="Bancarización">Bancarización</option>
                    </select>
                </div>

                <div class="file-upload">
                    <label for="certificacion" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Arrastra tu archivo aquí o <strong>haz clic para seleccionar</strong></span>
                        <span>Solo se permiten archivos PDF, JPG o PNG (Máx. 5MB)</span>
                    </label>
                    <input type="file" name="certificacion" id="certificacion" required 
                           accept=".pdf,.jpg,.jpeg,.png" 
                           title="Solo se permiten archivos PDF, JPG o PNG.">
                    <div class="file-name" id="fileName"></div>
                </div>

                <div class="button-group">
                    <button type="button" id="regresar" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Regresar</button>
                    <button type="submit" class="btn">Completar Registro <i class="fas fa-check"></i></button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const continuarBtn = document.getElementById("continuar");            // Elementos del formulario
            const regresarBtn = document.getElementById("regresar");
            const form1 = document.getElementById("form1");
            const form2 = document.getElementById("form2");
            const step1 = document.getElementById("step1");
            const step2 = document.getElementById("step2");
            const fileInput = document.getElementById("certificacion");
            const fileName = document.getElementById("fileName");

            // Mostrar nombre del archivo seleccionado
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileName.textContent = this.files[0].name;
                    fileName.style.display = 'block';
                } else {
                    fileName.style.display = 'none';
                }
            });
            // Validar y avanzar al paso 2
            if (continuarBtn) {
                continuarBtn.addEventListener("click", () => {
                    const inputs = form1.querySelectorAll("input[required]");
                    let esValido = true;

                    for (let i = 0; i < inputs.length; i++) {
                        if (!inputs[i].checkValidity()) {
                            inputs[i].reportValidity();
                            esValido = false;
                            break;
                        }
                    }
                    if (esValido) {
                        form1.style.display = "none";
                        form2.style.display = "block";
                        step1.classList.remove("active");
                        step1.classList.add("completed");
                        step2.classList.add("active");
                    }
                });
            }
            // Regresar al paso 1
            if (regresarBtn) {
                regresarBtn.addEventListener("click", () => {
                    form2.style.display = "none";
                    form1.style.display = "block";
                    step2.classList.remove("active");
                    step1.classList.remove("completed");
                    step1.classList.add("active");
                });
            }
            // Animación para los campos al enfocar
            document.querySelectorAll('input, textarea, select').forEach(input => {
                input.addEventListener('focus', function() {
                    const icon = this.parentElement.querySelector('i');
                    if (icon) icon.style.color = '#108b36';
                });
                
                input.addEventListener('blur', function() {
                    const icon = this.parentElement.querySelector('i');
                    if (icon) icon.style.color = '#1ec75f';
                });
            });
        });
    </script>
</body>
</html>