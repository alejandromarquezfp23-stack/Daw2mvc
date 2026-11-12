<div class="padre">
    <div class="py-5 divArriba">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold">Cuenta</h5>
            <form method="post" action="/Daw2mvc/index.php?controller=login&action=logout">
                <button type="submit" class="btn btn-secondary rounded-3">
                    Cerrar sesión
                </button>
            </form>
        </div>

        <hr>

        <div>
            <h2 class="fw-semibold">Hola, <?php echo $usuario->nombre ?></h2>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row gap-3 gap-md-0 p-3 p-md-5 divMedio my-5">
        <form method="POST" action="" id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Saldo de tu cuenta de Appletito: 0,00 €</h2>
            <p>Consulta el saldo disponible en tu cuenta y tenlo a mano para tus próximos pedidos en Appletito.</p>
            <input type="submit" name="gestionar_saldo" value="Gestionar saldo" class="btn btn-outline-primary rounded-3">
        </form>

        <form method="POST" action="" id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Tus pedidos</h2>
            <p>Revisa tus pedidos anteriores, consulta qué platos incluiste y comprueba el importe de cada pedido.</p>
            <input type="submit" name="historial_pedidos" value="Consulta tu historial de pedidos" class="btn btn-outline-primary rounded-3">
        </form>

        <form method="POST" action="" id="divBlancos" class="rounded-3 m-md-3 p-3">
            <h2 class="fw-semibold">Tus favoritos</h2>
            <p>Guarda tus platos favoritos para encontrarlos fácilmente y volver a pedirlos cuando te apetezcan.</p>
            <input type="submit" name="ver_favoritos" value="Ver Tus favoritos" class="btn btn-outline-primary rounded-3">
        </form>
    </div>

    <?php if ($gestionar_saldo): ?>
        <!-- <div>Contenido de cuenta</div> -->
    <?php endif; ?>

    <?php if ($historial_pedidos): ?>
        <div class="d-flex flex-column divMedio mb-5 py-5">
            <?php if (empty($pedidosUsuario)): ?>
                <div class="d-flex justify-content-center align-items-center m-5">
                    <div class="rounded-3 p-4 bg-white text-center">
                        <h4 class="fw-semibold mb-2">Todavía no tienes pedidos</h4>
                        <p>Cuando hagas tu primer pedido, aparecerá aquí.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="carruselProductos">
                    <button class="btn flecha-carrusel flecha-izquierda" type="button" onclick="desplazarProductos(this, -1)" aria-label="Pedido anterior">
                        <img src="/Daw2mvc/iconos/icono_flecha_izquierda-removebg-preview.png" alt="">
                    </button>

                    <div class="d-flex divProductos overflow-auto">
                        <?php foreach ($pedidosUsuario as $pedido): ?>
                            <div class="divProducto mx-3 m-md-3 p-4 rounded-3" style="min-width: 280px;">
                                <p class="text-muted mb-1">Pedido</p>
                                <h5 class="fw-bold">#<?= $pedido->getId() ?></h5>

                                <p class="mb-1"><strong>Estado:</strong> <?= htmlspecialchars($pedido->getEstado()) ?></p>
                                <p class="mb-1"><strong>Fecha:</strong> <?= htmlspecialchars($pedido->getFechaPedido()) ?></p>
                                <p class="mb-3"><strong>Total:</strong> <?= number_format((float) $pedido->getTotal(), 2, ',', '.') ?> €</p>

                                <?php foreach ($pedidodetalle as $detalle): ?>
                                    <?php if ((int) $detalle->getPedidoId() === (int) $pedido->getId()): ?>
                                        <div class="border-top pt-2">
                                            <p class="mb-1">Producto ID: <?= $detalle->getProductoId() ?></p>
                                            <p class="mb-1">Cantidad: <?= $detalle->getCantidad() ?></p>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button class="btn flecha-carrusel flecha-derecha" type="button" onclick="desplazarProductos(this, 1)" aria-label="Pedido siguiente">
                        <img src="/Daw2mvc/iconos/icono_flecha_derecha-removebg-preview.png" alt="">
                    </button>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($ver_favoritos): ?>
        <div class="d-flex flex-column divMedio mb-5 py-5">
            <?php if (empty($favoritosUsuario)): ?>
                <div class="d-flex justify-content-center align-items-center m-5">
                    <div class="rounded-3 p-4 bg-white text-center">
                        <h4 class="fw-semibold mb-2">Todavía no tienes productos en favoritos</h4>
                        <p>Cuando pongas tu primer producto en favoritos, aparecerá aquí.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="carruselProductos">
                    <button class="btn flecha-carrusel flecha-izquierda" type="button" onclick="desplazarProductos(this, -1)" aria-label="Pedido anterior">
                        <img src="/Daw2mvc/iconos/icono_flecha_izquierda-removebg-preview.png" alt="">
                    </button>

                    <div class="d-flex divProductos overflow-auto">
                        <?php foreach ($favoritosUsuario as $favorito): ?>
                            <div class="divProducto mx-3 m-md-3 p-4 rounded-4" style="min-width: 280px;">
                                <h5 class="fw-bold">
                                    <?= htmlspecialchars($favorito->getNombre(), ENT_QUOTES, 'UTF-8') ?>
                                </h5>

                                <div class="d-flex justify-content-center">
                                    <img
                                        src="/Daw2mvc/<?= htmlspecialchars($favorito->getImagen(), ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($favorito->getNombre(), ENT_QUOTES, 'UTF-8') ?>"
                                        class="object-fit-contain w-75"
                                    >
                                </div>
                                <a class="btn btn-primary rounded-3 w-100" href="/Daw2mvc/index.php?controller=detalleProducto&amp;action=index&amp;id=<?= urlencode((string) $favorito->getId()) ?>">
                                    Ver producto
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button class="btn flecha-carrusel flecha-derecha" type="button" onclick="desplazarProductos(this, 1)" aria-label="Pedido siguiente">
                        <img src="/Daw2mvc/iconos/icono_flecha_derecha-removebg-preview.png" alt="">
                    </button>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>