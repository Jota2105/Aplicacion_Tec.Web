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
            // Aqui podemos iniciar con la verificacion si se recibieron o no los datos por POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Campos con el uso de listas para verlo organizado
                echo "<h3>Datos Recibidos:</h3>";
                echo "<ul>";
                echo "<li><strong>Texto:</strong> " . htmlspecialchars($_POST['textoo'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Teléfono:</strong> " . htmlspecialchars($_POST['telefonoo'] ?? 'No ingresado') . "</li>";
                echo "<li><strong>Correo Electrónico:</strong> " . htmlspecialchars($_POST['correo'] ?? 'No ingresado') . "</li>";

            } else {
                echo "<p class='text-danger'>No se recibieron datos.</p>";
            }
            ?>
            <a href="index.html" class="btn btn-primary mt-3">Regresar al formulario</a>
        </div>
    </div>
</body>
</html>