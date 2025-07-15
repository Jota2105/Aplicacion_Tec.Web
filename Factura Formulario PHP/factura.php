<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body class="container mt-5">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){ //Procesamos los datos si el metodo es POST
        $nombree = $_POST['nombree'] ?? '';
        $correoo = $_POST['correoo'] ?? '';
        $fechaa = $_POST['fechaa'] ?? '';
        $comentarioss = $_POST['comentarioss'] ?? '';
        $productos = [];
        $subtotal_general = 0;
        $iva_general = 0;

        function calcular_total_producto($precio, $cantidad, $aplicar_iva){
            $subtotal = $precio * $cantidad;
            $iva = ($aplicar_iva) ? $subtotal * 0.15 : 0;
            return [$subtotal, $iva, $subtotal + $iva];
        } // Con esta funcion calculamos el total por producto con IVA
          // con nuevas variables: precio, cantidad, aplicar_iva

        for ($i = 1; $i <= 3; $i++){ // Procesamos los productos con los datos ingresados: articulo*, precioart*, cantidadart*, cat*, iva*
            $prod_nombre = $_POST["articulo$i"] ?? '';
            $precio = floatval($_POST["precioart$i"] ?? 0);
            $cantidad = intval($_POST["cantidadart$i"] ?? 0);
            $categoria = $_POST["cat$i"] ?? '';
            $iva_checkbox = isset($_POST["iva$i"]);

            if (!empty($prod_nombre) && $precio > 0 && $cantidad > 0) {
                list($subtotal, $iva, $total) = calcular_total_producto($precio, $cantidad, $iva_checkbox);

                $productos[] = [
                    'nombre' => $prod_nombre,
                    'categoria' => $categoria,
                    'precio' => $precio,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                    'iva' => $iva,
                    'total' => $total
                ];

                $subtotal_general += $subtotal;
                $iva_general += $iva;
            }
        }
        $total_pagar = $subtotal_general + $iva_general;

        if (!empty($productos)) {
        echo '<h2 class="mb-4 text-center">Factura Generada</h2>';
        echo '<p><strong>Cliente:</strong> ' . htmlspecialchars($nombree) . '</p>';
        echo '<p><strong>Correo:</strong> ' . htmlspecialchars($correoo) . '</p>';
        echo '<p><strong>Fecha:</strong> ' . $fechaa . '</p>';
        echo '<p><strong>Comentarios:</strong> ' . nl2br(htmlspecialchars($comentarioss)) . '</p>';
        } else {
            echo '<div class="alert alert-warning">Ingrese un producto valido. <a href="index.html">Volver</a></div>';
        }

    } else {
        header('Location: index.html');
        exit;
    }


    ?>
</body>
</html>