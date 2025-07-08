<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Formulario de Uso de HTML</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-5">
        <h1>Resultados del Formulario de Uso de HTML</h1>
        <div class="card p-4">
            <?php
            // Aqui podemos iniciar con la verificación si se recibieron o no los datos por POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Campos con el uso de listas para verlo organizado
                // Hacemos uso de htmlspecialchars para mejorar la seguridad en cada dato
                echo "<h3>Datos Recibidos:</h3>" ;
                echo "<ul>";
                echo "<li><strong>Texto:</strong> " . htmlspecialchars($_POST['textoo'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Teléfono:</strong> " . htmlspecialchars($_POST['telefonoo'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Correo Electrónico:</strong> " . htmlspecialchars($_POST['correo'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Fecha:</strong> " . htmlspecialchars($_POST['fechaa'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Hora:</strong> " . htmlspecialchars($_POST['horaa'] ?? ' No ingresado') . "</li>";
                echo "<li><strong>Fecha y Hora:</strong> " . htmlspecialchars($_POST['hyf'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Mes:</strong> " . htmlspecialchars($_POST['meses'] ?? 'No ingresado') . "</li>" ;
                echo "<li><strong>Semana:</strong> " . htmlspecialchars($_POST['semanaa'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>URL:</strong> " . htmlspecialchars($_POST['url'] ?? 'No ingresado') . "</li>" ;
                echo "<li><strong>Número:</strong> " . htmlspecialchars($_POST['numericoo'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Rango:</strong> " . htmlspecialchars($_POST['rec'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Color:</strong> " . htmlspecialchars($_POST['colores'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Contraseña:</strong> " . htmlspecialchars($_POST['pass'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Búsqueda:</strong> " . htmlspecialchars($_POST['searching'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>País:</strong> " . htmlspecialchars($_POST['supais'] ?? 'No seleccionado') . "</li>";
                echo "<li><strong>Comentarios:</strong> " . htmlspecialchars($_POST['comentarios'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Género:</strong> " . htmlspecialchars($_POST['sugenero'] ?? 'No seleccionado') . "</li>";
                echo "<li><strong>Campo Oculto:</strong> " . htmlspecialchars($_POST['oculto'] ?? 'No ingresado') . "</li>";

                //Manejamos las casillas de las preferencias del usuario con un blucle if
                // El arreglo que realizamos en el index nos servira para las casillas
                echo "<li><strong>Intereses:</strong> ";
                if (isset($_POST['casillas']) && is_array($_POST['casillas'])) {
                    echo htmlspecialchars(implode(", ", $_POST['casillas']));
                } else {
                    echo "Ninguno seleccionado";
                }
                echo "</li>";

                // Los archivos los podemos manejar con $_FILES, ya que nos muestra su nombre y si se subio o no
                echo "<li><strong>Archivo:</strong> ";
                if (isset($_FILES['docs']) && $_FILES['docs']['error'] === UPLOAD_ERR_OK) {
                    echo htmlspecialchars($_FILES['docs']['name']) . " (Tamaño: " . $_FILES['docs']['size'] . " bytes)";
                } else {
                    echo "No se subió ningún archivo";
                }
                echo "</li>";
                echo "</ul>";
                
            } else  {
                echo "<p class='text-danger'>No se ha recibido ningun dato.</p>";
            }
            ?>
            <a href ="index.html" class="btn btn-primary mt-3">Regresar al formulario</a>
        </div>
    </div>
</body>
</html>