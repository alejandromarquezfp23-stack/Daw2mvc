<section class="container py-5 py-lg-5">
    <div class="mb-4 mb-lg-5">
        <h1 class="fs-2 fw-bold"><?php echo $productoActivo->getNombre(); ?></h1>
        <p class="fs-5 fw-semibold mb-0">Desde <?php echo $productoActivo->getPrecio(); ?> €</p>
    </div>

    <div class="row align-items-center g-4 g-lg-5">
        <div class="col-12 col-md-6">
            <div class="divImagen rounded-4 d-flex justify-content-center align-items-center p-3 p-md-4">
                <img src="/Daw2mvc/<?php echo $productoActivo->getImagen(); ?>"
                    alt="<?php echo $productoActivo->getNombre(); ?>"
                    class="img-fluid w-75">
            </div>
        </div>

        <div class="col-12 col-md-6 p-5">
            <h2 class="h3 fw-semibold">
                Solo tú.
                <span class="text-secondary">¿Cómo lo prefieres?</span>
            </h2>

            <div class="mt-4">
                <?php if (empty($ingredientesActivos)) { ?>
                    <p class="fw-semibold">Este producto no tiene extras disponibles.</p>
                <?php } ?>

                <?php foreach ($ingredientesActivos as $ingrediente) { ?>
                    <div class="position-relative border rounded-3 p-3 mb-3 tarjeta-ingrediente">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <img src="/Daw2mvc/<?php echo $ingrediente->getImagen(); ?>"
                                    alt=""
                                    width="32"
                                    height="32"
                                    class="object-fit-contain">
                                <span class="fw-semibold">
                                    <?php echo $ingrediente->getNombre(); ?>
                                </span>
                            </div>

                            <span class="text-nowrap">
                                +<?php echo number_format($ingrediente->getPrecioExtra(), 2); ?> €
                            </span>
                        </div>
                        <a class="stretched-link"></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<form class="container-fluid bg-light py-4 py-lg-5" method="POST">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-12 col-md-4 text-center text-md-start">
                <h2 class="h3 fw-bold mb-3">
                    <?php echo $productoActivo->getNombre(); ?>
                </h2>
                <img
                    src="/Daw2mvc/<?php echo $productoActivo->getImagen(); ?>"
                    alt="<?php echo $productoActivo->getNombre(); ?>"
                    class="img-fluid w-50">
            </div>

            <div class="col-12 col-md-5">
                <h3 class="fs-5 fw-semibold mb-4">Desde <?php echo $productoActivo->getPrecio(); ?> €</h3>
                <hr>
                <h4 class="fs-6 fw-semibold">¿Necesitas un momento?</h4>
                <p class="small text-secondary my-3">
                    Conserva todas tus selecciones guardando este dispositivo
                    en Tus favoritos. Después, podrás volver cuando quieras
                    y retomar todo donde lo deixaste.
                </p>

                <button type="button" class="btn btn-primary btn-sm rounded-3">
                    Guardar en favoritos
                </button>
                <hr class="my-4">
                <p class="small text-secondary mb-0">
                    Tu información de ticket aparecerá en tu correo electrónico.
                </p>
            </div>

            <div class="col-12 col-md-3">
                <input type="hidden" name="producto_id" value="<?php echo $productoActivo->getId(); ?>">
                <button class="btn btn-primary rounded-3 w-100" type="submit" name="accion" value="continuar">
                    Continuar
                </button>
            </div>
        </div>
    </div>
</form>