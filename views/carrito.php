<div class="container-fluid carrito-container">
    <?php if (empty($productosCarrito)): ?>
        <div class="alert alert-info">Tu carrito está vacío actualmente.</div>
    <?php else: ?>
        <?php
            $totalCarrito = 0;
            foreach ($productosCarrito as $item) {
                $producto = $item['producto'];
                $cantidad = $item['cantidad'];
                $precio = method_exists($producto, 'getPrecio') ? $producto->getPrecio() : ($producto->precio ?? 0);
                $totalCarrito += $precio * $cantidad;
            }
        ?>

        <div class="text-center mb-5">
            <h1 class="fw-semibold fs-2">
                El total de tu pedido y reserva total, es de
                <?php echo number_format($totalCarrito, 2, ',', '.'); ?> €
            </h1>
            <p class="text-secondary small">Cancelación o devolución gratis.</p>
            <a href="/Daw2mvc/index.php?controller=checkout" class="btn btn-primary rounded-3 px-4 mt-2">
                Continuar con el pago
            </a>
        </div>

        <hr class="my-5">

        <div class="col-12 col-lg-9 mx-auto">
            <?php foreach ($productosCarrito as $item):
                $producto = $item['producto'];
                $cantidad = $item['cantidad'];

                $nombre = method_exists($producto, 'getNombre') ? $producto->getNombre() : ($producto->nombre ?? '');
                $precio = method_exists($producto, 'getPrecio') ? $producto->getPrecio() : ($producto->precio ?? 0);
                $imagen = method_exists($producto, 'getImagen') ? $producto->getImagen() : ($producto->imagen ?? '');

                $subtotal = $precio * $cantidad;
            ?>
                <div class="d-flex align-items-center gap-3 gap-md-4 py-4">
                    <img src="<?php echo htmlspecialchars($imagen); ?>"
                         alt="<?php echo htmlspecialchars($nombre); ?>"
                         class="imagenCarrito rounded-3">
                    <div class="flex-grow-1">
                        <h5 class="fw-semibold mb-2"><?php echo htmlspecialchars($nombre); ?></h5>
                        <span class="text-secondary small"><?php echo $cantidad; ?> unidades</span>
                    </div>

                    <h5 class="fw-semibold mb-0 text-nowrap">
                        <?php echo number_format($subtotal, 2, ',', '.'); ?> €
                    </h5>
                </div>

                <hr>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-4">
                <p>Subtotal:</p>
                <p><?php echo number_format($totalCarrito, 2, ',', '.'); ?> €</p>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <h4 class="fw-semibold">Tu total:</h4>
                <h4 class="fw-semibold"><?php echo number_format($totalCarrito, 2, ',', '.'); ?> €</h4>
            </div>

            <div class="bg-light rounded-3 p-3 mt-4">
                <h6 class="fw-semibold">
                    1 semana de margen para cancelar tu reserva si no puedes asistir.
                </h6>
                <p class="small text-secondary mb-0">
                    Total de pedido: <?php echo number_format($totalCarrito, 2, ',', '.'); ?> €
                </p>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-3">
                <a href="/Daw2mvc/index.php?controller=carta" class="btn btn-secondary rounded-3 px-4">
                    Seguir comprando
                </a>
                <a href="/Daw2mvc/index.php?controller=checkout" class="btn btn-primary rounded-3 px-5">
                    Pagar
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>