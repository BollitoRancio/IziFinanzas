<?php
session_start();
if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Proveedor') {
    header("Location: articulos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Artículo - IziFinanzas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --izi-green: #28a745;
            --izi-green-light: #e8f5e9;
            --izi-green-dark: #218838;
            --izi-text: #333333;
            --izi-text-light: #6c757d;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--izi-text);
        }
        
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: var(--izi-green-dark);
        }
        
        .btn-izi {
            background-color: var(--izi-green);
            border-color: var(--izi-green);
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .btn-izi:hover {
            background-color: var(--izi-green-dark);
            border-color: var(--izi-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.2);
        }
        
        .btn-izi-outline {
            background-color: transparent;
            border-color: var(--izi-green);
            color: var(--izi-green);
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .btn-izi-outline:hover {
            background-color: var(--izi-green-light);
            color: var(--izi-green-dark);
            border-color: var(--izi-green-dark);
        }
        
        .form-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--izi-green-dark);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--izi-green);
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }
        
        .page-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 2rem;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 4px;
            background-color: var(--izi-green);
            border-radius: 2px;
        }
        
        .tag-input-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .tag {
            display: inline-flex;
            align-items: center;
            background-color: var(--izi-green-light);
            color: var(--izi-green-dark);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
        }
        
        .tag-remove {
            margin-left: 5px;
            cursor: pointer;
            color: var(--izi-green-dark);
        }
        
        #image-preview {
            max-width: 100%;
            max-height: 300px;
            margin-top: 1rem;
            border-radius: 8px;
            display: none;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="../dashboard.php" class="text-decoration-none">
                    <h4 class="m-0 text-success"><i class="bi bi-currency-exchange"></i> IziFinanzas</h4>
                </a>
                <div class="user-info">
                    <?php if(isset($_SESSION['nombre_usuario'])): ?>
                        <span class="me-2"><i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['nombre_usuario']) ?></span>
                        <span class="text-muted">(<?= htmlspecialchars($_SESSION['rol_usuario']) ?>)</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="page-title">Crear nuevo artículo</h2>
                
                <div class="form-container">
                    <form action="guardar_articulo.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="titulo" class="form-label">Título del artículo</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" 
                                   placeholder="Escribe un título atractivo" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="contenido" class="form-label">Contenido</label>
                            <textarea name="contenido" id="contenido" class="form-control" 
                                      rows="10" placeholder="Desarrolla aquí tu contenido..." required></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="etiquetas" class="form-label">Etiquetas (separadas por comas)</label>
                            <input type="text" name="etiquetas" id="etiquetas" class="form-control" 
                                   placeholder="finanzas, ahorro, inversión">
                            <small class="text-muted">Máximo 5 etiquetas, cada una con máximo 15 caracteres</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="imagen" class="form-label">Imagen destacada (opcional)</label>
                            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                            <img id="image-preview" src="#" alt="Vista previa de la imagen" class="img-fluid">
                        </div>
                        
                        <div class="action-buttons">
                            <a href="articulos.php" class="btn btn-izi-outline">
                                <i class="bi bi-x-lg"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-izi">
                                <i class="bi bi-send-check"></i> Publicar Artículo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Vista previa de la imagen
        document.getElementById('imagen').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            const file = e.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            if (file) {
                reader.readAsDataURL(file);
            }
        });
        
        // Validación de etiquetas
        document.getElementById('etiquetas').addEventListener('input', function(e) {
            const tags = e.target.value.split(',');
            if (tags.length > 5) {
                alert('Máximo 5 etiquetas permitidas');
                e.target.value = tags.slice(0, 5).join(',');
            }
            
            tags.forEach(tag => {
                if (tag.trim().length > 15) {
                    alert('Cada etiqueta debe tener máximo 15 caracteres');
                    e.target.value = '';
                }
            });
        });
    </script>
</body>
</html>