<div class="container-fluid carrito-container">
    <?php if (empty($productosCarrito)): ?>
        <div class="d-flex flex-column justify-content-center align-items-center text-center">
            <h1 class="fw-semibold">Tu bolsa está vacía.</h1>
            <?php if (isset($_SESSION['usuario'])): ?>
                <span>No tienes ningun producto en la cesta.</span>
            <?php else: ?>
                <span>Inicia sesión para ver si tienes tus productos guardados. O sigue comprando.</span>
            <?php endif; ?>
            
                <div class="d-flex gap-3 mt-4">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <!-- <form method="post" action="/Daw2mvc/index.php?controller=usuario&action=logout">
                        <button type="submit" class="btn btn-primary rounded-3 py-3 botonesOcul">Cerrar sesión</button>
                    </form> -->
                <?php else: ?>
                    <a href="/Daw2mvc/index.php?controller=usuario&action=login" class="btn btn-primary rounded-3 py-3 botonesOcul">Iniciar sesión</a>
                <?php endif; ?>
                <a href="/Daw2mvc/index.php?controller=productos" class="btn btn-outline-primary rounded-3 py-3 botonesOcul">Seguir comprando</a>
            </div>
        </div>
    <?php else: ?>
        <?php
            $totalCarrito = 0;
            foreach ($productosCarrito as $item) {
                $cantidad = $item['cantidad'];
                $precio = $item['precio_unitario'];
                $totalCarrito += $precio * $cantidad;
            }
        ?>

        <div class="text-center mb-5">
            <h1 class="fw-semibold fs-2">
                El total de tu pedido y reserva total, es de
                <?php echo number_format($totalCarrito, 2, ',', '.'); ?> €
            </h1>
            <p class="text-secondary small">Cancelación o devolución gratis.</p>
            <a href="/Daw2mvc/index.php?controller=pedidos&action=create" class="btn btn-primary rounded-3 px-4 mt-2">
                Continuar con el pago
            </a>
        </div>

        <hr class="my-5">

        <div class="col-12 col-lg-9 mx-auto">
            <?php foreach ($productosCarrito as $item):
                $producto = $item['producto'];
                $cantidad = $item['cantidad'];

                $nombre = method_exists($producto, 'getNombre') ? $producto->getNombre() : ($producto->nombre ?? '');
                $precio = $item['precio_unitario'];
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
                        <span class="spanCantidadBotones d-flex">
                            <form method="POST" action="/Daw2mvc/index.php?controller=carrito&amp;action=update" class="m-1">
                                <input type="hidden" name="clave_carrito" value="<?= htmlspecialchars((string) $item['clave']) ?>">
                                <button type="submit" name="sumar" class="btn btn-outline-primary rounded-3">+</button>
                            </form>

                            <form method="POST" action="/Daw2mvc/index.php?controller=carrito&amp;action=update" class="m-1">
                                <input type="hidden" name="clave_carrito" value="<?= htmlspecialchars((string) $item['clave']) ?>">
                                <button type="submit" name="restar" class="btn btn-outline-primary rounded-3">-</button>
                            </form>
                        </span>
                    </div>

                    <div class="d-flex flex-column align-items-end">
                        <h5 class="fw-semibold text-nowrap">
                            <?php echo number_format($subtotal, 2, ',', '.'); ?> €
                        </h5>

                        <form method="post" action="/Daw2mvc/index.php?controller=carrito&amp;action=destroy">
                            <input type="hidden" name="clave_carrito" value="<?php echo htmlspecialchars((string) $item['clave'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" class="btn btn-outline-primary rounded-3 px-5">Eliminar</button>
                        </form>
                    </div>
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
                <a href="/Daw2mvc/index.php?controller=productos" class="btn btn-secondary rounded-3 px-4">
                    Seguir comprando
                </a>
                <a href="/Daw2mvc/index.php?controller=pedidos&action=create" class="btn btn-primary rounded-3 px-5">
                    Pagar
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>