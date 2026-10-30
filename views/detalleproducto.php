
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito - Producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/detalleproducto.css">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
</head>

<body>

    <?php
        include __DIR__ . '/header3.php';
    ?>

    <div class="d-block divTituloP">
        <h1 class="tituloh1 fw-bold"><?php echo $productoActivo->getNombre(); ?></h1>
        <p class="fw-semibold">Desde <?php echo $productoActivo->getPrecio(); ?> €</p>
    </div>

    <div class="divProducto m-5 d-flex">
        <div class="d-flex justify-content-center align-items-center w-50 m-5 divImagen">
            <img src="/Daw2mvc/<?php echo $productoActivo->getImagen(); ?>"
                alt="<?php echo $productoActivo->getNombre(); ?>"
                class="w-50">
        </div>

        <div class="d-block justify-content-center align-items-center divElementos">
            <h2 class="fw-semibold">
                Solo tu.
                <span class="text-secondary fw-semibold">
                    ¿Como lo prefieres?
                </span>
            </h2>

            <div class="p-5 mb-5 mt-5" style="max-height: 300px; overflow-y: auto;">
                <?php foreach ($ingredientesActivos as $ingrediente) { ?>

                    <div class="border border-black rounded-3 p-4 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">
                                <?php echo $ingrediente->getNombre(); ?>
                            </span>

                            <span>
                                +<?php echo number_format($ingrediente->getPrecioExtra(), 2); ?> €
                            </span>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>

    <div class="container-fluid bg-light p-5">
        <div class="row align-items-center g-5 m-5">
            <div class="col-12 col-md-4">
                <h2 class="fw-bold mb-5">
                    <?php echo $productoActivo->getNombre(); ?>
                </h2>
                <img
                    src="/Daw2mvc/<?php echo $productoActivo->getImagen(); ?>"
                    alt="<?php echo $productoActivo->getNombre(); ?>"
                    class="img-fluid w-50"
                >
            </div>

            <div class="col-12 col-md-5">
                <h3 class="fs-5 fw-semibold mb-4">
                    Desde precio€
                </h3>
                <hr>
                <h4 class="fs-6 fw-semibold">
                    ¿Necesitas un momento?
                </h4>
                <p class="small text-secondary my-3">
                    Conserva todas tus selecciones guardando este dispositivo
                    en Tus favoritos. Después, podrás volver cuando quieras
                    y retomar todo donde lo dejaste.
                </p>
                <button class="btn btn-primary btn-sm rounded-3">
                    Guardar en favoritos
                </button>
                <hr class="my-4">
                <p class="small text-secondary mb-0">
                    Tu información de ticket aparecerá en tu correo electrónico.
                </p>
            </div>

            <div class="col-12 col-md-3">
                <button class="btn btn-primary rounded-3 w-100">
                    Continuar
                </button>
            </div>
        </div>
    </div>

    <?php
        include __DIR__ . '/footer.php';
    ?>
</body>
</html>
