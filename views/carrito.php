<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $productosCarrito = $productosCarrito ?? [];
?>

<div class="container py-5">
    <h1 class="mb-4 fw-bold">Tu Carrito de Compra</h1>

    <?php if (empty($productosCarrito)): ?>
        <div class="alert alert-info">Tu carrito está vacío actualmente.</div>
    <?php else: ?>
        <div class="table-responsive bg-white rounded-3 shadow-sm p-3">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalCarrito = 0;
                    foreach ($productosCarrito as $item): 
                        $producto = $item['producto'];
                        $cantidad = $item['cantidad'];

                        $nombre = method_exists($producto, 'getNombre') ? $producto->getNombre() : ($producto->nombre ?? '');
                        $precio = method_exists($producto, 'getPrecio') ? $producto->getPrecio() : ($producto->precio ?? 0);
                        $id = method_exists($producto, 'getId') ? $producto->getId() : ($producto->id_producto ?? $producto->id ?? '');

                        $subtotal = $precio * $cantidad;
                        $totalCarrito += $subtotal;
                    ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($nombre); ?></strong></td>
                        <td><?php echo $cantidad; ?></td>
                        <td><?php echo number_format($precio, 2); ?> €</td>
                        <td><?php echo number_format($subtotal, 2); ?> €</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="text-end mt-4">
                <h3>Total Carrito: <span class="text-primary"><?php echo number_format($totalCarrito, 2); ?> €</span></h3>
                <a href="/Daw2mvc/index.php?controller=checkout" class="btn btn-success rounded-3 px-4 mt-2">Proceder al pago</a>
                <a href="/Daw2mvc/index.php?controller=carta" class="btn btn-success rounded-3 px-4 mt-2">Seguir comprando</a>
            </div>
        </div>
    <?php endif; ?>
</div>