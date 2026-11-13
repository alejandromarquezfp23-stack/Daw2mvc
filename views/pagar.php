<form class="container checkout-container py-4" action="index.php?controller=pedidos&action=store" method="POST">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-5">
        <h3 class="fw-semibold mb-0">Finalizar pedido</h3>
        <button type="button" class="btn btn-link text-primary text-decoration-none"
                data-bs-toggle="offcanvas" data-bs-target="#resumenPedido">
            Ver resumen del pedido: <?php echo number_format($total, 2, ',', '.'); ?> €
        </button>
    </div>

    <div class="text-center mb-5">
        <h1 class="fw-semibold mb-3">Ya casi está todo listo.</h1>
        <p class="text-secondary">Revisa tu pedido y confirma la compra.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-5">
                <h4 class="fw-semibold mb-4">Resumen de tu pedido</h4>

                <?php foreach ($productosCarrito as $producto): ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                        <div>
                            <h6 class="fw-semibold mb-1">
                                <?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                            </h6>
                            <small class="text-secondary">
                                Cantidad: <?php echo $producto['cantidad']; ?>
                            </small>
                            <?php foreach ($producto['ingredientes'] as $ingrediente): ?>
                                <div class="small mt-1">
                                    <?php if ($ingrediente['accion'] === 'anadir'): ?>
                                        <span class="text-secondary">Añadido:</span>
                                    <?php else: ?>
                                        <span class="text-secondary">Quitado:</span>
                                    <?php endif; ?>

                                    <span class="text-secondary">
                                        <?php echo htmlspecialchars($ingrediente['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <span class="fw-semibold">
                            <?php echo number_format($producto['subtotal'], 2, ',', '.'); ?> €
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="rounded-3 bg-light p-4 mb-5">
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-secondary">Subtotal</span>
                    <span><?php echo number_format($subtotal, 2, ',', '.'); ?> €</span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-secondary">Descuento</span>
                    <span>0,00 €</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <span class="fw-semibold fs-5">Total</span>
                    <span class="fw-bold fs-5">
                        <?php echo number_format($total, 2, ',', '.'); ?> €
                    </span>
                </div>
            </div>

            <div class="form-check mb-5">
                <input class="form-check-input" type="checkbox"
                       id="terminos" name="terminos" value="1" required>
                <label class="form-check-label" for="terminos">
                    He leído y acepto los términos y condiciones de Appletito.
                </label>
            </div>

            <button type="submit" name="confirmarPedido" value="1"
                    class="btn btn-dark btn-lg rounded-3 w-100 py-3">
                Confirmar pedido
            </button>

            <p class="text-secondary text-center small mt-3">
                Revisa tu pedido antes de confirmarlo.
            </p>
        </div>
    </div>
</form>

<div class="offcanvas offcanvas-end resumen-offcanvas rounded-start-4"
     tabindex="-1" id="resumenPedido"
     aria-labelledby="resumenPedidoLabel">

    <div class="offcanvas-header px-4 pt-4">
        <h4 class="offcanvas-title fw-semibold" id="resumenPedidoLabel">
            Tu pedido
        </h4>
        <button type="button" class="btn-close"
                data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>

    <div class="offcanvas-body px-4">
        <h5 class="fw-semibold mb-4">Artículos</h5>

        <?php foreach ($productosCarrito as $producto): ?>
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <p class="fw-medium mb-1">
                        <?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <small class="text-secondary">
                        Cantidad: <?php echo $producto['cantidad']; ?>
                    </small>
                    <?php foreach ($producto['ingredientes'] as $ingrediente): ?>
                        <div class="small mt-1">
                            <?php if ($ingrediente['accion'] === 'anadir'): ?>
                                <span class="text-secondary">Añadido:</span>
                            <?php else: ?>
                                <span class="text-secondary">Quitado:</span>
                            <?php endif; ?>

                            <span class="text-secondary">
                                <?php echo htmlspecialchars($ingrediente['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <span>
                    <?php echo number_format($producto['subtotal'], 2, ',', '.'); ?> €
                </span>
            </div>
        <?php endforeach; ?>

        <hr>

        <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary">Subtotal</span>
            <span><?php echo number_format($subtotal, 2, ',', '.'); ?> €</span>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary">Descuento</span>
            <span>0,00 €</span>
        </div>

        <hr>

        <div class="d-flex justify-content-between">
            <span class="fw-semibold">Total</span>
            <span class="fw-bold">
                <?php echo number_format($total, 2, ',', '.'); ?> €
            </span>
        </div>
    </div>
</div>