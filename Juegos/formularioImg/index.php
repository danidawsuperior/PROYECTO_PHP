<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include 'captura.html';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Control de inyección de código mediante htmlspecialchars
    $nombre = isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8') : '';
    $alias = isset($_POST['alias']) ? htmlspecialchars(trim($_POST['alias']), ENT_QUOTES, 'UTF-8') : '';
    $edad = isset($_POST['edad']) ? (int)$_POST['edad'] : '';
    
    $armas = isset($_POST['armas']) ? $_POST['armas'] : [];
    // Limpieza del array de armas seleccionadas
    $armas_limpias = array_map(function($item) {
        return htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
    }, $armas);
    $armas_texto = !empty($armas_limpias) ? implode(', ', $armas_limpias) : 'Ninguna';

    $magia = isset($_POST['magia']) ? htmlspecialchars($_POST['magia'], ENT_QUOTES, 'UTF-8') : 'No';

    // Variables de control de la imagen
    $mostrar_imagen = 'calavera.png';
    $mensaje_imagen = '';
    $error_subida = false;
    $imagen_indicada = false;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
        $imagen_indicada = true;
        
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['imagen']['tmp_name'];
            $file_name = $_FILES['imagen']['name'];
            $file_size = $_FILES['imagen']['size'];
            
            // Validación en el servidor: Tipo MIME
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $file_tmp);
            finfo_close($finfo);

            if ($mime_type !== 'image/png' && $mime_type !== 'image/jpeg' ) {
                $mensaje_imagen = 'Error al subir la imagen: Solo se permiten archivos PNG.';
                $error_subida = true;
            } 
            // Validación en el servidor: Tamaño máximo 10,240 kB (10240000 bytes)
            elseif ($file_size > 10240000) {
                $mensaje_imagen = 'Error al subir la imagen: El tamaño supera los 10 Kbytes.';
                $error_subida = true;
            } 
            else {
                // Directorio de destino
                $upload_dir = 'uploads/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                // Generar un nombre seguro para evitar sobreescrituras e inyecciones en el archivo
                $safe_file_name = time() . '_' . basename($file_name);
                $dest_path = $upload_dir . $safe_file_name;

                if (move_uploaded_file($file_tmp, $dest_path)) {
                    $mostrar_imagen = $dest_path;
                } else {
                    $mensaje_imagen = 'Error al subir la imagen';
                    $error_subida = true;
                }
            }
        } else {
            $mensaje_imagen = 'Error al subir la imagen';
            $error_subida = true;
        }
    } else {
        // No se subió ninguna imagen voluntariamente
        $mensaje_imagen = 'No se subió ninguna imagen.';
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Datos del Jugador</title>
        <style>
            body {
                background-color: #9297b4;
                font-family: sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }
            .card {
                background-color: #ffff42;
                border-radius: 12px;
                padding: 30px;
                width: 550px;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            }
            h2 {
                text-align: center;
                font-size: 26px;
                margin-top: 0;
                margin-bottom: 25px;
            }
            .content-wrapper {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
            }
            .info-side {
                width: 55%;
                font-size: 16px;
                line-height: 1.6;
            }
            .info-side p {
                margin: 12px 0;
            }
            .info-side strong {
                font-size: 17px;
            }
            .image-side {
                width: 40%;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .image-title {
                font-weight: bold;
                margin-bottom: 15px;
                font-size: 16px;
                min-height: 40px;
                display: flex;
                align-items: center;
            }
            .img-container {
                border: 1px solid #000080;
                background-color: white;
                width: 180px;
                height: 180px;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden;
            }
            .img-container img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }
            .status-msg {
                margin-top: 15px;
                font-size: 15px;
            }
        </style>
    </head>
    <body>

    <div class="card">
        <h2>Datos del Jugador</h2>
        
        <div class="content-wrapper">
            <div class="info-side">
                <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
                <p><strong>Alias:</strong> <?php echo $alias; ?></p>
                <p><strong>Edad:</strong> <?php echo $edad; ?></p>
                <p><strong>Armas seleccionadas:</strong> <?php echo $armas_texto; ?></p>
                <p><strong>¿Practica artes mágicas?:</strong> <?php echo $magia; ?></p>
            </div>
            
            <div class="image-side">
                <div class="image-title">
                    <?php 
                    if (!$imagen_indicada) {
                        echo "No se subió ninguna imagen.";
                    } elseif (!$error_subida) {
                        echo "Imagen subida:";
                    } else {
                        echo ""; 
                    }
                    ?>
                </div>
                
                <div class="img-container">
                    <img src="<?php echo $mostrar_imagen; ?>" alt="Visualización">
                </div>
                
                <div class="status-msg">
                    <?php 
                    if ($error_subida || ($imagen_indicada && $mostrar_imagen === 'calavera.png')) {
                        echo $mensaje_imagen;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    </body>
    </html>
    <?php
}
?>