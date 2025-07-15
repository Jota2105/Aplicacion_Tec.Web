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
        $productos = []; // Array para almacenar los productos
        $subtotal_general = 0; // Para el total
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

            if (!empty($prod_nombre) && $precio > 0 && $cantidad > 0) { // Si es valido llama a la funcion que creamos
                list($subtotal, $iva, $total) = calcular_total_producto($precio, $cantidad, $iva_checkbox);

                $productos[] = [ // Agregacion al array
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

        if (!empty($productos)) { // Si hay productos validos, muestra la factura
        echo '<h2 class="mb-4 text-center">Factura Generada</h2>'; // Usamos htmlspedialchars para seguridad contra XSS como en ocasiones anteriores
        echo '<p><strong>Cliente:</strong> ' . htmlspecialchars($nombree) . '</p>';
        echo '<p><strong>Correo:</strong> ' . htmlspecialchars($correoo) . '</p>';
        echo '<p><strong>Fecha:</strong> ' . $fechaa . '</p>';
        echo '<p><strong>Comentarios:</strong> ' . nl2br(htmlspecialchars($comentarioss)) . '</p>';
        echo '<h3>Detalles de Productos</h3>';
        echo '<table class="table table-bordered">'; // Usamos tablas responsive via Bootstrap
        echo '<thead><tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
            </tr></thead>';
        echo '<tbody>';
        foreach ($productos as $prod) { // En este foreach $prod toma cada subarray en cada vuelta, es decir, cada producto
            echo '<tr>';
            echo '<td>' . htmlspecialchars($prod['nombre']) . '</td>';
            echo '<td>' . htmlspecialchars($prod['categoria']) . '</td>';
            echo '<td>$' . number_format($prod['precio'], 2) . '</td>';
            echo '<td>' . $prod['cantidad'] . '</td>';
            echo '<td>$' . number_format($prod['subtotal'], 2 ) . '</td>';
            echo '<td>$' . number_format($prod['iva'], 2 ) . '</td>';
            echo '<td>$' . number_format($prod['total'], 2 ) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '<tfoot>';
        echo '<tr><td colspan="4"><strong>Subtotal General:</strong></td><td colspan="3">$' . number_format($subtotal_general, 2 ) . '</td></tr>';
        echo '<tr><td colspan="4"><strong>Total IVA:</strong></td><td colspan="3">$' . number_format($iva_general, 2 ) . '</td></tr>';
        echo '<tr><td colspan="4"><strong>Total:</strong></td><td colspan="3">$' . number_format($total_pagar, 2) . '</td></tr>';
        echo '</tfoot>';
        echo '</table>';

        echo '<a href="index.html" class="btn btn-secondary mt-3">Volver a la factura</a>';
        } else { // Si no, alerta de error
            echo '<div class="alert alert-warning">Ingrese un producto valido. <a href="index.html">Volver</a></div>';
        }

    } else {
        header('Location: index.html');
        exit;
    }


    ?>
</body>
</html>