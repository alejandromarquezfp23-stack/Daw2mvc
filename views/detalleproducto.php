<section class="container py-5 py-lg-5">
    <div class="mb-4 mb-lg-5">
        <h1 class="fs-2 fw-bold">
            <?php echo htmlspecialchars($productoActivo->getNombre(), ENT_QUOTES, 'UTF-8'); ?>
        </h1>

        <p class="fs-5 fw-semibold mb-0">
            Desde <?php echo number_format($precioCentimos / 100, 2, ',', '.'); ?> €
        </p>
    </div>

    <div class="row align-items-center g-4 g-lg-5">
        <div class="col-12 col-md-6">
            <div class="divImagen rounded-4 d-flex justify-content-center align-items-center p-3 p-md-4">
                <img src="/Daw2mvc/<?php echo $productoActivo->getImagen(); ?>"
                    alt="<?php echo htmlspecialchars($productoActivo->getNombre(), ENT_QUOTES, 'UTF-8'); ?>"
                    class="img-fluid w-75">
            </div>
        </div>

        <div class="col-12 col-md-6 p-5">
            <h2 class="h3 fw-semibold">
                Solo tú.
                <span class="text-secondary">¿Cómo lo prefieres?</span>
            </h2>

            <form id="formProducto" method="POST" action="index.php?controller=productos&amp;action=show&amp;id=<?php echo (int) $productoActivo->getId(); ?>">
                <input type="hidden" name="producto_id" value="<?php echo (int) $productoActivo->getId(); ?>">

                <div class="mt-4">
                    <?php if (empty($ingredientesActivos)) { ?>
                        <p class="fw-semibold">Este producto no tiene extras disponibles.</p>
                    <?php } ?>

                    <?php foreach ($ingredientesActivos as $ingrediente) { ?>
                        <?php $ingredienteId = (int) $ingrediente->getId(); ?>

                        <div class="border rounded-3 p-3 mb-3 tarjeta-ingrediente">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="/Daw2mvc/<?php echo $ingrediente->getImagen(); ?>"
                                        alt=""
                                        width="32"
                                        height="32"
                                        class="object-fit-contain">

                                    <span class="fw-semibold">
                                        <?php echo htmlspecialchars($ingrediente->getNombre(), ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                </div>
                            </div>

                            <label class="form-label small mt-3 mb-1"
                                for="ingrediente-<?php echo $ingredienteId; ?>">
                                Personaliza este ingrediente
                            </label>

                            <select class="form-select" id="ingrediente-<?php echo $ingredienteId; ?>" name="ingredientes[<?php echo $ingredienteId; ?>]">
                                <option value="" <?php echo empty($seleccionesIngredientes[$ingredienteId]) ? 'selected' : ''; ?>>
                                    Sin cambios
                                </option>

                                <option value="anadir" <?php echo ($seleccionesIngredientes[$ingredienteId] ?? '') === 'anadir' ? 'selected' : ''; ?>>
                                    Añadir (+<?php echo number_format($ingrediente->getPrecioExtra(), 2, ',', '.'); ?> €)
                                </option>

                                <option value="quitar" <?php echo ($seleccionesIngredientes[$ingredienteId] ?? '') === 'quitar' ? 'selected' : ''; ?>>
                                    Quitar (−<?php echo number_format($ingrediente->getPrecioExtra(), 2, ',', '.'); ?> €)
                                </option>
                            </select>
                        </div>
                    <?php } ?>

                    <?php if (!empty($ingredientesActivos)) { ?>
                        <button class="btn btn-primary" type="submit" name="accion" value="actualizar">
                            Actualizar precio
                        </button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="container-fluid bg-light py-4 py-lg-5">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">

            <div class="col-12 col-md-4 text-center text-md-start">
                <h2 class="h3 fw-bold mb-3">
                    <?php echo htmlspecialchars($productoActivo->getNombre(), ENT_QUOTES, 'UTF-8'); ?>
                </h2>

                <img src="/Daw2mvc/<?php echo $productoActivo->getImagen(); ?>"
                    alt="<?php echo htmlspecialchars($productoActivo->getNombre(), ENT_QUOTES, 'UTF-8'); ?>"
                    class="img-fluid w-50">
            </div>

            <div class="col-12 col-md-5">
                <h3 class="fs-5 fw-semibold mb-4">
                    Desde <?php echo number_format($precioCentimos / 100, 2, ',', '.'); ?> €
                </h3>

                <?php if ($mensajeFavoritos !== null) { ?>
                    <div class="alert alert-<?php echo htmlspecialchars($tipoMensajeFavoritos, ENT_QUOTES, 'UTF-8'); ?>"
                        role="alert">
                        <?php echo htmlspecialchars($mensajeFavoritos, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php } ?>

                <hr>

                <h4 class="fs-6 fw-semibold">¿Necesitas un momento?</h4>

                <p class="small text-secondary my-3">
                    Conserva todas tus selecciones guardando este producto
                    en Tus favoritos. Después, podrás volver cuando quieras
                    y retomar todo donde lo dejaste.
                </p>

                <?php if ($esFavorito) { ?>

                    <form method="POST" action="index.php?controller=favoritos&action=destroy">
                        <input type="hidden" name="producto_id"
                            value="<?php echo (int) $productoActivo->getId(); ?>">

                        <button type="submit" class="btn btn-secondary btn-sm rounded-3">
                            Eliminar de favoritos
                        </button>
                    </form>

                <?php } else { ?>

                    <form method="POST" action="index.php?controller=favoritos&action=store">
                        <input type="hidden" name="producto_id"
                            value="<?php echo (int) $productoActivo->getId(); ?>">

                        <button type="submit" class="btn btn-primary btn-sm rounded-3">
                            Guardar en favoritos
                        </button>
                    </form>

                <?php } ?>

                <hr class="my-4">

                <p class="small text-secondary mb-0">
                    Tu información de ticket aparecerá en tu correo electrónico.
                </p>
            </div>

            <div class="col-12 col-md-3">
                <button class="btn btn-primary rounded-3 w-100 mt-3"
                    type="submit" name="accion" value="continuar" form="formProducto">
                    Continuar
                </button>
            </div>
        </div>
    </div>
</section>

<div class="bannerCarta d-flex flex-column align-items-center justify-content-center text-center pt-5 mt-5 pb-5 mb-5 px-md-4">
    <div class="w-100 d-flex justify-content-center mb-4">
        <img src="/Daw2mvc/<?php echo $productoActivo->getImagen(); ?>"
            class="img-fluid w-25 rounded-3"
            alt="<?php echo htmlspecialchars($productoActivo->getNombre(), ENT_QUOTES, 'UTF-8'); ?>">
    </div>
</div>
