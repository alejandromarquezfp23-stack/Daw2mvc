<div class="container-fluid carrito-container">
    <?php if (!empty($mensajeCupon)): ?>
        <div class="alert <?= isset($_SESSION['cupon_codigo']) ? 'alert-success' : 'alert-warning' ?> col-12 col-lg-9 mx-auto" role="status">
            <?= htmlspecialchars($mensajeCupon, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($productosCarrito)): ?>
        <div class="d-flex flex-column justify-content-center align-items-center text-center">
            <h1 class="fw-semibold">Tu bolsa está vacía.</h1>
            <?php if (isset($_SESSION['usuario'])): ?>
                <span>No tienes ningun producto en la cesta.</span>
            <?php else: ?>
                <span>Inicia sesión para ver si tienes tus productos guardados. O sigue comprando.</span>
            <?php endif; ?>
            
                <div class="d-flex gap-3 mt-4 carrito-vacio-acciones">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <a href="<?= url ?>index.php?controller=productos" class="btn btn-outline-primary rounded-3 py-3 botonesOcul">Seguir comprando</a>
                <?php else: ?>
                    <a href="<?= url ?>index.php?controller=usuario&action=login" class="btn btn-primary rounded-3 py-3 botonesOcul">Iniciar sesión</a>
                    <a href="<?= url ?>index.php?controller=productos" class="btn btn-outline-primary rounded-3 py-3 botonesOcul">Seguir comprando</a>
                <?php endif; ?>
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
                <?php echo number_format($totalFinal, 2, ',', '.'); ?> €
            </h1>
            <p class="text-secondary small">Cancelación o devolución gratis.</p>
            <div class="d-flex flex-wrap justify-content-center gap-2 mt-2">
                <a href="<?= url ?>index.php?controller=pedidos&action=create"
                   class="btn btn-primary rounded-3 px-4">
                    Continuar con el pago
                </a>
                <button type="button" class="btn btn-outline-primary rounded-3 px-4"
                        data-bs-toggle="offcanvas" data-bs-target="#resumenPedido"
                        aria-controls="resumenPedido">
                    ¿Tienes un cupón?
                </button>
            </div>
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
                            <form method="POST" action="<?= url ?>index.php?controller=carrito&amp;action=update" class="m-1">
                                <input type="hidden" name="clave_carrito" value="<?= htmlspecialchars((string) $item['clave']) ?>">
                                <button type="submit" name="sumar" class="btn btn-outline-primary rounded-3">+</button>
                            </form>

                            <form method="POST" action="<?= url ?>index.php?controller=carrito&amp;action=update" class="m-1">
                                <input type="hidden" name="clave_carrito" value="<?= htmlspecialchars((string) $item['clave']) ?>">
                                <button type="submit" name="restar" class="btn btn-outline-primary rounded-3">-</button>
                            </form>
                        </span>
                    </div>

                    <div class="d-flex flex-column align-items-end">
                        <h5 class="fw-semibold text-nowrap">
                            <?php echo number_format($subtotal, 2, ',', '.'); ?> €
                        </h5>

                        <form method="post" action="<?= url ?>index.php?controller=carrito&amp;action=destroy">
                            <input type="hidden" name="clave_carrito" value="<?php echo htmlspecialchars((string) $item['clave'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" class="btn btn-outline-primary rounded-3 px-5">Eliminar</button>
                        </form>
                    </div>
                </div>

                <hr>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-4">
                <p>Subtotal:</p>
                <p><?php echo number_format($subtotalCarrito, 2, ',', '.'); ?> €</p>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <p>Descuento:</p>
                <p class="text-success"> -<?php echo number_format($descuento, 2, ',', '.'); ?> €</p>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <h4 class="fw-semibold">Tu total:</h4>
                <h4 class="fw-semibold"><?php echo number_format($totalFinal, 2, ',', '.'); ?> €</h4>
            </div>

            <div class="bg-light rounded-3 p-3 mt-4">
                <h6 class="fw-semibold">
                    1 semana de margen para cancelar tu reserva si no puedes asistir.
                </h6>
                <p class="small text-secondary mb-0">
                    Total de pedido: <?php echo number_format($totalFinal, 2, ',', '.'); ?> €
                </p>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-3">
                <a href="<?= url ?>index.php?controller=productos" class="btn btn-secondary rounded-3 px-4">
                    Seguir comprando
                </a>
                <a href="<?= url ?>index.php?controller=pedidos&action=create" class="btn btn-primary rounded-3 px-5">
                    Pagar
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="offcanvas offcanvas-end resumen-offcanvas rounded-start-4"
     tabindex="-1" id="resumenPedido"
     aria-labelledby="resumenPedidoLabel">

    <div class="offcanvas-header px-4 pt-4">
        <div>
            <span class="resumen-cupon-etiqueta">DESCUENTOS</span>
            <h4 class="offcanvas-title fw-semibold mt-2" id="resumenPedidoLabel">
                ¿Tienes un cupón?
            </h4>
        </div>
        <button type="button" class="btn-close"
                data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>

    <div class="offcanvas-body px-4 pt-3">
        <p class="text-secondary mb-4">
            Introduce tu código promocional.
        </p>

        <label for="codigoCupon" class="form-label fw-semibold">Código promocional</label>
        <form method="POST" action="<?= url ?>index.php?controller=carrito&amp;action=cupon">
            <input type="text" name="cupon" required maxlength="50"
                class="form-control form-control-lg" placeholder="Ej.: APPLETITO10"
                autocomplete="off">

            <button type="submit" class="btn btn-primary w-100 mt-3">
                Aplicar cupón
            </button>
        </form>

        <div class="resumen-cupon-ayuda mt-4 p-3 rounded-3">
            <p class="fw-semibold mb-1">Tu pedido, a un paso</p>
            <p class="small text-secondary mb-0">
                Los descuentos aplicables se reflejarán en el total de tu carrito.
            </p>
        </div>

        <button type="button" class="btn btn-outline-primary rounded-3 w-100 mt-4"
                data-bs-dismiss="offcanvas">
            Volver al carrito
        </button>
    </div>
</div>